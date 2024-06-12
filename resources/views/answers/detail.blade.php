@extends('logged')

@section('page')
<div class="container bg-white rounded">
    <div class="row justify-content-center p-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tema</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['questionnaire_estructure'] as $topic)
                    <tr>
                        <td>{{ $topic->name }}</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row justify-content-center p-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Questão</th>
                                            <th scope="col">Peso</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($topic->questions as $question)
                                            <tr>
                                                <td>{{ $question->description }}</td>
                                                <td>{{ $question->ratio }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="row justify-content-center p-3">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Alternativas</th>
                                                                    <th scope="col">Peso</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($data['answers_estructure'] as $answer)
                                                                    @foreach ($question->options as $option)
                                                                        @if(($answer->topic->id == $topic->id) and ($answer->question->id == $question->id) and ($answer->option_id == $option->id))
                                                                            <tr class="bg-primary">
                                                                                <td>{{ $option->name }}</td>
                                                                                <td>{{ $option->ratio }}</td>
                                                                            </tr>
                                                                        @endif
                                                                        @if(($answer->topic->id == $topic->id) and ($answer->question->id == $question->id) and ($answer->option_id != $option->id))
                                                                            <tr>
                                                                                <td>{{ $option->name }}</td>
                                                                                <td>{{ $option->ratio }}</td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

