@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card centralizar p-5">
                    <div class="card-body">
                        <div class="mb-3 row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('topic.edit', ['topic' => $question->topic]) }}"> <i class="bi bi-arrow-left-short icone"></i></a>
                            </div>
                            <div class="col-auto">
                                <h4>Opções de resposta</h4>
                            </div>
                        </div>
                        
                        <div class="mb-3 centralizar">
                            <h5 style="color: black">{{ $question->description }}</h5>
                        </div>

                        <form method="POST" action="{{ route('option.save', ['question' => $question]) }}">
                            @csrf
                            <div class="form-group col-12">
                                <label for="resposta">Adicionar opção de resposta</label>
                                <textarea class="form-control" name="resposta" id="resposta" style="width: 100%" rows="4"></textarea>
                            </div>
                            <div class="form-group centralizar">
                                <button type="submit" class="btn btn-custom">Salvar</button>
                            </div>
                        </form>
                        <br><hr><br>
                        <div class="mb-3 centralizar">
                            <h5 style="color: black">Alternativas</h5>
                        </div>

                    
                        <div class="container mt-5">
                            <!-- Cabeçalhos das colunas -->
                            <div class="row mb-3">
                                <div class="col-8">
                                    <strong>Descrição</strong>
                                </div>
                                <div class="col-2">
                                    <strong>Peso</strong>
                                </div>
                                <div class="col-2">
                                    <strong>Opções</strong>
                                </div>
                            </div>
                        
                            <!-- Loop através das opções -->
                            @foreach ($options as $index => $option)
                                <div class="row mb-3">
                                    <!-- Radio button e label -->
                                    <div class="col-8">
                                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio{{ $index }}" autocomplete="off" value="{{ $option->id }}">
                                        <label class="btn btn-outline-info mb-0 ms-2" for="vbtn-radio{{ $index }}">{{ $option->name }} - {{ $option->description }}</label>
                                    </div>
                                    
                                    <!-- Input de Peso -->
                                    <div class="col-2 form-group">
                                        <input class="form-control" type="number" id="ratio{{ $index }}" value="{{ $option->ratio }}" {{ $option->trashed() ? 'disabled' : '' }}>
                                    </div>
                                    
                                    <!-- Botão Restaurar ou Excluir -->
                                    <div class="col-2 form-group">
                                        @if ($option->trashed())
                                            <a href="{{ route('option.restore', ['option' => $option]) }}" class="btn btn-primary">Reativar</a>
                                        @else
                                            <a href="{{ route('option.delete', ['option' => $option]) }}" class="btn btn-danger">Excluir</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>