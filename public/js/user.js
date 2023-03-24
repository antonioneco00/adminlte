$(window).on("load", function () {
    $("#save-user").on("click", () => {
        saveUser();
    });

    $(document).on("click", '.showDeleteModal', function () {
        const id = $(this).data("id");

        $(".deleteBtn").attr("data-id", id);
    });

    $(".deleteBtn").on("click", function () {
        const id = $(this).data("id");

        $.ajax({
            url: `http://localhost:8000/api/users/${id}`,
            method: "DELETE",
            complete: function() {
                $(`#user--${id}`).remove();
            },
        });
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
                        <td>${data.name}</td>
                        <td>${data.email}</td>
                        <td><button data-toggle="modal" data-target="#deleteModal" class="showDeleteModal" data-id="${data.id}"><i class="fas fa-fw fa-solid fa-trash"></i></button></td>
                    </tr>
                `);
            },
        });
    }
});
