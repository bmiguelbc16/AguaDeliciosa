// npm package: jquery-validation
// github link: https://github.com/jquery-validation/jquery-validation
$(function() {
  'use strict';

  $.validator.setDefaults({
    submitHandler: function() {
      ("#form-client").submit();
    }
  });
  $(function() {
    // validate signup form on keyup and submit
    $("#form-client").validate({
      rules: {
        document_number: {
          required: true,
          digits: true,
          minlength: 8,
          maxlength: 8
        },
        last_name_father: {
          required: true,
          minlength: 3
        },
        last_name_mother: {
          required: true,
          minlength: 3
        },
        first_name: {
          required: true,
          minlength: 3
        },
        email: {
          required: true,
          email: true
        },
        gender: {
          required: true
        },
        birth_date: {
          required: true
        },
        phone: {
          required: false,
          digits: true
        },
        ruc: {
          required: true,
          minlength: 11,
          maxlength: 11
        },
        company_name: {
          required: true
        },
        social_name: {
          required: true
        },
        ubigeo_code: {
          required: true
        },
        representative: {
          required: true
        },
        representative_position: {
          required: true
        },
      },
      messages: {
        document_number: {
          required: "Ingresa el n° de documento",
          minlength: "N° de documento debe tener 8 caracteres.",
          maxlength: "N° de documento no debe tener más de 8 caracteres.",
        },
        last_name_father: {
          required: "Ingresa el apellido paterno",
          minlength: "Apellido paterno debe tener al menos 3 caracteres."
        },
        last_name_mother: {
          required: "Ingresa el apellido materno",
          minlength: "Apellido materno debe tener al menos 3 caracteres."
        },
        first_name: {
          required: "Ingresa los nombres",
          minlength: "Nombres debe tener al menos 3 caracteres."
        },
        ruc: {
          required: "Ingresa el RUC",
          minlength: "El RUC debe tener 11 caracteres.",
          maxlength: "El RUC no debe tener más de 11 caracteres.",
        },
        email: "Ingrese una dirección de correo electrónico válida",
        gender: "Selecciona tu género",
        birth_date: "Selecciona fecha de nacimiento",
        company_name: "Ingrese la Razon social",
        social_name: "Ingrese el Nombre de Negocio",
        ubigeo_code: "Ingrese el ubigeo",
        representative: "Ingrese el Representante",
        representative_position: "Ingrese el Cargo",
        phone: {
          digits: "Ingrese solo números",
        },
      },
      errorPlacement: function(error, element) {
        error.addClass( "invalid-feedback" );

        if (element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        }
        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
          error.insertAfter(element.parent().parent());
        }
        else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
          error.appendTo(element.parent().parent());
        }
        else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass) {
        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
          $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        }
      },
      unhighlight: function(element, errorClass) {
        if ($(element).prop('type') != 'checkbox' && $(element).prop('type') != 'radio') {
          $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        }
      }
    });
  });
});