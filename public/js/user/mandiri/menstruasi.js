let calendar;

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");
    const isMobile = window.innerWidth < 768;

    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        height: isMobile ? "auto" : 600,
        headerToolbar: {
            left: "prev,next",
            center: "title",
            right: isMobile ? "" : "today",
        },
        aspectRatio: isMobile ? 0.8 : 1.35,
        selectable: false,
        events: [],
        dayHeaderFormat: { weekday: isMobile ? "narrow" : "short" },
    });
    calendar.render();
});

function generateCalendar() {
    const startDateInput = document.getElementById("start_date").value;
    const cycleLength = parseInt(document.getElementById("cycle_length").value);

    if (!startDateInput) {
        alert("Silakan pilih tanggal hari pertama menstruasi terakhir Anda.");
        return;
    }

    const start = new Date(startDateInput);

    const periodEnd = new Date(start);
    periodEnd.setDate(start.getDate() + 5);

    const fertileStart = new Date(start);
    fertileStart.setDate(start.getDate() + cycleLength - 16);

    const fertileEnd = new Date(start);
    fertileEnd.setDate(start.getDate() + cycleLength - 11);

    const nextPeriodStart = new Date(start);
    nextPeriodStart.setDate(start.getDate() + cycleLength);

    const nextPeriodEnd = new Date(nextPeriodStart);
    nextPeriodEnd.setDate(nextPeriodStart.getDate() + 5);

    const events = [
        {
            title: "Haid",
            start: start,
            end: periodEnd,
            color: "rgb(255, 72, 103)",
            display: "block",
        },
        {
            title: "Subur",
            start: fertileStart,
            end: fertileEnd,
            color: "rgb(16, 185, 129)",
            display: "block",
        },
        {
            title: "Haid (Prediksi)",
            start: nextPeriodStart,
            end: nextPeriodEnd,
            color: "rgb(239, 108, 0)",
            display: "block",
        },
    ];

    calendar.removeAllEvents();
    calendar.addEventSource(events);
    calendar.gotoDate(start);

    const wrapper = document.getElementById("calendar-wrapper");
    wrapper.classList.add("show");

    setTimeout(() => {
        wrapper.scrollIntoView({ behavior: "smooth", block: "start" });
    }, 100);
}
