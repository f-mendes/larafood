@include('admin.includes.alerts')
@csrf

<div class="form-group">
    <label for="">Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{$user->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="">E-mail:</label>
    <input type="text" name="email" class="form-control" placeholder="Email:" value="{{$user->email ?? old('price')}}">
</div>
<div class="form-group">
    <label for="">Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha:" >
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
     