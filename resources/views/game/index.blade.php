@extends('layouts.app')
@extends('general')

@section('content')

<div class="container">
    <h1 class="text-center mt-5" style="color: white">Gire a roleta e descubra qual o tema da pergunta!</h1>

    <div class="roulette-container">
        <img class="img-arrow" src="{{ asset('images/arrow.png') }}" alt="Arrow">
        <div class="roulette">
            <div class="option"><img class="img-opt" src="{{ asset('images/op-1.png') }}" alt="opção 1"></div>
            <div class="option"><img class="img-opt" src="{{ asset('images/op-2.png') }}" alt="opção 2"></div>
            <div class="option"><img class="img-opt" src="{{ asset('images/op-3.png') }}" alt="opção 3"></div>
            <div class="option"><img class="img-opt" src="{{ asset('images/op-4.png') }}" alt="opção 4"></div>
           
        </div>
    </div>

    <audio id="roletaAudio" preload="auto">
        <source src="{{ asset('music/roleta.mp3') }}" type="audio/mpeg">
    </audio>

    <div class="centralizar">
        <button id="spin-btn" class="btn btn-custom">Girar roleta</button>
    </div>

    <div class="modal fade" id="pergunta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pergunta 1</h1>
                </div>
                <div class="modal-body">
                    <p>Você, um aventureiro corajoso, está explorando uma floresta misteriosa em busca de um tesouro lendário. De repente, você se depara com um pequeno elfo triste sentado em uma clareira. Ele olha para você com os olhos marejados de lágrimas.</p>
                    <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio1" autocomplete="off" checked>
                        <label class="btn btn-outline-info" for="vbtn-radio1">"O que aconteceu? Posso ajudar de alguma forma?"</label>

                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio2" autocomplete="off">
                        <label class="btn btn-outline-info" for="vbtn-radio2">"Sorrir e acenar."</label>
                        
                        <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio3" autocomplete="off">
                        <label class="btn btn-outline-info" for="vbtn-radio3">"Continuar explorando sem se preocupar com o elfo."</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-custom" data-bs-dismiss="modal">Enviar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('spin-btn').addEventListener('click', function() {
            tocarSomRoleta();

            var degrees = Math.floor(Math.random() * 3600) + 360;
            var roulette = document.querySelector('.roulette');
            roulette.style.transition = "transform 5s ease-out"; 
            roulette.style.transform = 'rotate(' + degrees + 'deg)';

            var duracaoGiro = 5000 + degrees / 10; 
            setTimeout(function() {
                pararSomRoleta();
            }, duracaoGiro);
        });

        const roletaAudio = document.getElementById("roletaAudio");
        const roletaSelecao = document.getElementById("selecao");

        function tocarSomRoleta() {
            if (roletaAudio.paused) {
                roletaAudio.play();
            }
        }


        function pararSomRoleta() {
            roletaAudio.pause();
            var minhaModal = new bootstrap.Modal(document.getElementById('pergunta'));
            minhaModal.show();
        }
    </script>
    
</div>