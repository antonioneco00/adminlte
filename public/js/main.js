const $ = require("jquery");
const { Calendar } = require("fullcalendar");

$(window).on("load", function () {
    const myCalendar = document.querySelector("#calendar");
    const fullCalendar = new Calendar(myCalendar, {
        initialView: "timeGridWeek",
    });

    $.ajax({
        url: "http://localhost:8000/api/xlsx-json",
        success: (data) =>
            data.map((event) => {
                fullCalendar.addEvent({
                    title: event.Titulo,
                    start: event.Inicio,
                    end: event.Fin,
                });
            }),
    });

    fullCalendar.render();
});
