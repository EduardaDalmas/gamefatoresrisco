@extends('logged')

@section('page')
<div class="container bg-white rounded">
    <div class="row justify-content-center p-3">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Grupo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['questionnaire_team_people'] as $questionnaire_team)
                    <tr>
                        <td>{{ $questionnaire_team->name }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row justify-content-center p-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Pessoa</th>
                                            <th scope="col">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($questionnaire_team->people as $person)
                                            @foreach ($data['person_answers'] as $person_answer)
                                                @if (($person->id == $person_answer->id) and (count($person_answer->answers) > 0))
                                                    <tr>
                                                        <td>{{ $person->name }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-light">
                                                                <a href="{{ route('answer.show', [$person->id, $questionnaire_team['questionnaires'][0]->id ]) }}">Questionário {{ $questionnaire_team['questionnaires'][0]->id }}</a>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endif
                                                
                                                @if (($person->id == $person_answer->id) and (count($person_answer->answers) == 0))
                                                    <tr>
                                                        <td>{{ $person->name }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-light" disabled>Ver Respostas</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

