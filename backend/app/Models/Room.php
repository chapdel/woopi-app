<?php

namespace App\Models;

use Antonrom\ModelChangesHistory\Traits\HasChangesHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Room extends Model
{
    use HasFactory;
    use HasChangesHistory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $with = ['user'];
    protected $appends = ['lastMessage', 'lastMessageTime'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uid = self::uid();
        });

        static::created(function ($model) {

            $model->messages()->create([
                'user_id' => $model->user_id,
                'content' => "room_welcome",
                'type' => 'system'
            ]);
        });
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getLastMessageAttribute()
    {
        return $this->messages()->orderBy('created_at', 'desc')->first();
    }

    public function getLastMessageTimeAttribute()
    {
        $message = $this->LastMessage;

        return $message ? $message->created_at : null;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    protected static function uid()
    {
        $name = Str::random(16);
        if (self::whereUid($name)->first()) {
            return self::uid();
        }
        return $name;
    }
}
