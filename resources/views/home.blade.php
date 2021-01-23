@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>Song List</span>
                    <button type="button" class="btn btn-primary create-song" data-toggle="modal" data-target="#modal">Create</button>
                    <div style="clear: both"></div>
                </div>

                <table class="table table-hover">
                    @foreach ($songs as $song)
                    <tr class="song-list" data-href="{{ url('/song/' . $song->id) }}">
                        <td>{{ $song->name }}</td>
                        <td>{{ $song->artist }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog">
    <form method="post" action="{{ url('/createSong') }}">
        {{ csrf_field() }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    New Song
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <tr>
                            <td>Song Name</td>
                            <td>
                                <input type="text" name="name" required="true">
                            </td>
                        </tr>
                        <tr>
                            <td>Artist</td>
                            <td>
                                <input type="text" name="artist" required="true">
                            </td>
                        </tr>
                        <tr>
                            <td>Composer</td>
                            <td>
                                <input type="text" name="composer" required="true">
                            </td>
                        </tr>
                        <tr>
                            <td>Writer</td>
                            <td>
                                <input type="text" name="writer" required="true">
                            </td>
                        </tr>
                        <tr>
                            <td>Original Key</td>
                            <td>
                                <input type="text" name="key" required="true">
                            </td>
                        </tr>
                        <tr>
                            <td>Major or Minor</td>
                            <td>
                                <label class="radio-inline">
                                    <input class="form-check-input" type="radio" name="major" value="1" checked="true">
                                    major
                                </label>
                                <label class="radio-inline">
                                    <input class="form-check-input" type="radio" name="major" value="0">
                                    minor
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="create" value="Create">
                </div>
            </div>
        </div>
    </form> 
</div>
<script src="./js/jquery-3.5.1.min.js"></script>
@endsection
