/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
	// Activate tooltip
	var arrayIdSeleccionados =[];
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
	
});
var opciones = [];
$(document).ready(function(){
	opciones = [];
	for(let i =0;i<$("#appbundle_producto_idcategoria").children().children().length;i++){
		opciones.push($("#appbundle_producto_idcategoria").children().children()[i]);
	}
	
	console.log(opciones);
	$(".select1").children().remove("optgroup");
	$(".select2").children().remove("optgroup");
	for(let i =0;i<opciones.length;i++){
		$( ".select1" ).append( opciones[i] );
		$( ".select2" ).append($('<option>', {value:variableCategoria[i], text:nombreCategoria[i]}));
	}
});

function crearProducto(){
	$('html, body').animate({scrollTop:0}, 'slow');
	$("#divIdCrear").remove()
	
	if($("#divFormCrear").hasClass("noVisible")){
		$("#divFormCrear").removeClass("noVisible");
		$(".container").addClass("containerModal");
		
		$( "#divFormCrear" ).animate({
			right: "0"
		  }, 400, function() {
		});
	}else{
		
		$( "#divFormCrear" ).animate({
			right: "-1000"
		  }, 400, function() {
		});
		setTimeout(function(){ $("#divFormCrear").addClass("noVisible"); }, 200);
		
		$(".container").removeClass("containerModal");
		
		
	}
	
}

$(document).ready(function(){
	$(".form-group")[0].remove();
		
	$("#appbundle_producto_Guardar").click(function(){
		$("#divGif1").removeClass("noVisible1");
	});
});
function editarProducto(id,nombre,categoria,preciocompra,precioventa){
	$('html, body').animate({scrollTop:0}, 'slow'); 
	
	if($("#divFormEditar").hasClass("noVisible")){
		
		$(".editar_producto_id").val(id);
		$(".editar_producto_nombre").val(nombre);
		$(".editar_producto_categoria").val(categoria);
		$(".editar_producto_compra").val(preciocompra);
		$(".editar_producto_venta").val(precioventa);
		
		$("#divFormEditar").removeClass("noVisible");
		$(".container").addClass("containerModal");
		
		$( "#divFormEditar" ).animate({
			right: "0"
		  }, 400, function() {
		});
	}else{
		
		$( "#divFormEditar" ).animate({
			right: "-1000"
		  }, 400, function() {
		});
		setTimeout(function(){ $("#divFormEditar").addClass("noVisible"); }, 200);
		
		$(".container").removeClass("containerModal");
		
		
	}
	
}

function actualizar() {
	$("#divGif2").removeClass("noVisible1");
    $.ajax({
        type: "POST",
        url: "actualizar",
        data: {
            "id" : $(".editar_producto_id").val(),
            "nombre": $(".editar_producto_nombre").val(),
            "categoria":$(".editar_producto_categoria").val(),
            "preciocompra":$(".editar_producto_compra").val(),
            "precioventa":$(".editar_producto_venta").val()
        },

        success: function(data) {
			console.log("Producto actualizado");
			location.reload(true);
        },
        error: function() {
			console.log("Error en actualizar");
			document.getElementById('img2').src = "{{ asset('img/error.png') }}";
		}
    });
}
var idEliminar=null;
function eliminarProducto(id,nombre,categoria,preciocompra,precioventa){
	$('html, body').animate({scrollTop:0}, 'slow'); 
	
	if($("#divFormEliminar").hasClass("noVisible")){

		$("#h4Nombre").html(nombre);
		
		for(let i=0;i<variableCategoria.length;i++){
			if(variableCategoria[i]==categoria){
				$("#h4Categoria").html(nombreCategoria[i]);
				break;
			}	
		}
		
		$("#h4Compra").html(preciocompra);
		$("#h4Venta").html(precioventa);
		
		$("#divFormEliminar").removeClass("noVisible");
		$(".container").addClass("containerModal");
		
		idEliminar=id;
		
		$( "#divFormEliminar" ).animate({
			right: "0"
		  }, 400, function() {
		});
	}else{
		idEliminar=null;
		$( "#divFormEliminar" ).animate({
			right: "-1000"
		  }, 400, function() {
		});
		setTimeout(function(){ $("#divFormEliminar").addClass("noVisible"); }, 200);
		
		$(".container").removeClass("containerModal");
		
		
	}
	
}

function eliminar() {
	$("#divGif3").removeClass("noVisible1");
    $.ajax({
        type: "POST",
        url: "eliminar",
        data: {
            "id" : idEliminar,
        },

        success: function(data) {
			console.log("Producto actualizado")
			location.reload(true);
        },
        error: function() {
			document.getElementById('img3').src = "{{ asset('img/error.png') }}";
		}
    });
}

function eliminarProductoMasivo(id,nombre,categoria){
	$('html, body').animate({scrollTop:0}, 'slow'); 
	actualizarArrayId();
	if($("#divFormEliminarMasivo").hasClass("noVisible")){


		$("#divFormEliminarMasivo").removeClass("noVisible");
		$(".container").addClass("containerModal");
		
		
		$( "#divFormEliminarMasivo" ).animate({
			right: "0"
		  }, 400, function() {
		});
	}else{
		$( "#divFormEliminarMasivo" ).animate({
			right: "-1000"
		  }, 400, function() {
		});
		setTimeout(function(){ $("#divFormEliminarMasivo").addClass("noVisible"); }, 200);
		
		$(".container").removeClass("containerModal");
		
		
	}
	
}


function actualizarArrayId(){
	arrayIdSeleccionados =[];
	$('.chck:checked').each(
		function() {
			arrayIdSeleccionados.push($(this).val());
		}
	);
	
	$("#mensajeCantidad").html(arrayIdSeleccionados.length+" productos seleccionados!.");
}

function eliminarMasivo() {
	if(arrayIdSeleccionados.length!=0){
		$("#divGif4").removeClass("noVisible1");
		$.ajax({
			type: "POST",
			url: "eliminarMasivo",
			data: {
				"id" : arrayIdSeleccionados,
			},

			success: function(data) {
				console.log("Productos eliminados")
				location.reload(true);
			},
			error: function() {
				document.getElementById('img3').src = "{{ asset('img/error.png') }}";
			}
		});
	}
}