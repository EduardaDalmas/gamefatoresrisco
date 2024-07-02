@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="mb-3 row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('home') }}"> <i class="bi bi-arrow-left-short icone"></i></a>
                            </div>
                            <div class="col">
                                <h4 class="m-0">Editar questionário</h4>
                            </div>
                        </div>
                       
                        <form id="questionnaire-form-edit" action="{{ route('questionnaire.update', ['questionnaire' => $questionnaire->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label for="name" id="labelNome">Nome do questionário</label><span class="text-danger fw-bold"> *</span>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $questionnaire->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="team_name" class="form-label">
                                    Grupo de Participantes <i class="bi bi-people-fill"></i> <span class="text-danger fw-bold"> *</span>
                                </label>
                                <select class="form-select js-example-basic-multiple" id="teams" name="teams[]" data-placeholder="Escolha os grupos de participantes" multiple="multiple">
                                    @foreach ($teams_avaibles as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                @foreach($questionnaire_teams as $team)
                                    <div class="row">
                                        <div class="col-8">{{ $team->name }}</div>
                                        <div class="col-2">
                                            <a class="btn btn-danger" href="{{ route('teams.detach_questionnaire', [$team->id, $questionnaire->id])}}">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <br><hr><br>
                                @endforeach 
                            </div>
                            <div class="mb-3">
                                <label for="description" id="labelObjetivo">Objetivo</label>
                                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') ?? $questionnaire->description }}</textarea>
                            </div>
                            <div class="form-check col-12 mb-4">
                                <input class="form-check-input" type="checkbox" name="roulette" id="roulette" {{ $questionnaire->roulette ? 'checked' : '' }} >
                                <label class="form-check-label" for="roulette">
                                    Utilizar a roleta
                                </label>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Você deseja apresentar as perguntas de que maneira?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="presentation" id="random" value="random" {{ $questionnaire->random ? 'checked' : '' }}>
                                    <label class="form-check-label" for="random">
                                        Aleatório
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="presentation" id="sequential" value="sequential" {{ $questionnaire->roulette ? '' : 'checked' }}>
                                    <label class="form-check-label" for="sequential">
                                        Sequencial
                                    </label>
                                </div>
                            </div>
                            <h5>Temas/Sessão</h5>
                            <div class="">
                                <div class="">
                                    <div class="col-auto">
                                        <label for="topic" id="labeTopic">Nome do Tema</label>
                                        <input type="text" class="form-control" id="topic" name="topic" value="{{ old('topic') }}">
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-outline-success btn-sm mt-2" id="addTopic">Adicionar</button>
                                    </div>
                                </div>
                            </div>
                            @foreach($questionnaire->topics as $topic)
                                <div class="row mb-2 mt-5">
                                    <div class="col-8">{{ $topic->name }}</div>
                                    <div class="col-2"><a href="{{ route('topic.edit', $topic) }}" class="btn btn-outline-primary btn-sm">editar</a></div>
                                    <div class="col-2"><a href="{{ route('topic.delete', $topic) }}" class="btn btn-outline-danger btn-sm">excluir</a></div>
                                </div>
                                <br><hr><br>
                            @endforeach 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection
