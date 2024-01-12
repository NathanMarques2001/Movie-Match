$().ready(function () {
  $('#login-form').validate({
    rules: {
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 3
      }
    },
    messages: {
      email: {
        required: "Por favor, entre com seu email.",
        email: "Por favor, entre com um email válido."
      },
      password: {
        required: "Por favor, entre com sua senha.",
        minlength: "A senha deve ter no mínimo 3 caracteres."
      }
    },
    errorPlacement: function (error, element) {
      error.addClass("text-danger");
      error.insertAfter(element.parent());
    }
  })
});