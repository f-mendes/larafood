@extends('adminlte::page')

@section('title', 'Detalhes do perfil')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}" >Perfis</a></li>
        <li class="breadcrumb-item active"><a href="#" class="active">Ver</a></li>
    </ol>
    <h1>Detalhes do perfil {{ $profile->name }}</h1>
@stop

@section('content')
    <div class="card">
       
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{ $profile->name }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{ $profile->description }}
                </li>
            </ul>
            @include('admin.includes.alerts')
            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Deletar o perfil {{ $profile->name }}</button>
            </form>
        </div>
    </div>
@stop