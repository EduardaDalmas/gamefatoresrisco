<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['option_id', 'text_answer', 'person_id'];

    public function option()
    {
        return $this->belongsTo(Option::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
