@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card centralizar p-5">
                    <div class="card-body">
                        <form action="{{ route("questionnaire.update", ['questionnaire' => $questionnaire->id]) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group col-12">
                                <label for="name" id="labelNome">Questionário</label><span class="text-danger fw-bold"> *</span>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $questionnaire->name }}">
                            </div>
                            <div class="form-group col-12">
                                <label for="description" id="labelObjetivo">Objetivo</label>
                                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') ?? $questionnaire->description }}</textarea>
                            </div>
                            <div class="form-check col-12">
                                <input class="form-check-input" type="checkbox" name="roulette" id="roulette" {{ $questionnaire->roulette ? 'checked' : '' }}>
                                <label class="form-check-label" for="roulette">
                                    Utilizar a roleta
                                </label>
                            </div>
                            <div class="mb-3">
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
                            <div class="form-group col-12">
                                <label for="topic" id="labeTopic">Nome do Tema</label>
                                <input type="text" class="form-control" id="topic" name="topic" value="{{ old('topic') }}">
                            </div>
                            @foreach($questionnaire->topics as $topic)
                                <div class="row">
                                    <div class="col-8">{{ $topic->name }}</div>
                                    <div class="col-2"><a href="{{ route('topic.edit', $topic) }}" class="btn btn-primary">editar</a></div>
                                    <div class="col-2"><a href="{{ route('topic.delete', $topic) }}" class="btn btn-danger">excluir</a></div>
                                </div>
                            @endforeach
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
