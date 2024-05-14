@extends('logged')  <!-- Substitua 'layout' pelo nome do seu layout principal -->

@section('page')
    <div class="container">
        <h2>Upload de Vídeo</h2>
        <form action="{{ route('media.video.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="video">Selecione o vídeo:</label>
                <input type="file" class="form-control" id="video" name="file" accept="video/mp4,video/mkv">
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
                <input type="file" class="form-control" id="imagem" name="file" accept="image/jpeg,image/png">
            </div>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>
    <div class="container">
        <h2>Integrar Videodo YouTube</h2>
        <form action="{{ route('media.url.upload') }}" method="POST">
            @csrf
            <label for="video_link">Link do Vídeo do YouTube:</label>
            <input type="text" id="video_link" name="video_link">
            <button type="submit">Salvar</button>
        </form>
    </div>
    
@endsection