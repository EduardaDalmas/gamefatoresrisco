@extends('logged')
@section('page')
<script src="https://tehsis.github.io/jfortune/jquery.fortune.js"></script>
<div class="container">
    <h1 class="text-center " style="color: white">Gire a roleta e descubra qual o tema da pergunta!</h1>
    
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
        border-width: 30px 15px 0 15px;
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
          <button class="btn btn-primary mt-3" id="spinButton">Girar</button>
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



        const cores = ['FF69B4', '87CEEB', '7FFFD4', 'FF7F50', '90EE90'];
        const wheel = new Winwheel({
            'canvasId': 'canvas',
            'numSegments': {{ count($topics) }},
            'segments': [
              @foreach($topics as $topic)
                {'fillStyle': '#' + cores[Math.floor(Math.random() * cores.length)], 'text': '{{ $topic->name }}', 'id': '{{ $topic->id }}'},
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
