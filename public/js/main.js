const $ = require("jquery");
const Calendar = require("fullcalendar");

$(window).on("load", function () {
    const myCalendar = document.querySelector("#calendar");
    const fullCalendar = new Calendar.Calendar(myCalendar, {
        initialView: "dayGridMonth",
    });

    fullCalendar.render();
});
