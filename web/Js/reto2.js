/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
	$.get("api/"+id_categoria, function(data, status){
		//llenar las filas con los datos obtenidos del api
		agregarCampo(data);
	});
	
});

var indice=1;
function agregarCampo(data){
	
	for(let a in data){
		console.log(a);
		let table = document.getElementById("tablaProductos");
		let row = table.insertRow(indice);
		// creacion de campos
		let cell1 = row.insertCell(0);
		let cell2 = row.insertCell(1);
		let cell3 = row.insertCell(2);
		let cell4 = row.insertCell(3);
		let cell5 = row.insertCell(3);

		cell1.innerHTML = indice;
        cell2.innerHTML = data[a].nombre;
        cell3.innerHTML = data[a].categoria;
		cell4.innerHTML = data[a].precioCompra;
		cell5.innerHTML = data[a].precioVenta;
		
		indice++;

	}
	


}
