@extends('logged')

@section('page')
<div class="container bg-white rounded p-5">
    <div class="d-flex flex-row align-items-center">
        <div>
            <button class="btn-md border rounded p-2">
                <a href="{{ route('answer.index', $data['questionnaire']) }}">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </button>
        </div>
        <div class="ms-3">
            <h1 class="h1 text-dark">{{ $data['person']->name }}</h1>
        </div>
    </div>
    <div class="">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        <i class="bi bi-people-fill"></i> Tópicos
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['estructure_questionnaire'] as $topic)
                    <tr>
                        <td>
                            <button id="button-collapse-control" class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $topic->name }}" aria-expanded="false" aria-controls="{{ $topic->name }}">
                                <i id="button-collapse-control-icon" class="bi bi-chevron-expand"></i>
                            </button>
                            {{ $topic->name }}
                        </td>
                    </tr>
                    <tr class="collapse" id="{{ $topic->name }}">
                        <td>
                            <div class="row justify-content-center p-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Questões</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topic->questions as $question)
                                            <tr>
                                                <td>
                                                    <button class="btn btn-light" type="button" data-bs-toggle="collapse" data-bs-target="#question-{{ $question->id }}" aria-expanded="false" aria-controls="question-{{ $question->id }}">
                                                        <i class="bi bi-chevron-expand"></i>
                                                    </button>
                                                    {{ $question->description }}
                                                </td>
                                            </tr>
                                            <tr class="collapse" id="question-{{ $question->id }}">
                                                <td>
                                                    <div class="row justify-content-center p-3">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Alternativas</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($question->options as $option)
                                                                    <tr>
                                                                        @if ($option->person_answer)
                                                                            <td class="border border-success" style="background-color: rgb(40, 167, 69, .2)">
                                                                                <i class="bi bi-check-circle-fill"></i> {{ $option->description }}
                                                                            </td>
                                                                        @else
                                                                            <td>
                                                                                {{ $option->description }}
                                                                            </td>
                                                                        @endif
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

