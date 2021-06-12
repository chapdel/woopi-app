<?php

namespace App\Traits;

use App\Models\Member;
use Illuminate\Database\Eloquent\Relations\MorphTo;

trait HasMembers
{
    public function members()
    {
        return $this->morphMany(Member::class, 'memberable')->with('user');
    }

    public function memberable(): MorphTo
    {
        return $this->morphTo('memberable');
    }
}
