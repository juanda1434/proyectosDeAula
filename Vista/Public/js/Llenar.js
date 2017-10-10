


function llenarSelect(){
    var url = window.location.pathname;
    if (url.indexOf("Registro")!=-1) {
        llenarProgramas(); 
    }
}

function llenarTabla(){
    var url = window.location.pathname;
    if (url.indexOf("Perfil")!=-1) {
        llenarPerfil();
    }
}

function llenarProgramas(){
    
    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?programasAcademicos=true",
                method: 'GET',   
                dataType: 'json',
                success: function (respuesta)
                {                   
                    if (respuesta instanceof Object) {
                        var opciones="";
                        for (var i = 0; i < respuesta.length; i++) {
                            var programa=respuesta[i];
                            opciones+='<option  value="'+programa["nombre"]+'">'+programa["nombre"]+'</option>' ;
                            
                        }
                        var inicio='<label class="control-label col-md-2" for="programa"E>Programa academico</label>\n\
<div class="col-md-6">\n\
<select name="programaE" class="form-control" id="programaE">\n\
<option  value="">Programas academicos</option>';
                        var fin='</select><label id="error-programaE"></label></div>';
                        $(".programas").html(inicio+opciones+fin);
                    }

                }
            });
}

$(document).ready(function (){
   llenarSelect(); 
   llenarTabla();
});

function llenarPerfil(){
    $.ajax(
            {
                url: "Vista/Modulos/Ajax.php?datosPerfil=true",
                method: 'GET',   
                dataType:'json',
                success: function (respuesta)
                {                   
                    console.log(respuesta);
                    if (respuesta instanceof Object) {
                        var fila="";                        
                        for (var key in respuesta) {
                           fila+="<tr><th>"+key+"</th><td>"+respuesta[key]+"</td></tr>";
                        }
                        
                        $("#datosPerfil").html(fila);
                    }

                }
            });
}