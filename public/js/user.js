$(window).on("load", function () {
    $("#save-user").on("click", () => {
        saveUser();
    });

    $(".showDeleteModal").on("click", function () {
        const id = $(this).data("id");

        $(".deleteBtn").attr("data-id", id);
    });

    $(".deleteBtn").on("click", function () {
        const id = $(this).data('id');

        $.ajax({
            url: `http://localhost:8000/api/users/${id}`,
            method: "DELETE",
            complete: () => console.log("si"),
        });
    });

    function saveUser() {
        const name = $("#nombre").val();
        const email = $("#email").val();
        const password = $("#password").val();

        console.log(name);
        console.log(email);
        console.log(password);

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
                    <tr>
                        <td>${data.id}</td>
                        <td>${data.name}</td>
                        <td>${data.email}</td>
                    </tr>
                `);
            },
        });
    }
});
