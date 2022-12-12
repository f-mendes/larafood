@extends('adminlte::page')

@section('title', 'Criar novo plano')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}" >Planos</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Criar</a></li>
    </ol>
    <h1>Criar novo plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.store') }}" class="form" method="POST">
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop