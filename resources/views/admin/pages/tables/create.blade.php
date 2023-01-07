@extends('adminlte::page')

@section('title', 'Criar nova Mesa')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}" >Mesas</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Criar</a></li>
    </ol>
    <h1>Criar nova Mesa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.store') }}" class="form" method="POST">
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@stop