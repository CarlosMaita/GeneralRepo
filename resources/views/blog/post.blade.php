@extends('layouts.app')

@section('title')
	{{$post->title}}
@endsection


@section('content')

<section class="container">

	<div class="card mb-2 mt-4">
	  <img src="{{asset('storage/'.$post->picture)}}" style="height: 60vh; object-fit: cover;" class="card-img-top" alt="...">
	  <div class="card-body">
	    <h5 class="card-title">{{$post->title}}</h5>
	    <p class="card-text">{!!$post->content!!}</p>
	  	<div class="d-flex">
	  		<img class="mr-2" src="{{asset('storage/'.$post->author->picture)}}" style="width: 50px;height: 50px;">
	  		<h5>{{$post->author->name}}</h5>
	  	</div>
	  	<p class="card-text"><small class="text-muted">{{$post->date}}</small></p>
	  </div>
	</div>

	<div class="d-flex">
		<a href="#" id="facebook">
			<img src="/icons/facebook.svg" style="width: 50px;height: 50px; cursor: pointer;">
		</a>
		<a href="#" id="twitter">
			<img src="/icons/twitter.svg" style="width: 50px;height: 50px; cursor: pointer;">
		</a>
		<a href="#" id="linkedin">
			<img src="/icons/linkedin.svg" style="width: 50px;height: 50px; cursor: pointer;">
		</a>
		<a href="#" id="pinterest">
			<img src="/icons/pinterest.svg" style="width: 50px;height: 50px; cursor: pointer;">
		</a>
	</div>

	<div>
		<div id="texto_blog" style="position: absolute; visibility: hidden;">
			{{$post->title}}
			{!!$post->content!!}
		</div>
		<button id="boton_reproducir" style="display: none;" class="btn btn-outline-primary">Reproducir post</button>
		<div id="reproductor_container" class="reproductor align-items-center">
			<audio src=""  id="reproductor" controls="true" style="display: none;"></audio>
		</div>
	</div>

	<div class="mt-2">
		<form action="" method="POST" class="mb-2">
			<input type="hidden" id="post_id" value="{{$post->id}}" name="article_id">
			<div class="row">
				<div class="form-group col-md-3">
					<input class="form-control" id="comment" type="text" name="comment" placeholder="Comentario">
				</div>
				<div class="col-md-3">
					<input type="submit" id="submit_button" class="btn btn-primary" value="Enviar">
				</div>
			</div>
		</form>
		<div>
			<h3>Comentarios</h3>
			<div id="comment_main">
				@foreach($comments as $comment)
					<p>{{$comment->comment}} <small>- {{$comment->created_at->diffForHumans()}}</small></p>
				@endforeach
			</div>
		</div>
	</div>
</section>


<script type="text/javascript">
	console.log(window.location)
	let submitButton = document.getElementById('submit_button'),
		post_id = document.getElementById('post_id'),
		comment = document.getElementById('comment');

	submitButton.addEventListener('click', e =>{
		e.preventDefault();

		sendComment(post_id.value, comment.value)
		comment.value = '';
	})





	function sendComment(post, comment)
	{
		axios.post(`/send/comment`, {
			comment: comment,
			article_id: post
		})
		.then(response => {
			if(response.status == 200)
			{
				addComment(comment)
			}
		})
	}



	function addComment(comment)
	{
		const container = document.getElementById('comment_main');

		container.innerHTML += `
			<p>${comment}</p>
		`
	}
</script>

<script type="text/javascript">
	const reproductor = document.getElementById('reproductor')

	let botonReproducir
		

	document.addEventListener('DOMContentLoaded', () => {
		let texto = document.getElementById('texto_blog')
		botonReproducir = document.getElementById('boton_reproducir')
		botonReproducir.style.display = 'block'


		boton_reproducir.addEventListener('click', () => {
			let changeText = encodeURIComponent(texto.textContent)
				url = `https://audio1.spanishdict.com/audio?lang=es&text=${changeText}`

			botonReproducir.style.display = 'none'
			reproductor.style.display = 'block'
			
			reproductor.src = url
			reproductor.play()

		})
	})
</script>

<script type="text/javascript">
	const facebook = document.getElementById('facebook'),
		  twitter = document.getElementById('twitter'),
		  linkedin = document.getElementById('linkedin'),
		  pinterest = document.getElementById('pinterest')

	let dir = window.location;
	let dir2 = encodeURIComponent(dir);
	let tit = window.document.title;
	let tit2 = encodeURIComponent(tit);

	facebook.addEventListener('click', (e) => {
		e.preventDefault()
		url = `http://www.facebook.com/share.php?u=${dir2}&t=${tit2}`
		window.open(url, '','width=600,height=400,left=50,top=50')
	})

	twitter.addEventListener('click', (e) => {
		url= `http://twitter.com/?status=${tit2}%20${dir}`
		window.open(url, '', 'width=600,height=400,left=50,top=50')
	})


	linkedin.addEventListener('click', (e) => {
		e.preventDefault();

		window.open(`http://www.linkedin.com/shareArticle?url='+${encodeURIComponent(window.location)}`, '', 'width=600,height=400,left=50,top=50')
	})


</script>

@endsection