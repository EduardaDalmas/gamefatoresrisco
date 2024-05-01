<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};



class Topic extends Model
{
    protected $fillable = ['questionnaire_id', 'media_id', 'name'];

    public function questionnaire(): BelongsTo
    {
        return $this->belongsTo(Questionnaire::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function getCurrentQuestion(): ?Question
    {
        return $this->questions()->pending()->first();
    }
    
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
}
