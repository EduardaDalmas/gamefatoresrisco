@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="mb-3 row align-items-center">
                            <div class="col-auto">
                                <h4>Relatórios</h4>
                            </div>
                        </div>
                        <hr>
                        @foreach ($questionnaires as $questionnaire)
                            <div class="col-lg-12 mb-4">
                                <div class="card card-custom">
                                    <div class="card-body">
                                        <!-- Conteúdo da pergunta -->
                                        <div class="row mb-2">
                                            <div class="col-lg-4">
                                                <h6>Questionário</h6>
                                                <h5>{{ $questionnaire->name }}</h5>
                                            </div>
                                            <div class="col-lg-4">
                                                <h6>Quantidade respostas</h6>
                                                <h5>{{ $questionnaire->responded_people }} / {{ $questionnaire->total_people }}</h5>
                                            </div>
                                            <div class="col-4 ">
                                                <div class="text-center">
                                                    <h6>Respostas</h6>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('dashboard.questionnaire', ['questionnaire' => $questionnaire]) }}" class="btn btn-custom btn-sm">Gerais</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                       
                                        @foreach($questionnaire->teams as $team)
                                            <div class="row">
                                                <div class="col-9">
                                                   <h6>Grupo</h6>
                                                    {{ $team->name }}
                                                </div>
                                                <div class="col-3">
                                                    <h6>Respostas</h6>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('dashboard.team', ['questionnaire' => $questionnaire, 'team' => $team]) }}" class="btn btn-custom btn-sm">Time</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection