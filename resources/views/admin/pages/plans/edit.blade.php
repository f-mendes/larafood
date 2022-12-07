@extends('adminlte::page')

@section('title', 'Editar plano')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}" >Planos</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Editar</a></li>
    </ol>
    <h1>Editar plano</h1>
@stop



@section('content')
@include('admin.includes.alerts')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->url) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
@stop