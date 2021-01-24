@extends('layouts.app')

@section('content')
<div class="container-box">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span>Song Information</span>
            <a class="btn btn-primary edit-song" href="{{ url('/song/' . $song->id . '/edit') }}">Edit</a>
            <div style="clear: both"></div>
        </div>

        <table class="table table-hover">
            <tr>
                <td>Song Name</td>
                <td>{{ $song->name }}</td>
            </tr>
            <tr>
                <td>Artist</td>
                <td>{{ $song->artist }}</td>
            </tr>
            <tr>
                <td>Composer</td>
                <td>{{ $song->composer }}</td>
            </tr>
            <tr>
                <td>Writer</td>
                <td>{{ $song->writer }}</td>
            </tr>
            <tr>
                <td>Original Key</td>
                <td>{{ $song->scale }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="container-box chord-area">
    <div class="panel panel-default">
        <div class="panel-heading">Chords and Lyrics</div>
        <hr style="margin-top: 0">
        @foreach ($songContents as $songContent)
        <div class="chord">{{ $songContent['chord'] }}</div>
        <div class="lyric">{{ $songContent['lyric'] }}</div>
        <hr>
        @endforeach
    </div>
</div>
<div style="height:11vh"></div>
<div class="panel panel-default key-controller">
    <div class="btn btn-primary controller-btn key-up">UP</div>
    <div class="btn btn-primary controller-btn key-down">DOWN</div>
    <div class="btn btn-primary controller-btn key-original">Orig.</div>
    <div class="capo controller-btn">
        <span>Capo: </span>
        <span id="capoCount">{{ $song->capo }}</span>
    </div>
    <div class="btn btn-primary speed-up controller-btn">▲</div>
    <div class="speed controller-btn">
        <span>Speed: </span>
        <span id="speedCount">5</span>
    </div>
    <div class="btn btn-primary controller-btn speed-down">▼</div>
    <div class="btn btn-success toggle-controller">ー</div>
</div>
<script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>

@endsection
