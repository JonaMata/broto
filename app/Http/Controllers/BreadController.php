<?php

namespace App\Http\Controllers;

use App\Models\Bread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BreadController extends Controller
{
    public function index() {
        $breads = Bread::orderBy('rating', 'ASC')->paginate(10);
        return view('breads.index', ['breads' => $breads]);
    }

    public function create() {
        return view('breads.edit');
    }

    public function edit(Bread $bread) {
        return view('breads.edit', ['bread' => $bread]);
    }

    public function store(Request $request, Bread $bread = null) {
        $validated = $request->validate([
            'name' => 'required|string',
            'special_ingredient' => 'required|string',
            'huts' => 'required|string',
            'rating' => 'required|integer',
            'bake_date' => 'required|date',
        ]);
        if($bread == null) {
            $bread = new Bread($validated);
        } else {
            $bread->update($validated);
        }
        $photo = $request->file('photo');
        if($photo != null) {
            $bread->addPhoto($photo);
        }
        $bread->save();
        return redirect()->route('breads::index');
    }

    public function delete(Bread $bread) {
        $bread->delete();
        return redirect()->back();
    }

    public function photo(Bread $bread) {
        return response()->file(Storage::path($bread->photo_path));
    }
}
