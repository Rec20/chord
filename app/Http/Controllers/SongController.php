<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Song;
use App\Models\Chord;
use App\Models\Lyric;

class SongController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        # Song
        $keysMajor = ['C','C#','D','D#','E','F','F#','G','G#','A','A#','B'];
        $keysMinor = ['A','A#','B','C','C#','D','D#','E','F','F#','G','G#'];
        $song = Song::where('id', $id)->first();
        if(!$song->major){
            $song->scale = $song->key . 'm';
            $song->capo = array_search($song->key, $keysMinor);
        } else {
            $song->scale = $song->key;
            $song->capo = array_search($song->key, $keysMajor);
        }
        $data['song'] = $song;

        $chords = Chord::where('song_id', $id)->get();
        $lyrics = Lyric::where('song_id', $id)->get();

        $songContents = [];
        foreach($chords as $chord) {
            $songContents[$chord->row]['chord'] = $chord->text;
        }
        foreach($lyrics as $lyric) {
            $songContents[$lyric->row]['lyric'] = $lyric->text;
        }
        
        $songContentsCount = count($songContents);
        for($i = 0; $i < $songContentsCount; $i++) {
            if (!array_key_exists('chord', $songContents[$i])) {
                $songContents[$i]['chord'] = '-';
            }

            if (!array_key_exists('lyric', $songContents[$i])) {
                $songContents[$i]['lyric'] = '-';
            }
        }

        $data['songContents'] = $songContents;

        return view('song', $data);
    }

    public function edit($id)
    {
        # Song
        $song = Song::where('id', $id)->first();
        if(!$song->major){
            $song->scale = $song->key . 'm';
        } else {
            $song->scale = $song->key;
        }
        $data['song'] = $song;

        $chords = Chord::where('song_id', $id)->get();
        $lyrics = Lyric::where('song_id', $id)->get();

        $songContents = [];
        foreach($chords as $chord) {
            $songContents[$chord->row]['chord'] = $chord->text;
        }
        foreach($lyrics as $lyric) {
            $songContents[$lyric->row]['lyric'] = $lyric->text;
        }
        
        $songContentsCount = count($songContents);
        for($i = 0; $i < $songContentsCount; $i++) {
            if (!array_key_exists('chord', $songContents[$i])) {
                $songContents[$i]['chord'] = '-';
            }

            if (!array_key_exists('lyric', $songContents[$i])) {
                $songContents[$i]['lyric'] = '-';
            }
        }

        $data['songContents'] = $songContents;

        return view('edit', $data);
    }

    public function editSong(Request $request)
    {
        $data = $request->all();
        $song_id = $data['song_id'];
        foreach ($data as $key => $value) {
            if ($key === 'name' && !is_null($value)) {
                Song::where('id', $song_id)
                    ->update(['name' => $value]);

            } elseif ($key === 'artist' && !is_null($value)) {
                Song::where('id', $song_id)
                    ->update(['artist' => $value]);

            } elseif ($key === 'composer' && !is_null($value)) {
                Song::where('id', $song_id)
                    ->update(['composer' => $value]);

            } elseif ($key === 'writer' && !is_null($value)) {
                Song::where('id', $song_id)
                    ->update(['writer' => $value]);

            } elseif ($key === 'key' && !is_null($value)) {
                Song::where('id', $song_id)
                    ->update(['key' => $value]);

            } elseif ($key === 'major' && !is_null($value)) {
                Song::where('id', $song_id)
                    ->update(['major' => (int) $value]);

            } elseif (strpos($key, 'chord') === 0 && !is_null($value)) {
                $chordPosition = explode('_', $key);
                $row = $chordPosition[1];
                $chord = Chord::where('song_id', $song_id)
                    ->where('row', $row)
                    ->first();
                if (is_null($chord)){
                    Chord::insert([
                        'song_id' => $song_id,
                        'row' => $row,
                        'text' => $value
                    ]);
                } else {
                    if ($value === '-'){
                        Chord::where('id', $chord->id)->delete();
                    }else{
                        Chord::where('id', $chord->id)
                            ->update([
                                'text' => $value
                            ]);
                    }
                }
            } elseif (strpos($key, 'lyric') === 0 && !is_null($value)) {
                $chordPosition = explode('_', $key);
                $row = $chordPosition[1];
                $lyric = Lyric::where('song_id', $song_id)
                    ->where('row', $row)
                    ->first();
                if (is_null($lyric)){
                    Lyric::insert([
                        'song_id' => $song_id,
                        'row' => $row,
                        'text' => $value
                    ]);
                } else {
                    if ($value === '-'){
                        Lyric::where('id', $lyric->id)->delete();
                    }else{
                        Lyric::where('id', $lyric->id)
                            ->update([
                                'text' => $value
                            ]);
                    }
                }
            }
        }

        return redirect('/song/' . $song_id);
    }
}
