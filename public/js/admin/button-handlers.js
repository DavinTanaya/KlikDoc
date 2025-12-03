// Button Event Handlers
// This file contains all button click handlers that trigger modals

// Setup button handlers after page load
document.addEventListener('DOMContentLoaded', function() {
    setupButtonHandlers();
});

// Function to setup all button handlers
function setupButtonHandlers() {
    // Use event delegation for dynamically loaded content
    document.getElementById('content').addEventListener('click', function(e) {
        const target = e.target.closest('button');
        if (!target) return;

        // Patient buttons
        if (target.textContent.includes('Tambah Pasien')) {
            e.preventDefault();
            showPatientForm();
        }
        
        // Doctor buttons  
        if (target.textContent.includes('Tambah Dokter')) {
            e.preventDefault();
            showDoctorForm();
        }

        // Article buttons
        if (target.textContent.includes('Tulis Artikel')) {
            e.preventDefault();
            showArticleForm();
        }

        // Service buttons
        if (target.textContent.includes('Jadwalkan Layanan')) {
            e.preventDefault();
            showServiceForm();
        }

        // Program buttons
        if (target.textContent.includes('Buat Program')) {
            e.preventDefault();
            showProgramForm();
        }

        // Product buttons
        if (target.textContent.includes('Tambah Produk') || target.textContent.includes('Tambah Obat')) {
            e.preventDefault();
            showProductForm();
        }

        // View/Detail buttons
        if (target.querySelector('.bi-eye') || target.textContent.includes('Detail')) {
            e.preventDefault();
            handleDetailClick(target);
        }

        // Edit buttons
        if (target.querySelector('.bi-pencil') || target.textContent.includes('Edit')) {
            e.preventDefault();
            handleEditClick(target);
        }

        // Monitor buttons
        if (target.textContent.includes('Monitor')) {
            e.preventDefault();
            handleMonitorClick(target);
        }

        // Tracking buttons
        if (target.textContent.includes('Tracking')) {
            e.preventDefault();
            alert('Fitur tracking akan segera tersedia!');
        }
    });
}

// Handle detail button clicks based on current page
function handleDetailClick(button) {
    const currentPage = document.querySelector('.list-group-item.active').dataset.page;
    
    // Find parent list item
    const listItem = button.closest('.list-item, tr');
    
    switch(currentPage) {
        case 'pasien':
            // Get patient ID from context
            const patientId = 'P001'; // In real app, extract from data attribute
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

// Handle edit button clicks
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

// Handle monitor button clicks
function handleMonitorClick(button) {
    const consultationId = 'C001';
    showConsultationMonitor(consultationId);
}

console.log('Button handlers loaded successfully!');
