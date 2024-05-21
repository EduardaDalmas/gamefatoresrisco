@extends('logged')

@section('page')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3 mb-5">
                <div class="card centralizar p-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <h2 class="text-dark">Upload de Vídeo</h2>
                            <form action="{{ route('media.video.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="video">Selecione o vídeo:</label>
                                    <input type="file" class="form-control" id="video" name="file" accept="video/mp4,video/webm">
                                </div>
                                <input type="submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3 mb-5">
                <div class="card centralizar p-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <h2 class="text-dark">Upload de Imagens</h2>
                            <form action="{{ route('media.image.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="imagem">Selecione a Imagem:</label>
                                    <input type="file" class="form-control" id="imagem" name="file" accept="image/jpeg,image/png,image/gif,image/webp">
                                </div>
                                <input type="submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3 mb-5">
                <div class="card centralizar p-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <h2 class="text-dark">Upload de Imagens através do link</h2>
                            <form action="{{ route('media.image.url.upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <p>Exemplo de imagem: https://cc-prod.scene7.com/is/image/CCProdAuthor/FF-SEO-text-to-image-marquee-1x?$pjpeg$&jpegSize=100&wid=600</p>
                                <label for="image_link">Link da Imagem:</label>
                                <input type="text" id="image_link" name="image_link">
                                <button type="submit">Salvar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-3 mb-5">
                <div class="card centralizar p-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <h2 class="text-dark">Integrar Video do YouTube</h2>
                            <form action="{{ route('media.video.url.upload') }}" method="POST">
                                @csrf

                                <p>É necessário obter o link através do compartilhamento do vídeo.</p>
                                <p>É possível conseguir este link através dos seguintes passos:</p>
                                <p>Abra o vídeo o qual deseja fazer o upload através do link -> clique em partilhar -> clique em incorporar -> seleciona apenas o que vem dentro das aspas duplas depois de "src="</p>
                                <p>Exemplo: src="https://www.youtube.com/embed/RK8CeKI69m4?si=gmsdfXbIIsofDzqL"</p>
                                <label for="video_link">Link do Vídeo do YouTube:</label>
                                <input type="text" id="video_link" name="video_link">
                                <button type="submit">Salvar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection