$(document).ready(function()
    {
      $('#modo_oscuro').click(function(){ 
        $('body').toggleClass('modo-oscuro'); 
        $('p, h1').toggleClass('modo-oscuro');
        $('#titulo').toggleClass('modo-oscuro');
        $('table').toggleClass('modo-oscuro');
        $('thead').toggleClass('modo-oscuro');
        $('#modo_oscuro').toggleClass('modo-oscuro');
        $('.login-form').toggleClass('modo-oscuro');
        
      });
        // TxtPrecio es el txtCantidad, solo que me da paja cambiarle el nombre
      $("#txtCantidad").on("input", function() {
        var cantidad = $(this).val(); // Obtén la cantidad ingresada
        var precioUnitario = $("#txtPrecio").val(); // Puedes cambiar esto al precio unitario de tu producto
        var total = cantidad * precioUnitario; // Calcula el total
        $("#txtTotal").val(total); // Muestra el total en el campo de precio
    });

});

    	