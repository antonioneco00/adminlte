const $ = require("jquery");
const { Calendar } = require("fullcalendar");

$(window).on("load", function () {
    const myCalendar = document.querySelector("#calendar");
    const fullCalendar = new Calendar(myCalendar, {
        initialView: "timeGridWeek",
    });

    $.ajax({
        url: "http://localhost:8000/api/event-types",
        method: "GET",
        success: (data) => {
            loadEvents(data.data);
        },
    });

    function loadEvents(eventTypes) {
        $.ajax({
            url: "http://localhost:8000/api/xlsx-json",
            method: "GET",
            success: (data) => {
                data.map((event) => {
                    const foundEventType = eventTypes.find(
                        (eventType) => eventType.name === event.Tipo
                    );

                    fullCalendar.addEvent({
                        className: "btnEvent",
                        title: event.Titulo,
                        start: event.Inicio,
                        end: event.Fin,
                        backgroundColor: foundEventType
                            ? foundEventType.background_color
                            : "",
                        textColor: foundEventType
                            ? foundEventType.text_color
                            : "",
                        borderColor: foundEventType
                            ? foundEventType.border_color
                            : "",
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
    }

    $(document).on("click", ".btnEvent", function () {
        const title = $(this).find(".fc-event-title").html();
        const selectedEvent = fullCalendar
            .getEvents()
            .find((event) => event.title === title);

        const start = selectedEvent.start.toLocaleString("es-ES");
        const end = selectedEvent.end.toLocaleString("es-ES");
        const type = selectedEvent.extendedProps.type;

        $("#eventTitle").html(title);
        $("#eventStart").html(start);
        $("#eventEnd").html(end);
        $("#eventType").html(type);
    });

    $(document).on("click", ".fc-button", function () {
        $(".btnEvent").attr({
            "data-toggle": "modal",
            "data-target": "#eventModal",
        });
    });

    fullCalendar.render();
});
