@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}" class="active">Mesas</a></li>
    </ol>
    
    <h1>
        Mesas
        <a href="{{ route('tables.create') }}" class="btn btn-dark">ADD</a>
    </h1>
 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('tables.search')}}" method="POST">
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
                    @foreach ($tables as $table)
                        <tr>
                            <td>{{ $table->name }}</td>
                            <td>{{ $table->description }}</td>
                            <td style="width=10px;">
                                <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning">Ver</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $tables->appends($filters)->links() !!}
            @else
                {!! $tables->links() !!} 
            @endif
        </div>
    </div>
@stop