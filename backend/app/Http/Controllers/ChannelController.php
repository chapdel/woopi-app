<?php

namespace App\Http\Controllers;

use App\Events\ChannelUpdated;
use App\Http\Resources\Channel\ChannelResource;
use App\Http\Resources\Channel\ChannelResourceCollection;
use App\Models\Channel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(new ChannelResourceCollection(auth()->user()->joinedChannels()->sortBy(['lastMessageTime', "DESC"])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'min:10'],
            'visibility' => ['nullable', 'in:public,private,protected']
        ]);

        return response()->json(new ChannelResource($request->user()->channels()->create([
            'name' => $request->name,
            'description' => $request->description,
            'visibity' => $request->visibility ?? 'public'
        ])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRoom(Channel $channel, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'min:10'],
            'visibility' => ['nullable', 'in:public,restricted']
        ]);

        return response()->json($channel->rooms()->create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'visibity' => $request->visibility ?? 'public'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {

        return response()->json(new ChannelResource($channel));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function messages(Room $room)
    {
        $room->messages = $room->messages;
        return response()->json($room);
    }

    public function addMember(Channel $channel, Request $request)
    {
        $request->validate([
            'user' => [
                'required', 'exists:users,uid',
            ],
            'role' => ['nullable', 'in:admin,moderator,member']
        ]);

        $channel->members()->create([
            'user_id' => User::whereUid($request->uid)->first()->id,
            'role' => $request->role ?? 'member'
        ]);

        return response()->json();
    }

    public function sendMessage(Room $room, Request $request)
    {
        $request->validate([
            'message' => ['required']
        ]);

        $message = $room->messages()->create([
            'content' => $request->message,
            'fuid' => $request->fuid,
            'user_id' => auth()->id()
        ]);

        return response()->json($message);
    }

    public function join(Channel $channel, Request $request)
    {
        $channel->members()->create([
            'user_id' => auth()->id()
        ]);

        return response()->json();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'min:10'],
            'visibility' => ['nullable', 'in:public,private,protected'],
            'uid' => ['nullable', 'unique:channels,uid']
        ]);

        $channel->update($request->all());

        $channel = $channel->refresh();

        event(new ChannelUpdated($channel));

        return response()->json(new ChannelResource($channel));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        $channel->delete();

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function leave(Channel $channel)
    {
        $channel->members()->whereUserId(auth()->id())->delete();

        return response()->json();
    }
}
