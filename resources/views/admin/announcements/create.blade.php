@extends('layouts.admin', ['title' => 'Ongeza Tangazo', 'heading' => 'Ongeza tangazo'])

@section('content')
    @include('admin.announcements.form', ['action' => route('admin.announcements.store'), 'method' => 'POST', 'announcement' => null])
@endsection
