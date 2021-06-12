<?php

namespace App\Models;

use Antonrom\ModelChangesHistory\Traits\HasChangesHistory;
use App\Traits\HasMembers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Channel extends Model
{
    use HasFactory;
    use HasChangesHistory;
    use SoftDeletes;
    use HasMembers;

    protected $guarded = ['id'];
    protected $appends = ['member_status', 'home', 'lastMessageTime'];
    //protected $with = ['members'];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uid = self::uid($model->name);
        });

        static::created(function ($model) {
            $model->members()->create(['user_id' => $model->user_id, 'role' => 'superadmin']);

            $model->rooms()->create([
                'user_id' => $model->user_id,
                'name' => "general"
            ]);
            $model->rooms()->create([
                'user_id' => $model->user_id,
                'name' => "off-topic"
            ]);
        });
    }

    public function getMemberStatusAttribute()
    {
        $member = $this->members()->whereUserId(auth()->id())->first();

        if ($member) {
            return 'member';
        }

        return 'guest';
    }

    public function getLastMessageTimeAttribute()
    {

        $msg =  Message::whereIn('room_id', $this->rooms()->get()->pluck('id'))->first();

        return $msg ? $msg->created_at : null;
    }

    public function getHomeAttribute()
    {
        return $this->rooms()->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    protected static function uid($name)
    {
        $name = Str::slug($name);
        if (self::whereUid($name)->first()) {
            return self::uid($name . '-' . Str::random(3));
        }
        return $name;
    }
}
