 $(document).ready(function(){
        $('#btn').hide();

        $('.proyectoEliminar').each(function(key,element){
            $(this).on( 'click', function() {
                if($(this).is(':checked'))
                    {
                         $('#btn').show();
                    }
                else{
                    $('#btn').hide();
                    }
            });
        });
       
        $('#checkTodos').on( 'click', function() {
            
            if($(this).is(':checked'))
            {
                $('.proyectoEliminar').prop("checked", "checked");
                $('#btn').show();
            }
            else
            {
                 $('.proyectoEliminar').prop("checked", "");
                 $('#btn').hide();
            }
            });


         $('#botonDelete').on( 'click', function() {
            alert("hola");

         });


           
        });