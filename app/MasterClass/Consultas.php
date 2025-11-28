<?php

namespace App\MasterClass;

use App\Models\Comment;
use App\Models\Download;
use App\Models\File;
use App\Models\Style;
use Illuminate\Support\Facades\DB;

class Consultas
{
    public static function file()
    {
        return File::query()
            ->leftJoin('downloads as d', 'd.file_id', '=', 'files.id')
            ->leftJoin('comments as c', 'c.file_id', '=', 'files.id')
            ->leftJoin('shares as share', 'share.file_id', '=', 'files.id')
            ->leftJoin('likes as l', 'l.file_id', '=', 'files.id')
            ->leftJoin('user_followers as uf', 'uf.user_id', '=', 'files.user_id')
            ->join('equipaments as e', 'e.id', '=', 'files.equipament_id')
            ->join('segments as s', 's.id', '=', 'files.segment_id')
            ->join('users as u', 'u.id', '=', 'files.user_id')
            ->select(
                'files.id',
                'files.nome as nome',
                'files.descricao as descricao',
                'files.file_path as file_path',
                'files.image_path as img',
                'files.created_at as data',
                'files.privacidade',
                'files.instrumento',
                'files.tags',
                'e.nome as produto_nome',
                'e.id as produto_id',
                'e.descricao as produto_descricao',
                'u.name as user_name',
                'u.email as user_email',
                'u.foto_perfil as foto',
                's.nome as segmento',
                DB::raw('COUNT(DISTINCT d.id) as total_downloads'),
                DB::raw('COUNT(DISTINCT share.id) as total_shares'),
                DB::raw('COUNT(DISTINCT c.id) as total_comments'),
                DB::raw('COUNT(DISTINCT l.id) as total_likes'),
                DB::raw('COUNT(DISTINCT uf.follower_id) as total_seguidores')
            )
            ->where('files.privacidade', 'publico')
            ->groupBy(
                'files.id',
                'files.nome',
                'files.descricao',
                // ... (todos os outros campos 'files', 'e', 'u', 's' que estão no SELECT) //
                'e.nome',
                'e.id',
                'e.descricao',
                'u.name',
                'u.email',
                'u.foto_perfil',
                's.nome'
            );
    }

    public static function preset()
    {
        return File::query()
            ->leftJoin('downloads as d', 'd.file_id', '=', 'files.id')
            ->leftJoin('comments as c', 'c.file_id', '=', 'files.id')
            ->leftJoin('shares as share', 'share.file_id', '=', 'files.id')
            ->leftJoin('likes as l', 'l.file_id', '=', 'files.id')
            ->leftJoin('user_followers as uf', 'uf.user_id', '=', 'files.user_id')
            ->join('equipaments as e', 'e.id', '=', 'files.equipament_id')
            ->join('segments as s', 's.id', '=', 'files.segment_id')
            ->join('users as u', 'u.id', '=', 'files.user_id')
            ->select(
                'files.id',
                'files.nome as nome',
                'files.descricao as descricao',
                'files.file_path as file_path',
                'files.image_path as img',
                'files.created_at as data',
                'files.privacidade',
                'files.instrumento',
                'files.tags',
                'e.nome as produto_nome',
                'e.id as produto_id',
                'e.descricao as produto_descricao',
                'u.name as user_name',
                'u.email as user_email',
                'u.foto_perfil as foto',
                's.nome as segmento',
                DB::raw('COUNT(DISTINCT d.id) as total_downloads'),
                DB::raw('COUNT(DISTINCT share.id) as total_shares'),
                DB::raw('COUNT(DISTINCT c.id) as total_comments'),
                DB::raw('COUNT(DISTINCT l.id) as total_likes'),
                DB::raw('COUNT(DISTINCT uf.follower_id) as total_seguidores')
            )
            ->where('files.segment_id', 1)
            ->groupBy(
                'files.id',
                'files.nome',
                'files.descricao',
                // ... (todos os outros campos 'files', 'e', 'u', 's' que estão no SELECT) //
                'e.nome',
                'e.id',
                'e.descricao',
                'u.name',
                'u.email',
                'u.foto_perfil',
                's.nome'
            )
            ->paginate(20);
    }

    public static function tone()
    {
        return File::query()
            ->join('equipaments as e', 'e.id', '=', 'files.equipament_id')
            ->join('segments as s', 's.id', '=', 'files.segment_id')
            ->join('users as u', 'u.id', '=', 'files.user_id')
            ->select(
                'files.id',
                'files.nome as nome',
                'files.descricao as descricao',
                'files.file_path as file_path',
                'files.image_path as img',
                'files.created_at as data',
                'files.privacidade',
                'files.instrumento',
                'files.tags',
                'e.nome as produto_nome',
                'e.id as produto_id',
                'e.descricao as produto_descricao',
                'u.name as user_name',
                'u.email as user_email',
                'u.foto_perfil as foto',
                's.nome as segmento',
            )
            ->where('files.segment_id', 2)
            ->get();
    }

    public static function style()
    {
        return Style::query()
            ->join('files_styles as fs', 'fs.style_id', '=', 'styles.id')
            ->join('files as f', 'f.id', '=', 'fs.file_id')
            ->select(
                'fs.file_id as file_id',
                'styles.nome as style',
                'styles.id as style_id'
            )
            ->get();
    }

    public static function download()
    {
        // retornar total de downloads por arquivo //
        return Download::query()
            ->select(
                'file_id',
                DB::raw('COUNT(*) as total_downloads')
            )
            ->groupBy('file_id')
            ->orderByDesc('total_downloads')
            ->get();
    }

    public static function comment()
    {
        return Comment::query()
            ->join('files as f', 'f.id', '=', 'comments.file_id')
            ->join('users as u', 'u.id', '=', 'comments.user_id')
            ->select(
                'comments.id',
                'comments.user_id as user_id',
                'comments.content as texto',
                'comments.created_at',
                'u.name as user_name',
                'u.email as user_email',
                'u.foto_perfil as user_foto',
                'f.nome as file_name',
                'f.descricao as file_description',
                'f.id as file_id'
            )
            ->get();
    }

    public static function orderDownloads()
    {
        return File::query()
            ->leftJoin('downloads as d', 'd.file_id', '=', 'files.id')
            ->leftJoin('comments as c', 'c.file_id', '=', 'files.id')
            ->leftJoin('shares as share', 'share.file_id', '=', 'files.id')
            ->leftJoin('likes as l', 'l.file_id', '=', 'files.id')
            ->leftJoin('user_followers as uf', 'uf.user_id', '=', 'files.user_id')
            ->join('equipaments as e', 'e.id', '=', 'files.equipament_id')
            ->join('segments as s', 's.id', '=', 'files.segment_id')
            ->join('users as u', 'u.id', '=', 'files.user_id')
            ->select(
                'files.id',
                'files.nome as nome',
                'files.descricao as descricao',
                'files.file_path as file_path',
                'files.image_path as img',
                'files.created_at as data',
                'files.privacidade',
                'files.instrumento',
                'files.tags',
                'e.nome as produto_nome',
                'e.id as produto_id',
                'e.descricao as produto_descricao',
                'u.name as user_name',
                'u.email as user_email',
                'u.foto_perfil as foto',
                's.nome as segmento',
                DB::raw('COUNT(DISTINCT d.id) as total_downloads'),
                DB::raw('COUNT(DISTINCT share.id) as total_shares'),
                DB::raw('COUNT(DISTINCT c.id) as total_comments'),
                DB::raw('COUNT(DISTINCT l.id) as total_likes'),
                DB::raw('COUNT(DISTINCT uf.follower_id) as total_seguidores')
            )
            ->where('files.privacidade', 'publico')
            ->groupBy(
                'files.id',
                'files.nome',
                'files.descricao',
                // ... (todos os outros campos 'files', 'e', 'u', 's' que estão no SELECT) //
                'e.nome',
                'e.id',
                'e.descricao',
                'u.name',
                'u.email',
                'u.foto_perfil',
                's.nome'
            )
            ->orderBy('total_downloads', 'desc');
    }
}