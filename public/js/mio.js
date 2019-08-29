$(function () {

    $('#boton').attr("disabled", true);
    $('.subcategory_div').hide();
	$('#categories').on('change',cargar);
	$('.f_apartada').hide();
    $('#f_apartada').val('');
     $('#datepicker').datepicker({
        startDate: "yesterday",
        language: "es",
        keyboardNavigation: true,
        autoclose: true,
        todayHighlight: true,
        autoclose: true
    }).on('changeDate',function(e){
    	var fecha = $('#datepicker').val();
    	fecha = moment(fecha).format('YYYY-MM-DD');
    	$.get('/fechaelemento/'+fecha,function (data) {
           if (data > 0) {
           	//si hay problema
           	$('#boton').attr("disabled", true);
           	$('.error_apartado').html('<strong>Uno de los elementos ya está apartado para esa fecha. Seleccione una fecha anterior</strong>');
          
           }else{
           	//no hay problema
           	$('.error_apartado').html('');
           	$('#boton').attr("disabled", false);
           
           }
	});
       
});

     $('#f_apartada').datepicker({
        startDate: "yesterday",
        language: "es",
        keyboardNavigation: true,
        autoclose: true,
        todayHighlight: true,
        autoclose: true
    }).on('changeDate',function(e){
    	var fecha = $('#f_apartada').val();
    	fecha = moment(fecha).format('YYYY-MM-DD');
        //$('#datepicker').datepicker('setStartDate', '2015-01-01');
        var minDate = new Date(e.date.valueOf());
        $('#datepicker').datepicker('setStartDate', minDate);
    	
        
    });

	cargar();


});

function cargar() {
	var category_id = $('#categories').val();
	if (!category_id) {
			$('#subcategories').html('<option value="" > Seleccione subcategoriayyy</option>');
			return;
		}

	$.get('/getsubcategories/'+category_id,function (data) {
	var html_select = '<option value="" >Seleccione subcategoría</option>';
	$('#subcategories').html(html_select);
	if(data.length>0){
		$('.subcategory_div').show();
	  for (var i=0; i<data.length; ++i) {
		  html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
		  $('#subcategories').html(html_select);
	    }
	     
   }else{
   	$('.subcategory_div').hide();
   	$( "#subcategories" ).val('');
   }


	});


}

function cargar2() {
	var category_id = $(this).val();
	if (!category_id) {
			$('#subcategories').html('<option value=""> Seleccione subcategoriasdasdasda</option>');
			return;
		}

	$.get('/getsubcategories/'+category_id,function (data) {
	var html_select = '<option value""> Seleccione subcategoria</option>';
	for (var i=0; i<data.length; ++i) {
		html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
		$('#subcategories').html(html_select);
	}


	});
}

$( document ).ready(function() {

    // Update item cart
	$(".btn-update-item").on('click', function(e){
		e.preventDefault();
		
		var id = $(this).data('id');
		var href = $(this).data('href');
		var cantidad = $("#product_" + id).val();

		window.location.href = href + "/" + cantidad;
	});

	
	$(".btn-update-tool-cant").on('click', function(e){
		e.preventDefault();
		
		var id = $(this).data('id');
		var href = $(this).data('href');
		var cantidad = $("#product_" + id).val();

		window.location.href = href + "/" + id + "/" + cantidad;
	});

	$(".btn-update-tool-dev").on('click', function(e){
		e.preventDefault();
		
		var id = $(this).data('id');
		var href = $(this).data('href');
		var cantidad = $("#product_" + id).val();

		window.location.href = href + "/" + id + "/" + cantidad;
	});

});

setTimeout(function() {
    $('.alert').fadeOut('fast');
}, 5000); // <-- time in milliseconds

//del carrito

$('.number').on('change keyup', function() {
  // Remove invalid characters
  var sanitized = $(this).val().replace(/[^0-9]/g, '');
  // Update value
  $(this).val(sanitized);
});

function enviar_formulario(){ 
   document.form.submit() ;
}

function mostrar_apartar() {
        check = document.getElementById("check");
        if (check.checked) {
        	document.getElementById("f_apartada").value = "";
            $('.f_apartada').show();
        }
        else {
        	document.getElementById("f_apartada").value = "";
            $('.f_apartada').hide();
        }
    }

$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});