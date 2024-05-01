<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Pivot\PersonTeam;
use App\Models\Pivot\QuestionnaireTeam;

class Team extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function people()
    {
        return $this->belongsToMany(Person::class, 'person_team')
                    ->using(PersonTeam::class);
    }

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class, 'questionnaire_team')
                    ->using(QuestionnaireTeam::class);
    }
}
