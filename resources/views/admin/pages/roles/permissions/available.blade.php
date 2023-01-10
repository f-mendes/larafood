@extends('adminlte::page')

@section('title', "Permissões do Cargo {$role->name}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}" class="active">Cargo</a></li>
    </ol>
    
    <h1> Permissões disponíveis do Cargo {{$role->name}}</h1>
    
 
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('roles.permissions.available', $role->id)}}" method="POST">
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
                        <th>#</th>
                        <th>Nome</th>

                     
                    </tr>
                </thead>
                <tbody>
                    <form action="{{route('roles.permissions.attach', $role->id)}}" method="POST">
                        @csrf
                        
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                                </td>
                                <td>{{ $permission->name }}</td>
                                
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="500">
                                @include('admin.includes.alerts')
                                <button type="submit" class="btn btn-dark">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!} 
            @endif
        </div>
    </div>
@stop