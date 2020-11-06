@extends('cms.layout.main')
@section('title')
	Contacto
@endsection

@section('content')
@if(session('message'))
    <div class="alert alert-success my-4" role="alert">
      {{session('message')}}
    </div>
@endif
<h1 class="my-4">Información de contacto</h1>

<div>
	 <form action="{{route('cms.contacto.update')}}" method="POST">
	 	@csrf
	 	<div class="row">
	 		<div class="form-group col-6">
	 			<h5>email</h5>
	 			<input class="form-control" type="email" name="email" value="{{$email->valor}}">
	 		</div>
	 		<div class="form-group col-6">
	 			<h5>Direccion</h5>
	 			<input class="form-control" type="text" name="direccion" value="{{$direccion->valor}}">
	 		</div>
	 		<div class="form-group col-6">
	 			<h5>Telefono</h5>
	 			<input class="form-control" type="number" name="phone" value="{{$phone->valor}}">
	 		</div>
	 		<div class="form-group col-6">
	 			<h5>Facebook</h5>
	 			<input class="form-control" type="text" name="facebook" value="{{$facebook->valor}}">
	 		</div>
	 		<div class="form-group col-6">
	 			<h5>Instagram</h5>
	 			<input class="form-control" type="text" name="instagram" value="{{$instagram->valor}}">
	 		</div>
	 		<div class="col-12">
	 			<input type="submit" class="btn btn-success" value="Actualizar información de contacto">
	 		</div>
	 	</div>
	 </form>
</div>
@endsection