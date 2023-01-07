@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('products.index') }}" class="active">Produtos</a></li>
    </ol>
    
    <h1>
        Produtos
        <a href="{{ route('products.create') }}" class="btn btn-dark">ADD</a>
    </h1>
 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('products.search')}}" method="POST">
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
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                @if ($product->image)
                                    <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->name }}" style="max-width: 100px;">
                                @else
                                    <img src="{{ url("storage/no-photo.jpg") }}" alt="{{ $product->name }}" style="max-width: 100px;">
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td style="width=10px;">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Editar</a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning">Ver</a>
                                <a href="{{ route('products.categories', $product->id) }}" class="btn btn-primary" title="Categorias">
                                    <i class="fas fa-layer-group"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!} 
            @endif
        </div>
    </div>
@stop