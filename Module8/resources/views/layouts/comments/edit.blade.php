@extends('layouts.master')

@section('title', '| Edit Comment')

@section('content')
<br><br><br>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Edit Comment</h1>
			
			    {{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) }}
				    <div class="col-md-12">
                        <strong>Rate:</strong><br>
                        {{ Form::label('design', "Design:") }}&nbsp;&nbsp;&nbsp;&nbsp;
                        {{ Form::select('design', array('5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1'), '5')}}&emsp;&emsp;
                        {{ Form::label('engine', "Engine:") }}&emsp;&emsp;&emsp;&emsp;&emsp;
                        {{ Form::select('engine', array('5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1'), '5')}}&emsp;&emsp;
                        {{ Form::label('comfort', "Comfort:") }}&emsp;&nbsp;&nbsp;
                        {{ Form::select('comfort', array('5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1'), '5')}}<br>
                        {{ Form::label('fuel', "Fuel Cost:") }}
                        {{ Form::select('fuel', array('5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1'), '5')}}&emsp;&emsp;
                        {{ Form::label('costperformance', "Costperformance:") }}
                        {{ Form::select('costperformance', array('5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1'), '5')}}&emsp;&emsp;
                        {{ Form::label('satisfaction', "Satisfaction:") }}
                        {{ Form::select('satisfaction', array('5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1'), '5')}}
                        
                    </div>
				{{ Form::label('comment', 'Comment:') }}
				{{ Form::textarea('comment', null, ['class' => 'form-control']) }}
			
				{{ Form::submit('Update Comment', ['class' => 'btn btn-block btn-success', 'style' => 'margin-top: 15px;']) }}
			
			{{ Form::close() }}
		</div>
	</div>

@endsection