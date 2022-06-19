document.addEventListener ("keydown", function (e) {
    if (e.altKey  &&  e.which === 65) {
        $('#exampleModal').modal('show')
    }

    if(e.altKey  &&  e.which === 67) {
        $('#tipofactura').text('Cuenta Corriente');
    }

    if(e.altKey  &&  e.which === 66) {
        $('#tipofactura').text('Consumidor Final');
    }
});

$(document).ready(function(){
    if ($("div#flashdata")) {
      setInterval(function(){ $("div#flashdata").hide("slow"); }, 5000);
    }
  });

