@extends('layouts.app')

@section('content')
<form method="post" action="{{ url('/editSong') }}" autocomplete="off">
    {{ csrf_field() }}
    <input type="hidden" name="song_id" value="{{ $song->id }}">
    <div class="container-box">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>Song Information (Edit)</span>
                <input type="submit" name="update" value="Update">
            </div>

            <table class="table table-hover">
                <tr>
                    <td>Song Name</td>
                    <td>
                        <input type="text" name="name" placeholder="{{ $song->name }}">
                    </td>
                </tr>
                <tr>
                    <td>Artist</td>
                    <td>
                        <input type="text" name="artist" placeholder="{{ $song->artist }}">
                    </td>
                </tr>
                <tr>
                    <td>Composer</td>
                    <td>
                        <input type="text" name="composer" placeholder="{{ $song->composer }}">
                    </td>
                </tr>
                <tr>
                    <td>Writer</td>
                    <td>
                        <input type="text" name="writer" placeholder="{{ $song->writer }}">
                    </td>
                </tr>
                <tr>
                    <td>Key</td>
                    <td>
                        <input type="text" name="key" placeholder="{{ $song->key }}">
                    </td>
                </tr>
                <tr>
                    <td>Major</td>
                    <td>
                        <input type="text" name="major" placeholder="{{ $song->major }}">
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="container-box">
        <div class="panel panel-default">
            <div class="panel-heading">Chord and Lyric</div>
            <hr style="margin-top: 0">
            @if (empty($songContents))
            @for ($i = 0; $i < 30; $i++)
            <div class="chord-lyric hide">
                <div class="chord">
                    <input type="text" class="inputChord" name="chord_{{$i}}" placeholder="chord">
                </div>
                <div class="lyric">
                    <input type="text" class="inputLyric" name="lyric_{{$i}}" placeholder="lyric">
                </div>
                <hr>
            </div>
            @endfor
            @else
            @foreach ($songContents as $i => $songContent)
            <div class="chord-lyric">
                <div class="chord">
                    <input type="text" class="inputChord" name="chord_{{$i}}" placeholder="{{ $songContent['chord'] }}">
                </div>
                <div class="lyric">
                    <input type="text" class="inputLyric" name="lyric_{{$i}}" placeholder="{{ $songContent['lyric'] }}">
                </div>
                <hr>
            </div>
            @endforeach
            @for ($k = $i + 1; $k < $i + 30; $k++)
            <div class="chord-lyric hide">
                <div class="chord">
                    <input type="text" class="inputChord" name="chord_{{$k}}" placeholder="chord">
                </div>
                <div class="lyric">
                    <input type="text" class="inputLyric" name="lyric_{{$k}}" placeholder="lyric">
                </div>
                <hr>
            </div>
            @endfor
            @endif

            <div id="addArea">
                <div class="btn btn-primary addBtn">Add</div>
            </div>
        </div>
    </div>
</form>
@endsection
