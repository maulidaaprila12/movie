@extends('layouts.template')

@section('title', 'Tambah Movie')

@section('content')

<div class="container mt-4">
    <h2>Tambah Movie</h2>

    <form action="{{ url('/movies/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('movies.partials.form')
    </form>
</div>

@endsection