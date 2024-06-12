<?php

namespace App\Console\Commands;

use App\Models\Person;
use App\Models\Questionnaire;
use App\Models\Team;
use Illuminate\Console\Command;

class dev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cria:turma';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $team = Team::firstOrNew(['name' => 'Default Team']);
        if (!$team->exists) {
            $team->save();
        }

        $persons = Person::all();
        $team->people()->sync($persons->pluck('id')->toArray());

        $questionnaires = Questionnaire::all();
        $team->questionnaires()->sync($questionnaires->pluck('id')->toArray());
    }
}
