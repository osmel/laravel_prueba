    jQuery(document).ready(function($) {    
        


    var uno=['william','osmel'];
    var dos=['duvi','alex', 'fidel' , 'frida'];
    var  condiciones= [];
    condiciones['uno']= uno;
    condiciones['dos']= dos;

    //console.log(uno);
    //console.log(dos);

//var tempArr = [];

var elemento = {};
Object.keys(condiciones).forEach( (element,i) => { //element=uno y dos
    elemento[element]=(JSON.stringify(condiciones[element]));
});
condiciones= elemento; 


$.ajax({                 
            url : '/pagina',                 
            data:{                     
                    condiciones:condiciones, //JSON.stringify((condiciones)) 
                        //JSON.stringify(JSON.parse(condiciones)) 
                 },    
            headers: {
                    //'{{ csrf_token()}}' 
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },                
            type : 'POST',                 
            dataType : 'json',                 
            success : function(data) {                     
                                //    alert(  JSON.stringify(JSON.parse(data)) );                 
                                      },                 
            error : function(jqXHR, status, error) {                                      
                                                   },                 
            complete : function(jqXHR, status) {                                      
                                                }         
      }); 





        //$('#tabla').DataTable();

        idioma= (jQuery('.idioma').attr('idioma')!='') ? jQuery('.idioma').attr('idioma') : "es";

/*
        jQuery.ajax({
                url : '/idioma',
                data:{
                     //"_token": "{{ csrf_token() }}",
                    idioma:idioma
                },
                //esta clausula es obligatoria en laravel
                headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

                type : 'POST',
                dataType : 'json',
                success : function(data) {
                    alert(  JSON.stringify(JSON.parse(data)) );
                },
                error : function(jqXHR, status, error) {
                    //
                },
                complete : function(jqXHR, status) {
                    
                }
        }); 
*/

        

        jQuery('#tabla').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/midatatable", //"scripts/server_processing.php"

              "pageLength": 10, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
                /*
                search: {
                    "regex": true
                },*/

               "columnDefs": [
                            
                            { 
                                "render": function ( data, type, row ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "render": function ( data, type, row ) {
                                        return row.name;
                                },
                                "targets": [1] 
                            },

                            { 
                                "render": function ( data, type, row ) {
                                        return row.email;
                                },
                                "targets": [2] 
                            },

                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/usuarios/'+row.id+'/editar" type="button"';
                                    texto+=' class="btn btn-warning btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Editar</span>'; 
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 3
                            },


                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_usuario/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 4
                            },



                ],            
                /*
               "columns":[
                  {data:'id'},
                  {data:'name'},
                  {data:'email'},
                  {data:'updated_at'},
                ],

            */


                } );







        //perfiles

        jQuery('#tabla_perfiles').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_perfiles", //"scripts/server_processing.php"

              "pageLength": 5, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "render": function ( data, type, row ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "render": function ( data, type, row ) {
                                        return row.nombre_rol;
                                },
                                "targets": [1] 
                            },

                          

                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/perfiles/'+row.id+'/editar" type="button"';
                                    texto+=' class="btn btn-warning btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Editar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 2
                            },


                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_perfil/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 3
                            },



                ],            
              


                } );




    //marcas

        jQuery('#tabla_marcas').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_marcas", //"scripts/server_processing.php"

              "pageLength": 5, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "render": function ( data, type, row ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "render": function ( data, type, row ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                          

                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/marcas/'+row.id+'/editar" type="button"';
                                    texto+=' class="btn btn-warning btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Editar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 2
                            },


                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_marca/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 3
                            },



                ],            
              


                } );



    //modelos

        jQuery('#tabla_modelos').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_modelos", //"scripts/server_processing.php"

              "pageLength": 5, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "render": function ( data, type, row ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "render": function ( data, type, row ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                          

                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/modelos/'+row.id+'/editar" type="button"';
                                    texto+=' class="btn btn-warning btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Editar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 2
                            },


                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_modelo/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 3
                            },



                ],            
              


                } );



 //almacens

        jQuery('#tabla_almacens').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_almacens", //"scripts/server_processing.php"

              "pageLength": 5, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "render": function ( data, type, row ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "render": function ( data, type, row ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                          

                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/almacens/'+row.id+'/editar" type="button"';
                                    texto+=' class="btn btn-warning btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Editar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 2
                            },


                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_almacen/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 3
                            },



                ],            
              


                } );


 //variacions

        jQuery('#tabla_variacions').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_variacions", //"scripts/server_processing.php"

              "pageLength": 5, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "render": function ( data, type, row ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "render": function ( data, type, row ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                          

                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/variacions/'+row.id+'/editar" type="button"';
                                    texto+=' class="btn btn-warning btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Editar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 2
                            },


                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_variacion/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 3
                            },



                ],            
              


                } );


 //categorias

        jQuery('#tabla_categorias').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_categorias", //"scripts/server_processing.php"

              "pageLength": 5, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "render": function ( data, type, row ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "render": function ( data, type, row ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                          

                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/categorias/'+row.id+'/editar" type="button"';
                                    texto+=' class="btn btn-warning btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Editar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 2
                            },


                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_categoria/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 3
                            },



                ],            
              


                } );                        




 //fabricantes

        jQuery('#tabla_fabricantes').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_fabricantes", //"scripts/server_processing.php"

              "pageLength": 5, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "render": function ( data, type, row ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "render": function ( data, type, row ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                          

                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/fabricantes/'+row.id+'/editar" type="button"';
                                    texto+=' class="btn btn-warning btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Editar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 2
                            },


                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_fabricante/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 3
                            },



                ],            
              


                } );                        





 //motors

        jQuery('#tabla_motors').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_motors", //"scripts/server_processing.php"

              "pageLength": 5, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "render": function ( data, type, row ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "render": function ( data, type, row ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                          

                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/motors/'+row.id+'/editar" type="button"';
                                    texto+=' class="btn btn-warning btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Editar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 2
                            },


                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_motor/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 3
                            },



                ],            
              


                } );     



 //productos

        jQuery('#tabla_productos').DataTable( {
              "processing": true,
              "serverSide": true,
              "ajax": "/api/resultado_productos", //"scripts/server_processing.php"

              "pageLength": 5, //numeros de filas por paginas

              "language": {  //tratamiento de lenguaje
                   "url": "/plugins/dataTables-1.10.21/Plugins/i18n/"+idioma+".lang",
                },
               "columnDefs": [
                            
                            { 
                                "render": function ( data, type, row ) {
                                        return row.id;
                                },
                                "targets": [0] 
                            },


                            { 
                                "render": function ( data, type, row ) {
                                        return row.nombre;
                                },
                                "targets": [1] 
                            },

                          

                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/productos/'+row.id+'/editar" type="button"';
                                    texto+=' class="btn btn-warning btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Editar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 2
                            },


                            {
                                "render": function ( data, type, row ) {
                                texto='<td>';
                                    texto+='<a href="/eliminar_producto/'+row.id+'" type="button"';
                                    texto+=' class="btn btn-danger btn-sm btn-block" >';
                                        texto+=' <span class="oi oi-pencil">Eliminar</span>';
                                    texto+=' </a>';
                                texto+='</td>';

                                    return texto;   
                                },
                                "targets": 3
                            },



                ],            
              


                } );                                        



////////////////////////cargar modal dinamica para imagenes y ver con lupa///////
 
    $('body').on('click', '.modal_imagen[data-toggle="modal"]', function(e){




            este = $(this);

        jQuery.ajax({                 
            url : este.data("remoto"),                 
            /*data:{                     
                    condiciones:condiciones, //JSON.stringify((condiciones)) 
                        //JSON.stringify(JSON.parse(condiciones)) 
                 },*/    
            headers: {
                    //'{{ csrf_token()}}' 
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },                
            type : 'GET',                 
            //dataType : 'json',                 
            success : function(data) {       
                    $(este.data("target")+' .modal-content').html(data) ;
                        //alert(data);
                       setTimeout(function(){  //este delay esta porq a veces demora la carga de la imagen
                            img = jQuery('#imageTOzoom')[0];
                              
                              var width = img.clientWidth;
                              var height = img.clientHeight;

                              
                               
                              //if ((width*height)<136080) {return};
                              if ((width*height)<10000) {return};


                               jQuery("#imageTOzoom").mlens(
                                {
                                    imgSrc: jQuery("#imageTOzoom").attr("data-big"),   // path of the hi-res version of the image
                                    lensShape: "circle",                // shape of the lens (circle/square)
                                    lensSize: 380,                  // size of the lens (in px)
                                    borderSize: 4,                  // size of the lens border (in px)
                                    borderColor: "#fff",                // color of the lens border (#hex)
                                    borderRadius: 0,                // border radius (optional, only if the shape is square)
                                    imgOverlay: jQuery("#imageTOzoom").attr("data-overlay"), // path of the overlay image (optional)
                                    overlayAdapt: true // true if the overlay image has to adapt to the lens size (true/false)
                                });

                        }, 100);

                                             
                                         
                   

            },                 
            error : function(jqXHR, status, error) {                                      
                                                   },                 
            complete : function(jqXHR, status) {                                      
                                                }         
        }); 

    });



   //cuando oculta la modal
    jQuery('#modalMessage').on('hide.bs.modal', function(e) {
        jQuery(this).removeData('bs.modal');
    });    



//////////////////////////Cambiar las imagenes dentro de la modal/////////////////////

    $('body').on('click', '.cambio_imagen_modal', function(e){
        //console.log(  $(this) );
          este = $(this);
         jQuery.ajax({
                url :  este.attr("data-remoto"),  //'/cambio_imagen_modal/1',
                data:{
                     //"_token": "{{ csrf_token() }}",
                    id_imagen:este.attr("id_imagen")
                },
                //esta clausula es obligatoria en laravel
                headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

                type : 'POST',
                dataType : 'json',
                success : function(data) {
                    
                    jQuery('#imageTOzoom').attr('src', "images/piezas/"+data.url ) ;
                    jQuery('#modal_imagen').attr('data-remoto', "images/piezas/"+data.url ) ;

                     activar_lupa();

                    //alert(  JSON.stringify(data.url) ); //JSON.stringify(JSON.parse(data)) 
                },
                error : function(jqXHR, status, error) {
                    //
                },
                complete : function(jqXHR, status) {
                    
                }
        }); 


    });

    function activar_lupa(number) {
             setTimeout(function(){  //este delay esta porq a veces demora la carga de la imagen
                  img = jQuery('#imageTOzoom')[0];
                    
                    var width = img.clientWidth;
                    var height = img.clientHeight;

                    
                     
                    //if ((width*height)<136080) {return};
                    if ((width*height)<10000) {return};


                     jQuery("#imageTOzoom").mlens(
                      {
                          imgSrc: jQuery("#imageTOzoom").attr("data-big"),   // path of the hi-res version of the image
                          lensShape: "circle",                // shape of the lens (circle/square)
                          lensSize: 380,                  // size of the lens (in px)
                          borderSize: 4,                  // size of the lens border (in px)
                          borderColor: "#fff",                // color of the lens border (#hex)
                          borderRadius: 0,                // border radius (optional, only if the shape is square)
                          imgOverlay: jQuery("#imageTOzoom").attr("data-overlay"), // path of the overlay image (optional)
                          overlayAdapt: true // true if the overlay image has to adapt to the lens size (true/false)
                      });

              }, 100);

      }


      /////////////////////////////////paginacion por ajax


    jQuery(document).on('click', '.pagination a', function(e){
          e.preventDefault();  //parar la accion del evento
          var num_page = $(this).attr('href').split('page=')[1];
          var ruta ="http://autos.dev.com/";  //   /index
          //console.log(num_page);
          jQuery.ajax({
                      url :  ruta,
                      data:{
                          page:num_page
                      },
                      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                      type : 'GET',
                      dataType : 'json',
                      success : function(data) {
                           //console.log(data); 
                          jQuery('#mi_galeria').html(data ) ;
                          //jQuery('#modal_imagen').attr('data-remoto', "images/piezas/"+data.url ) ;

                    
                      },
                      error : function(jqXHR, status, error) {
                          //
                      },
                      complete : function(jqXHR, status) {
                          
                      }
              });       

    });


    /////////////////////////////////buscador


    jQuery('body').on('click', '.buscar', function(e){
          e.preventDefault();  //parar la accion del evento

          var busqueda = $('#busqueda').val().split(' '); //.split('page=')[1];
          //console.log(busqueda);

          //return false;
          
          var ruta ="/buscar";  //   /index
          
          jQuery.ajax({
                      url :  ruta,
                      data:{
                          busqueda:busqueda
                      },
                      headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
                      type : 'GET',
                      dataType : 'json',
                      success : function(data) {
                           //console.log(data); 
                           jQuery('#mi_galeria').html(data ) ;
                          //jQuery('#mi_galeria').html(data ) ;
                          //jQuery('#modal_imagen').attr('data-remoto', "images/piezas/"+data.url ) ;

                    
                      },
                      error : function(jqXHR, status, error) {
                          //
                      },
                      complete : function(jqXHR, status) {
                          
                      }
              });       

    });


    ////////////////////////////////////////////carrito guardar a la cesta

    jQuery('body').on('click', '.agregar_cesta', function(e){

        if ( $('input').is(':focus') ) {
          return false;
        }
            //e.preventDefault();  //parar la accion del evento

            //cantCarProd
            //console.log( $(this).find('input').val()  );
            //console.log( $(this).attr('id_producto')  );
            //return false;

            cantidad =  ( (parseInt($(this).find('input').val())>0) ? (parseInt($(this).find('input').val())) : 1);
            id_producto =  ( $(this).attr('id_producto')  );
            

            jQuery.ajax({
                    url : '/session_producto',
                    data:{
                           cantidad:cantidad,
                        id_producto:id_producto
                    },
                    //esta clausula es obligatoria en laravel
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

                    type : 'POST',
                    dataType : 'json',
                    success : function(data) {
                      jQuery('#contenido_cesta').html(data.vista);
                      jQuery('#total_prod_carrito').html(data.total_prod_carrito);
                      jQuery('#importe').html(data.importe);
                      
                        // console.log(data);
                        //alert(  JSON.stringify(JSON.parse(data)) );
                    },
                    error : function(jqXHR, status, error) {
                        //
                    },
                    complete : function(jqXHR, status) {
                        
                    }
            }); 

      });      

///////////////////////////////////eliminar productos de la cesta

 jQuery('body').on('click', 'button.btn_eliminar', function(e){

        if ( $('input').is(':focus') ) {
          return false;
        }

            cantidad = -1* ( (parseInt($(this).parent().parent().find('input').val())>0) ? (parseInt($(this).parent().parent().find('input').val())) : 0);
            id_producto =  ( $(this).attr('id_producto')  );
            

            jQuery.ajax({
                    url : '/session_producto',
                    data:{
                           cantidad:cantidad,
                        id_producto:id_producto
                    },
                    //esta clausula es obligatoria en laravel
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

                    type : 'POST',
                    dataType : 'json',
                    success : function(data) {
                      jQuery('#contenido_cesta').html(data.vista);
                      jQuery('#total_prod_carrito').html(data.total_prod_carrito);
                      jQuery('#importe').html(data.importe);
                      
                        // console.log(data);
                        //alert(  JSON.stringify(JSON.parse(data)) );
                    },
                    error : function(jqXHR, status, error) {
                        //
                    },
                    complete : function(jqXHR, status) {
                        
                    }
            }); 

      });  





///////////////////////////////////cambiar cantidades



 jQuery('body').on('change', 'input.cantidad', function(e){

            cantidad = ( (parseInt($(this).val())>0) ? (parseInt($(this).val())) : 0);
            id_producto =  ( $(this).attr('id_producto')  );

            jQuery.ajax({
                    url : '/session_producto',
                    data:{
                           cantidad:cantidad,
                        id_producto:id_producto,
                        cambio:0,
                    },
                    //esta clausula es obligatoria en laravel
                    headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},

                    type : 'POST',
                    dataType : 'json',
                    success : function(data) {
                      jQuery('#contenido_cesta').html(data.vista);
                      jQuery('#total_prod_carrito').html(data.total_prod_carrito);
                      jQuery('#importe').html(data.importe);
                      
                        // console.log(data);
                        //alert(  JSON.stringify(JSON.parse(data)) );
                    },
                    error : function(jqXHR, status, error) {
                        //
                    },
                    complete : function(jqXHR, status) {
                        
                    }
            }); 

      });  



} );

