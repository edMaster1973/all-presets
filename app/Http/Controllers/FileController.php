<?php

namespace App\Http\Controllers;

use App\MasterClass\Consultas;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Download;
use App\Models\Equipament;
use App\Models\File;
use App\Models\FileStyle;
use App\Models\Like;
use App\Models\Marca;
use App\Models\Segment;
use App\Models\Share;
use App\Models\Style;
use App\Models\User;
use Illuminate\Http\Request;
use ZipArchive;

class FileController extends Controller
{
    protected $equipament;
    protected $file;
    protected $segment;
    protected $category;
    protected $marca;
    protected $style;
    protected $file_style;
    protected $user;
    protected $download;
    protected $like;
    protected $comment;
    protected $share;

    public function __construct(
        Equipament $equipament,
        File $file,
        Segment $segment,
        Category $category,
        Marca $marca,
        Style $style,
        FileStyle $file_style,
        User $user,
        Download $download,
        Like $like,
        Comment $comment,
        Share $share
    ) {
        $this->equipament = $equipament;
        $this->file = $file;
        $this->segment = $segment;
        $this->category = $category;
        $this->marca = $marca;
        $this->style = $style;
        $this->file_style = $file_style;
        $this->user = $user;
        $this->download = $download;
        $this->like = $like;
        $this->comment = $comment;
        $this->share = $share;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function home()
    {
        $presets = Consultas::preset();
        $styles = Consultas::style();
        $likes = $this->like->all();
        $shares = $this->share->all();
        $comments = $this->comment->all();
        $downloads = $this->download->all();
        return view('home', [
            'presets' => $presets,
            'styles' => $styles,
            'likes' => $likes,
            'shares' => $shares,
            'comments' => $comments,
            'downloads' => $downloads,
        ]);
    }

    public function inicio()
    {
        $presets = Consultas::preset();
        $styles = Consultas::style();
        $likes = $this->like->all();
        $shares = $this->share->all();
        $comments = $this->comment->all();
        $downloads = $this->download->all();
        $marcas = $this->marca->all();
        $equipaments = $this->equipament->all();
        $segments = $this->segment->all();

        return view('inicio', [
            'presets' => $presets,
            'styles' => $styles,
            'likes' => $likes,
            'shares' => $shares,
            'comments' => $comments,
            'downloads' => $downloads,
            'marcas' => $marcas,
            'equipaments' => $equipaments,
            'segments' => $segments,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $segments = $this->segment->all();
        return view('upload-select-segment', [
            'segments' => $segments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $segment = $this->segment->find($id);
        $equipaments = $this->equipament->all();
        $categories = $this->category->all();
        $marcas = $this->marca->all();
        $styles = $this->style->all();

        return view('upload', [
            'equipaments' => $equipaments,
            'segment' => $segment,
            'categories' => $categories,
            'marcas' => $marcas,
            'styles' => $styles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request) {

            $file = new $this->file;
            $file->user_id = auth()->user()->id;
            $file->nome = $request->nome;
            $file->descricao = $request->descricao;
            $file->segment_id = $request->segment_id;
            $file->category_id = $request->category_id;
            $file->equipament_id = $request->equipament_id;
            $file->instrumento = $request->instrumento;
            $file->tags = $request->tags;
            $file->link_audio = $request->link_audio;
            $file->link_video = $request->link_video;
            $file->privacidade = $request->privacidade;
            $file = $file->save();

            /* busca último registro do usuario logado na tabela files */
            $file = $this->file->where('user_id', auth()->user()->id)->latest()->first();
            $file_id = $file->id;

            if ($request->hasFile('file') && $request->file('file')->isValid()) {

                $requestFile = $request->file;
                $extension = $requestFile->getClientOriginalExtension();
                $fileName = md5($requestFile->getClientOriginalName() . strtotime('now')) . '.' . $extension;
                $requestFile->move(public_path('presets'), $fileName);

                $file->file_path = 'presets/' . $fileName;
                $file->save();
            }

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->image;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;
                $requestImage->move(public_path('images'), $imageName);

                $file->image_path = 'images/' . $imageName;
                $file->save();
            }

            /* verificar se o array styles foi enviado */
            $styles = $request->input('styles', []);

            if (!empty($styles)) {
                foreach ($styles as $styleId) {
                    // gravar na tabela files_styles considerando file_id e style_id //
                    $fileStyle = new $this->file_style;
                    $fileStyle->file_id = $file_id;
                    $fileStyle->style_id = $styleId;
                    $fileStyle->save();
                }
            }

            return redirect()->route('upload')->withErrors('Arquivo enviado com sucesso!');
        }

        return redirect()->back()->withErrors('Erro ao enviar o arquivo. Tente novamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        $user = $this->user->where('id', $file->user_id)->first();
        $styles = Consultas::style()->where('file_id', $file->id);
        $file = Consultas::preset()->where('id', $file->id)->first();
        $comments = Consultas::comment()->where('file_id', $file->id);
        $likes = $this->like->all();
        $shares = $this->share->all();

        $total_comments = $this->comment->where('file_id', $file->id)->count();
        $total_likes = $this->like->where('file_id', $file->id)->count();
        $total_shares = $this->share->where('file_id', $file->id)->count();

        return view('saiba_mais', [
            'file' => $file,
            'user' => $user,
            'styles' => $styles,
            'likes' => $likes,
            'shares' => $shares,
            'comments' => $comments,
            'total_comments' => $total_comments,
            'total_likes' => $total_likes,
            'total_shares' => $total_shares,
        ]);
    }

    public function downloadZip(Request $request)
    {
        // forçar compactação em zip de um arquivo e download //
        $filePath = $request->input('file_path');
        $fileName = 'All-Presets-' . basename($filePath);
        $zipFileName = pathinfo($fileName, PATHINFO_FILENAME) . '.zip';

        $zip = new ZipArchive;

        $zipPath = public_path('temp_zip/' . $zipFileName);
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {

            $zip->addFile(public_path($filePath), $fileName);
            $zip->close();

            // buscar na tabela downloads o último registro da coluna counter do file_id //
            $busca = $this->download
                ->where('file_id', $request->file_id)
                ->orderBy('created_at', 'desc')
                ->first();

            $totalDownloads = $busca ? $busca->counter + 1 : 1;

            $download = new $this->download;
            $download->file_id = $request->file_id;
            $download->user_id = auth()->user()->id;
            $download->counter = $totalDownloads;
            $download->downloaded_at = now();
            $download->save();

            return response()->download($zipPath)->deleteFileAfterSend(true);
        } else {
            return redirect()->back()->withErrors('Erro ao criar o arquivo zip.');
        }
    }

    public function share(File $file)
    {
        $link_file = $file->file_path;
        return back()->with('link_file', $link_file);
    }

    public function searchFiles(Request $request)
    {
        if ($request) {

            $files = Consultas::file()
                ->where('files.segment_id', $request->segment_id)
                ->where('files.equipament_id', $request->equipament_id)
                ->where('files.instrumento', 'like', $request->instrumento)
                ->paginate(10);

            $styles = Consultas::style();
            $segments = $this->segment->all();
            $likes = $this->like->all();
            $shares = $this->share->all();
            $comments = $this->comment->all();
            $downloads = $this->download->all();
            $marcas = $this->marca->all();
            $equipaments = $this->equipament->all();

            return view('inicio', [
                'files' => $files,
                'likes' => $likes,
                'shares' => $shares,
                'comments' => $comments,
                'downloads' => $downloads,
                'marcas' => $marcas,
                'equipaments' => $equipaments,
                'styles' => $styles,
                'segments' => $segments,
            ]);
        }
    }
}