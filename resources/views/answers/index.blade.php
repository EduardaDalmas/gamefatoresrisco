@extends('logged')

@section('page')
<div class="container bg-white rounded">
    <div class="row justify-content-center p-5">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Questionário</th>
                <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($team_people as $team)
                    @foreach ($team as $person)
                        <tr>
                            <td>{{$person->name}}</td>
                            <td>
                                <button type="button" class="btn btn-primary">
                                    <a href="" target="_self" rel="noopener noreferrer" class="text-white">Ver Respostas</a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

