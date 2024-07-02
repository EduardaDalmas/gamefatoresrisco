@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="mb-3 row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('teams.index') }}"> <i class="bi bi-arrow-left-short icone"></i></a>
                            </div>
                            <div class="col-auto">
                                <h4>{{ $data['team']->name }}</h4>
                            </div>
                        </div>

                    <div class="card p-3">
                        <div class="card-body col-auto">
                            <div class="mb-3 col-auto">
                                <form action="{{ route('teams.update', ['team' => $data['team']->id]) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="d-flex row align-items-end">
                                        <div class="col-auto">
                                            <label for="team_name" class="form-label">
                                                Novo Partipante <i class="bi bi-people-fill"></i> <span class="text-danger fw-bold"></span>
                                            </label>
                                            <select class="form-select" aria-label="Default select example" id="person_id" name="person_id" >
                                                <option selected>Selecione o Participante</option>
                                                @foreach ($data['people_avaibles'] as $person)
                                                    <option value="{{ $person->id }}">{{ $person->user->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-custom">Adicionar</button>
                                        </div>
                                    </div>
                                        
                                    
                                </form>
                            </div>
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Participante</th>
                                            <th scope="col">Email</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['people_team'] as $team)
                                            <tr>
                                                <td>{{ $team->name }}</td>
                                                <td>{{ $team->user->email }}</td>
                                                <td>
                                                
                                                    <form id="delete-form-{{ $team->id }}" action="{{ route('teams.destroy-person', $data['team']->id) }}" method="POST" >
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" id="person_team_id" name="person_team_id" value="{{ $team->id }}" style="display: none;">
                                                        <button class="btn btn-danger" type="submit" >
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
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
