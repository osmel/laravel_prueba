 <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('/images/logo.png') }}" alt="" sizes="64x64" >
                    {{-- config('app.name', 'Autos') --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ trans('autenticacion.Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>


                @if (Auth::check()) 
                  @if (Auth::user()->esAdministrador()) 
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          {{-- lado izquierdo del Navbar --}}

                        <ul class="navbar-nav mr-auto">
                            
                            <li class="nav-item active">
                              <a class="nav-link" href="{{ route('users.index') }}">{{ trans('aplicacion.users') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ trans('aplicacion.catalogs') }}
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                

                                 <a class="dropdown-item" href="{{ route('productos.index') }}">Productos</a>

                               
                                <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="{{ route('marcas.index') }}">Marcas</a>
                                <a class="dropdown-item" href="{{ route('modelos.index') }}">Modelos</a>

                                <div class="dropdown-divider"></div>

                                 <a class="dropdown-item" href="{{ route('almacens.index') }}">Almacenes</a>
                                <a class="dropdown-item" href="{{ route('variacions.index') }}">Variaciones</a>                           
                                <a class="dropdown-item" href="{{ route('categorias.index') }}">Categoría</a>                                
                                <div class="dropdown-divider"></div>

                                 <a class="dropdown-item" href="{{ route('fabricantes.index') }}">Fabricantes</a>
                                <a class="dropdown-item" href="{{ route('motors.index') }}">Motores</a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('perfiles.index') }}">Perfiles</a>

                              </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('inventario.index') }}">{{ trans('aplicacion.reception') }}</a>
                            </li>
                            <li class="nav-item">

                              {{-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">{{ trans('aplicacion.disabled') }}</a> --}}
                            </li>
                          </ul>
                    @endif  
                  @endif  

                    {{-- lado derecho del Navbar --}}
                    <ul class="navbar-nav ml-auto">
                        {{-- Enlaces de autenticacion --}}
                        @guest
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ trans('autenticacion.Login') }}</a>
                            </li>
                            {{--
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ trans('autenticacion.Register') }}</a>
                                </li>
                            @endif
                            --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ trans('autenticacion.Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>



                     <ul class="nav navbar-nav navbar-right">
                          
                          <form method="POST" action="{{ route('busqueda.predictiva') }}" class="form-inline my-2 my-lg-0">
                              {{ csrf_field() }}

                              <input class="form-control mr-sm-2 busqueda" type="search" id="busqueda" placeholder="Busqueda" aria-label="Busqueda">
                              <button class="btn btn-outline-success my-2 my-sm-0 buscar" id="buscar" type="submit"><i class="fa fa-search"></i></button>
                          </form>

                        <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle idioma" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                              idioma= "{{ session('lang') }}"
                              >
                                {{  ucfirst(session('lang')!='' ? session('lang') : "es")   }}
                                
                              </a>
                              <div class="dropdown-menu " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item " href="{{ url('lang', ['es']) }}" >Español</a>
                                <a class="dropdown-item " href="{{ url('lang', ['en']) }}" >English</a>


                              </div>
                      </li>



                    </ul>

                </div>
            </div>
        </nav>