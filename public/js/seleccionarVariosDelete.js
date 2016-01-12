$(document).ready(function(){
    $('#btn').hide();
    $(".proyectoEliminar").on( 'change', function() {
        if( $(this).is(':checked') ) 
        {
            $('#btn').show();
        } 
        else 
        {
            //excepcion si hay por lo menos un combobox seleccionado el boton no se oculta
           if($('.proyectoEliminar').is(':checked'))
           {
                $('#btn').show();
           } 
           else
           {
                $('#btn').hide();
                $('#checkTodos').prop("checked", "");
           }
        }
    });

     $('#checkTodos').on( 'change', function() {
        if($(this).is(':checked'))
        {
           // $('.proyectoEliminar').click();
           $('.proyectoEliminar').prop("checked", "checked");
           $('#btn').show();
        }
        else
        {
              // $('.proyectoEliminar').unbind( "click" );
           $('.proyectoEliminar').prop("checked", "");
           $('#btn').hide();
        }
     });
     
});