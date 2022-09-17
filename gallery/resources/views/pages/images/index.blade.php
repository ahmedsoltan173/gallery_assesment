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

{{-- @if (Route::currentRouteName()=="album.show")
    <a href="{{ route('album.destroyAll',$image->id) }}" onclick="alert('are you sure you need to delete All images in this album !')" class="btn btn-danger">delete</a>
@endif --}}

<div class="container">
    <form class="form" action="{{ route('album.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf

    <div class="row justify-content-center" style="direction: rtl">
        @foreach ($images as $image)
        {{-- {{ $image->name }} --}}
            <div class="col-md-4">
                <div class="form-group">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('storage/image/'.$image->image) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            {{ $image->album->name }}
                          <h2 class="card-text" style="text-align: center;">{{ $image->name }}</p>
                            <a href="{{ route('image.edit',$image->id) }}" class="btn btn-success">edit</a>
                            <a href="{{ route('image.destroy',$image->id) }}"onclick="alert('are you sure you need to delete this image')" class="btn btn-danger">Delete</a>
                        </div>
                      </div>
                    </div>
                </div>
                @endforeach









    </div>
    </form>
</div>
    <a href="{{ route('image.create',$id) }}" class="btn btn-primary">Create New Image</a>

@endsection
