@extends('adminlte::page')

@section('title', 'Criar nova permissão')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('permissions.index') }}" >Permissões</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Criar</a></li>
    </ol>
    <h1>Criar nova permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" class="form" method="POST">
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop