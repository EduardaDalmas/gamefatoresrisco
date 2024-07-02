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
                            <div class="col-auto">
                                <h4>Grupos de participantes</h4>
                            </div>
                        </div>
                    <div class="card p-3">
                        <div class="card-body col-auto">
                            <div class="mb-3 col-auto">
                                <form action="{{ route('teams.store') }}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <div class="d-flex row align-items-end">
                                        <div class="col-auto">
                                            <label for="team_name" class="form-label">
                                                Novo Grupo <i class="bi bi-people-fill"></i> <span class="text-danger fw-bold"></span>
                                            </label>
                                            <input type="text" class="form-control" id="team_name" name="team_name" placeholder="Nome do Grupo">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-outline-success btn-sm">Adicionar</button>
                                        </div>
                                    </div>
                                        
                                    
                                </form>
                            </div>
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Pessoas</th>
                                            <th scope="col">Questionário</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $team)
                                            <tr>
                                                <td>{{ $team->name }}</td>
                                                <td>{{ $team->people_count }}</td>
                                                <td>
                                                    @foreach ($team->questionnaires as $questionnaire)
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <span class="badge rounded-pill bg-primary mb-1">{{ $questionnaire->name }}</span>
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-auto">
                                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('teams.edit', [$team->id] ) }}">Editar</a>
                                                        </div>
                                                        <div class="col-auto">
                                                            <form id="delete-form-{{ $team->id }}" action="{{ route('teams.destroy', $team->id) }}" method="POST" >
                                                                @csrf
                                                                @method('POST')
                                                                <input type="hidden" id="team_id" name="team_id" value="{{ $team->id }}" style="display: none;">
                                                                <button class="btn btn-outline-danger btn-sm" type="submit" >
                                                                    {{-- <i class="bi bi-trash"></i> --}}
                                                                    Excluir
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
