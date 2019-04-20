/*Instanciamos Ajax*/
function objetoAjax(){
        var xmlhttp=false;
        try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
                try {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (E) {
                        xmlhttp = false;
                }
        }
        if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
                xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
}


function ShowPage(page,id){
  cont = document.getElementById('content');   
  ajax=objetoAjax();   
  ajax.open("GET", page);
  ajax.onreadystatechange = function(){
	   if (ajax.readyState == 4 && ajax.status == 200) {
	   	cont.innerHTML = ajax.responseText;
	   }
  }
  	ajax.send(null);
}

/*Funcion de pruebas*/
function mensajeprueba(){
	alert("Mensaje de prueba");
}

/********************************************************************
Name      : registrarAnexo
Input     : Ninguno
Outout    : 0
function  : Enviar los valores a un php para la insercion de datos
Author    : Carlos Alberto Sacaca Bernachea
*********************************************************************/
function registrarAnexo(){

  vUserName     = document.getElementById("txtUserName").value;
  vNumber       = document.getElementById("txtNumber").value;
  vName         = document.getElementById("txtName").value;
  vType         = document.getElementById("cbType").value;
  vHost         = document.getElementById("txtHost").value;
  vContext      = document.getElementById("txtContext").value;
  vSecret       = document.getElementById("txtSecret").value;
  vCanreinvite  = document.getElementById("txtCanreinvite").value;
  vQualify      = document.getElementById("txtQualify").value;
  vNat          = document.getElementById("txtNat").value;
  vCallLimit    = document.getElementById("txtCallLimit").value;
  vDtmfMode     = document.getElementById("txtDtmfMode").value;
  vCallGroup    = document.getElementById("txtCallGroup").value;
  vPickupGroup  = document.getElementById("txtPickupGroup").value;
  vUlaw         = (document.getElementById("optUlaw").checked == true ? document.getElementById("optUlaw").value : "");
  vAlaw         = (document.getElementById("chkAlaw").checked == true ? document.getElementById("chkAlaw").value : "");
  vGsm          = (document.getElementById("chkGsm").checked == true ? document.getElementById("chkGsm").value : "");
  vG729         = (document.getElementById("chkG729").checked == true ? document.getElementById("chkG729").value : "");
  vG723         = (document.getElementById("chkG723").checked == true ? document.getElementById("chkG723").value : "");
  vActMailSi    = document.getElementById("optActMailSi").value;
  vActMailNo    = document.getElementById("optActMailNo").value;
  vActMailSecret= document.getElementById("txtActMailSecret").value;
  vAdjMsgSi     = document.getElementById("optAdjMsgSi").value;
  vAdjMsgNo     = document.getElementById("optAdjMsgNo").value;
  vAdjMsgEmail  = document.getElementById("txtAdjMsgEmail").value;
  //viId_Queue    =  document.getElementById("cbQueue").value;


  ajax=objetoAjax();
  pagina = "apps/anexos/datos/anexos.inserta.php";
  ajax.open("POST",pagina);
  
  ajax.onreadystatechange=function() {
          if (ajax.readyState==4) {
                  content.innerHTML = ajax.responseText;
          }
  }
  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  ajax.send("vUserName="          +vUserName+
            "&vNumber="            +vNumber+
            "&vName="             +vName+
            "&vType="             +vType+
            "&vHost="             +vHost+
            "&vContext="          +vContext+
            "&vSecret="           +vSecret+
            "&vCanreinvite="      +vCanreinvite+
            "&vQualify="          +vQualify+
            "&vNat="              +vNat+
            "&vCallLimit="        +vCallLimit+
            "&vDtmfMode="         +vDtmfMode+
            "&vCallGroup="        +vCallGroup+
            "&vPickupGroup="      +vPickupGroup+
            "&vUlaw="             +vUlaw+
            "&vAlaw="             +vAlaw+
            "&vGsm="              +vGsm+
            "&vG729="             +vG729+
            "&vG723="             +vG723+
            "&vActMailSi="        +vActMailSi+
            "&vActMailNo="        +vActMailNo+
            "&vActMailSecret="    +vActMailSecret+
            "&vAdjMsgSi="         +vAdjMsgSi+
            "&vAdjMsgNo="         +vAdjMsgNo+
            "&vAdjMsgEmail="      +vAdjMsgEmail/*+
            "&viId_Queue="         +viId_Queue*/);
}


/********************************************************************
Name      : registrarCampania
Input     : Ninguno
Outout    : 0
function  : Enviar los valores a un php para la insercion de datos
Author    : Carlos Alberto Sacaca Bernachea
*********************************************************************/
function registrarCampania(){
  vNameCampaign   = document.getElementById("txtNameCampaign").value;
  vNUmberPos      = document.getElementById("txtNUmberPositions").value;
  vShortDes       = document.getElementById("txtShortDescription").value;
  vQueue          = document.getElementById("cbQueue").value;

  ajax=objetoAjax();
  pagina = "apps/campanias/datos/campanias.inserta.php";
  ajax.open("POST",pagina)

  ajax.onreadystatechange=function() {
      if (ajax.readyState==4) {
              content.innerHTML = ajax.responseText;
      }
  }
  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  ajax.send("vNameCampaign="      +vNameCampaign+
            "&vNUmberPos="        +vNUmberPos+
            "&vShortDes="         +vShortDes+
            "&vQueue="            +vQueue);

}

function registrarCuenta(){    
    vUsuario   = document.getElementById("txtAccountUser").value;
    vClave     = document.getElementById("txtAccountPassword").value;  
    vCClave    = document.getElementById("txtConfirmPassword").value;
    vQueue     = document.getElementById("cbQueue").value;
  
  if(vUsuario != "" && vClave != "" && vCClave != "" && vQueue != 0){
    if (confirm("¿Seguro de registrar la nueva cuenta...?")) {
      ajax=objetoAjax();
      pagina = "apps/cuentas/datos/cuentas.inserta.php";
      ajax.open("POST",pagina)

      ajax.onreadystatechange=function() {
          if (ajax.readyState==4) {
                  content.innerHTML = ajax.responseText;
          }
      }
      ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      ajax.send("vUsuario="    +vUsuario+
                "&vClave="    +vClave+
                "&vCClave="    +vCClave+
                "&vQueue="   +vQueue);

      alert("Registro de cuenta exitosa..!!!");
      }
    }else{
      alert("Faltan argumentos...!!!");
    }
}



function modificaCuenta(id_user){    
    vUsuario   = document.getElementById("txtAccountUser").value;
    vClave     = document.getElementById("txtAccountPassword").value;  
    vCClave    = document.getElementById("txtConfirmPassword").value;
    vQueue     = document.getElementById("cbQueue").value;
  
  if(vUsuario != "" && vClave != "" && vCClave != "" && vQueue != 0){
    if (confirm("¿Seguro de modificar los datos...?")) {
      ajax=objetoAjax();
      pagina = "apps/cuentas/datos/cuentas.modifica.datos.php";
      ajax.open("POST",pagina)

      ajax.onreadystatechange=function() {
          if (ajax.readyState==4) {
                  content.innerHTML = ajax.responseText;
          }
      }
      ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      ajax.send("id_user="+id_user+
                "&vUsuario="    +vUsuario+
                "&vClave="    +vClave+
                "&vCClave="    +vCClave+
                "&vQueue="   +vQueue);

      alert("Los datos de modificaron correctamente..!!!");
      }
    }else{
      alert("Faltan argumentos...!!!");
    }
}



function modificaAgente(iid_agent){  
  vFirstName   = document.getElementById("txtFirstName").value;
  vLastName      = document.getElementById("txtLastName").value;  
  vIdentity       = document.getElementById("txtIdentity").value;
  cPhoneHome      = document.getElementById("txtPhoneHome").value;
  vPhoneMobie     = document.getElementById("txtPhoneMobie").value;
  vHome           = document.getElementById("txtHome").value;  
  vSexFem = document.getElementById("optSexoFem").checked;  
  vSexMas = document.getElementById("optSexoMas").checked;  
  vCanUser = document.getElementById("txtCanUser").value;  

  if(vSexMas == true){
      vSex = 1;      
  }else{
      vSex = 2;      
  }

  if (confirm("¿Seguro de modificar los datos...?")){
    checkboxes = document.getElementById("form1").checkbox;
    cont = 0;
    viIdUser = "";
      for (var x=0; x < vCanUser; x++) {
        //if (checkboxes[x].checked) {
        check = document.getElementById('chk'+x);
     
         if (check.checked) {
          cont = cont + 1;
          iiduser = document.getElementById('iduser'+x);          
     
          viIdUser +=iiduser.value+",";
        }
      }
      viIdUser = viIdUser.substring(0,viIdUser.length-1);
    
    ajax=objetoAjax();
    pagina = "apps/agente/datos/agente.modifica.datos.php";
    ajax.open("POST",pagina)

    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
                content.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    ajax.send("iid_agent="+iid_agent+
              "&vFirstName="    +vFirstName+
              "&vLastName="    +vLastName+
              "&vIdentity="    +vIdentity+
              "&cPhoneHome="   +cPhoneHome+
              "&vPhoneMobie="  +vPhoneMobie+
              "&vHome="        +vHome+            
              "&cPhoneHome="   +cPhoneHome+
              "&vSex="+vSex+
              "&viIdUser="+viIdUser);
    alert("Los datos de modificaron correctamente..!!!");
  }

}


function registrarAgente(){
  
  vFirstName   = document.getElementById("txtFirstName").value;
  vLastName      = document.getElementById("txtLastName").value;  
  vIdentity       = document.getElementById("txtIdentity").value;
  cPhoneHome      = document.getElementById("txtPhoneHome").value;
  vPhoneMobie     = document.getElementById("txtPhoneMobie").value;
  vHome           = document.getElementById("txtHome").value;

  vSexFem = document.getElementById("optSexoFem").checked;  
  vSexMas = document.getElementById("optSexoMas").checked;  
  vCanUser = document.getElementById("txtCanUser").value;  
  if(vSexMas == true){
      vSex = 1;      
  }else{
      vSex = 2;      
  }

if (confirm("¿Seguro de registrar al nuevo agente...?")) {

    checkboxes = document.getElementById("form1").checkbox;
    cont = 0;
    viIdUser = "";
      for (var x=0; x < vCanUser; x++) {        
        check = document.getElementById('chk'+x);
        
         if (check.checked) {
          cont = cont + 1;
          iiduser = document.getElementById('iduser'+x);          
          
          viIdUser +=iiduser.value+",";
        }
      }
      viIdUser = viIdUser.substring(0,viIdUser.length-1);
      



  ajax=objetoAjax();
  pagina = "apps/agente/datos/agente.inserta.php";
  ajax.open("POST",pagina)

  ajax.onreadystatechange=function() {
      if (ajax.readyState==4) {
              content.innerHTML = ajax.responseText;
      }
  }
  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  ajax.send("vFirstName="    +vFirstName+
            "&vLastName="    +vLastName+
            "&vIdentity="    +vIdentity+
            "&cPhoneHome="   +cPhoneHome+
            "&vPhoneMobie="  +vPhoneMobie+
            "&vHome="        +vHome+            
            "&cPhoneHome="   +cPhoneHome+
            "&vSex="+vSex+
            "&viIdUser="+viIdUser);
alert("Los datos de ingresaron correctamente..!!!");

  }

}


function registrarCola(){
  alert("Mensaje de prueba");
  vNameQueue            = document.getElementById("txtNameQueue").value;
  vMussicClassQueue     = document.getElementById("txtMussicClassQueue").value;  
  vAnnounceQueue        = document.getElementById("txtAnnounceQueue").value;
  vStrategy             = document.getElementById("cbStrategy").value;
  vTimeOutQueue         = document.getElementById("txtTimeOutQueue").value;
  vRetryQueue           = document.getElementById("txtRetryQueue").value;
  vJoinemptyQueue       = document.getElementById("txtJoinemptyQueue").value;
  vLeavewhenemptyQueue  = document.getElementById("txtLeavewhenemptyQueue").value;
  vWrapuptimeQueue      = document.getElementById("txtWrapuptimeQueue").value;
  vMaxLenQueue          = document.getElementById("txtMaxLenQueue").value;  


    /*alert("vFirstName => "+vFirstName+"\n"+
          "vLastName => "+vLastName+"\n"+
          "vIdentity => "+vIdentity+"\n"+
          "cPhoneHome => "+cPhoneHome+"\n"+
          "vPhoneMobie => "+vPhoneMobie+"\n"+
          "vHome => "+vHome+"\n"+
          "vCampaign => "+vCampaign+"\n"+
          "vAnnex => "+vAnnex+"\n"+
          "vUserAgent => "+vUserAgent+"\n"+
          "vPasswordAgent => "+vPasswordAgent+"\n"+
          "vSex => "+vSex+"\n")*/



  ajax=objetoAjax();
  pagina = "apps/colas/datos/colas.inserta.php";
  ajax.open("POST",pagina)

  ajax.onreadystatechange=function() {
      if (ajax.readyState==4) {
              content.innerHTML = ajax.responseText;
      }
  }
  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  ajax.send("vNameQueue="           +vNameQueue+
            "&vMussicClassQueue="   +vMussicClassQueue+
            "&vAnnounceQueue="      +vAnnounceQueue+
            "&vStrategy="           +vStrategy+
            "&vTimeOutQueue="       +vTimeOutQueue+
            "&vRetryQueue="         +vRetryQueue+
            "&vJoinemptyQueue="     +vJoinemptyQueue+
            "&vLeavewhenemptyQueue="+vLeavewhenemptyQueue+
            "&vWrapuptimeQueue="    +vWrapuptimeQueue+
            "&vMaxLenQueue="        +vMaxLenQueue);

}




function generateAccountSip(){
  rpta = confirm("Esta seguro de generar las cuentas Sip...?");
  if(rpta==true){
      ajax=objetoAjax();
      pagina = "apps/anexos/datos/anexos.genera.php";
      ajax.open("POST",pagina)

      ajax.onreadystatechange=function() {
          if (ajax.readyState==4) {
                  content.innerHTML = ajax.responseText;
          }
      }
      ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      ajax.send(null);
  }else{
  alert("La respuesta es NO");
  }
}


function mostrarmensaje(){
  var mensaje = $('#txtFecha').val();
  alert(mensaje);
}


function mostrarSubtabla(id){
  tr = document.getElementById(id);
	if(tr.style.display == "none"){
		tr.style.display = ""; 
	}else{
		tr.style.display = "none"; 	
	}  
}


function consultarEstPorHoras(){
  divResultado = document.getElementById("lista_estadistica");

    cola      = document.getElementById("cbCola").value;
    agente    = document.getElementById("cbAgente").value;
    vAnio   = document.getElementById("cbAnio").value;
    vMes     = document.getElementById("cbMes").value;  

    chkent = 0;    
    chksal = 0;

    if(document.getElementById('chkEnt').checked == true){
      chkent = 1
    }

    if(document.getElementById('chkSal').checked == true){
      chksal = 1;
    }

    vEstado     = document.getElementById("cbEstado").value;      

  
      ajax=objetoAjax();
      pagina = "apps/reportes/form/estadistica.horas.lista.php";
      ajax.open("POST",pagina)

      ajax.onreadystatechange=function() {
          if (ajax.readyState==4) {
                  divResultado.innerHTML = ajax.responseText;
          }
      }
      ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      ajax.send("cola="+cola+
                "&agente="+agente+
                "&anio="+vAnio+
                "&mes="    +vMes+
                "&chkent="+chkent+
                "&chksal="+chksal+
		            "&estado="  +vEstado);
}

function consultarReporte(prm_reporte,prm_id){
  //alert("Consultar reporte");

  divResultado = document.getElementById(prm_id);

  recarga = document.getElementById("recarga");

  /*cola      = document.getElementById("cbCola").value;
  agente    = document.getElementById("cbAgente").value;*/
  desde     = document.getElementById("txtFechaDesde").value;  
  hasta     = document.getElementById("txtFechaHasta").value;  
  tdesde    = document.getElementById("cbHoraDesde").value+':'+document.getElementById("cbMinDesde").value+":01";  
  thasta    = document.getElementById("cbHoraHasta").value+':'+document.getElementById("cbMinHasta").value+":59";  
  chkent    = 0;
  chksal    = 0;
  if(document.getElementById('chkEnt').checked == true){
      chkent = 1
    }

    if(document.getElementById('chkSal').checked == true){
      chksal = 1;
    }

//  estado    = document.getElementById("cbEstado").value;
  anexo    = document.getElementById("txtAnexo").value;
  numero    = document.getElementById("txtNumero").value;
  buscar="1";

/*  if(document.getElementById('optEspania').checked == true){
    pais="espania";
  }else if(document.getElementById('optPeru').checked == true){
    pais="peru";
  }
*/



/*
  if(document.getElementById('chkEnt').checked == true){
      chkent = 1
  }

  if(document.getElementById('chkSal').checked == true){
      chksal = 1;
  } 
  
*/

  ajax=objetoAjax();

  if(prm_reporte == 1){
    pagina = "apps/reportes/form/reporte.llamadas.agente.lista.php";    
  }else if(prm_reporte == 2){
    pagina = "apps/reportes/form/reporte.log.des.agente.lista.php";
  }else if(prm_reporte == 3){ 
    pagina = "apps/reportes/form/reporte.duracion.llamada.lista.php";
  }else if(prm_reporte == 4){
    pagina = "llamadas.grabadas.lista.php";
  }

  /*pagina = "apps/colas/datos/colas.inserta.php";*/
  ajax.open("POST",pagina)

  ajax.onreadystatechange=function() {

      if (ajax.readyState==4) {
            divResultado.innerHTML = ajax.responseText;

	 	if(ajax.status==200){

            recarga.innerHTML = "<div style='color:green;font-size: 110%' align='center'>..........Consulta Exitosa........</div>";
                }else{

 		alert('ppp');
 		}

      }

 }
 /* alert("desde="   +desde+
            "&hasta="   +hasta+
            "&tdesde="  +tdesde+
            "&thasta="  +thasta+
            "&chkent="  +chkent+
            "&chksal="  +chksal+
            "&estado="  +estado+
            "&anexo=" +anexo+
            "&numero="  +numero);*/
  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
 ajax.send("desde="   +desde+
            "&hasta="   +hasta+
            "&tdesde="  +tdesde+
            "&thasta="  +thasta+
			"&chkent=" +chkent+
			"&chksal=" +chksal+
            "&anexo=" +anexo+
            "&numero="  +numero+
            "&buscar=" +buscar);

            recarga.innerHTML = "<div style='color:red;font-size: 110%' align='center'>..........Cargando Consulta........</div>";
}








function downloadExcel(sql){

alert(sql);

  ajax=objetoAjax();

    pagina = "downloadExcel.php";    

  ajax.open("POST",pagina)
  ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  ajax.send("sql=" +sql);

}











function generaExcel(prm_reporte){
alert("Consultar reporte");
  
  agente    = document.getElementById("cbAgente").value;

  alert("El agente seleccionado es " + agente);

  desde     = document.getElementById("txtFechaDesde").value;  
  hasta     = document.getElementById("txtFechaHasta").value;  
  

  ajax=objetoAjax();

  if(prm_reporte == 1){
    pagina = "apps/reportes/form/reporte.llamadas.agente.lista.php";    
  }else if(prm_reporte == 2){
    pagina = "apps/reportes/form/reporte.log.des.agente.xls.php";
  }else if(prm_reporte == 3){ 
    pagina = "apps/reportes/form/reporte.duracion.llamada.xls.php";
  }else if(prm_reporte == 4){
    pagina = "apps/reportes/form/reporte.llamadas.grabadas.xls.php";
  }
  
  window.open(pagina+"?agente="+agente+
                      "&desde="+desde+
                      "&hasta="+hasta,"popup","height=300,width=400");
}


function generaExcelEst(){

  ajax=objetoAjax();

  pagina = "apps/reportes/form/estadistica.horas.xls.php";    

  window.open(pagina,"popup","height=300,width=400");
}


function muestraManual(){

  ajax=objetoAjax();

  pagina = "manual/Manual-de-Usuario.pdf";    

  window.open(pagina,"popup","height=700,width=900");
}

function elimina(page,id){
  if(confirm("Esta segudo de eliminar el registro...?")){
    ajax=objetoAjax();
    pagina = page;
    ajax.open("POST",pagina);

    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
                content.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("id="+id);     
    alert("Registro eliminado..."); 
  }
}

function eliminauser(page,id){
  if(confirm("Se eliminara el usuario seleccionado y las relaciones que con los agentes, Esta seguro de eliminar el registro...?")){
    ajax=objetoAjax();
    pagina = page;
    ajax.open("POST",pagina);

    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
                content.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("id="+id); 
    alert("Registro eliminado..."); 
  }
}

function aliminaagente(page,id){
  if(confirm("Se eliminara el agente seleccionado y las relaciones que con los usuarios, Esta seguro de eliminar el registro...?")){
    ajax=objetoAjax();
    pagina = page;
    ajax.open("POST",pagina);

    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
                content.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("id="+id); 
    
    alert("Registro eliminado..."); 
  }
}


function mostrarrr(page){
  //alert(page);
  cont=0;
total =   document.getElementById('totalgrab').value;
//alert(total);

 cadfile = "";
  for (var x=1; x < total; x++) {        
    check = document.getElementById('chk'+x);    
     if (check.checked) {
      //alert(check.checked);
      cont = cont + 1;
      file = document.getElementById('chk'+x);          
      cadfile +=file.value+",";
    }
  }

//alert(cadfile);
  cadfile = cadfile.substring(0,cadfile.length-1);
	
//alert(cadfile);

  content = "iddescarga";
  contenedor = document.getElementById('iddescarga');
  
  var contenedor;
  
  ajax=objetoAjax()
  ajax.open("POST", page,true);
  ajax.onreadystatechange=function() {
    if (ajax.readyState==4) {
      contenedor.innerHTML = ajax.responseText
    }
  }
  valor="dsdas";
   //ajax.send("valor="+valor);

   //alert(cadfile);
   ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("cadfile="+cadfile); 
}


function popup(url,fecha,pais,callsense,ancho,alto) {
pagina = "reproduction.php?rutaaudio="+url+"&fecha="+fecha+"&pais="+pais+"&callsense="+callsense;
/*alert(url);
alert(fecha);
alert(pais);
alert(callsense);
alert(ancho);
alert(alto);
alert(pagina);*/
  var posicion_x; 
  var posicion_y; 
  posicion_x=(screen.width/2)-(ancho/2); 
  posicion_y=(screen.height/2)-(alto/2); 
  window.open(pagina, "leonpurpura.com", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
}


function checktodos(){
total =   document.getElementById('totalgrab').value;
  check = document.getElementById('chk0');    
     if (check.checked) {
        for (var x=1; x < total; x++) {        
          check = document.getElementById('chk'+x);    
            check.checked = true;           
        }    
    }else{
      for (var x=1; x < total; x++) {        
          check = document.getElementById('chk'+x);    
            check.checked = false;           
        }          
    }
}

function descargagrabaciones(url,ancho,alto) {
  cadfile = "";
  for (var x=1; x < 8; x++) {        
    check = document.getElementById('chk'+x);    
     if (check.checked) {
      //alert(check.checked);
      cont = cont + 1;
      file = document.getElementById('chk'+x);          
      cadfile +=file.value+",";
    }
  }

  cadfile = cadfile.substring(0,cadfile.length-1);

  content = "iddescarga";
  cont = document.getElementById('iddescarga');     
  //alert(cadfile);

  ajax=objetoAjax();
    pagina = url;
    ajax.open("POST",pagina);

    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
                content.innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("cadfile="+cadfile); 

  /*cont = document.getElementById('content');   
  ajax=objetoAjax();   
  ajax.open("GET", page);
  ajax.onreadystatechange = function(){
     if (ajax.readyState == 4 && ajax.status == 200) {
      cont.innerHTML = ajax.responseText;
     }
  }
  ajax.send(null);*/
}


function descarga_audio(url, fecha, pais, callsense){
/*alert(url);
alert(fecha);
alert(pais);
alert(callsense);*/
  ajax=objetoAjax();
  ajax.open("GET", url);
  /*ajax.onreadystatechange = function(){
	   if (ajax.readyState == 4 && ajax.status == 200) {
	   	//cont.innerHTML = ajax.responseText;
	   }
  }
  	ajax.send(null);*/
//window.location.href = "http://192.168.99.21/OUT/000000000-77341965329335-16082012-065230.gsm";
window.location.href = "buscaaudio.php?ruta="+url+"&fecha="+fecha+"&pais="+pais+"&callsense="+callsense;
}
