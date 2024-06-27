<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    public function videoUpload(Request $request)
    {
        $file = $request->file("file");

        $request->validate([
            'file' => 'required|mimes:mp4,webm|max:102400', // Max size 100MB
        ]);

        // Cria uma nova instância de Media sem salvar o arquivo ainda
        $media = new Media();
        $media->type = "video_file";
        $media->user()->associate(Auth::user());
        $media->original_media_name = $file->getClientOriginalName(); // Salva o nome original do arquivo
        $media->save();

        $fileName = $media->id . '-' . $file->getClientOriginalName();
        $destinationPath = "videos";

        if ($file->move($destinationPath, $fileName)) {
            // Atualiza o caminho da mídia com o novo nome do arquivo
            $media->media_path = $fileName;
            $media->save();

            return response()->json(['success' => true, 'fileName' => $fileName, 'mediaId' => $media->id]);
        } else {
            return response()->json(['success' => false, 'error' => 'Erro ao enviar o arquivo']);
        }
    }


    public function imageUpload(Request $request)
    {
        $file = $request->file("file");

        $request->validate([
            'file' => 'required|mimes:jpeg,png,gif,webp|max:10240', // Max size 10MB
        ]);

        // Cria uma nova instância de Media sem salvar o arquivo ainda
        $media = new Media();
        $media->type = "image";
        $media->user()->associate(Auth::user());
        $media->original_media_name = $file->getClientOriginalName(); // Salva o nome original do arquivo
        $media->save();

        $fileName = $media->id . '-' . $file->getClientOriginalName();
        $destinationPath = "images";

        if ($file->move($destinationPath, $fileName)) {
            // Atualiza o caminho da mídia com o novo nome do arquivo
            $media->media_path = $fileName;
            $media->save();

            return response()->json(['success' => true, 'fileName' => $fileName, 'mediaId' => $media->id]);
        } else {
            return response()->json(['success' => false, 'error' => 'Erro ao enviar o arquivo']);
        }
    }


    public function videoUrlUpload(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'video_link' => 'required|url', // URL válida é necessária
        ]);
    
        // Verifica se houve erros na validação
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->first()], 400);
        }
    
        try {
            // Cria uma nova instância de Media
            $media = new Media();
            $media->media_path = $request->video_link;
            $media->type = "video_url";
            $media->user()->associate(Auth::user());
            $media->save();
    
            // Retorna a resposta JSON de sucesso com os dados necessários
            return response()->json([
                'success' => true,
                'video_link' => $media->media_path, // Retorna o link do vídeo salvo
                'mediaId' => $media->id // Retorna o ID da mídia salva
            ]);
        } catch (\Exception $e) {
            // Em caso de erro ao salvar no banco de dados
            return response()->json(['success' => false, 'error' => 'Erro ao salvar o link do vídeo.'], 500);
        }
    }

    public function imageUrlUpload(Request $request)
    {
        // Validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'image_link' => 'required|url', // URL válida é necessária
        ]);
    
        // Verifica se houve erros na validação
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->first()], 400);
        }
    
        try {
            // Cria uma nova instância de Media
            $media = new Media();
            $media->media_path = $request->image_link;
            $media->type = "image_url";
            $media->user()->associate(Auth::user());
            $media->save();
    
            // Retorna a resposta JSON de sucesso com os dados necessários
            return response()->json([
                'success' => true,
                'image_link' => $media->media_path, // Retorna o link do vídeo salvo
                'mediaId' => $media->id // Retorna o ID da mídia salva
            ]);
        } catch (\Exception $e) {
            // Em caso de erro ao salvar no banco de dados
            return response()->json(['success' => false, 'error' => 'Erro ao salvar o link da imagem.'], 500);
        }
    }
}

