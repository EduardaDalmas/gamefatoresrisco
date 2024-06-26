@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5 mb-5">
                <div class="card p-5">
                    <div class="card-body">
                        <div class="mb-3 row align-items-center">
                            <div class="col-auto">
                                <a href="{{ route('home') }}"> <i class="bi bi-arrow-left-short icone"></i></a>
                            </div>
                            <div class="col-auto">
                                <h1 class="h1 text-dark">Questionário: {{ $data['questionnaire']->name }}</h1>
                            </div>
                        </div>

                        <div class="container">
                            <div class="col-auto">
                                <h4>Grupos de participantes:</h4>
                            </div>
                            <hr>
                            @foreach ($data['teams'] as $questionnaire_team)
                            <p>
                                <button class="btn btn-custom" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample-{{ $questionnaire_team->id }}" aria-expanded="false" aria-controls="collapseWidthExample-{{ $questionnaire_team->id }}">
                                    <span class="icon-expand bi bi-chevron-down"></span>
                                    <span class="icon-collapse bi bi-chevron-up" style="display: none;"></span>
                                    {{ $questionnaire_team->name }}
                                </button>
                              </p>
                              <div>
                                <div class="collapse collapse-horizontal" id="collapseWidthExample-{{ $questionnaire_team->id }}">
                                  <div class="card card-body">
                                    @foreach ($questionnaire_team->people as $person)
                                    @if ($person->answers_count > 0)
                                        <div class="row w-100">
                                            <div class="col-7 d-flex align-items-center">
                                                <h5>{{ $person->name }}</h5>
                                            </div>
                                            <div class="col-5 d-flex justify-content-end align-items-end">
                                                <a href="{{ route('answer.show', [$person->id, $questionnaire_team['questionnaires'][0]->id ]) }}" class="btn btn-custom btn-sm">Ver respostas</a>
                                            </div>
                                        </div>
                                        @if (count($questionnaire_team->people) > count($questionnaire_team->people) - 1)
                                            <hr>
                                        @endif
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
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var collapseButtons = document.querySelectorAll('button[data-bs-toggle="collapse"]');
        collapseButtons.forEach(function(collapseButton) {
            collapseButton.addEventListener('click', function() {
                setTimeout(function() { // Adiciona um pequeno atraso para garantir que o atributo aria-expanded seja atualizado
                    var isExpanded = collapseButton.getAttribute('aria-expanded') === 'true';
                    collapseButton.querySelector('.icon-expand').style.display = isExpanded ? 'none' : 'inline';
                    collapseButton.querySelector('.icon-collapse').style.display = isExpanded ? 'inline' : 'none';
                }, 100);
            });
        });
    });
</script>
@endsection
