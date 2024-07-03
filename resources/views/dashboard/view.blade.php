@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="mb-3 row align-items-center">
                            <div class="col-auto">
                                <h4>Relatórios</h4>
                            </div>
                        </div>
                        <hr>

                        @foreach ($topics as $topic)
                            <div class="col-lg-12 mb-4">
                                <div class="card card-custom">
                                    <div class="card-body">
                                        <!-- Conteúdo do Tópico -->
                                        <div class="row mb-2">
                                            <div class="col-lg-10">
                                                <h5>{{ $topic['topic'] }}</h5>
                                            </div>
                                        </div>
                                        <!-- Conteúdo das Perguntas -->
                                        @foreach($topic['questions'] as $question)
                                            <div class="row mb-2">
                                                <div class="col-lg-10">
                                                    <h6>{{ $question['question'] }}</h6>
                                                </div>
                                            </div>
                                            @if(!empty($question['options']))
                                                <div class="row mb-3">
                                                    <div class="col-lg-12">
                                                        <ul>
                                                            @foreach($question['options'] as $option)
                                                                <li>{{ $option['option'] }} - {{ $option['answers'] }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection