@extends('adminlte::page')

@section('title', "Planos do perfil {$profile->name}")

@section('content_header')

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}" class="active">Perfis</a></li>
    </ol>
    
    <h1> Planos do perfil {{$profile->name}}</h1>
    <a href="{{ route('profiles.plans.available', $profile->id) }}" class="btn btn-dark">ADD NOVO PLANO</a>
    
 
@stop

@section('content')
  
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
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>{{ $plan->description }}</td>
                            <td style="width=10px;">
                                <a href="{{ route('profiles.plans.detach', [$profile->id, $plan->id]) }}" class="btn btn-danger">Remover</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!} 
            @endif
        </div>
    </div>
@stop