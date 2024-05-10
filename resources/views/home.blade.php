@extends('logged')

@section('page')
<div class="container">
    <h1 class="text-center mt-5" style="color: white">Olá, bem-vindo(a) ao Rainbow Minds</h1>
    <h3 class="text-center mt-5" style="color: white">Escolha um dos questionários abaixo para começar</h3>
    <div class="row justify-content-center mt-5">
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

