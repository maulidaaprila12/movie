@extends('layouts.template')

@section('title', 'Edit Movie')

@section('content')

<div class="container mt-4">
    <h2>Edit Movie</h2>

    <form action="{{ url('/movies/update/'.$movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('movies.partials.form')
    </form>
</div>

@endsection