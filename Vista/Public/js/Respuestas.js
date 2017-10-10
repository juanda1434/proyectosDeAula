
function respuestaExito(titulo,mensaje){
    
    swal({
        title:titulo,
        text:mensaje,
        icon:"success"
        
    }).then(function (value){
        window.location.reload();
    });
    
    
    
}


function respuestaError(titulo,mensaje){
    swal({
        title:titulo,
        text:mensaje,
        icon:"error"
    });
}

function respuestaInfoEspera(mensaje){
    swal({
        text:mensaje,
        buttons:false,
        closeOnClickOutside:false,
        closeOnEsc: false,
        icon:"info"
    });
}