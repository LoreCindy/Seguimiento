@extends('app')

@section('content')
<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width:70%;
      margin: auto;
  }
    </style>


    
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
     

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="http://www.abogama.com/wp-content/uploads/2015/01/contrato.jpg" alt="Chania" width="100" height="150">
        </div>

        <div class="item">
          <img src="http://www.spicegourmet.com.br/site/media/k2/items/cache/245effadf41c6129f4fe7accc564ef86_XL.jpg" alt="Chania" width="100" height="150">
        </div>
      
        <div class="item">
          <img src="http://www.contratosdeformacionyaprendizaje.es/images/contrato.jpg" alt="Flower" width="100" height="150">
        </div>

        <div class="item">
          <img src="http://diarioresponsable.com/images/stories/contrato.jpg" alt="Flower" width="100" height="150">
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
