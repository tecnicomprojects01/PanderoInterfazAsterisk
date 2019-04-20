// JavaScript Document

function valida_login(f){
	if (document.frmLogin.usuario.value.length == 0){
		window.alert("Ingrese usuario valido");
		document.frmLogin.usuario.focus();
		return false;
	}
	if (document.frmLogin.clave.value.length == 0){
		window.alert("Ingrese clave valida");
		document.frmLogin.clave.focus();
		return false;
	}
	//document.frmLogin.submit();
	return true;
}

function valida_usuario(f){
	if (document.frmUsuario.usuario.value.length == 0){
		window.alert("Ingrese usuario");
		document.frmUsuario.usuario.focus();
		return false;
	}
	if (document.frmUsuario.clave.value.length == 0){
		window.alert("Ingrese clave");
		document.frmUsuario.clave.focus();
		return false;
	}
	if (document.frmUsuario.perfil.selectedIndex == 0){
		window.alert("Seleccione Perfil");
		document.frmUsuario.perfil.focus();
		return false;
	}
	//document.frmUsuario.submit();
	return true;
}

function cerrar_frm_user(f){
	window.close(f);
}

function popup(url){
	if (window.open) { 
		window.open(url, "popup", "status=0,scrollbars=0,resizable=0,width=400,height=300"); 
		return false; 
	}	
}
function valida_form_agente(f){
	if(document.frmAgente.numero.value.length==0){
		alert("Ingrese Numero de Agente");
		document.frmAgente.numero.focus();
		return false;
	}
}

function valida_form_anexo(f){
	if(document.frmAnexos.numero.value.length==0){
		alert("Ingrese Numero de Anexo");
		document.frmAnexos.numero.focus();
		return false;
	}
	if(document.frmAnexos.nombre.value.length==0){
		alert("Ingrese nombre del Anexo");
		document.frmAnexos.nombre.focus();
		return false;
	}

	if(document.frmAnexos.contexto.selectedIndex == 0){
		alert("Seleccione contexto valido");
		document.frmAnexos.contexto.focus();
		return false;
	} 

	if(document.frmAnexos.clave.value.length==0){
		alert("Ingrese clave del Anexo");
		document.frmAnexos.clave.focus();
		return false;
	} 

//activacv(f);
//document.frmAnexos.cvemail.focus();
	document.frmAnexos.submit();
}

function activacv(f){
	if(document.frmAnexos.actcv[0].checked == true){
		if(document.frmAnexos.cvclave.value.length==0){
			alert("Ingrese clave de correo de voz");
			document.frmAnexos.cvclave.focus();
			return false;
		}
		else if (document.frmAnexos.cvemail.value.length==0){
			alert("Ingrese email");
			document.frmAnexos.cvemail.focus();
			return false;
		}
		return true;
		document.frmAnexos.submit();
	}
	else{
		return true;
		document.frmAnexos.submit();
	}
}

function limpiarcv(){
	if(document.frmAnexos.actcv[1].checked == true){
		document.frmAnexos.cvemail.value="";
		document.frmAnexos.cvclave.value="";
	//document.frmAnexos.actcv[0].checked = true;
	//document.frmAnexos.actcv[1].checked = false;
		document.frmAnexos.msjadj[0].checked = false;
		document.frmAnexos.msjadj[1].checked = true;
	}
}

/*
function nivel-Desc(id){
	alert(document.frmAnexos.contexto[id].value);
}
*/