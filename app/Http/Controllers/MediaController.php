<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Question;


class MediaController extends Controller
{

    public function showUploadForm()
    {
        return view('upload');
    }

    public function videoUpload(Request $request)
    {
        $file = $request->file("file");

        $request->validate([
            'file' => 'required|mimes:mp4,webm|max:102400', // Max size 100MB
        ]);
    

        $fileName = $file->getClientOriginalName();
        $destinationPath = "videos";

        if($file->move($destinationPath, $file->getClientOriginalName())) {
            $media = new Media();
            $media->media_path = $fileName;
            $media->type = "video_file";
            $media->save();
            return redirect()->route('media.upload.form')->with('success', 'Arquivo enviado com sucesso!');
        } else {
            return redirect()->route('media.upload.form')->with('error', 'Erro ao enviar o arquivo');
        }
    }
    public function imageUpload(Request $request)
    {
        $file = $request->file("file");

        $request->validate([
            'file' => 'required|mimes:jpeg,png,gif,webp|max:10240', // Max size 100MB
        ]);
    

        $fileName = $file->getClientOriginalName();
        $destinationPath = "images";

        if($file->move($destinationPath, $file->getClientOriginalName())) {
            $media = new Media();
            $media->media_path = $fileName;
            $media->type = "image";
            $media->save();
            return redirect()->route('media.upload.form')->with('success', 'Arquivo enviado com sucesso!');
        } else {
            return redirect()->route('media.upload.form')->with('error', 'Erro ao enviar o arquivo');
        }
    }

    public function videoUrlUpload(Request $request)
    {

        $request->validate([
            'video_link' => 'required|url', // Validação básica de URL
        ]);
    
        // Salvar o link do vídeo no banco de dados
        $media = new Media();
        $media->media_path = $request->video_link;
        $media->type = "video_url";
        $media->save();
    
        return redirect()->route('media.upload.form')->with('success', 'Vídeo do YouTube adicionado com sucesso!');
    }

    public function imageUrlUpload(Request $request)
    {

        $request->validate([
            'image_link' => 'required|url', // Validação básica de URL
        ]);
    
        // Salvar o link do vídeo no banco de dados
        $media = new Media();
        $media->media_path = $request->image_link;
        $media->type = "image_url";
        $media->save();
    
        return redirect()->route('media.upload.form')->with('success', 'Imagem adicionada através do link com sucesso!');
    }
    
}
