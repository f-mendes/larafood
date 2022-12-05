@extends('adminlte::page')

@section('title', 'Criar novo plano')

@section('content_header')
    <h1>Criar novo plano</h1>
@stop

@section('content')
    <div class="card">
       
        <div class="card-body">
            <form action="{{ route('plans.store')}}" class="form" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Nome:</label>
                    <input type="text" name="name" class="form-control" placeholder="Nome:">
                </div>
                <div class="form-group">
                    <label for="">Preço:</label>
                    <input type="text" name="price" class="form-control" placeholder="Preço:">
                </div>
                <div class="form-group">
                    <label for="">Descrição:</label>
                    <input type="text" name="description" class="form-control" placeholder="Descrição:">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>

        </div>
    </div>
@stop