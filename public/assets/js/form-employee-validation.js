// npm package: jquery-validation
// github link: https://github.com/jquery-validation/jquery-validation
$(function() {
  'use strict';

  $.validator.setDefaults({
    submitHandler: function() {
      ("#form-employee").submit();
    }
  });
  $(function() {
    // validate signup form on keyup and submit
    $("#form-employee").validate({
      rules: {
        document_number: {
          required: true,
          digits: true,
          minlength: 8,
          maxlength: 11,
        },
        last_name: {
          required: true,
          minlength: 3
        },
        name: {
          required: true,
          minlength: 3
        },
        email: {
          required: true,
          email: true
        },
        gender_radio: {
          required: true
        },
        birth_date: {
          required: true
        },
        phone: {
          digits: true
        },
      },
      messages: {
        document_number: {
          required: "Ingresa el n° de documento",
          minlength: "N° de documento debe tener 8 caracteres."
        },
        last_name: {
          required: "Ingresa el apellido paterno",
          minlength: "Apellido paterno debe tener al menos 3 caracteres."
        },
        name: {
          required: "Ingresa los nombres",
          minlength: "Nombres debe tener al menos 3 caracteres."
        },
        email: "Ingrese una dirección de correo electrónico válida",
        gender_radio: "Selecciona tu género",
        birth_date: "Selecciona fecha de nacimiento",
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