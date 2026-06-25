@extends('layouts.admin', ['title' => 'Hariri Huduma', 'heading' => 'Hariri huduma'])

@section('content')
    @include('admin.services.form', ['action' => route('admin.services.update', $service), 'method' => 'PUT', 'service' => $service])
@endsection
