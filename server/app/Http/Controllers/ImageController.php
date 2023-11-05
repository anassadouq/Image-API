<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

class ImageController extends Controller
{
    public function index()
    {
        return response(Image::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $image = new Image([
                'nom' => $request->input('nom'),
                'image' => $imagePath,
            ]);
    
            $image->save();
        }
    
        return response()->json([
            'message' => 'Image created successfully',
        ]);
    }       
 
    public function update(Request $request, Image $image){
        $request->validate([
            'nom'=>'required',
        ]);
        return response()->json([
            'message' => 'Item updated successfully'
        ]);
    }

    public function destroy(Image $image)
    {
        return response($image->delete());
    }
}