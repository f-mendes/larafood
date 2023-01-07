@extends('adminlte::page')

@section('title', 'Detalhes da Mesa {{ $table->name }}')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}" >Mesas</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Ver</a></li>
    </ol>
    <h1>Detalhes da Mesa {{ $table->name }}</h1>
@stop

@section('content')
    <div class="card">
       
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $table->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $table->description }}
                </li>
                
            </ul>
            @include('admin.includes.alerts')
            <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar a mesa {{ $table->name }}</button>
            </form>
        </div>
    </div>
@stop