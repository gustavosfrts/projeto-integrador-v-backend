<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Garantia as ModelGarantia;
use Exception;
use Illuminate\Support\Facades\Auth;

class Manual extends Controller
{
    function listagemManuais(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|integer'
            ]);
            $product_id = $request->get("product_id");
            return response()->json([
                'data' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ipsum nisi, vulputate id dolor eu, lacinia feugiat sem. Nulla leo leo, elementum in convallis et, fringilla at urna. Quisque a lacus risus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec ut aliquet enim, eget pretium nunc. Cras sed urna quam. Suspendisse sodales pretium felis, sed aliquam mauris rutrum vitae. Phasellus vitae mattis sapien. Sed elementum quam eu ante tristique bibendum. Maecenas lobortis nisl ac mauris euismod lacinia. Etiam posuere justo in diam feugiat, a ullamcorper erat semper. Suspendisse potenti. In eget tincidunt est. Phasellus euismod elit eget pellentesque semper. Fusce quis dignissim ligula. Quisque lacus velit, faucibus sed hendrerit ac, accumsan sagittis ligula "
                    . $product_id,
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
