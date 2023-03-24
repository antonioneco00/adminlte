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
                        <td>${data.name}</td>
                        <td>${data.background_color}</td>
                        <td>${data.text_color}</td>
                        <td>${data.border_color}</td>
                        <td><button data-toggle="modal" data-target="#deleteModal" class="showDeleteModal" data-id="${data.id}"><i class="fas fa-fw fa-solid fa-trash"></i></button></td>
                    </tr>
                `);
            },
        });
    }

    $(document).on("click", ".showDeleteModal", function () {
        const id = $(this).data("id");

        console.log("si");

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
