@extends('logged')

@section('page')
<div class="container bg-white rounded">
    <div class="row justify-content-center p-5">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Questionário</th>
                <th scope="col">Pessoal</th>
                <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($answerByQuestionnaireAndPerson as $row)
                <tr>
                    <td>{{$row->questionnaires_name}}</td>
                    <td>{{$row->people_name}}</td>
                    <td>
                        <button type="button" class="btn btn-primary">
                            <a href="{{ route('logout', []) }}" target="_blank" rel="noopener noreferrer">Detalhes</a>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

