@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <form action="{{route('articles.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" required>
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}    
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input type="text" name="content" class="form-control @error('content') is-invalid @enderror" value="{{old('content')}}" required>
                    @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}    
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{old('image')}}" required>
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}    
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection