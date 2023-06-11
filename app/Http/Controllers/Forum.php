<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Forum as ModelsForum;
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
                $comentario->delete();
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
                'comentario_id' => 'integer'
            ]);
            $comentario = new Comentario();
            $comentario->comentario = $request->comentario;
            $comentario->usuario_id = $request->user()->id;
            $comentario->forum_id = $request->forum_id;
            $comentario->comentario_id = $request->comentario_id;
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
}
