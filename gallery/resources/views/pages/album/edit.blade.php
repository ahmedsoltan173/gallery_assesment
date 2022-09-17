@extends('layouts.app')

@section('content')
<div class="container">
    <form class="form" action="{{ route('album.update',$album->id) }}" method="POST"
    enctype="multipart/form-data">
    @csrf

    <div class="row justify-content-center" style="direction: rtl">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="projectinput1">Album name</label>
                    <input type="text"  id="name"
                           class="form-control"
                           placeholder="Name of album"
                           name="name"
                           value="{{ $album->name }}">
                           @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                           @enderror
                </div>
                <input type="submit" class="btn btn-primary" style="margin-top: 50px;width:150px; ">
            </div>







    </div>
    </form>
</div>
@endsection
