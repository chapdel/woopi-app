<?php

namespace App\Models;

use App\Interfaces\MustVerifyAccount;
use App\Traits\VerifyAccount;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable //implements MustVerifyAccount
{
    use HasFactory, Notifiable;
    use SoftDeletes;
    use HasApiTokens;
    use Bannable;
    use VerifyAccount;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->bio = "Hi, i'm on Woopi";
        });
    }

    /**
     * Determine if BannedAtScope should be applied by default.
     *
     * @return bool
     */
    public function shouldApplyBannedAtScope()
    {
        return true;
    }

    /**
     * Route notifications for the Nexmo channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForNexmo($notification)
    {
        return $this->phone;
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function scopeJoinedChannels()
    {
        $channels = $this->channels;

        $channels->union(Channel::whereIn('id', Member::whereUserId(auth()->id())->where('memberable_type', Channel::class)->get()->pluck('id')));

        return $channels;
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
