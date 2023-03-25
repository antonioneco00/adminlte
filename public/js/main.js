const $ = require("jquery");
const { Calendar } = require("fullcalendar");

$(window).on("load", function () {
    const myCalendar = document.querySelector("#calendar");
    const fullCalendar = new Calendar(myCalendar, {
        initialView: "timeGridWeek",
    });

    $.ajax({
        url: "http://localhost:8000/api/xlsx-json",
        success: (data) => {
            data.map((event) => {
                fullCalendar.addEvent({
                    className: "btnEvent",
                    title: event.Titulo,
                    start: event.Inicio,
                    end: event.Fin,
                    extendedProps: {
                        type: event.Tipo,
                    },
                });
            });

            $(".btnEvent").attr({
                "data-toggle": "modal",
                "data-target": "#eventModal",
            });
        },
    });

    $(document).on("click", ".btnEvent", function () {
        const title = $(this).find(".fc-event-title").html();
        const selectedEvent = fullCalendar
            .getEvents()
            .find((event) => event.title === title);

        const start = selectedEvent.start;
        const end = selectedEvent.end;
        const type = selectedEvent.extendedProps.type;

        $('#eventTitle').html(title)
        $('#eventStart').html(start)
        $('#eventEnd').html(end)
        $('#eventType').html(type)
    });

    fullCalendar.render();
});
