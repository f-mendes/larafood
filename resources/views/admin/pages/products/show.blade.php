@extends('adminlte::page')

@section('title', 'Detalhes do Produto {{ $product->name }}')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" >Produtos</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Ver</a></li>
    </ol>
    <h1>Detalhes do Produto {{ $product->name }}</h1>
@stop

@section('content')
    <div class="card">
       
        <div class="card-body">
            <ul>

                
                @if ($product->image)
                    <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->name }}" style="max-width: 100px;">
                @else
                    <img src="{{ url("storage/no-photo.jpg") }}" alt="{{ $product->name }}" style="max-width: 100px;">
                @endif

                <li>
                    <strong>Nome: </strong> {{ $product->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $product->url }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $product->description }}
                </li>
                
            </ul>
            @include('admin.includes.alerts')
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o Produto {{ $product->name }}</button>
            </form>
        </div>
    </div>
@stop