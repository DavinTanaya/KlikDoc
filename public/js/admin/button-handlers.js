document.addEventListener('DOMContentLoaded', function() {
    setupButtonHandlers();
});

function setupButtonHandlers() {
    document.getElementById('content').addEventListener('click', function(e) {
        const target = e.target.closest('button');
        if (!target) return;

        if (target.textContent.includes('Tambah Pasien')) {
            e.preventDefault();
            showPatientForm();
        }

        if (target.textContent.includes('Tambah Dokter')) {
            e.preventDefault();
            showDoctorForm();
        }

        if (target.textContent.includes('Tulis Artikel')) {
            e.preventDefault();
            showArticleForm();
        }

        if (target.textContent.includes('Jadwalkan Layanan')) {
            e.preventDefault();
            showServiceForm();
        }

        if (target.textContent.includes('Buat Program')) {
            e.preventDefault();
            showProgramForm();
        }

        if (target.textContent.includes('Tambah Produk') || target.textContent.includes('Tambah Obat')) {
            e.preventDefault();
            showProductForm();
        }

        if (target.querySelector('.bi-eye') || target.textContent.includes('Detail')) {
            e.preventDefault();
            handleDetailClick(target);
        }

        if (target.querySelector('.bi-pencil') || target.textContent.includes('Edit')) {
            e.preventDefault();
            handleEditClick(target);
        }

        if (target.textContent.includes('Monitor')) {
            e.preventDefault();
            handleMonitorClick(target);
        }

        if (target.textContent.includes('Tracking')) {
            e.preventDefault();
            alert('Fitur tracking akan segera tersedia!');
        }
    });
}

function handleDetailClick(button) {
    const currentPage = document.querySelector('.list-group-item.active').dataset.page;
    const listItem = button.closest('.list-item, tr');
    
    switch(currentPage) {
        case 'pasien':            
            const patientId = 'P001';
            showPatientDetail(patientId);
            break;
            
        case 'dokter':
            const doctorId = 'D001';
            showDoctorDetail(doctorId);
            break;
            
        case 'apotek':
        case 'obat':
            const productId = 'PR001';
            showProductDetail(productId);
            break;
            
        case 'artikel':
            const articleId = 'A001';
            showArticleDetail(articleId);
            break;
            
        case 'klikhome':
            const serviceId = 'HS001';
            showServiceDetail(serviceId);
            break;
            
        case 'program':
            const programId = 'PG001';
            showProgramDetail(programId);
            break;
            
        case 'rekam-medis':
            const recordId = 'MR001';
            showMedicalRecordDetail(recordId);
            break;
            
        default:
            console.log('Detail view for', currentPage);
    }
}

function handleEditClick(button) {
    const currentPage = document.querySelector('.list-group-item.active').dataset.page;
    
    switch(currentPage) {
        case 'pasien':
            const patientId = 'P001';
            showPatientForm(patientId);
            break;
            
        case 'dokter':
            const doctorId = 'D001';
            showDoctorForm(doctorId);
            break;
            
        case 'apotek':
        case 'obat':
            const productId = 'PR001';
            showProductForm(productId);
            break;
            
        case 'artikel':
            const articleId = 'A001';
            showArticleForm(articleId);
            break;
            
        default:
            console.log('Edit for', currentPage);
    }
}

function handleMonitorClick(button) {
    const consultationId = 'C001';
    showConsultationMonitor(consultationId);
}

console.log('Button handlers loaded successfully!');
