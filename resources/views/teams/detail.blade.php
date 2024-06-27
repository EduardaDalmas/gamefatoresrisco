@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="mb-3 d-flex row align-items-center w-100 flex-nowrap">
                    <div class="col-auto">
                        <a href="{{ route('teams.index') }}">
                            <i class="bi bi-arrow-left-short icone"></i>
                        </a>
                    </div>
                    <div>
                        <h1 class="m-0 h4">Participantes</h1>
                    </div>
                </div>
                <div class="card p-3">
                    <div class="card-body col-auto">
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $people)
                                        <tr>
                                            <td>{{ $people->name }}</td>
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
