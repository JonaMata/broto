<?php

namespace App\Http\Controllers;

use App\Models\Bruote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BruoteController extends Controller
{
    public function index() {
        $bruotes = Bruote::paginate(20);
        return view('bruotes.index', ['bruotes' => $bruotes]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'bruote' => 'required',
            'author' => 'required|integer'
        ]);

        $author = User::findOrFail($validated['author']);

        $bruote = new Bruote([
            'bruote' => $validated['bruote'],
            'author_id' => $author->id,
            'placer_id' => Auth::user()->id,
        ]);

        $bruote->save();
        return redirect()->route('bruotes::index');
    }

    public function delete(Request $request, $id) {
        $bruote = Bruote::findOrFail($id);
        $bruote->delete();
        return redirect()->back();
    }
}
