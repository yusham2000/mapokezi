@extends('layouts.admin', ['title' => 'Ongeza Huduma', 'heading' => 'Ongeza huduma'])

@section('content')
    @include('admin.services.form', ['action' => route('admin.services.store'), 'method' => 'POST', 'service' => null])
@endsection
