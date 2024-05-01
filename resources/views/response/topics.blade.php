@extends('logged')
@section('page')
<div class="container">
    <h1 class="text-center mt-5" style="color: white">Gire a roleta e descubra qual o tema da pergunta!</h1>

    <div class="roulette-container">
        <img class="img-arrow" src="{{ asset('images/arrow.png') }}" alt="Arrow">
        <div class="roulette">
            @foreach ($topics as $topic)
                <div class="option"><img class="img-opt" src="{{ asset('images/op-'.$topic->id.'.png') }}" data-url="{{ route("response.question", ["topic" => $topic->id]) }}" alt="opção 2"></div>
            @endforeach           
        </div>
    </div>

    <audio id="roletaAudio" preload="auto">
        <source src="{{ asset('music/roleta.mp3') }}" type="audio/mpeg">
    </audio>

    <div class="centralizar">
        <button id="spin-btn" class="btn btn-custom">Girar roleta</button>
    </div>
</div>

<script>   
    document.getElementById('spin-btn').addEventListener('click', function() {
        tocarSomRoleta();

        var degrees = Math.floor(Math.random() * 3600) + 360;
        var roulette = document.querySelector('.roulette');
        roulette.style.transition = "transform 5s ease-out"; 
        roulette.style.transform = 'rotate(' + degrees + 'deg)';

        roulette.addEventListener('transitionend', () => {
            var style = window.getComputedStyle(roulette);
            var transform = style.getPropertyValue('transform');
            var matrix = new WebKitCSSMatrix(transform);
            var rotation = Math.round(Math.atan2(matrix.b, matrix.a) * (180/Math.PI));

            var options = document.querySelectorAll('.option');
            var angleStep = 360 / options.length;
            var selectedOptionIndex = Math.floor((rotation % 360) / angleStep);
            var selectedOption = options[selectedOptionIndex];
            var selectedURL = selectedOption.querySelector('.img-opt').dataset.url;
            console.log("Opção selecionada:", selectedURL);
            callbackRoleta(selectedURL);
        });

        var duracaoGiro = 5000 + degrees / 10; 
        setTimeout(function() {
            pararSomRoleta();
        }, duracaoGiro);
    });

    function callbackRoleta(url) {
        window.location.href = url;
    }

    const roletaAudio = document.getElementById("roletaAudio");
    const roletaSelecao = document.getElementById("selecao");

    function tocarSomRoleta() {
        if (roletaAudio.paused) {
            roletaAudio.currentTime = 0;
            roletaAudio.play();
        }
    }

    function pararSomRoleta() {
        roletaAudio.pause();
    }
</script>
    
</div>
@endsection

