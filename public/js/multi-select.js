//jQuery('#friends').selectpicker('refresh');
//https://stackoverflow.com/questions/27727655/can-not-populate-bootstrap-select-with-data-live-search-multiple-with-jquery


//jQuery('body').on('changed.bs.select', '#friends', function(e){
//$('#friends').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
  // do something...
//});

//https://tutorialzine.com/2013/07/50-must-have-plugins-for-extending-twitter-bootstrap?fbclid=IwAR31iaIJXZvRGQ9ugbTBvaZTGqGK7zC8CBp_DqQM_ZZZqJlq4lTXCpe5z48
//http://davidstutz.de/bootstrap-multiselect/?fbclid=IwAR2Y0P6DMvx8L8L2TYs3bDsTiADlJTbL6fIoL9ZZEW-lY8HGJdqJzy2JkOk#getting-started
//https://github.com/davidstutz/bootstrap-multiselect
////////////////////////////////////////////////////

/*
            $(document).ready(function() {
                $('#example-checkboxName').multiselect({
                    checkboxName: function(option) {
                        return 'multiselect[]';
                    }
                });
            });
*/
        /*
        $('#example-post-checkboxName').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true
        });
        */


 $('#example-post-checkboxName').multiselect({

        //seleccionar todos
            includeSelectAllOption: true,   //para habilitar seleccionar todo
            selectAllText : '¡Verificar todo!', // texto q se muestra para "seleccionar todo"
            selectAllValue: 0,                  //para controlar el "value" , para la opcion seleccionar todo
            selectAllName : 'select-all-name', //para controlar el "name" , para la opcion seleccionar todo
            
            //selectAllNumber
            
            onSelectAll : function () {  //se dispara cuando se selecciona todo
                                       // o con el metodo .multiselect('selectAll')
                console.log ( 'onSelectAll activado!' );
            },

            onDeselectAll: function () {  //se dispara cuando se deselecciona todo
                                       // o con el metodo .multiselect('deselectAll')
                console.log ( 'onSelectAll activado!' );
            },

            selectAllJustVisible: false,   //este permite que se seleccionen todas las opciones con includeSelectAllOption, aunq no esten visibles
           
    //filtros


            enableFiltering: true,  //habilitar o deshabilitar el filtro. 
                                    //Se agregará un input  para filtrar dinámicamente todas las opciones.

            enableCaseInsensitiveFiltering : true, //filtrado de forma sensible, May y Min

            //enableFullValueFiltering : true , // cuando se filtra con esto, lo q prevalece es el orden de las letras q se van escribiendo
                                               //https://github.com/davidstutz/bootstrap-multiselect/pull/555

            filterBehavior: 'value',   //Filtrar las opciones por(valor, texto o ambos) value, text, both, 

            filterPlaceholder: 'consulte', //Placeholder para el filtrado

   //btn de reinicio
            includeResetOption : true ,    //agregar el btn de reinicio(limpiar check) 
            includeResetDivider : true ,  //agrega division entre reinicio y opciones
             resetText : "Restablecer todo" , // texto para el btn de reinicio



    //grupos
            enableClickableOptGroups : true,  //se seleccionan automaticamente todos los elementos
                                             //este permite hacer click en los grupos tambien
                                             // funciona tambien con opciones deshabilitadas

            enableCollapsibleOptGroups: true,   //colapsar los grupos
            //collapseOptGroupsByDefault: true,  //colapsa todos los grupos por defecto  

            
   //boton

             buttonContainer : '<div class = "btn-group" />', //El contenedor que contiene tanto el botón como el menú desplegable.

                    buttonClass : 'btn btn-link' ,  // clase del botón de selección múltiple.

                        inheritClass: true,  //Herede la clase del botón de la selección original.
                buttonWidth : '400px', //El ancho del botón de selección múltiple se puede corregir con esta opción.
                    /*
                buttonText: function(options, select) {   // callback que especifica el texto que se muestra en el botón en función de las opciones seleccionadas actualmente
                    if (options.length === 0) {
                        return 'no hay opciones seleccionadas ...';
                    }
                    else if (options.length > 3) {
                        return 'mas de 3 opciones seleccionadas!';
                    }
                     else {  //aqui va a mostrar las etiquetas seleccionadas
                         var labels = [];
                         options.each(function() {
                             if ($(this).attr('label') !== undefined) {
                                 labels.push($(this).attr('label'));  
                             }
                             else {
                                 labels.push($(this).html());
                             }
                         });
                         return labels.join(', ') + '';
                     }
                },
                */
        
                nonSelectedText: 'marca una opciòn!', //texto q se muestra cuando no se selecciona ninguna opciòn(buttonText, buttonTitle)
                 nSelectedText : '- ¡Demasiadas opciones seleccionadas!', //texto q se muestra cuando no se selecciona muchas opciòn(buttonText, buttonTitle)
                 allSelectedText : 'No queda ninguna opción ...' , //texto mostrado cuando se seleccionan todas las opciones(buttonText, buttonTitle)

                 numberDisplayed: 2, //para determinar si se mostrarían demasiadas opciones.   (buttonText, buttonTitle)

                 delimiterText: ';',  //separador por defecto de la lista de elementos
///////////////

                optionLabel: function(element) { //callback para definir etiquetas de opciones
                    return $(element).html() + '(' + $(element).val() + ')';
                },


                optionClass: function(element) {  //callback para definir clase de los elementos li que contienen casillas de verificación y etiquetas.
                    var value = $(element).val();
     
                    if (value%2 == 0) {
                        return 'even';
                    }
                    else {
                        return 'odd';
                    }
                },

                selectedClass : 'seleccionada' , //clase aplicada en las opciones seleccionada


        //en caso de no haber opciones
            disableIfEmpty : true,  // la selección múltiple se desactivará si no hay opciones.  o el select es disabled = "disabled"
            disabledText :  'Desactivado ...' , //texto q se muestra en caso de q la seleccion multiple este desactivada


            dropRight : true, // el menu desplegable se coloca a la derecha
            
            
            onChange: function(option, checked) {    //no se dispara con seleccion y deseleccion de todos
                                                     //cada vez q se hace click en opciones
                                                     //Cada vez que se hace clic en un "grupo de opciones", 
                                                    //el evento onChange se dispara con todas las opciones afectadas como primer parámetro.

                console.log(option[0]);  //son cada elemento
                //alert(option.length + ' options ' + (checked ? 'selected' : 'deselected'));
            },                                             

            onInitialized : function ( select , container ) {   //se dispara cuando la seleccion multiple termina de inicializarse
                    console.log ( 'Inicializado' );
            },    

            onDropdownShow: function(event) {  //callback cuando se muestra el menú desplegable.
                console.log('Mostrando menu.');
            },                 

            onDropdownHide : function(event) {  //callback cuando se oculta el menú desplegable.
                console.log('ocultando menu.');
            },             
   

            checkboxName: function(option) {  //nombre utilizado para las casillas de verificación generadas. Nombre q enviare a php
                //e.preventDefault();  //parar la accion del evento
                //console.log(option[0]);  //son cada elemento
                var $optgroup = $(option).closest('optgroup');
                console.log($optgroup.id);
                //return false;

                if ($optgroup.id == 'example-post-checkboxName-1') {

                    return 'group1[]';
                }
                else {
                    return 'group2[]';
                }
            }
        
    });

     //$('#example-post-checkboxName .caret-container').click();



//  $('#example-dataprovider').multiselect();
 
    var options = [
        {label: 'osmel 1', title: 'Option 1', value: '1', selected: true},
        {label: 'Option 2', title: 'Option 2', value: '2'},
        {label: 'Option 3', title: 'Option 3', value: '3', selected: true},
        {label: 'Option 4', title: 'Option 4', value: '4'},
        {label: 'Option 5', title: 'Option 5', value: '5'},
        {label: 'Option 6', title: 'Option 6', value: '6', disabled: true}
    ];
    
    $('#example-post-checkboxName').multiselect('dataprovider', options);



<optgroup label="Group 1" id="marcas-1">
                    <option value="1-1">Option 1.1</option>
                    <option value="1-2">Option 1.2</option>
                    <option value="1-3">Option 1.3</option>
                </optgroup>
                <optgroup label="Group 1" id="marcas-2" >
                    <option value="2-1">Option 2.1</option>
                    <option value="2-2">Option 2.2</option>
                    <option value="2-3">Option 2.3</option>
                </optgroup>



<form class="form-horizontal" method="POST" action="post.php">
    <div class="form-group">
        <label class="col-sm-2 control-label">Multiselect</label>
        <div class="col-sm-10">
            <select id="example-post-checkboxName" name="multiselect[]" multiple="multiple" required>
                <optgroup label="Group 1" id="example-post-checkboxName-1">
                    <option value="1-1">Option 1.1</option>
                    <option value="1-2">Option 1.2</option>
                    <option value="1-3">Option 1.3</option>
                </optgroup>
                <optgroup label="Group 1" id="example-post-checkboxName-2" >
                    <option value="2-1">Option 2.1</option>
                    <option value="2-2">Option 2.2</option>
                    <option value="2-3">Option 2.3</option>
                </optgroup>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>


$(document).ready(function() {
    var data = [];
    for (var i = 0; i < 100; i++) {
        var group = {label: 'Group ' + (i + 1), children: []};
        for (var j = 0; j < 10; j++) {
            group['children'].push({
                label: 'Option ' + (i + 1) + '.' + (j + 1),
                value: i + '-' + j
            });
        }
 
        data.push(group);
    }
 
    $('#example-large-dataprovider-button').on('click', function() {
        $('#example-large-dataprovider').multiselect({
            maxHeight: 200
        });
        $('#example-large-dataprovider').multiselect('dataprovider', data);
    });
});
<p class="alert alert-info"><button id="example-large-dataprovider-button" class="btn btn-primary">Activate</button></p>

<select id="example-large-dataprovider" multiple="multiple"></select>

///////////////////////////////////////////////

/*


   jQuery.ajax({
        url:'/get_fabricantes', //this returns object data
        data:
            {                     
                valor: jQuery('select[modulo="fabricantes"]').val(),
                modulo: jQuery('select[modulo="fabricantes"]').attr('modulo'),
              }, 

            headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },    
        type:'GET',
        datatype:'json',
        success:function(data) { //data = {"0":{"id":1,"name":"Jason"},"1":{"id":2,"name":"Will"},"length":2 }
            //data = JSON.parse(data);
            //console.log(data);

           
            var options='';
            for (var i = 0; i < data['length']; i++) {
                
                //console.log(data[i].nombre);

                options += "<option value='"+data[i].id+"'>"+data[i].nombre+"</option>";
            }
            //console.log(options);
             //jQuery('#friends').selectpicker('val', 'osmel');
            jQuery('#friends').append(options);
            jQuery('#friends').selectpicker('refresh');
            
        }
    });

jQuery('body').on('keyup', 'input[type="search"][role="combobox"]', function(e){

    //console.log( $(this).val() );

    texto= $(this).val();

    jQuery.ajax({
        url:'/get_fabricantes', //this returns object data
        data:
            {                     
                valor: texto, //jQuery('select[modulo="fabricantes"]').val(),
                modulo: jQuery('select[modulo="fabricantes"]').attr('modulo'),
              }, 

            headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },    
        type:'GET',
        datatype:'json',
        success:function(data) { //data = {"0":{"id":1,"name":"Jason"},"1":{"id":2,"name":"Will"},"length":2 }
            var options='';
            for (var i = 0; i < data['length']; i++) {
                options += "<option value='"+data[i].id+"'>"+data[i].nombre+"</option>";
            }
            //console.log(options);
            jQuery('#friends').selectpicker('val', 'osmel');
            //jQuery('#friends').html('');
            jQuery('#friends').append(options);
            jQuery('#friends').selectpicker('refresh');
            
        }
    });   

}); 

*/
//jQuery('#friends').selectpicker('refresh');
//$(selectpicker).selectpicker('refresh');





$('#marcas').multiselect({
        //seleccionar todos
            includeSelectAllOption: true, 
            maxHeight: 200,
 

            /*
        dataprovider: function(dataprovider) {
            var optionDOM = "";
            var groupCounter = 0;
            var selected="";
            $.each(dataprovider, function (index, option) {

                if (option['title']!==undefined) {

                    groupCounter++;
                    optionDOM += '<optgroup label="' + (option.title || 'Group ' + groupCounter) + '">';

                    $.each(option['stuff'], function (index, option) {
                        optionDOM += '<option value="' + option.value +'" >' + (option.label || option.value) + '</option>';                   
                    });
                    optionDOM += '</optgroup>';
                }
                else {
                    optionDOM += '<option value="' + option.value +'">' + (option.label || option.value) + '</option>';
                }
            });

        },*/
                     
});     




    var data = [
        {
            label: 'Group 1', children: [
                {label: 'Option 1.1', value: '1-1', selected: true},
                {label: 'Option 1.2', value: '1-2'},
                {label: 'Option 1.3', value: '1-3'}
            ]
        },
        {
            label: 'Group 2', children: [
                {label: 'Option 2.1', value: '1'},
                {label: 'Option 2.2', value: '2'},
                {label: 'Option 2.3', value: '3', disabled: true}
            ]
        }
    ];


//http://davidstutz.de/bootstrap-multiselect/?fbclid=IwAR2Y0P6DMvx8L8L2TYs3bDsTiADlJTbL6fIoL9ZZEW-lY8HGJdqJzy2JkOk#configuration-options-enableHTML





   //console.log( key_marca + ": " + marca.nombre+ ": " + modelo+ ": " + modelo['modelo'] );
                      /*
                      $.each( modelo.modelo, function( key_variacion, variacion ) {

                            console.log( key_marca + ": " + marca.nombre+ ": " + modelo + ": " + variacion );

                      });  
                      */

/*
 var data = [];
    for (var i = 0; i < 100; i++) {
        var group = {label: 'Group ' + (i + 1), children: []};
        for (var j = 0; j < 10; j++) {
            group['children'].push({
                label: 'Option ' + (i + 1) + '.' + (j + 1),
                value: i + '-' + j
            });
        }
 
        data.push(group);
    }
*/
    //console.log(data);


//$('#marcas').multiselect('dataprovider', data);



data='[{title:"group1",stuff:{label:"one",value:1},{label:"two",value:2"}},{title:"group2",stuff:{label:"three",value:3},{label:"four",value:4"}}]';






/*
       $data['valor']=$request->get('valor'); 
       $data['modulo']=$request->get('modulo'); 
      
       //return json_encode($data);

       $result=[];
      switch ($data['modulo']) {
        case 'fabricantes':
            $result=Fabricante::where('nombre', 'LIKE', "%{$data['valor']}%")->get();
            return $result;
          break;
        default:
             $result=Fabricante::where('nombre', 'LIKE', "%{$data['valor']}%")->get();
          break;
       }
        return response()->json($result);

        */

























                 {{--  predictivo con typeahead  

                <div class="form-group">
                    <input  type="text" name="editando_proyectos" idusuario="1" class="form-control buscar_elemento ttip" title="Campo predictivo. Escriba y seleccione el nombre de un proyecto." autocomplete="off" spellcheck="false" placeholder="Buscar fabricante...">
                </div>                

                 --}}


                    {{--  selectpicker   
                    <select name='friends[]' id='friends'  modulo="fabricantes" class='selectpicker show-tick form-control'
                    data-live-search='true' multiple>
                       
                    </select>
                    --}}

{{--

  <form class="form-horizontal" method="POST" action="/post.php">
    <div class="form-group">
        <label class="col-sm-2 control-label">Multiselect</label>
        <div class="col-sm-10">
            <select id="example-post" name="multiselect[]" multiple="multiple">
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
                <option value="5">Option 5</option>
                <option value="6">Option 6</option>
            </select>
        </div>
    </div>
  
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>
--}}






            {{-- marca, modelo, variacion, motor--}}   
                <form class="form-horizontal" method="POST" action="post.php">
                    <div class="form-group">
                        {{-- <label class="col-sm-2 control-label">Seleccione marca</label> --}}
                        <div class="col-sm-10">
                            <select id="marcas" name="multiselect[]" multiple="multiple" required>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>




para editar el select

https://laracasts.com/discuss/channels/laravel/form-select-box-formselect?page=1
