@extends('adminlte::page')

@section('title', 'Detalhes da Empresa')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tenants.index') }}" >Empresas</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Ver</a></li>
    </ol>
    <h1>Detalhes da Empresa {{ $tenant->name }}</h1>
@stop

@section('content')
    <div class="card">
       
        <div class="card-body">
            <ul>

                
                @if ($tenant->logo)
                    <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}" style="max-width: 100px;">
                @else
                    <img src="{{ url("storage/no-photo.jpg") }}" alt="{{ $tenant->name }}" style="max-width: 100px;">
                @endif

                <li>
                    <strong>Nome: </strong> {{ $tenant->name }}
                </li>
                <li>
                    <strong>Email: </strong> {{ $tenant->email }}
                </li>
                <li>
                    <strong>Cnpj: </strong> {{ $tenant->cnpj }}
                </li>
                <li>
                    <strong>Ativo: </strong> {{ $tenant->active == 'Y' ? 'Sim' : 'Não' }}
                </li>     
            </ul>
            <hr>
            <h3>Assinatura</h3>
            <ul>
                <li>
                    <strong>Data Assinatura: </strong> {{ $tenant->subscription }}
                </li>
                <li>
                    <strong>Data Expiração: </strong> {{ $tenant->expires_at }}
                </li>
                <li>
                    <strong>Identificador: </strong> {{ $tenant->subscription_id }}
                </li>
                <li>
                    <strong>Ativo: </strong> {{ $tenant->subscription_active == 1 ? 'Sim' : 'Não' }}
                </li>
                <li>
                    <strong>Cancelado: </strong> {{ $tenant->subscription_suspended == 1 ? 'Sim' : 'Não' }}
                </li>
            </ul>
            @include('admin.includes.alerts')
            <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o Empresa {{ $tenant->name }}</button>
            </form>
        </div>
    </div>
@stop