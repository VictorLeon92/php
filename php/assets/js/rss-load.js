/* Cargar RSS */
function cargarRss(){
	var objHttp=null;
	if(window.XMLHttpRequest) {
		objHttp = new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		objHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	objHttp.open("GET", "http://localhost/php/assets/xml/rss.xml", true);
	objHttp.onreadystatechange = function() {
		if (objHttp.readyState==4) {							
			var documento = objHttp.responseXML; 
			var noticias = documento.documentElement;
			var cadena = "";

			
			nombre = documento.getElementsByTagName('item');
			
			for (i = 0;i < nombre.length; i++){ 			
				cadena = cadena + "<div class='titulo-rss'>" + noticias.getElementsByTagName("item")[i].childNodes[1].firstChild.nodeValue + "</div><br/>";	
				cadena = cadena + "<div class='cuerpo-rss'>" + noticias.getElementsByTagName("item")[i].childNodes[3].firstChild.nodeValue + "</div><br/>";
				cadena = cadena + "<a class='enlace-rss' href='" + noticias.getElementsByTagName("item")[i].childNodes[5].firstChild.nodeValue + "' target='_blank'>Leer el artículo completo</a><br/><br/>";
				console.log(noticias.getElementsByTagName("item")[i].childNodes[4]);
			}
			document.getElementById("rss").innerHTML = cadena;
			} 
	}
	objHttp.send(null);
}

$(document).ready(function(){
	
	cargarRss();
});