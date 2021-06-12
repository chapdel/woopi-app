<?php

namespace App\Http\Resources\Channel;

use App\Http\Resources\Member\MemberResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'uid' => $this->uid,
            'description' => $this->description,
            'visibility' => $this->visibility,
            'member_status' => $this->member_status,
            'members' => new MemberResourceCollection($this->members),
            'rooms' => $this->rooms->sortBy([
                'lastMessageTime',
                'DESC'
            ]),
            'home' => $this->home
        ];
    }
}
