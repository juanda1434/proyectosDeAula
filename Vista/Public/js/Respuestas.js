
function respuestaExitoRecargar(titulo,mensaje){
    
    swal({
        title:titulo,
        text:mensaje,
        icon:"success"
        
    }).then(function (value){
        window.location.reload();
    });
    
    
    
}

function respuestaExito(mensaje){
    swal({
        text:mensaje,
        icon:"success"
        
    })
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

function respuestaPeligro(mensaje){
        swal({
        text:mensaje,
        icon:"warning"
    }); 
    }