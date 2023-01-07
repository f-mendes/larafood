@extends('adminlte::page')

@section('title', 'Editar Mesa')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}" >Mesas</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Editar</a></li>
    </ol>
    <h1>Editar Mesa {{ $table->name }}</h1>
@stop



@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" class="form" method="POST">
                @method('PUT')
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop