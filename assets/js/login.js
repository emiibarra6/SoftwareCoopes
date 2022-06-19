$(document).ready(function () {
  $("#login").validate({
    rules: {
      usuario: { required: true, number: true, rangelength: [7, 10], },
      pass: { required: true, },
    },
    errorClass: "mensajeerrorfondoazul",
    errorElement: "span",
  });

  $("#cambiopassForm").validate({
    rules: {
      pass: {
        required: true,
        maxlength: 250,
      },
      passconfirmar: {
        required: true,
        equalTo: "#pass"
      }
    },
    errorClass: "mensajeerrorfondoazul",
    errorElement: "span",
    highlight: function (element, errorClass, validClass) {
      $(element).parents('.form-control').addClass('has-error');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).parents('.form-control').removeClass('has-error');
      $(element).parents('.form-control').addClass('has-success');
    },
    submitHandler: function (form, e) {
      e.preventDefault();
      var parametros = $('#cambiopassForm').serialize();
      $.ajax({
        type: "POST",
        url: base_url + "C_usuarios/cambiopass/" + $('#usuario').val(),
        data: parametros
        //beforeSend: gifCargaModPassUsuario()
      })
        .done(function (datos) {
          //gifCargaModPassUsuarioOff();
          $('#mensajesOkAcciones').css("display", 'block');
          setTimeout(function () {
            $("#mensajesOkAcciones").fadeOut(5000);
            $(location).attr('href', base_url + 'iniciorrhh')
          }, 1500);
          /*
          setTimeout(function() {
            location.reload(true);
          },6000);
          */
        })
        .fail(function (datos) {
          //gifCargaModPassUsuarioOff();
          $('#mensajesErroresAcciones').css("display", 'block');
          setTimeout(function () {
            $("#mensajesErroresAcciones").fadeOut(5000);
          }, 500);
        });

      return false;
    }
  });
})