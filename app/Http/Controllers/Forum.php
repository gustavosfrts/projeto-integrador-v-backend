<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Forum as ModelsForum;
use App\Models\ImagemForum;
use App\Models\LikeComentario;
use App\Models\LikeForum;
use App\Models\Usuario;
use Exception;
use Illuminate\Http\Request;

class Forum extends Controller
{
    function listagemForums(Request $request)
    {
        try {
            $forums = ModelsForum::all();
            return response()->json([
                'data' => $forums,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function forum(Request $request, $id)
    {
        try {
            $forum = ModelsForum::find($id);
            if (!$forum) {
                return response()->json([
                    'data' => null,
                    'error' => 'Forum não encontrado'
                ], 404);
            }
            $comentarios = Comentario::where('forum_id', $id)->get();
            foreach ($comentarios as $comentario) {
                $comentario->usuario = Usuario::select('id', 'nome', 'email')->where('id', $comentario->usuario_id)->get();
                $comentario->likes = LikeComentario::where('comentario_id', $comentario->id)->count();
            }
            $comentariosAninhados = [];
            $comentariosArray = $comentarios->toArray();
            $this->aninharRespostas($comentariosArray, $comentariosAninhados);

            $forum->comentarios = $comentariosAninhados;
            return response()->json([
                'data' => $forum,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function aninharRespostas(&$comentarios, &$comentariosAninhados, $comentarioId = null)
    {
        foreach ($comentarios as &$comentario) {
            if ($comentario['comentario_id'] === $comentarioId) {
                $comentario['respostas'] = [];
                $this->aninharRespostas($comentarios, $comentario['respostas'], $comentario['id']);
                $comentariosAninhados[] = $comentario;
            }
        }
    }

    function createForum(Request $request)
    {
        try {
            $request->validate([
                'titulo' => 'required|string',
                'descricao' => 'required|string',
                'comentario' => 'required|string'
            ]);
            $forum = new ModelsForum();
            $forum->titulo = $request->titulo;
            $forum->descricao = $request->descricao;
            $forum->usuario_id = $request->user()->id;
            $forum->save();

            $comentario = new Comentario();
            $comentario->comentario = $request->comentario;
            $comentario->usuario_id = $request->user()->id;
            $comentario->forum_id = $forum->id;
            $comentario->save();
            return response()->json([
                'data' => $forum,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function updateForum(Request $request, $id)
    {
        try {
            $request->validate([
                'titulo' => 'required|string',
                'descricao' => 'required|string',
                'comentario' => 'required|string'
            ]);
            $forum = ModelsForum::find($id);
            if (!$forum) {
                return response()->json([
                    'data' => null,
                    'error' => 'Forum não encontrado'
                ], 404);
            }
            $forum->titulo = $request->titulo;
            $forum->descricao = $request->descricao;
            $forum->usuario_id = $request->user()->id;
            $forum->save();

            $comentario = Comentario::where('forum_id', $forum->id)->first();
            $comentario->comentario = $request->comentario;
            $comentario->usuario_id = $request->user()->id;
            $comentario->forum_id = $forum->id;
            $comentario->save();
            return response()->json([
                'data' => $forum,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function deleteForum(Request $request, $id)
    {
        try {
            $forum = ModelsForum::find($id);
            $comentarios = Comentario::where('forum_id', $forum->id)->get();
            foreach ($comentarios as $comentario) {
                $likes = LikeComentario::where('comentario_id', $comentario->id)->get();
                foreach ($likes as $like) {
                    $like->delete();
                }
                $filhosComentarios = Comentario::where('comentario_id', $comentario->id)->get();
                foreach ($filhosComentarios as $filhoComentario) {
                    $likesFilhosComentarios = LikeComentario::where('comentario_id', $filhoComentario->id)->get();
                    foreach ($likesFilhosComentarios as $likeFilhoComentario) {
                        $likeFilhoComentario->delete();
                    }
                    $filhosComentarios1 = Comentario::where('comentario_id', $filhoComentario->id)->get();
                    foreach ($filhosComentarios1 as $filhoComentario1) {
                        $filhoComentario1->delete();
                    }
                    $filhoComentario->delete();
                }
                $comentario->delete();
            }
            $likesForum = LikeForum::where('forum_id', $forum->id)->get();
            foreach ($likesForum as $likeForum) {
                $likeForum->delete();
            }

            $forum->delete();
            return response()->json([
                'data' => $forum,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function createComentario(Request $request)
    {
        try {
            $request->validate([
                'comentario' => 'required|string',
                'forum_id' => 'required|integer',
                'comentario_id' => 'integer',
                'path' => 'string'
            ]);

            $comentario = new Comentario();
            $comentario->comentario = $request->comentario;
            $comentario->usuario_id = $request->user()->id;
            $comentario->forum_id = $request->forum_id;
            $comentario->comentario_id = $request->comentario_id;
            $comentario->save();

            if ($request->path) {
                $imagem = new ImagemForum();
                $imagem->caminho = $request->path;
                $imagem->forum_id = $request->forum_id;
                $imagem->comentario_id = $comentario->id;
                $imagem->save();
            }

            return response()->json([
                'data' => $comentario,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function updateComentario(Request $request, $id)
    {
        try {
            $request->validate([
                'comentario' => 'required|string'
            ]);
            $comentario = Comentario::find($id);
            $comentario->comentario = $request->comentario;
            $comentario->save();
            return response()->json([
                'data' => $comentario,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function deleteComentario(Request $request, $id)
    {
        try {
            $comentario = Comentario::find($id);
            $comentario->delete();
            return response()->json([
                'data' => $comentario,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function likeComentario(Request $request)
    {
        try {
            $request->validate([
                'comentario_id' => 'required|integer'
            ]);
            $like = LikeComentario::where('usuario_id', $request->user()->id)->where('comentario_id', $request->comentario_id)->first();
            if ($like) {
                return response()->json([
                    'data' => $like,
                    'error' => 'Você já curtiu esse comentário'
                ], 400);
            }
            $like = new LikeComentario();
            $like->usuario_id = $request->user()->id;
            $like->comentario_id = $request->comentario_id;
            $like->save();
            return response()->json([
                'data' => $like,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    function unlikeComentario(Request $request)
    {
        try {
            $request->validate([
                'comentario_id' => 'required|integer'
            ]);

            $like = LikeComentario::where('usuario_id', $request->user()->id)->where('comentario_id', $request->comentario_id)->first();
            $like->delete();
            return response()->json([
                'data' => $like,
                'error' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => $like,
                'error' => 'Erro: ' . $e->getMessage()
            ], 500);
        }
    }
}
