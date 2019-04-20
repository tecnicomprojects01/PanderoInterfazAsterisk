function Verifica(f){
if(frmReg.nombre.value == ''){
alert('Introduzca Nombre de Usuario')
frmReg.nombre.focus()
return false
}

if(frmReg.clave.value == ''){
alert('Introduzca Clave')
frmReg.clave.focus()
return false
}
if (! (document.forms [0].Condiciones [0].checked || document.forms [0].Condiciones [1].checked ) ) {
alert ('Especifique las condiciones del mobiliario')
return false;
}
frmReg.submit()
}
