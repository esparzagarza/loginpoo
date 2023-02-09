window.addEventListener("load", function () {

    $(document).on("click", ".btnLogin", function () {

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

    $(document).on("click", ".btnChangePassword", function () {

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

    $(document).on("click", ".btnResetPassword", function () {

        try {

            // --- Validaciones

            const frmForgetPassword = $("#frmForgetPassword").serialize();

            $.ajax({
                url: "controller/",
                method: "POST",
                data: frmForgetPassword + "&actionController=resetPassword",
                success: function (data) {
                    $(".contenedor-alert").empty().html(data);
                }
            });

        } catch (error) {
            alert(error);
        }

    });

    $(document).on("click", ".btnChangeResetPassword", function () {

        try {

            // --- Validaciones
            
            const frmChangePassword = $("#frmChangePassword").serialize();

            $.ajax({
                url: "controller/",
                method: "POST",
                data: frmChangePassword + "&actionController=changeResetPassword",
                success: function (data) {
                    $(".contenedor-alert").empty().html(data);
                }
            });

        } catch (error) {
            alert(error);
        }

    });

});