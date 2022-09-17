@extends('layouts.app')

@section('content')
<div class="container">
    <form class="form" action="{{ route('image.update',$image->id) }}" method="POST"
    enctype="multipart/form-data">
    @csrf

    <div class="row justify-content-center" style="direction: rtl">
            <div class="col-md-12   ">
                <div class="form-group">
                    <label for="projectinput1">Image name</label>
                    <input type="text"  id="name"
                           class="form-control"
                           value="{{ $image->name }}"
                           placeholder="Name of album"
                           name="name">
                           @error('name')
                            <span class="text-danger"> {{ $message }}</span>
                           @enderror
                </div>
            </div>
            <input type="hidden" name="old_image" value='{{ $image->image }}'>
            <input type="hidden" name="album_id" value='{{ $image->album_id }}'>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="projectinput1">Image</label>
                    <input type="file"  id="name"
                           class="form-control"
                           placeholder="Name of album"
                           name="image">
                           @error('image')
                            <span class="text-danger"> {{ $message }}</span>
                           @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="projectinput1">album</label>
                    <select name="album_id" id=""class="form-control"  >
                        <option value="{{ $image->album->id }}">{{ $image->album->name }}</option>
                        @foreach ($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                        @endforeach
                    </select>


                           @error('image')
                            <span class="text-danger"> {{ $message }}</span>
                           @enderror
                </div>
                <input type="submit" class="btn btn-primary" style="margin-top: 50px;width:150px; ">

            </div>








    </div>
    </form>
</div>
@endsection
