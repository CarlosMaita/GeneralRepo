@extends('layouts.app')


@section('content')
<div class="container">
	<div class="d-flex justify-content-center my-5">
		<form class="row">
			<div class="form-group col-6">
				<h5>Nombre</h5>
				<input class="form-control" type="text" maxlength="191" name="name">
			</div>
			<div class="form-group col-6">
				<h5>Correo</h5>
				<input class="form-control" type="email" name="email">
			</div>
			<div class="form-group col-12">
				<h5>Mensaje</h5>
				<textarea class="form-control"></textarea>
			</div>
			<div class="form-group col-6">
				<input type="submit" class="btn btn-primary" value="Enviar">
			</div>
		</form>
	</div>
</div>

@endsection