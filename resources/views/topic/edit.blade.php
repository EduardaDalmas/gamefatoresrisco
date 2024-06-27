@extends('logged')

@section('page')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-5 mb-5">
            <div class="card p-5">
                <div class="card-body">
                    <div class="mb-3 row align-items-center">
                        <div class="col-auto">
                            <a href="{{ route('questionnaire.edit', ['questionnaire' => $topic->questionnaire]) }}">
                                <i class="bi bi-arrow-left-short icone"></i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <h4>{{ $topic->name }}</h4>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('question.save', ['topic' => $topic]) }}">
                        @csrf
                        <div class="form-group">
                            <label for="pergunta">Adicionar pergunta</label>
                            <textarea class="form-control" name="pergunta" id="pergunta" style="width: 100%" rows="4"></textarea>
                        </div>
                        <div class="form-check col-12 mb-3">
                            <input class="form-check-input" type="checkbox" name="mediaCheck" id="mediaCheck">
                            <label class="form-check-label" for="mediaCheck">Utilizar mídia</label>
                        </div>

                        <div id="mediaOptions" style="display: none;">
                            <div class="form-group">
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
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success" onclick="uploadMedia('video')">Upload</button>
                            </div>

                            <div id="uploadImage" class="media-upload-form" style="display: none;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="imageName" placeholder="Escolher arquivo" readonly>
                                        <div class="input-group-append">
                                            <label class="btn btn-primary">
                                                Selecionar <input type="file" id="image" name="file" accept="image/jpeg,image/png,image/gif,image/webp" class="d-none">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success" onclick="uploadMedia('image')">Upload</button>
                            </div>

                            <div id="videoUrl" class="media-upload-form" style="display: none;">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="video_link" name="video_link" placeholder="Insira o link do YouTube">
                                </div>
                                <button type="button" class="btn btn-success" onclick="uploadVideoUrl()">Salvar Link</button>
                            </div>

                            <div id="imageUrl" class="media-upload-form" style="display: none;">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="image_link" name="image_link" placeholder="Insira o link da imagem">
                                </div>
                                <button type="button" class="btn btn-success" onclick="uploadImageUrl()">Salvar Link</button>
                            </div>

                            <div id="existingMedia" class="media-upload-form" style="display: none;">
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
                        </div>

                        <div id="successMessage" class="alert alert-success" style="display: none;"></div>

                        <input type="hidden" name="media_id" id="media_id">

                        <button type="submit" class="btn btn-primary mt-3">Salvar Pergunta</button>
                    </form>
                    <br><hr><br>

                    <div class="container">
                        <div class="row mt-3">
                            @foreach($questions as $question)
                                <div class="col-lg-12 mb-4">
                                    <div class="card card-custom">
                                        <div class="card-body">
                                            <!-- Conteúdo da pergunta -->
                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <h5>{{ $question->description }}</h5>
                                                </div>
                                            </div>
                                            <div class="row mt-3 justify-content-center">
                                                <div class="col-lg-4 text-center">
                                                    <p><strong>Peso:</strong></p>
                                                    <input class="form-control" type="number" id="ratio" value="{{ $question->ratio }}" {{ $question->trashed() ? 'disabled' : '' }}>
                                                </div>
                                                <div class="col-lg-4 text-center">
                                                    <p><strong>Resposta em Texto Livre:</strong></p>
                                                    <div class="form-check mt-2">
                                                        <label class="form-check-label" for="texto_livre">
                                                            <input class="form-check-input" type="checkbox" name="texto_livre" id="texto_livre" {{ $question->text ? 'checked' : '' }} disabled>
                                                            Sim
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 text-center">
                                                    <p><strong>Ações:</strong></p>
                                                    <div class="btn-group" role="group">
                                                        @if($question->trashed())
                                                            <a href="{{ route('question.restore', ['question' => $question]) }}" class="btn btn-outline-warning btn-sm">Reativar</a>
                                                        @else
                                                            <a href="{{ route('question.view', ['question' => $question]) }}" class="btn btn-outline-primary btn-sm">Opções</a>
                                                            <a href="{{ route('question.delete', ['question' => $question]) }}" class="btn btn-outline-danger btn-sm">Excluir</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mídia da pergunta -->
                                            @if($question->media)
                                                <div class="row mt-3 justify-content-center">
                                                    <div class="col-12 col-md-8">
                                                        @if ($question->media->type == 'image')
                                                            <img src="{{ asset('images/' . $question->media->media_path) }}" class="img-thumbnail" alt="Miniatura">
                                                        @elseif ($question->media->type == 'image_url')
                                                            <img src="{{ $question->media->media_path }}" class="img-thumbnail" alt="Miniatura">
                                                        @elseif ($question->media->type == 'video_file')
                                                            <video class="img-thumbnail" controls class="video-thumbnail">
                                                                <source src="{{ asset('videos/' . $question->media->media_path) }}" type="video/{{ pathinfo($question->media->media_path, PATHINFO_EXTENSION) }}">
                                                            </video>
                                                        @elseif ($question->media->type == 'video_url')
                                                        <div class="youtube-video">
                                                            <iframe src="{{ $question->media->media_path }}" frameborder="0" allowfullscreen></iframe>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row mt-3">
                                                    <div class="col-lg-12">
                                                        <p class="text-muted">Esta pergunta não possui mídia cadastrada.</p>  
                                                    </div>
                                                </div>
                                            @endif
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
        const mediaIdInput = document.getElementById('media_id');

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
                        mediaIdInput.value = data.mediaId;
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
                    successMessage.innerHTML = `Link de vídeo salvo com sucesso!`;
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
                    successMessage.innerHTML = `Link de imagem foi salvo com sucesso!`;
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

        mediaSelect.addEventListener('change', function() {
            // console.log('Valor selecionado:', this.value); // Verifique se este valor está correto
            // console.log('Valor de mediaIdInput antes da atribuição:', mediaIdInput.value); // Confirme se mediaIdInput já tem algum valor antes da atribuição
            mediaIdInput.value = this.value; // Atribui o valor selecionado em mediaIdInput
            // console.log('Valor de mediaIdInput após a atribuição:', mediaIdInput.value); // Verifique se mediaIdInput foi atualizado corretamente
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
@endsection
