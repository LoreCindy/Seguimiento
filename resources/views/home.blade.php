@extends('app')

@section('content')
<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width:70%;
      margin: auto;
  }
    </style>

  {{Session::get("message")}}
    

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
     
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="images/contratos.jpg" alt="contratacion" width="100" height="150">
        </div>

        <div class="item">
          <img src="images/3.jpg" alt="contratacion" width="100" height="150">
        </div>
      
        <div class="item">
          <img src="images/XL.jpg" alt="contratacion" width="100" height="150">
        </div>

        <div class="item">
          <img src="images/contrato.jpg" alt="Flower" width="100" height="150">
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only"></span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only"></span>
      </a>
    </div>
  
@endsection
