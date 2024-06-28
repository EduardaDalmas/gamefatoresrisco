<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Model, SoftDeletes};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasManyThrough};
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    use SoftDeletes;
    protected $fillable = ['topic_id', 'media_id'];

    protected static function booted()
    {
        static::addGlobalScope('order', function (Builder $query) {
            $query->orderBy('order');
            $query->orderBy('id');
        });
    }

    public function scopePending(Builder $query): void
    {
        $query->whereHas('options');
        $query->whereDoesntHave('answers', function (Builder $query) {
            $query->where('person_id', Auth::user()->person->id);
        });
    }


    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function answers(): HasManyThrough
    {
        return $this->hasManyThrough(Answer::class, Option::class);
    }
}
