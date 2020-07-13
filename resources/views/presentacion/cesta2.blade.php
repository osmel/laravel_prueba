
<style>
.bigicon {    
    color:white;
}

.mix{
    min-height:370px;
}

ul.dropdown-cart{
    min-width:250px;
    border: 2px solid #343434;
    padding: 2px;
    margin: 7px;
    margin-top: 11px;
}
ul.dropdown-cart li .item{
    display:block;
    padding:3px 10px;
    margin: 3px 0;
    
}
ul.dropdown-cart li .item:hover{
    background-color:#c3c5c5;
    
}
ul.dropdown-cart li .item:after{
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}

ul.dropdown-cart li .item-left{
    float:left;
}
ul.dropdown-cart li .item-left img,
ul.dropdown-cart li .item-left span.item-info{
    float:left;
}
ul.dropdown-cart li .item-left span.item-info{
    margin-left:10px;   
}
ul.dropdown-cart li .item-left span.item-info span{
    display:block;
}
ul.dropdown-cart li .item-right{
    float:right;
}
ul.dropdown-cart li .item-right button{
    margin-top:14px;
}   
</style>

<div class="mix2">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <div>  
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 
                <i class="fas fa-shopping-bag"></i>
                <span id="cart-total"> <span id="total_prod_carrito">{{ (session('arreglo')) ? count(session('arreglo')) : 0 }}</span> producto(s) - $<span id="importe">{{ $importe }}</span></span>
              </a>

            <ul class="dropdown-menu dropdown-cart" id="contenido_cesta" role="menu">

                @include('presentacion.productos_cesta')

            </ul>

        </li>
      </ul>
    </div>
  </div>
</nav>
</div>