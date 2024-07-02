<?php

namespace App\Services\Reports;

use App\Models\Questionnaire;
use App\Models\Team;
use App\Models\Topic;

class QuantityService
{
    protected $answers;

    public function __construct(Questionnaire $questionnaire, Team $team = null)
    {
        // Carregar todas as topics com suas relações
        $topics = Topic::with([
            'questions.options.answers' => function ($query) {
                $query->with(['person', 'option']);
            }
        ])->where('questionnaire_id', $questionnaire->id)->get();

        // Filtrar as respostas com base no team, se fornecido
        if ($team) {
            $topics->each(function ($topic) use ($team) {
                $topic->questions->each(function ($question) use ($team) {
                    $question->options->each(function ($option) use ($team) {
                        $option->answers = $option->answers->filter(function ($answer) use ($team) {
                            return $answer->person->teams->contains('id', $team->id);
                        });
                    });
                });
            });
        }

        $this->topics = $topics;
    }

    public function get(): array
    {
        $report = [];

        foreach ($this->topics as $topic) {
            $topicData = [
                'topic' => $topic->name,
                'questions' => []
            ];

            foreach ($topic->questions as $question) {
                $questionData = [
                    'question' => $question->description,
                    'options' => []
                ];

                foreach ($question->options as $option) {
                    $optionData = [
                        'option' => $option->description,
                        'answers' => $option->answers->count(),
                    ];

                    $questionData['options'][] = $optionData;
                }

                $topicData['questions'][] = $questionData;
            }

            $report[] = $topicData;
        }

        return $report;
    }

    function toJson(): String
    {
        return json_encode($this->get());
    }
}