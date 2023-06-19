<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    // View File To Upload Image
    public function index()
    {
        return view('image-form');
    }

    // Store Image
    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = 'img' . $request->user()->id . '-' . time() . '.' . $request->image->extension();

        $request->image->storeAs('images', $imageName);

        return back()->with('success', 'Image uploaded Successfully!')
            ->with('image', $imageName);
    }
}
