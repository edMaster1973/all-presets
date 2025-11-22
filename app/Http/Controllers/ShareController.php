<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Share;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ShareController extends Controller
{
    protected $share;
    protected $file;

    public function __construct(Share $share, File $file)
    {
        $this->share = $share;
        $this->file = $file;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Share $share)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Share $share)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Share $share)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Share $share)
    {
        //
    }

    public function generateLink(File $file)
    {
        // 1. Registra o compartilhamento na tabela shares
        $share = new $this->share;
        $share->user_id = auth()->user()->id;
        $share->file_id = $file->id;
        $share->save();

        // 2. Cria link assinado (Signed URL) para download
        $expiration = Carbon::now()->addDays(7);

        $signedUrl = URL::temporarySignedRoute(
            'file.download.signed',
            $expiration,
            ['share_id' => $share->id]
        );

        // 3. Retorna a URL para o front-end (.blade) via Ajax
        return response()->json([
            'success' => true,
            'share_url' => $signedUrl,
            'message' => 'Link de compartilhamento gerado com sucesso!',
        ]);
    }

    public function downloadFile(Request $request, $share_id)
    {
        // 1. Verifica se a URL está assinada corretamente (Segurança)
        if (! $request->hasValidSignature()) {
            abort(401, 'Link para download inválido ou expirado.');
        }

        // 2. Econtra o registro de compartilhamento e o arquivo
        $share = Share::with('file')->findOrFail($share_id);

        // Caminho do arquivo
        $filePath = $share->file->file_path;

        // 3. Verifica se o caminho existe
        if (!Storage::exists($filePath)) {
            abort(404, 'Arquivo não encontrado.');
        }

        // 4. Força o download do arquivo utilizando Storage Facede
        return Storage::download($filePath, $share->file->nome);
    }
}
