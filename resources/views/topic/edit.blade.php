@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5 mb-5">
                <div class="card centralizar p-5">
                    <div class="card-body">
                        <a href="{{ route('questionnaire.edit', ['questionnaire' => $topic->questionnaire]) }}">Voltar</a>
                        <div class="mb-3 centralizar">
                            <h4>{{ $topic->name }}</h4>
                        </div>

                        <form method="POST" action="{{ route('question.save', ['topic' => $topic]) }}">
                            @csrf
                            <div class="form-group col-12">
                                <label for="pergunta">Adicionar pergunta</label>
                                <textarea class="form-control" name="pergunta" id="pergunta" style="width: 100%" rows="4"></textarea>
                            </div>
                            <div class="form-check col-12 mb-3">
                            <input class="form-check-input" type="checkbox" name="mediaCheck" id="mediaCheck">
                            <label class="form-check-label" for="mediaCheck">Utilizar mídia</label>
                        </div>

                        <div id="mediaOptions" style="display: none;">
                            <div class="form-group col-12">
                                <label for="mediaType">Selecione o tipo de mídia:</label>
                                <select class="form-control" id="mediaType">
                                    <option value="none">Nenhum</option>
                                    <option value="videoFile">Upload de Vídeo</option>
                                    <option value="imageFile">Upload de Imagem</option>
                                    <option value="videoUrl">Link do YouTube</option>
                                    <option value="imageUrl">Link de Imagem</option>
                                    <option value="existingMedia">Escolher Mídia Existente</option>
                                </select>
                            </div>

                            <div id="uploadVideo" class="media-upload-form" style="display: none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="videoName" placeholder="Escolher arquivo" readonly>
                                            <div class="input-group-append">
                                                <label class="btn btn-primary">
                                                    Selecionar <input type="file" id="video" name="file" accept="video/mp4,video/webm" class="d-none">
                                                </label>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-success" onclick="uploadMedia('video')">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>


                            <div id="uploadImage" style="display: none;">
                            <div class="form-group">
                                <label for="image">Selecione a imagem:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="imageName" placeholder="Escolher arquivo" readonly>
                                    <div class="input-group-append">
                                        <label class="btn btn-primary">
                                            Selecionar <input type="file" id="image" name="file" accept="image/jpeg,image/png,image/gif,image/webp" class="d-none">
                                        </label>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success" onclick="uploadMedia('image')">Upload</button>
                            </div>
                        </div>

                        <div id="videoUrl" style="display: none;">
                            <div class="form-group">
                                <label for="video_link">Link do Vídeo do YouTube:</label>
                                <input type="text" class="form-control" id="video_link" name="video_link">
                            </div>
                            <button type="button" class="btn btn-success" onclick="uploadVideoUrl()">Salvar Link</button>
                        </div>

                        <div id="imageUrl" style="display: none;">
                            <div class="form-group">
                                <label for="image_link">Link da Imagem:</label>
                                <input type="text" class="form-control" id="image_link" name="image_link">
                            </div>
                            <button type="button" class="btn btn-success" onclick="uploadImageUrl()">Salvar Link</button>
                        </div>


                        <div id="existingMedia" style="display: none;">
                            @if ($myMedia->isNotEmpty())
                                <div class="form-group">
                                    <label for="mediaSelect">Selecione uma mídia</label>
                                    <select class="form-control" id="mediaSelect" name="media_id">
                                        <option value="none">Nenhum</option>
                                        @foreach ($myMedia as $media)
                                            <option value="{{ $media->id }}">
                                                {{ $media->media_path }} ({{ ucfirst(str_replace('_', ' ', $media->type)) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <p class="text-muted">Nenhuma mídia enviada ainda.</p>
                            @endif
                        </div>

                        <div id="successMessage" class="alert alert-success" style="display: none;"></div>

                            <input type="hidden" name="media_id" id="media_id">

                            <div class="form-group col-12">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                        <br><hr><br>
                        @foreach($questions as $question)
                            <div class="col-12">
                                <div class="row col-12">
                                    <h4>{{ $question->description }}</h4>
                                </div>
                                <div class="row">
                                    <div class="col-4 form-group">
                                        <label for="ratio">Peso</label>
                                        <input class="form-control" type="number" id="ratio" value="{{ $question->ratio }}" {{ $question->trashed() ? 'disabled' : '' }}>
                                    </div>
                                    <div class="col-4 form-group">
                                        <input class="form-check-input" type="checkbox" name="texto_livre" id="texto_livre" {{ $question->text ? 'checked' : '' }} disabled>
                                        <label class="form-check-label" for="texto_livre">
                                            Resposta em Texto Livre?
                                        </label>
                                    </div>
                                    @if($question->trashed())
                                        <div class="col-2 form-group">
                                            <label>-</label>
                                            <a href="{{ route('question.restore', ['question' => $question]) }}" class="btn btn-primary">Reativar</a>
                                        </div>
                                    @else
                                        <div class="col-2 form-group">
                                            <label>-</label>
                                            <a href="{{ route('question.view', ['question' => $question]) }}" class="btn btn-primary">Opções</a>
                                        </div>
                                        <div class="col-2 form-group">
                                            <label>-</label>
                                            <a href="{{ route('question.delete', ['question' => $question]) }}" class="btn btn-danger">Excluir</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mediaCheckbox = document.getElementById('mediaCheck');
        const mediaOptions = document.getElementById('mediaOptions');
        const mediaType = document.getElementById('mediaType');
            
        const uploadVideo = document.getElementById('uploadVideo');
        const uploadImage = document.getElementById('uploadImage');
        const videoUrl = document.getElementById('videoUrl');
        const imageUrl = document.getElementById('imageUrl');
        const existingMedia = document.getElementById('existingMedia');

        const videoInput = document.getElementById('video');
        const videoName = document.getElementById('videoName');
        const imageInput = document.getElementById('image');
        const imageName = document.getElementById('imageName');
        const videoUrlInput = document.getElementById('video_link');
        const imageUrlInput = document.getElementById('image_link');
        const successMessage = document.getElementById('successMessage');
        const mediaSelect = document.getElementById('mediaSelect');
        const mediaIdInput = document.getElementById('media_id'); // Certifique-se de que esta linha está definida corretamente

        mediaCheckbox.addEventListener('change', function() {
            if (this.checked) {
                mediaOptions.style.display = 'block';
            } else {
                mediaOptions.style.display = 'none';
                mediaType.value = 'none';
                hideAllMediaForms();
            }
        });

        mediaType.addEventListener('change', function() {
            hideAllMediaForms();
            switch (this.value) {
                case 'videoFile':
                    uploadVideo.style.display = 'block';
                    break;
                case 'imageFile':
                    uploadImage.style.display = 'block';
                    break;
                case 'videoUrl':
                    videoUrl.style.display = 'block';
                    break;
                case 'imageUrl':
                    imageUrl.style.display = 'block';
                    break;
                case 'existingMedia':
                    existingMedia.style.display = 'block';
                    break;
            }
        });

        videoInput.addEventListener('change', function() {
            videoName.value = this.files[0].name;            
        });

        imageInput.addEventListener('change', function() {
            imageName.value = this.files[0].name;
        });

        function hideAllMediaForms() {
            uploadVideo.style.display = 'none';
            uploadImage.style.display = 'none';
            videoUrl.style.display = 'none';
            imageUrl.style.display = 'none';
            existingMedia.style.display = 'none';
        }

        window.uploadMedia = function(mediaType) {
            const formData = new FormData();
            let inputFile, route;
                
            if (mediaType === 'video') {
                inputFile = videoInput;
                route = "{{ route('media.video.upload') }}";
            }else if (mediaType === 'image') {
                inputFile = imageInput;
                route = "{{ route('media.image.upload') }}";
            }

            if (inputFile.files.length > 0) {
                formData.append('file', inputFile.files[0]);

                fetch(route, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        videoName.value = data.fileName;
                        mediaIdInput.value = data.mediaId; // Use a variável definida corretamente
                        displaySuccessMessage(mediaType, data.fileName);
                        disableUploadButton(mediaType);
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            } else {
                alert('Selecione um arquivo primeiro.');
            }
        }

        window.uploadVideoUrl = function() {
            const videoUrl = videoUrlInput.value.trim();
            if (videoUrl === '') {
                alert('Insira um link de vídeo do YouTube.');
                return;
            }

            const formData = new FormData();
            formData.append('video_link', videoUrl);

            fetch("{{ route('media.video.url.upload') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    successMessage.innerHTML = `Link de vídeo ${data.fileName} foi salvo com sucesso!`;
                    successMessage.style.display = 'block';
                    mediaIdInput.value = data.mediaId;
                } else {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        window.uploadImageUrl = function() {
            const imageUrl = imageUrlInput.value.trim();
            if (imageUrl === '') {
                alert('Insira um link de imagem.');
                return;
            }

            const formData = new FormData();
            formData.append('image_link', imageUrl);

            fetch("{{ route('media.image.url.upload') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    successMessage.innerHTML = `Link de imagem ${data.fileName} foi salvo com sucesso!`;
                    successMessage.style.display = 'block';
                    mediaIdInput.value = data.mediaId;
                } else {
                    alert(data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // window.addEventListener('load', function() {
        //     const mediaSelect = document.getElementById('mediaSelect');
        //     const selectedMediaId = document.getElementById('selectedMediaId');

        //     mediaSelect.addEventListener('change', function() {
        //         selectedMediaId.value = this.value;
        //     });
        // });

        mediaSelect.addEventListener('change', function() {
            console.log('Valor selecionado:', this.value); // Verifique se este valor está correto
            console.log('Valor de mediaIdInput antes da atribuição:', mediaIdInput.value); // Confirme se mediaIdInput já tem algum valor antes da atribuição
            mediaIdInput.value = this.value; // Atribui o valor selecionado em mediaIdInput
            console.log('Valor de mediaIdInput após a atribuição:', mediaIdInput.value); // Verifique se mediaIdInput foi atualizado corretamente
        });

        function displaySuccessMessage(mediaType, fileName) {
            successMessage.innerHTML = `Mídia ${fileName} foi enviada com sucesso!`;
            successMessage.style.display = 'block';
        }

        function disableUploadButton(mediaType) {
            if (mediaType === 'video') {
                document.querySelector('#uploadVideo button').disabled = true;
            }
        }
    });
</script>