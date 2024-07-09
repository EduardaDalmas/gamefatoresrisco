@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="mb-3 row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('dashboard.index') }}"> <i class="bi bi-arrow-left-short icone"></i></a>
                            </div>
                            <div class="col-auto">
                                <h4>Relatórios</h4>
                            </div>
                        </div>
                        <hr>

                        @foreach ($topics as $topic)
                            <div class="col-lg-12 mb-4">
                                <div class="row">
                                    <div class="col-auto"><i class="bi bi-bookmark-check icone-topico"></i></div>
                                    <div class="col-auto"><h4>Tópico:  {{ $topic['topic'] }}</h4></div>
                                </div>
                                
                                <div class="card card-body">
                                    @foreach($topic['questions'] as $index => $question)
                                        <p><b> Questão: {{ $question['question'] }}</b></p>
                                        <div class="row">
                                            <div class="col-10">
                                                <h6>Alternativas</h6>
                                            </div>
                                            <div class="col-2">
                                                <h6>Respostas</h6>
                                            </div>
                                        </div>
                                
                                        @if(!empty($question['options']))
                                            @php
                                                // Encontrar o maior número de respostas
                                                $maxAnswers = max(array_column($question['options'], 'answers'));
                                            @endphp
                                
                                            @foreach($question['options'] as $option)
                                                @php
                                                    // Determinar a classe de cor com base no número de respostas
                                                    if ($option['answers'] == $maxAnswers && $maxAnswers > 0) {
                                                        $answerClass = 'biggerAnswer';
                                                    } else {
                                                        $answerClass = 'no-selected-answer';
                                                    }
                                                @endphp
                                                <div class="option row {{ $answerClass }}">
                                                    <div class="col-11">
                                                        <i class="bi bi-check-circle" style="color: grey;"></i> {{ $option['option'] }}
                                                    </div>
                                                    <div class="col-1">
                                                        <div>{{ $option['answers'] }}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                
                                        @if($index < count($topic['questions']) - 1)
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
                                
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection