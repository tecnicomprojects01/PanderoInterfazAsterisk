var xmlhttp = false ;

if (!xmlhttp && typeof XMLHttpRequest != 'undefined'){
  try {
	xmlhttp = new XMLHttpRequest ();
  }
  catch (e) {
	xmlhttp = false}
}

function myXMLHttpRequest (){
  var xmlhttplocal;
  try {
  	xmlhttplocal = new ActiveXObject ("Msxml2.XMLHTTP")}
  catch (e) {
	try {
	xmlhttplocal = new ActiveXObject ("Microsoft.XMLHTTP")}
	catch (E) {
	  xmlhttplocal = false;
	}
  }

  if (!xmlhttplocal && typeof XMLHttpRequest != 'undefined') {
	try {
	  var xmlhttplocal = new XMLHttpRequest ();
	}
	catch (e) {
	  var xmlhttplocal = false;
	}
  }
  return (xmlhttplocal);
}

var mnmxmlhttp = Array ();
var mnmString = Array ();
var mnmPrevColor = Array ();
var responsestring = Array ();
var myxmlhttp = Array ();
var responseString = new String;

var i=0;
var ii = 0;

function ajax_update(url){
	//url = "ajax_php.php";
	url = "monitor_db.php";
	target2 = document.getElementById ('content');
	
	ii = i++;

	var content = "i=" + ii ;

	mnmxmlhttp = new myXMLHttpRequest ();
	if (mnmxmlhttp) {
			mnmxmlhttp.open ("POST", url, true);
			mnmxmlhttp.setRequestHeader ('Content-Type',
					   'application/x-www-form-urlencoded');

			mnmxmlhttp.send (content);
			errormatch = new RegExp ("^ERROR:");

			target2 = document.getElementById ('content');

			mnmxmlhttp.onreadystatechange = function () {
				if (mnmxmlhttp.readyState == 4) {
					mnmString = mnmxmlhttp.responseText;
			
					if (mnmString.match (errormatch)) {
						mnmString = mnmString.substring (6, mnmString.length);
						
						target = document.getElementById ('content');
						target2.innerHTML = mnmString;
						
					} else {
						target = document.getElementById ('content');
						target2.innerHTML = mnmString;

					}
				}
			}
		}
	setTimeout('ajax_update()', 1000);
}