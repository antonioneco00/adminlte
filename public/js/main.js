const $ = require("jquery");
const { Calendar } = require("fullcalendar");

$(window).on("load", function () {
    const myCalendar = document.querySelector("#calendar");
    const fullCalendar = new Calendar(myCalendar, {
        events: [
            {
                title: "Si",
                start: "2023-03-23 18:00",
            },
        ],
        initialView: "timeGridDay",
    });

    fullCalendar.render();
});
