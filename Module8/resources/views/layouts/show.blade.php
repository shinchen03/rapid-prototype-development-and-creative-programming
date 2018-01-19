@extends('layouts.master')
<?php
$titleTag = htmlspecialchars($post->title);
use Illuminate\Support\Facades\Auth;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
{!! Html::style('css/lightbox.css') !!}
@section('title','| $titleTag')



@section('content')
    <br><br><br>
    <div class="row">
        <div class="col-md-8">
            <h2>{{ $post->title }}</h2>
			<hr>
			<p><h5>User Rate:<span id ="userrate"></span></h5>    Design:<span id="designrate"></span> &emsp;    Engine:<span id="enginerate"></span>&emsp;     Comfort:<span id="comfortrate"></span>&emsp;        Fuel Cost:<span id="fuelrate"></span>&emsp;       Satisfaction:<span id="satisfactionrate"></span>&emsp;           CostPerformance:<span id="costperformancerate"></span></p>
            <hr>
            <p>Brand:{{$post->brand}}&emsp;&emsp;   Price:{{$post->price}}&emsp;&emsp;  </p>
            <hr>
            
            <img src="{{ asset('img/' . $post->img) }}" width="1000" hight="800">
            <hr>
            <strong>TOP FEATURES</strong>
		
            <p class="lead">{{ $post->body }}</p>
        </div>
			
		@if(Auth::user()["name"]==="root")	
            <div class="col-md-4">
                <div class="well">
                    <dl class="dl-horizental">
                        <dt>Created at:</dt>
                        <dd>{{ date('M j, Y H:i', strtotime($post->created_at)) }}</dd>
                    </dl>
                    <dl class="dl-horizental">
                        <dt>Last Updated:</dt>
                        <dd>{{ date('M j, Y H:i', strtotime($post->updated_at)) }}</dd>
                    </dl>
                    <hr>
					
				
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class'=>'btn btn-primary btn-block')) !!}
                            
                        </div>
                        <div class="col-sm-6">
                            {!! Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'DELETE']) !!}
                        
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-block']) !!}
                            {!! Form::close() !!}                           
                        </div>
                    </div>
                
                </div>
            </div>
		@endif		
    </div>
		<!--Here is the little Gallery-->
		
		
			<p><a href="{{ asset('img/' . $post->img2) }}" data-lightbox="group" rel="lightbox"><img src="{{ asset('img/' . $post->img2) }}" alt="" width="150" /></a>
			<a href="{{ asset('img/' . $post->img3) }}" data-lightbox="group" rel="lightbox"><img src="{{ asset('img/' . $post->img3) }}" alt="" width="150" /></a>
			<a href="{{ asset('img/' . $post->img4) }}" data-lightbox="group" rel="lightbox"><img src="{{ asset('img/' . $post->img4) }}" alt="" width="150" /></a></p>

		

                     <!--Here is the old Comments-->
                     
    <hr>
    <div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="comments-title"><span class="glyphicon glyphicon-comment"></span>  {{ $post->comments()->count() }} Comments</h3>
                
                <?php  $designrate=0; $enginerate=0; $comfortrate=0; $fuelrate=0; $costperformancerate=0; $satisfactionrate=0;
                       $i=0;
                ?>
                
			@foreach($post->comments as $comment)
				<div class="comment">
					<div class="author-info">
                        <!-- user avatar  
						<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) . "?s=50&d=monsterid" }}" class="author-image">
						 if we have time.... -->
                        <div class="author-name">
							<strong>{{ $comment->name }}
							{{ date('M j, Y H:i' ,strtotime($comment->created_at)) }}</strong>
						</div>
						
					</div>
                    
                    <div class="comment-rate">
                        {{ Form::label('design', "Design:") }}
                        {{ $comment->design }}&emsp;
                        {{ Form::label('engine', "Engine:") }}
                        {{ $comment->engine }}&emsp;
                        {{ Form::label('comfort', "Comfort:") }}
                        {{ $comment->comfort }}&emsp;
                        {{ Form::label('fuel', "Fule Cost:") }}
                        {{ $comment->fuel }}&emsp;
                        {{ Form::label('costperformance', "Costperformance:") }}
                        {{ $comment->costperformance }}&emsp;
                        {{ Form::label('satisfaction', "Satisfaction:") }}
                        {{ $comment->satisfaction }}&emsp;
                    </div>
                <?php
                        $designrate+=$comment->design;
                        $enginerate+=$comment->engine;
                        $comfortrate+=$comment->comfort;
                        $fuelrate+=$comment->fuel;
                        $costperformancerate+=$comment->costperformance;
                        $satisfactionrate+=$comment->satisfaction;
                        $i++;
                ?>
					
					<div class="comment-content">
						{{ $comment->comment }}
					</div>
			@if(Auth::user()["name"]===$comment->name)	
					<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-primary"><span class="glyphicons glyphicons-edit">Edit</span></a>
					<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash">Delete</span></a>
			@endif
				</div>
                <hr size="20">
			@endforeach
		</div>
			<div type="hidden" id="hdesign" hidden><?php echo $designrate; ?></div>
			<div type="hidden" id="hengine" hidden><?php echo $enginerate; ?></div>
			<div type="hidden" id="hcomfort" hidden><?php echo $comfortrate; ?></div>
			<div type="hidden" id="hfuel" hidden><?php echo $fuelrate; ?></div>
			<div type="hidden" id="hcostperformance" hidden><?php echo $costperformancerate; ?></div>
			<div type="hidden" id="hsatisfaction" hidden><?php echo $satisfactionrate; ?></div>
			<div type="hidden" id="hnumber" hidden><?php echo $i; ?></div>
			<div type="hidden" id="hrate" hidden><?php echo $designrate+$enginerate+$comfortrate+$fuelrate+$costperformancerate+$satisfactionrate; ?></div>
	</div>
                     
                     
                     
                     
                     
                     
                     
                 <!--Here is the New Comment-->
    <hr>
	@if(Auth::user()["name"]!==null)	
   <div class="row">
		<div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
			{{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
				
				<div class="row">
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
                    
					<div class="col-md-12">
						{{ Form::label('comment', "Comment:") }}
						{{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
						{{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block', 'style' => 'margin-top:15px;']) }}
					</div>
				</div>

			{{ Form::close() }}
		</div>
	</div>
	@endif
	
	@if(Auth::user()["name"]===null)
	<h5>You can Comment and Rate after login</h5>
	@endif
		
	

            <script type="text/javascript">
		var design = document.getElementById("hdesign").innerHTML;
		var engine = document.getElementById("hengine").innerHTML;
		var comfort = document.getElementById("hcomfort").innerHTML;
		var fuel = document.getElementById("hfuel").innerHTML;
		var costperformance = document.getElementById("hcostperformance").innerHTML;
		var satisfaction = document.getElementById("hsatisfaction").innerHTML;
		var num = document.getElementById("hnumber").innerHTML;
		var rate = document.getElementById("hrate").innerHTML;
	    document.getElementById("userrate").innerHTML = (rate/(num*6)).toFixed(1);
		document.getElementById("designrate").innerHTML = (design/num).toFixed(1);
		document.getElementById("enginerate").innerHTML = (engine/num).toFixed(1);
		document.getElementById("comfortrate").innerHTML = (comfort/num).toFixed(1);
		document.getElementById("fuelrate").innerHTML = (fuel/num).toFixed(1);
		document.getElementById("costperformancerate").innerHTML = (costperformance/num).toFixed(1);
		document.getElementById("satisfactionrate").innerHTML = (satisfaction/num).toFixed(1);
		
	</script>
@endsection
{!! Html::script('js/lightbox.js') !!}
