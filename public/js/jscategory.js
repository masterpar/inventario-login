$(document).ready(function(){
 
manageData();

/* manage data list */
function manageData() {
    $.ajax({
        dataType: 'json',
        type: 'GET',
        url: '/categoryGetAll',
        success:function(data){
                   console.log("ya" +data);
                   manageRow(data);
                },
        error:function(msj){
                    alert("Error al listar las categorías");
                }
    });

}


/* Add new Item table row */
function manageRow(data) {
    var rows = '';
    var check = '';
    var btn_editar = '';
    var btn_ver = '';
    $.each( data, function( key, value ) {

        rows = rows + '<tr class="checkable">';
        check = ' <span class="custom-checkbox"><input type="checkbox" value='+value.id+' id=checkbox'+key+' name=checkbox'+key+' class="checkbox" ><label for=checkbox'+key+'></label></span>';
        rows = rows + '<td>'+check+'</td>';
        rows = rows + '<td id=nombre'+value.id+'>'+value.nombre+'</td>';
        btn_editar = '<div><button type="button" class="btn btn-default editar  sinborde" id="edit" name="edit" value='+value.id+' title="Editar" data-toggle="modal"><span class="glyphicon glyphicon-edit fa-lg" style="color: blue;" ></span></button></div>'
        rows = rows + '<td>'+btn_editar+'</td>';
        btn_ver = '<div> <button type="button" class="btn btn-default ver  sinborde" id="ver" name="ver" value='+value.id+'  title="Ver" data-toggle="modal"><span class="glyphicon glyphicon-eye-open fa-lg" style="color: green;" ></span></button></div>'
        rows = rows + '<td>'+btn_ver+'</td>';
        rows = rows + '</tr>';
    });

    $("tbody").html(rows);
}


$(document).on("click", ".ver", function(){
        var id = $(this).val();
        
        location.href = "/category/"+id+"";
         
    });

$(".add-new").click(function(){

    $( "#nombre" ).val("");
    $( "#viejo" ).val("0");
    
    
       
    });

$(document).on("click", ".editar", function(){
        
            var id = $(this).val();
            nombre = $("#nombre"+id).text();
            $( "#viejo" ).val( id );
            $( "#nombre" ).val( nombre );
            $("#add_data_Modal").modal(); 
        });


$(document).on("click", ".delete2", function(){
        
        var ids = [];
        var token = $("#token").val();

          $("input:checkbox:checked:not(#selectAll)").map(function(){
            ids.push($(this).val());
          });

         var route = "/category/deleteAll";
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                dataType: 'json',
                data:{ids: ids},

                success:function(){
                   manageData();
                   toastr.success('Se eliminaron correctamente las categorías');
                   
                },
                error:function(msj){
                    toastr.error("Error al eliminar las categorías");
                }

            });
         
         
    });

$(document).on("click", ".insert", function(){
    
        var id = document.getElementsByName('viejo')[0].value;
        var nombre = document.getElementsByName('nombre')[0].value;
        var token = $("#token").val();
  
        if(id == '0'){
            var route = "/category";
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                dataType: 'json',
                data:{nombre: nombre},

                success:function(){
                  $('#add_data_Modal').modal('hide');
                  toastr.success('Categoría creada correctamente');
                  manageData();
                },
                error:function(msj){
                    toastr.error('Error al ingresar la categoría');
                }

            });
        }
        //para editar
        else {
            var route = "/category/"+id+"";
            $.ajax({
                url: route,
                headers: {'X-CSRF-TOKEN': token},
                type: 'PUT',
                dataType: 'json',
                data:{nombre: nombre},

                success:function(){
                   $('#add_data_Modal').modal('hide');
                  toastr.success('Categoría editada correctamente');
                  manageData();
                },
                error:function(msj){
                    toastr.error("Error al editar la categoría");
                }

            });
        }
          
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