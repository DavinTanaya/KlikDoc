function calculatePregnancy() {
    const hphtInput = document.getElementById('hpht_date').value;

    if (!hphtInput) {
        alert('Silakan pilih tanggal HPHT Anda.');
        return;
    }

    const hpht = new Date(hphtInput);
    const today = new Date();

    // 1. Hitung HPL: HPHT + 280 hari (40 minggu)
    const hpl = new Date(hpht);
    hpl.setDate(hpht.getDate() + 280);

    // 2. Hitung Usia Kehamilan (Selisih waktu)
    const diffTime = Math.abs(today - hpht);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
    const weeks = Math.floor(diffDays / 7);
    const days = diffDays % 7;

    // 3. Format tanggal ke bahasa Indonesia
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const hplFormatted = hpl.toLocaleDateString('id-ID', options);

    // 4. Update tampilan HTML
    document.getElementById('hpl-display').innerHTML = hplFormatted;
    document.getElementById('age-display').innerHTML = `${weeks} Minggu ${days} Hari`;

    // 5. Animasi menampilkan hasil
    const wrapper = document.getElementById('result-wrapper');
    wrapper.style.display = 'block';
    
    setTimeout(() => {
        wrapper.classList.add('show');
        wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 50);
}