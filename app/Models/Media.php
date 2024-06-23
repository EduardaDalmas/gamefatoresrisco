<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Media extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($media) {
            $media->user()->associate(Auth::user());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getByOwner()
    {
        return static::where('user_id', Auth::id())->get();
    }
}