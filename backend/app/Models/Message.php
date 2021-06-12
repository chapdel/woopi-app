<?php

namespace App\Models;

use Antonrom\ModelChangesHistory\Traits\HasChangesHistory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasChangesHistory;
    protected $guarded = ['id'];
    protected $with = ['user'];


    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uid = self::uid();
        });
    }




    public function user()
    {
        return $this->belongsTo(User::class);
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
