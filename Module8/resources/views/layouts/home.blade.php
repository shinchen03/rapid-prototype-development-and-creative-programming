@extends('layouts.master')

@section('image')
    <head>
        <link rel="stylesheet" type="text/css" href="/css/style.css" />
    </head>
    <body>
      <h1 class="h1">Welcome to the world of Motorcycle!</h1>
      <div class="slideshow">
        
          <div class="slideshow-image" style="background-image: url('/img/Animatemotor2.jpg')"></div>
          <div class="slideshow-image" style="background-image: url('/img/Animatemotor3.jpg')"></div>
          <div class="slideshow-image" style="background-image: url('/img/Animatemotor4.jpg')"></div>
          <div class="slideshow-image" style="background-image: url('/img/Animatemotor1.jpg')"></div>
        </a>
      </div>
     <div class="container">
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
     </div>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
         <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
         <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
         <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
        <a href={{ url('gallery')}}>  
           <div class="carousel-item active">
             <img class="d-block img-fluid" src="/img/motor8.jpg" alt="First slide">
             <div class="carousel-caption d-none d-md-block">
                <h3>See more</h3>
                <br>
            </div>
           </div>
           <div class="carousel-item">
             <img class="d-block img-fluid" src="/img/motor5.jpg" alt="Second slide">
             <div class="carousel-caption d-none d-md-block">
                <h3>See more</h3>
                <br>
            </div>
           </div>
           <div class="carousel-item">
            <img class="d-block img-fluid" src="/img/motor2.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h3>See more</h3>
                <br>
            </div>
           </div>
        </a>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <br>
  </body>
          
          
  
@endsection