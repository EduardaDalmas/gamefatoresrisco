@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5 mb-5">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="mb-3 row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('answer.index', $data['questionnaire']) }}"> <i class="bi bi-arrow-left-short icone"></i></a>
                            </div>
                            <div class="col-auto">
                                <h1 class="h1 text-dark">Respostas: {{ $data['person']->name }}</h1>
                            </div>
                        </div>
                        <hr>

                        <div class="container">
                            {{-- <div class="col-auto">
                                <h4>Tópicos</h4>
                            </div>
                            <hr> --}}
                            @foreach ($data['estructure_questionnaire'] as $topic)
                               
                                {{-- <button class="btn btn-custom" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-topic-{{ $loop->index }}" aria-expanded="false" aria-controls="collapse-topic-{{ $loop->index }}">
                                    <span class="icon-expand bi bi-chevron-down"></span>
                                    <span class="icon-collapse bi bi-chevron-up" style="display: none;"></span>
                                    {{ $topic->name }}
                                </button> --}}
                                <div class="mb-5">
                                    <div class="row">
                                        <div class="col-auto"><i class="bi bi-bookmark-check icone-topico"></i></div>
                                        <div class="col-auto"><h4>Tópico:  {{ $topic->name }}</h4></div>
                                        
                                        
                                    </div>
                                
                                    {{-- <div class="collapse collapse-horizontal" id="collapse-topic-{{ $loop->index }}"> --}}
                                        <div class="card card-body">
                                            @foreach ($topic->questions as $question)
                                                <p>
                                                    <b> Questão:  {{ $question->description }} </b>
                                                </p>
                                                <div class="col-auto">
                                                    <h6>Alternativas</h6>
                                                </div>
                                                @foreach ($question->options as $index => $option)

                                                @php
                                                    $optionsCount = count($question->options);
                                                @endphp
                                                    <div class="option {{ $option->person_answer ? 'selected-answer' : '' }}">
                                                        @if ($option->person_answer)
                                                            <i class="bi bi-check-circle-fill" style="color: green;"></i> {{ $option->description }}
                                                        @else
                                                            {{ $option->description }}
                                                        @endif
                                                    </div>
                                                    @if ($index < $optionsCount - 1)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    {{-- </div> --}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
