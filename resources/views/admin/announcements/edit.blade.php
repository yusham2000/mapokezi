@extends('layouts.admin', ['title' => 'Hariri Tangazo', 'heading' => 'Hariri tangazo'])

@section('content')
    @include('admin.announcements.form', ['action' => route('admin.announcements.update', $announcement), 'method' => 'PUT', 'announcement' => $announcement])
@endsection
