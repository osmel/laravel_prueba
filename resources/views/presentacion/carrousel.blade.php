<!DOCTYPE html>
 
<body>
<br><br><br>
  <div class="container">

  <div class="row">
   <div class="col-md-1">
  </div>
  <div class="col-md-10">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" >
        <div class="carousel-item active marco" >
          <img class="d-block w-100 " src="{{ asset('/images/Ofertas.jpg') }}" alt="Screenshot 11">
        <div class="carousel-caption d-none d-md-block">
          <h3 style="color: blue; margin: 2px;">Descuentos de locura</h3>
          <p style="color: gray;" >Estamos brindando los mejores descuentos a productos Bosch</p>
          <a href="" class="btn btn-primary">Mas informacion</a>
        </div>
        </div>
        <div class="carousel-item marco">
          <img class="d-block w-100" src="{{ asset('/images/Ofertas1.png') }}" alt="Screenshot 10">
        </div>
        <div class="carousel-item marco">
          <img class="d-block w-100" src="{{ asset('/images/Ofertas2.png') }}" alt="Screenshot 13">
        </div>
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
  </div>
  </div>
  </div>
</body>
</html>