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
            <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" required>
                    @error('name')
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