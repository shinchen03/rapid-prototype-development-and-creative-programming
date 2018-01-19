@extends('layouts.master')

@section('title', '|Create New Post')
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

{!! Html::style('css/parsley.css') !!}
@section('content')

	<div class ="row">
		<div class="col-md-8 col-md-offset-2">
		<br><br><br><br>
			<h1>Create New Post</h1>
			<hr>
			{!! Form::open(array('route'=>'posts.store', 'data-parsley-validate' => '')) !!}
			{{ Form::label('title','Title:')}}
			{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength'=>'50')) }}
			{{ Form::label('brand','Brand:')}}
			{{ Form::text('brand', null, array('class' => 'form-control', 'required' => '')) }}
			{{ Form::label('price','Price:')}}
			{{ Form::text('price', null, array('class' => 'form-control', 'required' => '')) }}
			{{ Form::label('body', "Post Body:")}}
			{{ Form::textarea('body', null, array('class' =>'form-control', 'required' => '')) }}
			{{ Form::submit('Create Post', array('class' =>'btn-success btn-lg btn-block', 'style' => 'margin-top:20px;')) }}	

			{!! Form::close() !!}
		</div>
	</div>


@endsection

{!! Html::script('js/parsley.min.js') !!}
@section('scripts')

	{!! Html::script('js/parsley.min.js') !!}

@endsection