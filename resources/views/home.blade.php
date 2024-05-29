@extends('logged')

@section('page')
<div class="container">
    <h1 class="text-center mt-5">Olá, bem-vindo(a) ao Rainbow Minds</h1>

    <h3 class="text-center mt-5">Escolha um dos questionários abaixo para começar</h3>
    <div class="row justify-content-center">
        @foreach ($questionnaires as $questionnaire)
        <div class="col-md-5">
            <div class="card card-custom-questionnaire">
                <div class="card-body">
                    <h5 class="card-title">{{ $questionnaire->name }}</h5>
                    <p class="card-text">{{ $questionnaire->description }}</p>
                    <a href="{{ route('response.topic', ['questionnaire' => $questionnaire->id]) }}" class="btn btn-custom">Iniciar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex align-items-center justify-content-center mt-5">
        <h3 class="text-center">Meus Questionários</h3>
        <a href="{{ route('questionnaire.create') }}" class="btn btn-custom ml-2"><i class="bi bi-plus-circle"></i></a>
    </div>
    <div class="row justify-content-center">
        @foreach ($myQuestionnaires as $questionnaire)
            <div class="col-md-5">
                <div class="card card-custom-questionnaire">
                    <div class="card-body">
                        <h5 class="card-title">{{ $questionnaire->name }}</h5>
                        <p class="card-text">{{ $questionnaire->description }}</p>
                        <a href="{{ route('questionnaire.delete', $questionnaire) }}" class="btn btn-custom">Excluir</a>
                        <a href="{{ route('questionnaire.view', $questionnaire) }}" class="btn btn-custom">Ver Detalhes</a>
                        <a href="{{ route('questionnaire.edit', $questionnaire) }}" class="btn btn-custom">Editar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if ($errors->any())
        <div class="alert alert-danger" id="errorAlert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <script>
            // JavaScript para ocultar a mensagem de erro após alguns segundos
            setTimeout(function() {
                document.getElementById('errorAlert').style.display = 'none';
            }, 5000); // Tempo em milissegundos (neste caso, 5000ms = 5 segundos)
            
        </script>
    @endif
</div>
@endsection

