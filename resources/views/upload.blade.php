@extends('logged')

@section('page')
    <div class="container">
        <h2>Upload de Vídeo</h2>
        <form action="{{ route('media.video.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="video">Selecione o vídeo:</label>
                <input type="file" class="form-control" id="video" name="file" accept="video/mp4,video/webm">
            </div>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>
    <div class="container">
        <h2>Upload de Imagens</h2>
        <form action="{{ route('media.image.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="imagem">Selecione a Imagem:</label>
                <input type="file" class="form-control" id="imagem" name="file" accept="image/jpeg,image/png,image/gif,image/webp">
            </div>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>
    <div class="container">
        <h2>Upload de Imagens através do link</h2>
        <form action="{{ route('media.image.url.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="image_link">Link da Imagem:</label>
            <input type="text" id="image_link" name="image_link">
            <button type="submit">Salvar</button>
        </form>
    </div>
    <div class="container">
        <h2>Integrar Video do YouTube</h2>
        <form action="{{ route('media.video.url.upload') }}" method="POST">
            @csrf
            <label for="video_link">Link do Vídeo do YouTube:</label>
            </br><span>É necessário obter o link através do compartilhamento do vídeo.</span>
            </br><span>É possível conseguir este link seguindo os seguintes passos:</span>
            </br><span>Abra o vídeo o qual deseja fazer o upload através do link -> clique em partilhar -> clique em incorporar -> seleciona apenas o que vem dentro das aspas duplas depois de "src="</span></br>
            <span>Exemplo: src="https://www.youtube.com/embed/RK8CeKI69m4?si=gmsdfXbIIsofDzqL"</span></br>
            <input type="text" id="video_link" name="video_link">
            <button type="submit">Salvar</button>
        </form>
    </div>
    
@endsection