@extends('adminlte::page')

@section('title', 'Detalhes da Categoria {{ $category->name }}')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}" >Categorias</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Ver</a></li>
    </ol>
    <h1>Detalhes da Categoria {{ $category->name }}</h1>
@stop

@section('content')
    <div class="card">
       
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $category->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $category->url }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $category->description }}
                </li>
                
            </ul>
            @include('admin.includes.alerts')
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar a categoria {{ $category->name }}</button>
            </form>
        </div>
    </div>
@stop