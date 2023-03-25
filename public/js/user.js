$(window).on("load", function () {
    $("#save-user").on("click", () => {
        saveUser();
    });

    function saveUser() {
        const name = $("#nombre").val();
        const email = $("#email").val();
        const password = $("#password").val();

        $.ajax({
            url: "http://localhost:8000/api/users",
            method: "POST",
            data: {
                name,
                email,
                password,
            },
            complete: (res) => {
                const data = res.responseJSON.data;

                $("#usersTable").append(`
                    <tr id="user--${data.id}">
                        <td>${data.id}</td>
                        <td id="username--${data.id}">${data.name}</td>
                        <td id="email--${data.id}">${data.email}</td>
                        <td><button data-toggle="modal" data-target="#editModal" class="showEditModal" data-id="${data.id}"><i class="fas fa-fw fa-solid fa-edit"></i></button><button data-toggle="modal" data-target="#deleteModal" class="showDeleteModal" data-id="${data.id}"><i class="fas fa-fw fa-solid fa-trash"></i></button></td>
                        </tr>
                        `);
            },
        });
    }

    $(document).on("click", ".showEditModal", function () {
        const id = $(this).data("id");

        const currentName = $(`#username--${id}`).html();
        const currentEmail = $(`#email--${id}`).html();

        $("#edit-nombre").val(currentName);
        $("#edit-email").val(currentEmail);

        $(".editBtn").attr("data-id", id);
    });

    $(".editBtn").on("click", function () {
        const id = $(this).data("id");
        const name = $("#edit-nombre").val();
        const email = $("#edit-email").val();
        const password = $("#edit-password").val();

        $.ajax({
            url: "http://localhost:8000/api/users",
            method: "PUT",
            data: {
                id,
                name,
                email,
                password,
            },
            complete: function () {
                $(`#username--${id}`).html(name);
                $(`#email--${id}`).html(email);
            },
        });
    });

    $(document).on("click", ".showDeleteModal", function () {
        const id = $(this).data("id");

        $(".deleteBtn").attr("data-id", id);
    });

    $(".deleteBtn").on("click", function () {
        const id = $(this).data("id");

        $.ajax({
            url: `http://localhost:8000/api/users/${id}`,
            method: "DELETE",
            complete: function () {
                $(`#user--${id}`).remove();
            },
        });
    });
});
