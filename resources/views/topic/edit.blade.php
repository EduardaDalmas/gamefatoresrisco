@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card centralizar p-5">
                    <div class="card-body">
                        <a href="{{ route('questionnaire.edit', ['questionnaire' => $topic->questionnaire]) }}">Voltar</a>
                        <div class="mb-3 centralizar">
                            <h4>{{ $topic->name }}</h4>
                        </div>

                        <form method="POST" action="{{ route('question.save', ['topic' => $topic]) }}">
                            @csrf
                            <div class="form-group col-12">
                                <label for="pergunta">Adicionar pergunta</label>
                                <textarea class="form-control" name="pergunta" id="pergunta" style="width: 100%" rows="4"></textarea>
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                        <br><hr><br>
                        @foreach($questions as $question)
                            <div class="col-12">
                                <div class="row col-12">
                                    <h4>{{ $question->description }}</h4>
                                </div>
                                <div class="row">
                                    <div class="col-4 form-group">
                                        <label for="ratio">Peso</label>
                                        <input class="form-control" type="number" id="ratio" value="{{ $question->ratio }}" {{ $question->trashed() ? 'disabled' : '' }}>
                                    </div>
                                    <div class="col-4 form-group">
                                        <input class="form-check-input" type="checkbox" name="texto_livre" id="texto_livre" {{ $question->text ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="texto_livre">
                                            Resposta em Texto Livre?
                                        </label>
                                    </div>
                                    @if($question->trashed())
                                        <div class="col-2 form-group">
                                            <label>-</label>
                                            <a href="{{ route('question.restore', ['question' => $question]) }}" class="btn btn-primary">Reativar</a>
                                        </div>
                                    @else
                                        <div class="col-2 form-group">
                                            <label>-</label>
                                            <a href="{{ route('question.view', ['question' => $question]) }}" class="btn btn-primary">Opções</a>
                                        </div>
                                        <div class="col-2 form-group">
                                            <label>-</label>
                                            <a href="{{ route('question.delete', ['question' => $question]) }}" class="btn btn-danger">Excluir</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>