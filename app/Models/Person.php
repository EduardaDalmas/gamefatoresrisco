<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Pivot\PersonTeam;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany, BelongsTo};


class Person extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'person_team')
                    ->using(PersonTeam::class);
    }
}
