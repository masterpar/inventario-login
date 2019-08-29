$(document).ready(function(){
 
$(document).on("click", ".delete2", function(){
        
        var ids = [];
        var token = $("#token").val();

          $("input:checkbox:checked:not(#selectAll)").map(function(){
            ids.push($(this).val());
          });

         var route = "/tool/deleteAll";
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                dataType: 'json',
                data:{ids: ids},

                success:function(){
                   location.reload();
                   
                },
                error:function(msj){
                    toastr.error("Error al eliminar los elementos");
                }

            });
         
         
    });




//otras funciones
$('#selectAll').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#selectAll').prop('checked',true);
        }else{
            $('#selectAll').prop('checked',false);
        }
    });
    
$(document).on('click', 'tr.checkable', function(){
 if($(this).hasClass('checked')){
  $(this).closest('tr').find("input[type=checkbox]").prop('checked', false);
   $(this).removeClass('checked');
 } else{
  $(this).closest('tr').find("input[type=checkbox]").prop('checked', true);
            $(this).addClass('checked');
 }

});




});