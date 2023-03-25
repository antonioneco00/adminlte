$(window).on("load", function () {
    $("#save-event-type").on("click", () => {
        saveEventType();
    });

    function saveEventType() {
        const name = $("#nombre").val();
        const background_color = $("#background_color").val();
        const text_color = $("#text_color").val();
        const border_color = $("#border_color").val();

        $.ajax({
            url: "http://localhost:8000/api/event-types",
            method: "POST",
            data: {
                name,
                background_color,
                text_color,
                border_color,
            },
            complete: (res) => {
                const data = res.responseJSON.data;

                $("#eventTypesTable").append(`
                    <tr id="eventType--${data.id}">
                        <td>${data.id}</td>
                        <td id="name--${data.id}">${data.name}</td>
                        <td id="background_color--${data.id}"><i class="fa fa-fw fa-square"
                        style="color: ${data.background_color}"></i>${data.background_color}</td>
                        <td id="text_color--${data.id}"><i class="fa fa-fw fa-square"
                        style="color: ${data.text_color}"></i>${data.text_color}</td>
                        <td id="border_color--${data.id}"><i class="fa fa-fw fa-square"
                        style="color: ${data.border_color}"></i>${data.border_color}</td>
                        <td><button data-toggle="modal" data-target="#editModal" class="showEditModal" data-id="${data.id}"><i class="fas fa-fw fa-solid fa-edit"></i></button><button data-toggle="modal" data-target="#deleteModal" class="showDeleteModal" data-id="${data.id}"><i class="fas fa-fw fa-solid fa-trash"></i></button></td>
                    </tr>
                `);
            },
        });
    }

    $(document).on("click", ".showEditModal", function () {
        const id = $(this).data("id");

        const currentName = $(`#name--${id}`).html();
        const currentBackgroundColor = $(`#background_color--${id} span`).html();
        const currentTextColor = $(`#text_color--${id} span`).html();
        const currentBorderColor = $(`#border_color--${id} span`).html();

        $("#edit-nombre").val(currentName);
        $("#edit-background_color").val(currentBackgroundColor);
        $("#edit-text_color").val(currentTextColor);
        $("#edit-border_color").val(currentBorderColor);

        $(".editBtn").attr("data-id", id);
    });

    $(".editBtn").on("click", function () {
        const id = $(this).data("id");
        const name = $("#edit-nombre").val();
        const background_color = $("#edit-background_color").val();
        const text_color = $("#edit-text_color").val();
        const border_color = $("#edit-border_color").val();

        $.ajax({
            url: "http://localhost:8000/api/event-types",
            method: "PUT",
            data: {
                id,
                name,
                background_color,
                text_color,
                border_color,
            },
            complete: function () {
                $(`#name--${id}`).html(name);
                $(`#background_color--${id}`).html(`<i class="fa fa-fw fa-square"
                style="color: ${background_color}"></i><span>${background_color}`);
                $(`#text_color--${id}`).html(`<i class="fa fa-fw fa-square"
                style="color: ${text_color}"></i><span>${text_color}`);
                $(`#border_color--${id}`).html(`<i class="fa fa-fw fa-square"
                style="color: ${border_color}"></i><span>${border_color}`);
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
            url: `http://localhost:8000/api/event-types/${id}`,
            method: "DELETE",
            complete: function () {
                $(`#eventType--${id}`).remove();
            },
        });
    });
});
