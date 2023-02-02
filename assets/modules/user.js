window.addEventListener("load", function () {

    $(document).on("click", ".btnUpdateUser", function () {
        // --- Validaciones
        $("input[name='user-id']").val($(this)[0].dataset.idUser);
    });


    $(document).on("click", ".btnEditUser", function () {
        try {

            // --- Validaciones
            const frmUser = $("#frmUser").serialize();

            $.ajax({
                url: "controller/",
                method: "POST",
                data: frmUser + "&actionController=updateUser",
                dataType: "JSON",
                success: function (data) {

                    try {

                        if (data.estado == "warnign") {
                            throw data.mensaje;
                        }

                        if (data.estado == "success") {
                            $("#modalEditUser").modal("hide");
                            $("select[name='role'] option")[0].selected = true;
                            $("select[name='status'] option")[0].selected = true;
                            throw data.mensaje;
                        }

                    } catch (error) {
                        alert(error);
                        updateTableUsers()
                    }

                }
            });

        } catch (error) {

        }
    });

    $(document).on("click", ".btnEliminarUser", function () {
        $("input[name='user-id']").val($(this)[0].dataset.idUser);
        $("#deleteUser").modal("show");
    });

    $(document).on("click", ".btnDeleteUser", function () {

        try {

            // --- Validaciones
            const idUser = $("input[name='user-id']").val();

            $.ajax({
                url: "controller/",
                method: "POST",
                data: { idUser: idUser, actionController: "deleteUser" },
                dataType: "JSON",
                success: function (data) {

                    try {

                        $("#deleteUser").modal("hide");

                        if (data.estado == "warnign") {
                            throw data.mensaje;
                        }

                        if (data.estado == "success") {
                            throw data.mensaje;
                        }

                    } catch (error) {
                        alert(error);
                        updateTableUsers();
                    }
                }
            });

        } catch (error) {
            alert(error);
        }

    });

    $(document).on("click", ".btnUpdateTable", function () {
        updateTableUsers();
    });

    function updateTableUsers() {

        $.ajax({
            url: "controller/",
            method: "POST",
            data: { actionController: "updateTableUsers", update: true },
            success: function (data) {
                $(".containerTableUsers").empty().html(data);
            }
        });

    }

});