@extends('adminlte::page')

@section('title', 'Detalhes do plano')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}" >Planos</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Ver</a></li>
    </ol>
    <h1>Detalhes do plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
       
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $plan->name }}
                </li>
                <li>
                    <strong>URL: </strong> {{ $plan->url }}
                </li>
                <li>
                    <strong>Preço: </strong> R$ {{ number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $plan->description }}
                </li>
            </ul>

            <form action="{{ route('plans.destroy', $plan->url) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o plano {{ $plan->name }}</button>
            </form>
        </div>
    </div>
@stop