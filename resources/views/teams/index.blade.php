@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="mb-3 d-flex row align-items-center w-100 flex-nowrap">
                    <div class="col-auto">
                        <a href="{{ route('home') }}">
                            <i class="bi bi-arrow-left-short icone"></i>
                        </a>
                    </div>
                    <div>
                        <h1 class="m-0 h4">Grupos de Participantes</h1>
                    </div>
                </div>
                <div class="card p-3">
                    <div class="card-body col-auto">
                        <div class="mb-3 col-auto">
                            <form action="" method="POST">
                                @method('POST')
                                @csrf
                                <div class="d-flex row align-items-end">
                                    <div class="col-auto">
                                        <label for="team_name" class="form-label">
                                            Grupo <i class="bi bi-people-fill"></i> <span class="text-danger fw-bold"> *</span>
                                        </label>
                                        <input type="text" class="form-control" id="team_name" placeholder="name@example.com">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn text-white" style="background-color: #F615E0;">Salvar</button>
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
                                                <button type="button" class="btn" style="background-color: #F615E0;">
                                                    <a class="text-white" href="{{ route('teams.show', [$team->id] ) }}">Ver Detalhes</a>
                                                </button>
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
@endsection