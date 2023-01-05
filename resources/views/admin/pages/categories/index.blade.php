@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('categories.index') }}" class="active">Categorias</a></li>
    </ol>
    
    <h1>
        Categorias
        <a href="{{ route('categories.create') }}" class="btn btn-dark">ADD</a>
    </h1>
 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('categories.search')}}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <input type="text" name="filter" placeholder="Filtrar:" class="form-control col-sm-3 mr-2" 
                        value="{{ $filters['filter'] ?? '' }}">
                        <button type="submit" class="btn btn-dark col-sm-2">Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td style="width=10px;">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-warning">Ver</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!} 
            @endif
        </div>
    </div>
@stop