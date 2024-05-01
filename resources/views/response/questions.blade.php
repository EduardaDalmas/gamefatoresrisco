@extends('logged')

@section('page')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3 mb-5">
            <div class="card centralizar p-5">
                <form id="questionForm">
                @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <h4>Pergunta {{$question->order}}</h4>
                        </div>

                        <div>
                            <p>{{ $question->description }}</p>
                        </div>

                        <div class="centralizar"> 
                            @if ($question->media)
                                <img src="{{ asset($question->media->media_path) }}" class="card-img-top img-question" alt="...">
                            @endif
                        </div>

                        <!-- validar se possui vídeo e necessário copiar aquele incorporar para apresentar o vídeo -->
                        <!-- <div class="col-lg-12">
                            <iframe width="750" height="515" src="https://www.youtube.com/embed/VPtcAtAuuQE?si=CrIX2-SdTUoxSse8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div> -->
                       
                        <div class="btn-group-vertical mt-5 centralizar" role="group" aria-label="Vertical radio toggle button group">
                            @foreach ($question->options as $index => $option)
                                <input type="radio" class="btn-check" name="vbtn-radio" id="vbtn-radio{{$index}}" autocomplete="off" value="{{$option->id}}">
                                <label class="btn btn-outline-info mb-3" for="vbtn-radio{{$index}}">{{ $option->description}}</label>
                            @endforeach
                        </div>
                        

                        <div class="centralizar mt-3">
                            <button type="submit" class="btn btn-custom" data-bs-dismiss="pergunta">Enviar resposta</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<script>
    var radioButtons = document.querySelectorAll('.btn-check');
    radioButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            if (this.checked) {
                var labelText = document.querySelector('label[for="' + this.id + '"]').innerText;
                console.log("Valor selecionado:", labelText);
            }
        });
    });


    $("#questionForm").submit(function(e) {
        e.preventDefault();
        let successCallback = (response) => {
            console.log("Resposta salva com sucesso");
            window.location.href = response;
        }

        let errorCallback = (response) => {
            console.log("Erro ao salvar resposta");
        }

        let anyCallback = (response) => {
            console.log("Resposta salva com sucesso ou erro");
        }

        let data = {
            option_id: $('input[name=vbtn-radio]:checked').val(),
        }

        let ajax = new Ajax('{{ route("response.ajax.question") }}');

        ajax.setSuccess(successCallback)
            // .setError(errorCallback)
            // .setAny(anyCallback)
            // .setData(data)
            .run(data);
    });
    
</script>
@endsection