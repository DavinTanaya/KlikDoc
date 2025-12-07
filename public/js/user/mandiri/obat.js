document.addEventListener('DOMContentLoaded', function() {
    loadReminders();
});

async function addReminder() {
    const payload = {
        medicine_name: document.getElementById("med_name").value,
        frequency: document.getElementById("med_freq").value,
        start_time: document.getElementById("med_time").value,
        note: document.getElementById("med_note").value,
    };

    await fetch("/mandiri/obat", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]').content,
            "Content-Type": "application/json",
        },
        body: JSON.stringify(payload),
    });

    alert("Pengingat obat berhasil ditambahkan ✅");
}


function calculateSchedule(start, freq) {
    const times = [];
    const [startH, startM] = start.split(':').map(Number);
    const startTotalMinutes = (startH * 60) + startM;
    
    // Interval dalam menit (24 jam / frekuensi)
    const intervalMinutes = (24 * 60) / freq;

    for (let i = 0; i < freq; i++) {
        let currentTotalMinutes = startTotalMinutes + (intervalMinutes * i);
        
        // Handle jika lewat 24 jam (hari berikutnya)
        if (currentTotalMinutes >= 24 * 60) {
            currentTotalMinutes -= 24 * 60;
        }

        const h = Math.floor(currentTotalMinutes / 60);
        const m = Math.floor(currentTotalMinutes % 60);

        const hStr = h.toString().padStart(2, '0');
        const mStr = m.toString().padStart(2, '0');
        
        times.push(`${hStr}:${mStr}`);
    }

    return times.sort();
}

function deleteReminder(id) {
    if(confirm('Hapus pengingat ini?')) {
        let reminders = getRemindersFromStorage();
        reminders = reminders.filter(r => r.id !== id);
        saveReminders(reminders);
        renderList(reminders);
    }
}

function getRemindersFromStorage() {
    const data = localStorage.getItem('klikdoc_med_reminders');
    return data ? JSON.parse(data) : [];
}

function saveReminders(reminders) {
    localStorage.setItem('klikdoc_med_reminders', JSON.stringify(reminders));
}

function loadReminders() {
    const reminders = getRemindersFromStorage();
    renderList(reminders);
}

function renderList(reminders) {
    const container = document.getElementById('med-list');
    container.innerHTML = '';

    if (reminders.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-prescription-bottle-alt" style="font-size: 2rem; margin-bottom: 10px; opacity: 0.5;"></i>
                <p>Belum ada pengingat obat.<br>Tambahkan obat pertama Anda di atas.</p>
            </div>
        `;
        return;
    }

    reminders.forEach(item => {
        const card = document.createElement('div');
        card.className = 'med-card';
        
        let timeBadgesHtml = '<div class="med-badge-group">';
        item.times.forEach(time => {
            timeBadgesHtml += `<div class="med-time-badge"><i class="far fa-clock"></i> ${time}</div>`;
        });
        timeBadgesHtml += '</div>';

        card.innerHTML = `
            <div class="med-info">
                <h4>${item.name} <small style="font-weight:400; font-size: 0.8em; color: var(--grey2)">(${item.frequency}x Sehari)</small></h4>
                <p><i class="far fa-sticky-note"></i> ${item.note}</p>
                ${timeBadgesHtml}
            </div>
            <div class="med-actions">
                <button onclick="deleteReminder(${item.id})" class="btn-delete" title="Hapus">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        `;
        container.appendChild(card);
    });
}