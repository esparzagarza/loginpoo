window.addEventListener("load", function () {

    $(document).on("click", ".btnRegister", function () {

        try {

            // --- Validaciones

            const frmRegister = $("#frmRegister").serialize();

            $.ajax({
                url: "controller/",
                method: "POST",
                data: frmRegister + "&actionController=registerUser",
                success: function (data) {
                    $(".contenedor-alert").empty().html(data);
                }
            });

        } catch (error) {
            alert(error);
        }

    });
    
});