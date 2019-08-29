$(document).ready(function(){

	
	// Activate tooltip
	$('[data-toggle="modal"]').tooltip();
	$('[title]').tooltip();
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	var actions = $("table td:last-child").html();
	var resolucion = $("table td:nth-child(12)").html();
	

	$(".add-new2").click(function(){
		
        
        $.get('CreditosPosgrado?p=agregar', function(responseText) {
        	var respuesta = responseText.substr(0, responseText.indexOf(','));
        	var respuesta2 = responseText.split(",").pop();        	
			$('#nivel').html(respuesta);
			$('#modalidad').html(respuesta2);
		});
    });
	
$(".add-new").click(function(){

	$( "#nombre" ).val("");
	$( "#valor" ).val("");
	$( "#viejo" ).val("0");
	
	
       
    });



	// Delete row on delete button click
	

	
	$(document).on("click", ".delete", function(){

		$("#deleteEmployeeModal2").modal();
		$(".delete3").prop("value", $(this).val());
		
    });
	
	$(document).on("click", ".delete2", function(){
		
		var ids = [];
		
		  $("input:checkbox:checked:not(#selectAll)").map(function(){
		    ids.push($(this).val());
		  });
		 
		 
		 
		  $.post('TipoRespuestas?accion=deleteAll',{
	        	ids: ids,
	        	accion: "deleteAll"
	        }, function(responseText) {
	        	if(responseText.trim()===""){
	        		//alertify.success("Los formatos se han eliminado correctamente.");
	        		location.reload();
	        	}else{
	        		$('#mensajeerror').html(responseText);
	        		$("#myModal").modal();
	        	}
			});
    });
	
	//DELETE INDIVIDUAL
	$(document).on("click", ".delete3", function(){
		var id = $(this).val();
		if(body == document.body){
		  $.post('TipoRespuestas',{
	        	id: id,
	        	accion: "delete"
	        }, function(responseText) {
	        	if(responseText.trim()===""){
	        		
	        		//alertify.success("La pregunta "+numPregunta+" se ha eliminado correctamente.");
	        		location.reload();
	        		//setTimeout(function(){location.href ="listadoFormatos"; } , 3000 );
	        		
	        	}else{
	        		$('#mensajeerror').html(responseText);
	        		$("#myModal").modal();
	        	}
			});
		}else{
			alert("cambios");
		}
    });
	
	$(document).on("click", ".activar", function(){

		$("#activarmodal").modal();
		$(".activar2").prop("value", $(this).val());
		
    });
	
	
	$(document).on("click", ".activar2", function(){
		var id = $(this).val();
		var nombre_formato = $("#formato"+id).text();
		  $.post('listadoFormatos',{
	        	id: id,
	        	accion: "activar"
	        }, function(responseText) {
	        	if(responseText.trim()===""){
	        		
	        		//alertify.success("El formato "+nombre_formato+" se ha activado correctamente.");
	        		location.reload();
	        		//setTimeout(function(){location.href ="listadoFormatos"; } , 3000 );
	        		
	        	}else{
	        		$('#mensajeerror').html(responseText);
	        		$("#myModal").modal();
	        	}
			});
    });
	
	
	$(document).on("click", ".cancelar", function(){
		location.reload();
    });
	
	$(document).on("click", ".insert", function(){
	
		var id = document.getElementsByName('viejo')[0].value;
		var nombre = document.getElementsByName('nombre')[0].value;
		var valor = document.getElementsByName('valor')[0].value;

		if(id == '0'){
		  $.post('TipoRespuestas',{
			    nombre: nombre,
			    valor: valor,
	        	accion: "insert"
	        }, function(responseText) {
	        	if(responseText.trim()===""){
	        		 $('#add_data_Modal').modal('hide');
	        		 $( "#viejo" ).val("0");
	        		//alertify.success("La pregunta se ha creado correctamente.");
	        		location.reload();
	        		
	        		
	   
	        	}else{
	        		$('#mensajeerror').html(responseText);
	        		$("#myModal").modal();
	        	}
			});
		}
		//para editar
		else {
			$.post('TipoRespuestas',{
				id: id,
				nombre: nombre,
			    valor: valor,
	        	accion: "update"
	        }, function(responseText) {
	        	if(responseText.trim()===""){
	        		$('#add_data_Modal').modal('hide');
	        		//alertify.success("La pregunta # "+numPregunta+" ha sido actualizado correctamente.");
	        		location.reload();
	        		
	        	}else{
	        		$('#mensajeerror').html(responseText);
	        		$("#myModal").modal();
	        	}
			});
		}
		  
    });
	
	
	$(document).on("click", ".ver", function(){
		var id = $(this).val();
		  $.get('listadoFormatos',{
	        	id: id,
	        	accion: "ver"
	        }, function(responseText) {
	        	if(responseText.trim()===""){
	        		
	        	}else{
	        		$('#mensajeerror').html(responseText);
	        		$("#myModal").modal();
	        	}
			});
    });
	

		$(document).on("click", ".editar", function(){
		
			var id = $(this).val();
			nombre = $("#nombre"+id).text();
			valor = $("#valor"+id).text();
			alert(nombre);
			$( "#viejo" ).val( id );
			$( "#nombre" ).val( nombre );
			$( "#valor" ).val( valor );
	        $("#add_data_Modal").modal();
	       
			
		
			
	    });

	
//	acciones de la ventana resolucion
	


	
	$('[data-toggle="modal"]').tooltip({
	    trigger : 'hover'
	})  
	
	$(document).on("click", ".visualizar", function(){
		var id = $(this).val();		
		$.ajax({
		     url: 'listadoFormatos', 
		     type: "POST",
		     data: ({
		        	id: id,
		        	p: "visualizar"
		        }),
		        async: false
		        ,
		        success: function(responseText) {
		        	if(responseText.trim()===""){
		        		location.reload();
		        	}else{
		        		window.open(responseText);
		        		$(".ui-tooltip").css("display", "none");
		        	}
				}
		});
    });	

});


$(document).on("click", ".cancelar", function(){
	location.reload();
});

function act_tabla(formato_id) {
	 $.get("TipoRespuestas", function(responseText) {          // Execute Ajax GET request on URL of "someservlet" and execute the following function with Ajax response JSON...
		 DOMparser = new DOMParser();
		  DOMdata = DOMparser.parseFromString(responseText, 'text/html');
		  var bodyHTML = DOMdata.body;
		  var html = $(responseText).find('#tabla_respuesta') ;
		  $("#tabla_respuesta").replaceWith(html);
		  
	    });
	
}


