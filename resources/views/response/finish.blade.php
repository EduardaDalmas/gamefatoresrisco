@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5 mb-5">
            <div class="card centralizar p-5">
                <div class="card-body">
                    <div class="mb-3 centralizar">
                        <h4>Parabéns! Você concluiu a atividade. 🎉🌟</h4>
                    </div>

                    <div>
                        <p>Sua participação é valiosa e apreciamos seu tempo dedicado a este processo.</p>
                    </div>

                    <div class="mt-4 centralizar">
                        <button type="button" onclick="window.location='{{ route('home') }}'" class="btn btn-custom">Voltar para a página inicial</button>
                    </div>

                    <!-- Elemento oculto para disparar a explosão de confetes ao carregar -->
                    <div id="confetti-container" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Função para criar a explosão de confetes
function criarExplosaoDeConfetes() {
    let params = {
        particleCount: 500, // Quantidade de confetes
        spread: 90, // O quanto eles se espalham
        startVelocity: 70, // Velocidade inicial
        origin: { x: 0, y: 0.5 }, // Posição inicial na tela
        angle: 45 // Ângulo em que os confetes serão lançados
    };

    // Selecionar o contêiner de confetes
    const container = document.getElementById('confetti-container');

    // Joga confetes da esquerda para a direita
    confetti(params, { target: container });

    // Joga confetes da direita para a esquerda
    params.origin.x = 1;
    params.angle = 135;
    confetti(params, { target: container });
}

// Executar a função ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    // Chamar a função para criar a explosão de confetes ao abrir a tela
    criarExplosaoDeConfetes();
});
</script>
@endsection
