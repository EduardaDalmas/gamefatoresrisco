@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card centralizar p-5">
                    <div class="card-body">
                        <a href="{{ route('topic.edit', ['topic' => $question->topic]) }}">Voltar</a>
                        <div class="mb-3 centralizar">
                            <h4>{{ $question->description }}</h4>
                        </div>

                        <form method="POST" action="{{ route('option.save', ['question' => $question]) }}">
                            @csrf
                            <div class="form-group col-12">
                                <label for="resposta">Adicionar opção de resposta</label>
                                <textarea class="form-control" name="resposta" id="resposta" style="width: 100%" rows="4"></textarea>
                            </div>
                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                        <br><hr><br>
                        @foreach($options as $option)
                            <div class="col-12">
                                <div class="row col-8">
                                    <h4>{{ $option->name }}</h4>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <p>{{ $option->description }}</p>
                                    </div>
                                    <div class="col-2 form-group">
                                        <label for="ratio">Peso</label>
                                        <input class="form-control" type="number" id="ratio" value="{{ $option->ratio }}" {{ $option->trashed() ? 'disabled' : '' }}>
                                    </div>
                                    @if($option->trashed())
                                        <div class="col-2 form-group">
                                            <label> - </label>
                                            <a href="{{ route('option.restore', ['option' => $option]) }}" class="btn btn-primary">Reativar</a>
                                        </div>
                                    @else
                                        <div class="col-2 form-group">
                                            <label> - </label>
                                            <a href="{{ route('option.delete', ['option' => $option]) }}" class="btn btn-danger">Excluir</a>
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