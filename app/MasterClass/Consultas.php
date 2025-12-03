<?php

namespace App\MasterClass;

use App\Models\Comment;
use App\Models\Download;
use App\Models\File;
use App\Models\LikeComment;
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
                'files.link_audio',
                'files.link_video',
                'e.nome as produto_nome',
                'e.id as produto_id',
                'e.descricao as produto_descricao',
                'u.id as user_id',
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
            ->groupBy(
                'files.id',
                'files.nome',
                'files.descricao',
                // ... (todos os outros campos 'files', 'e', 'u', 's' que estão no SELECT) //
                'e.nome',
                'e.id',
                'e.descricao',
                'u.id',
                'u.name',
                'u.email',
                'u.foto_perfil',
                's.nome'
            );
    }

    public static function style()
    {
        return Style::query()
            ->leftJoin('files_styles as fs', 'fs.style_id', '=', 'styles.id')
            ->leftJoin('files as f', 'f.id', '=', 'fs.file_id')
            ->select(
                'fs.file_id',
                'styles.nome as style',
                'styles.id'
            );
    }

    public static function download()
    {
        return Download::query()
            ->join('files as f', 'f.id', '=', 'downloads.file_id')
            ->join('users as u', 'u.id', '=', 'f.user_id')
            ->join('segments as s', 's.id', '=', 'f.segment_id')
            ->join('equipaments as e', 'e.id', '=', 'f.equipament_id')
            ->select(
                'downloads.id',
                'downloads.downloaded_at',
                'u.id as user_id',
                'u.name as user_name',
                'u.email as user_email',
                'u.foto_perfil as user_foto',
                'f.nome as file_name',
                'f.descricao as file_description',
                'f.id as file_id',
                'f.instrumento as instrumento',
                'f.created_at as file_date',
                'e.nome as produto_nome',
                'e.id as produto_id',
                'e.descricao as produto_descricao',
                's.nome as segmento'
            )
            ->groupBy(
                'file_id',
                'downloads.id',
                'downloads.downloaded_at',
                'u.id',
                'u.name',
                'u.email',
                'u.foto_perfil',
                'f.nome',
                'f.descricao',
                'f.id',
                'f.created_at',
                'f.instrumento',
                'e.nome',
                'e.id',
                'e.descricao',
                's.nome'
            );
    }

    public static function comment()
    {
        // user atual (0 se não autenticado)
        $userId = auth()->id() ?? 0;

        return Comment::query()
            // mantém o comentário completo (comments.*) para não perder atributos
            ->join('files as f', 'f.id', '=', 'comments.file_id')
            ->join('users as u', 'u.id', '=', 'comments.user_id')
            ->select(
                'comments.*',                 // <-- importante: deixa content, created_at, etc.
                'u.name as user_name',
                'u.email as user_email',
                'u.foto_perfil as user_foto',
                'f.nome as file_name',
                'f.descricao as file_description',
                'f.id as file_id',
                // contadores via subqueries (seguro mesmo com join)
                DB::raw("(SELECT COUNT(*) FROM likes_comments lc WHERE lc.comment_id = comments.id AND lc.like = 1) AS likes_count"),
                DB::raw("(SELECT COUNT(*) FROM likes_comments lc WHERE lc.comment_id = comments.id AND lc.dislike = 1) AS dislikes_count"),
                // reação do usuário atual (pode ser NULL, 0 ou 1)
                DB::raw("(SELECT lc.like FROM likes_comments lc WHERE lc.comment_id = comments.id AND lc.user_id = {$userId} LIMIT 1) AS user_like"),
                DB::raw("(SELECT lc.dislike FROM likes_comments lc WHERE lc.comment_id = comments.id AND lc.user_id = {$userId} LIMIT 1) AS user_dislike")
            );
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
                'u.id as user_id',
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
                'u.id',
                'u.name',
                'u.email',
                'u.foto_perfil',
                's.nome'
            )
            ->orderBy('total_downloads', 'desc');
    }

    public static function contLikesComments()
    {
        return LikeComment::query()
            ->leftJoin('comments as c', 'c.id', '=', 'like_comments.comment_id')
            ->leftJoin('users as u', 'u.id', '=', 'like_comments.user_id')
            ->select(
                'like_comments.id',
                'like_comments.comment_id',
                'like_comments.user_id',
                'like_comments.like',
                'like_comments.dislike',
                'c.content as comment_text',
                'u.name as user_name',
                'u.email as user_email',
                'u.foto_perfil as user_foto'
            );
    }

    public static function seguidores()
    {
        return DB::table('user_followers as uf')
            ->join('users as u', 'u.id', '=', 'uf.follower_id')
            ->select(
                'u.id as user_id',
                'u.name as user_name',
                'u.email as user_email',
                'u.foto_perfil as foto',
                'u.created_at'
            );
    }

    // public static function preset()
    // {
    //     return File::query()
    //         ->leftJoin('downloads as d', 'd.file_id', '=', 'files.id')
    //         ->leftJoin('comments as c', 'c.file_id', '=', 'files.id')
    //         ->leftJoin('shares as share', 'share.file_id', '=', 'files.id')
    //         ->leftJoin('likes as l', 'l.file_id', '=', 'files.id')
    //         ->leftJoin('user_followers as uf', 'uf.user_id', '=', 'files.user_id')
    //         ->join('equipaments as e', 'e.id', '=', 'files.equipament_id')
    //         ->join('segments as s', 's.id', '=', 'files.segment_id')
    //         ->join('users as u', 'u.id', '=', 'files.user_id')
    //         ->select(
    //             'files.id',
    //             'files.nome as nome',
    //             'files.descricao as descricao',
    //             'files.file_path as file_path',
    //             'files.image_path as img',
    //             'files.created_at as data',
    //             'files.privacidade',
    //             'files.instrumento',
    //             'files.tags',
    //             'e.nome as produto_nome',
    //             'e.id as produto_id',
    //             'e.descricao as produto_descricao',
    //             'u.name as user_name',
    //             'u.email as user_email',
    //             'u.foto_perfil as foto',
    //             's.nome as segmento',
    //             DB::raw('COUNT(DISTINCT d.id) as total_downloads'),
    //             DB::raw('COUNT(DISTINCT share.id) as total_shares'),
    //             DB::raw('COUNT(DISTINCT c.id) as total_comments'),
    //             DB::raw('COUNT(DISTINCT l.id) as total_likes'),
    //             DB::raw('COUNT(DISTINCT uf.follower_id) as total_seguidores')
    //         )
    //         ->where('files.segment_id', 1)
    //         ->groupBy(
    //             'files.id',
    //             'files.nome',
    //             'files.descricao',
    //             // ... (todos os outros campos 'files', 'e', 'u', 's' que estão no SELECT) //
    //             'e.nome',
    //             'e.id',
    //             'e.descricao',
    //             'u.name',
    //             'u.email',
    //             'u.foto_perfil',
    //             's.nome'
    //         );
    // }

    // public static function tone()
    // {
    //     return File::query()
    //         ->join('equipaments as e', 'e.id', '=', 'files.equipament_id')
    //         ->join('segments as s', 's.id', '=', 'files.segment_id')
    //         ->join('users as u', 'u.id', '=', 'files.user_id')
    //         ->select(
    //             'files.id',
    //             'files.nome as nome',
    //             'files.descricao as descricao',
    //             'files.file_path as file_path',
    //             'files.image_path as img',
    //             'files.created_at as data',
    //             'files.privacidade',
    //             'files.instrumento',
    //             'files.tags',
    //             'e.nome as produto_nome',
    //             'e.id as produto_id',
    //             'e.descricao as produto_descricao',
    //             'u.name as user_name',
    //             'u.email as user_email',
    //             'u.foto_perfil as foto',
    //             's.nome as segmento',
    //         )
    //         ->where('files.segment_id', 2);
    // }
}