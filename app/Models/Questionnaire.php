<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

use App\Models\Pivot\QuestionnaireTeam;
use Illuminate\Support\Facades\Auth;

class Questionnaire extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($questionnaire) {
            $questionnaire->user()->associate(Auth::user());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'questionnaire_team')
                    ->using(QuestionnaireTeam::class);
    }

    public function getOpenTopics() : Collection
    {
        return $this->topics()
            ->whereHas('questions', function($query){
                $query->pending();
            })
            ->get();
    }

    public static function getOpenedsCurrentUser() : Collection {
        return self::all();
    }

    public static function getByOwner() : Collection {
        return self::where('user_id', auth()->id())->get();
    }
}
