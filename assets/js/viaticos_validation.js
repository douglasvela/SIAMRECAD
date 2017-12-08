function TEXTO(id,mini,maxi){
	var data = $("#"+id).val();
	var band = false;
	var l = data.length;
	
	if(l < mini){
		band = false;
		CLASE_ERROR(id,"Debe ingresar al menos "+mini+" caracteres");
	}else{
		band = true;
		CLASE_SUCCESS(id);
	}
	if(l > maxi){
		band = false;
		CLASE_ERROR(id,"Excedió el máximo de "+maxi+" caracteres");
	}
	return band;	
}

function COMBO(id){
	var data = $("#"+id).val();
	var band = false;
	if(data == 0 || data == ""){
		CLASE_ERROR(id,"Debes seleccionar una opción");
	}else{
		band = true;
		CLASE_SUCCESS(id);
	}
	return band;	
}

function CLASE_ERROR(id,texto){
	$("#"+id).parent("div").removeClass("t_success");
	$("#"+id).siblings(".text_validate").removeClass("t_successtext");
	$("#"+id).parent("div").addClass("t_error");
	$("#"+id).siblings(".text_validate").addClass("t_errortext");
	$("#"+id).siblings(".text_validate").html("<span class='fa fa-warning'></span> "+texto);
}

function CLASE_SUCCESS(id){
	$("#"+id).parent("div").removeClass("t_error");
	$("#"+id).siblings(".text_validate").removeClass("t_errortext");
	$("#"+id).parent("div").addClass("t_success");
	$("#"+id).siblings(".text_validate").addClass("t_successtext");
	$("#"+id).siblings(".text_validate").html("¡¡¡ Tiene buena pinta !!! <span class='fa fa-thumbs-up'></span>");
}