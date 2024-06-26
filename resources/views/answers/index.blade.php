@extends('logged')

@section('page')
<div class="container bg-white rounded p-5">
    <div class="d-flex flex-row align-items-center">
        <div>
            <button class="btn-md border rounded p-2">
                <a href="{{ route('home') }}">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </button>
        </div>
        <div class="ms-3">
            <h1 class="h1 text-dark">{{ $data['questionnaire']->name }}</h1>
        </div>
    </div>
    <div class="">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <i class="bi bi-people-fill"></i> Grupos
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['teams'] as $questionnaire_team)
                    <tr>
                        <td>
                            <button id="button-collapse-control" class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $questionnaire_team->name }}" aria-expanded="false" aria-controls="{{ $questionnaire_team->name }}">
                                <i id="button-collapse-control-icon" class="bi bi-chevron-expand"></i>
                            </button>
                            {{ $questionnaire_team->name }}
                        </td>
                    </tr>
                    <tr class="collapse" id="{{ $questionnaire_team->name }}">
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
                                            <tr>
                                                <td>
                                                    <i class="bi bi-person-fill"></i> {{ $person->name }}
                                                </td>
                                                @if ($person->answers_count > 0)
                                                    <td>
                                                        <button type="button" class="btn btn-light">
                                                            <a href="{{ route('answer.show', [$person->id, $questionnaire_team['questionnaires'][0]->id ]) }}">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                        </button>
                                                    </td>
                                                @else
                                                    <td>
                                                        <button type="button" class="btn btn-light" disabled>
                                                            <a href="">
                                                                <i class="bi bi-eye-slash"></i>
                                                            </a>
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                               
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

<script>
    document.getElementById('button-collapse-control').onclick = function (e) {
        if(e.target.getAttribute('aria-expanded') == "true") {
            document.getElementById('button-collapse-control-icon').className = "bi bi-chevron-contract"
        } else if(e.target.getAttribute('aria-expanded') == "false") {
            document.getElementById('button-collapse-control-icon').className = "bi bi-chevron-expand"
        }
    }
</script>
@endsection

