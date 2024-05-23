@extends('logged')
@section('page')
<script src="https://tehsis.github.io/jfortune/jquery.fortune.js"></script>
<div class="container">
    <h1 class="text-center">Gire a roleta e descubra qual o tema da pergunta!</h1>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
      .wheel-container {
        position: relative;
        width: 500px;
        height: 500px;
        margin: 20px auto;
      }
      .pointer {
        width: 0;
        height: 0;
        border-style: solid;
        border-radius: 30%;
        border-width: 40px 25px 0 25px;
        border-color: rgb(0, 0, 0) transparent transparent transparent;
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translateX(-50%);
      }
    </style>

    <div class="container mt-5">
      <div class="wheel-container">
          <canvas id="canvas" width="500" height="500"></canvas>
          <div class="pointer"></div>
      </div>
      <div class="text-center">
          <button class="btn-custom mt-2" id="spinButton">Girar roleta</button>
      </div>
    </div>

    <audio id="roletaAudio" preload="auto">
      <source src="{{ asset('music/roleta.mp3') }}" type="audio/mpeg">
    </audio>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
    <script src="{{ asset('js/Winwheel.js') }}"></script>
    <script>
      $(document).ready(function() {
        const callback = function(selected) {
            console.log(selected);
            pararSomRoleta();
            const url = "{{ route('response.question', ['topic' => 'topicId']) }}".replace('topicId', selected.id);
            window.location.href = url;
        };

        const cores = ['E3D2F4', 'AFDEFA', 'BDF6E3', 'FBF5C5', 'FFD1D0', ];
        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        shuffle(cores);

        const wheel = new Winwheel({
            'canvasId': 'canvas',
            'numSegments': {{ count($topics) }},
            'segments': [
              @foreach($topics as $index => $topic)
                {'fillStyle': '#' + cores[{{ $index }}], 'text': '{{ $topic->name }}', 'id': '{{ $topic->id }}'},
              @endforeach
            ],
            'animation': {
                'type': 'spinToStop',
                'duration': 5,
                'spins': 8,
                'callbackFinished': callback
            }
        });

        $('#spinButton').click(function() {
            tocarSomRoleta();  // Call this function here to ensure it's triggered by user interaction
            wheel.stopAnimation(false);
            wheel.rotationAngle = 0;
            wheel.draw();
            wheel.startAnimation();
        });
      });
      
      function tocarSomRoleta() {
        var roletaAudio = document.getElementById('roletaAudio');
        if (roletaAudio.paused) {
            roletaAudio.currentTime = 0;
            roletaAudio.play();
        }
    }

    function pararSomRoleta() {
        var roletaAudio = document.getElementById('roletaAudio');
        roletaAudio.pause();
    }

    </script>
</div>
@endsection
