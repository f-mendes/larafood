@extends('adminlte::page')

@section('title', 'Detalhe do Plano {{ $plan->name }}')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.index') }}" >Planos</a></li>
        <li class="breadcrumb-item "><a href="{{ route('plans.show', $plan->url) }}" >{{$plan->name}}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.index', $plan->url) }}" class="active">Detalhes</a></li>
    </ol>
    
    <h1>
        Detalhe do plano {{ $plan->name }}
        {{-- <a href="{{ route('details.plan.create'), $plan->url}}" class="btn btn-dark">ADD</a> --}}
    </h1>
 
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $detail->name }}
                </li>
            </ul>
            
        </div>
        
        <div class="card-footer">
            
            <form action="{{ route('details.plan.destroy', [$plan->url, $detail->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o detalhe {{ $detail->name }} do plano {{ $plan->name }}</button>
            </form>
        </div>


@endsection