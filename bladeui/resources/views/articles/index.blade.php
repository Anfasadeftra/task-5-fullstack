@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <a href="{{ route('articles.create') }}" class="btn btn-primary my-3">
                Add Articles
                </a>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show my-1" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Content</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $key => $item)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->content }}</td>
                                <td>{{ $item->image }}</td>
                                <td>
                                    <a href="{{ route('articles.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form method="POST" action="{{route('articles.destroy', [$item->id])}}" class="d-inline" onsubmit="return confirm('Move categories to trash ?')">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        @endforeach   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection