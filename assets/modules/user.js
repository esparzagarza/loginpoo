window.addEventListener("load", function () {

    $(document).on("click", ".btnEditUser", function () {

        try {

            // --- Validaciones

            const frmLogin = $("#ControllerLogin").serialize();

            $.ajax({
                url: "controller/",
                method: "POST",
                data: frmLogin + "&actionController=login",
                success: function (data) {
                    $(".contenedor-alert").empty().html(data);
                }
            });

        } catch (error) {
            alert(error);
        }

    });

    $(document).on("click", ".btnEliminarUser", function () {

        try {

            // --- Validaciones

            const frmChangePassword = $("#frmChangePassword").serialize();

            $.ajax({
                url: "controller/",
                method: "POST",
                data: frmChangePassword + "&actionController=changePassword",
                success: function (data) {
                    $(".contenedor-alert").empty().html(data);
                }
            });

        } catch (error) {
            alert(error);
        }

    });

});