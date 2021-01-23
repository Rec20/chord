<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Song;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $songs = Song::get();
        $data = ['songs' => $songs];
        return view('home', $data);
    }

    public function createSong(Request $request)
    {
        $data = $request->all();
        Song::insert([
            'name' => $data['name'],
            'key' => $data['key'],
            'major' => (int) $data['major'],
            'artist' => $data['artist'],
            'writer' => $data['writer'],
            'composer' => $data['composer'],
        ]);
        return redirect('/');
    }
}
