@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
<div class="container">
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif
<div class="container">
    <form class="form" action="{{ route('album.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf

    <div class="row justify-content-center" style="direction: rtl">
        @foreach ($albums as $album)

        <div class="col-md-4">
            <div class="form-group">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h2 class="card-title" style="text-align: center;margin: 49px 0;">{{ $album->name }} </h5>
                            <a href="{{ route('album.show',$album->id) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('album.edit',$album->id) }}" class="btn btn-success">edit</a>
                            <a href="{{ route('album.destroy',$album->id) }}" onclick="alert('are you sure you need to delete this album')" class="btn btn-danger">delete</a>
                            <br>
                            <hr>
                            <a href="{{ route('album.destroyAll',$album->id) }}" onclick="alert('are you sure you need to delete All images in this album !')" class="btn btn-warning">delete All Images</a>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach









    </div>
    </form>
    <a href="{{ route('album.create') }}" class="btn btn-primary">Create New Album</a>
</div>
@endsection
