@extends('layouts.app')

@section('content')
<div class="container">
    <form class="form" action="{{ route('image.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf

    <div class="row justify-content-center" style="direction: rtl">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="projectinput1">Image name</label>
                    <input type="text" value="" id="name"
                           class="form-control"
                           placeholder="Name of album"
                           name="name">
                           @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                           @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="projectinput1">Image</label>
                    <input type="file" value="" id="name"
                           class="form-control"
                           placeholder="Name of album"
                           name="image">
                           @error('image')
                            <span class="text-danger"> {{ $message }}</span>
                           @enderror
                        </div>
                        <input type="hidden" name='album_id' value='{{ $id}}'>
                    </div>

                    <br><br>
                    <input type="submit" class="btn btn-primary" style="margin-top: 50px;width:150px; ">







    </div>
    </form>
</div>
@endsection
