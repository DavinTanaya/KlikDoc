@extends('layout')

@section('title', 'KlikDoc | Pelacak Menstruasi')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.css">
    <style>
        /* Tinggi kalender agar memenuhi 1 layar */
        #calendar {
            height: 650px;
            border-radius: 15px;
            background: white;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
@endpush

@section('body')
    <main class="bmi py-5">
        <div class="bmi_container container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="bmi_information mb-4">
                        <h1 class="mb-3">Pelacak Menstruasi</h1>
                        <p>
                            Masukkan tanggal hari pertama menstruasi terakhir dan panjang siklus rata-rata.
                            Sistem akan menghitung dan menampilkannya langsung pada kalender di sebelah kanan.
                        </p>
                    </div>

                    <div class="bmi_form">
                        <h4 class="mb-4">Input Siklus Kamu</h4>

                        <form onsubmit="event.preventDefault(); generateCalendar();">
                            <div class="mb-3">
                                <label class="bmi_input-label form-label small text-muted">
                                    Tanggal Hari Pertama Menstruasi
                                </label>
                                <input type="date" class="form-control" id="start_date">
                            </div>

                            <div class="mb-4">
                                <label class="bmi_input-label form-label small text-muted">
                                    Panjang Siklus (hari)
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="cycle_length" value="28"
                                        min="21" max="40">
                                    <span class="input-group-text text-muted">hari</span>
                                </div>
                            </div>

                            <button class="bmi_submit-button btn btn-primary w-100">Lihat di Kalender</button>
                        </form>
                    </div>
                </div>

                <!-- ================================ -->
                <!-- KALENDER (FULL WIDTH COL)        -->
                <!-- ================================ -->
                <div class="col-lg-6">
                    <div id="calendar"></div>
                </div>

            </div>
        </div>
    </main>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>

    <script>
        let calendar;

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: '100%',
                selectable: false,
                events: []
            });
            calendar.render();
        });

        function generateCalendar() {
            const startDate = document.getElementById('start_date').value;
            const cycle = parseInt(document.getElementById('cycle_length').value);

            if (!startDate) {
                alert('Masukkan tanggal mulai menstruasi');
                return;
            }

            const start = new Date(startDate);

            // Kalkulasi menstruasi berikutnya
            const nextPeriod = new Date(start);
            nextPeriod.setDate(start.getDate() + cycle);

            // Masa subur
            const fertileStart = new Date(start);
            fertileStart.setDate(start.getDate() + cycle - 16);

            const fertileEnd = new Date(start);
            fertileEnd.setDate(start.getDate() + cycle - 12);

            // Event kalender
            const events = [{
                    title: 'Menstruasi Dimulai',
                    start: start,
                    end: new Date(start.getTime() + 4 * 24 * 60 * 60 * 1000),
                    color: '#ff6b81' // merah lembut
                },
                {
                    title: 'Masa Subur',
                    start: fertileStart,
                    end: fertileEnd,
                    color: '#7bed9f' // hijau lembut
                },
                {
                    title: 'Prediksi Menstruasi Berikutnya',
                    start: nextPeriod,
                    end: new Date(nextPeriod.getTime() + 4 * 24 * 60 * 60 * 1000),
                    color: '#ffa502' // kuning oranye
                }
            ];

            calendar.removeAllEvents();
            calendar.addEventSource(events);
            calendar.gotoDate(start); // pindahkan kalender ke bulan tersebut
        }
    </script>
@endpush
