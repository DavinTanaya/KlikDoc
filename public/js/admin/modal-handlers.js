// Modal Handler Functions
// Load this after modals.js and script.js

// Sample Data
const sampleData = {
    patients: {
        P001: {
            id: "P001",
            name: "Andi Wijaya",
            initials: "AW",
            gender: "Laki-laki",
            age: 35,
            email: "andi.wijaya@email.com",
            phone: "081234567890",
            city: "Jakarta",
            consultations: 12,
            status: "Aktif",
            lastVisit: "2 hari lalu",
        },
        P002: {
            id: "P002",
            name: "Budi Santoso",
            initials: "BS",
            gender: "Laki-laki",
            age: 42,
            email: "budi.santoso@email.com",
            phone: "081234567891",
            city: "Bandung",
            consultations: 8,
            status: "Aktif",
            lastVisit: "1 minggu lalu",
        },
    },
    doctors: {
        D001: {
            id: "D001",
            name: "Dr. Sarah Johnson",
            specialty: "Kardiologi",
            experience: "15 tahun",
            rating: 4.9,
            consultations: 245,
            price: "Rp 150.000",
            email: "sarah.johnson@klikdoc.com",
            phone: "081234560001",
            status: "online",
            image: "https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=120&h=120&fit=crop",
        },
    },
    consultations: {
        C001: {
            id: "C001",
            patient: "Andi Wijaya",
            doctor: "Dr. Sarah Johnson",
            specialty: "Kardiologi",
            startTime: "09:00",
            duration: "15 menit",
            status: "ongoing",
            type: "CHAT",
            complaint: "Nyeri dada sebelah kiri",
        },
        C002: {
            id: "C002",
            patient: "Budi Santoso",
            doctor: "Dr. Michael Chen",
            specialty: "Dermatologi",
            startTime: "09:15",
            duration: "8 menit",
            status: "waiting",
            type: "CHAT",
            complaint: "Ruam kulit di tangan",
        },
        C003: {
            id: "C003",
            patient: "Citra Dewi",
            doctor: "Dr. Lisa Anderson",
            specialty: "Pediatri",
            startTime: "09:30",
            duration: "20 menit",
            status: "ongoing",
            type: "VIDEO",
            complaint: "Demam anak 2 hari",
        },
    },
    products: {
        PR001: {
            id: "PR001",
            name: "Paracetamol 500mg",
            category: "Analgesik",
            manufacturer: "Kimia Farma",
            stock: 1250,
            sold: 456,
            price: "Rp 5.000",
            expiryDate: "Dec 2025",
            status: "available",
            statusText: "Tersedia",
            stockPercentage: 100,
        },
        PR002: {
            id: "PR002",
            name: "Amoxicillin 500mg",
            category: "Antibiotik",
            manufacturer: "Kalbe Farma",
            stock: 45,
            sold: 234,
            price: "Rp 15.000",
            expiryDate: "Mar 2025",
            status: "low",
            statusText: "Stok Rendah",
            stockPercentage: 22.5,
        },
    },
};

// Patient Functions
window.showPatientDetail = function (patientId) {
    const patient =
        sampleData.patients[patientId] || sampleData.patients["P001"];
    ModalFunctions.showPatientDetail(patient);
};

window.showPatientForm = function (patientId = null) {
    const patient = patientId ? sampleData.patients[patientId] : null;
    ModalFunctions.showPatientForm(patient);
};

window.deletePatient = function (patientId) {
    ModalFunctions.showConfirmDelete("pasien ini", () => {
        ModalFunctions.showSuccess("Pasien berhasil dihapus!");
    });
};

// Doctor Functions
window.showDoctorDetail = function (doctorId) {
    const doctor = sampleData.doctors[doctorId] || sampleData.doctors["D001"];
    ModalFunctions.showDoctorDetail(doctor);
};

window.showDoctorForm = function (doctorId = null) {
    const doctor = doctorId ? sampleData.doctors[doctorId] : null;
    ModalFunctions.showDoctorForm(doctor);
};

window.deleteDoctor = function (doctorId) {
    ModalFunctions.showConfirmDelete("dokter ini", () => {
        ModalFunctions.showSuccess("Dokter berhasil dihapus!");
    });
};

// Consultation Functions
window.showConsultationMonitor = function (consultationId) {
    const consultation =
        sampleData.consultations[consultationId] ||
        sampleData.consultations["C001"];
    ModalFunctions.showConsultationMonitor(consultation);
};

// Product Functions
window.showProductDetail = function (productId) {
    const product =
        sampleData.products[productId] || sampleData.products["PR001"];
    ModalFunctions.showProductDetail(product);
};

window.showAddForm = function () {
    const modal = new bootstrap.Modal(document.getElementById("formModal"));

    document.getElementById("formModalTitle").textContent =
        "Tambah Produk Baru";
    document.getElementById("formModalBody").innerHTML =
        document.getElementById("hiddenFormAdd").innerHTML;
    const saveBtn = document.getElementById("saveFormBtn");
    saveBtn.onclick = function () {
        const form = document.querySelector("#formModalBody form");
        if (form) form.submit();
    };
    modal.show();
};

window.showEditForm = function (product) {
    const modal = new bootstrap.Modal(document.getElementById("formModal"));
    document.getElementById("formModalTitle").textContent = "Edit Produk";

    let template = document.getElementById("hiddenFormEdit").innerHTML;

    template = template
        .replace("__ID__", product.id)
        .replace("__NAME__", product.name)
        .replace("__PRICE__", product.price)
        .replace("__STOCK__", product.stock)
        .replace(
            "__CAT_ANALGESIK__",
            product.category === "Analgesik" ? "selected" : ""
        )
        .replace("__TYPE_TABLET__", product.type === "Tablet" ? "selected" : "")
        .replace("__DOSIS__", product.dosis ?? "")
        .replace("__SHORT__", product.short_description ?? "")
        .replace("__DESC__", product.description ?? "");

    document.getElementById("formModalBody").innerHTML = template;
    const saveBtn = document.getElementById("saveFormBtn");
    saveBtn.onclick = function () {
        const form = document.querySelector("#formModalBody form");
        if (form) form.submit();
    };
    modal.show();
};

window.showDeleteForm = function (product) {
    const modal = new bootstrap.Modal(document.getElementById("formModal"));
    document.getElementById("formModalTitle").textContent = "Hapus Produk";

    let template = document.getElementById("hiddenFormDelete").innerHTML;

    template = template
        .replace("__ID__", product.id)
        .replace("__NAME__", product.name);

    document.getElementById("formModalBody").innerHTML = template;

    modal.show();
};

window.deleteProduct = function (productId) {
    ModalFunctions.showConfirmDelete("produk ini", () => {
        ModalFunctions.showSuccess("Produk berhasil dihapus!");
    });
};

// Article Functions
window.showArticleForm = function (articleId = null) {
    ModalFunctions.showArticleForm(articleId ? {} : null);
};

window.showArticleDetail = function (articleId) {
    const modal = new bootstrap.Modal(document.getElementById("detailModal"));
    document.getElementById("detailModalTitle").textContent = "Detail Artikel";
    document.getElementById("detailModalBody").innerHTML = `
        <div class="mb-3">
            <div class="bg-secondary rounded mb-3" style="height: 200px;"></div>
            <h4>10 Tips Menjaga Kesehatan Jantung di Usia Muda</h4>
            <div class="d-flex align-items-center gap-2 mb-3">
                <div class="avatar" style="width: 32px; height: 32px; font-size: 12px;">SJ</div>
                <small class="text-muted">Dr. Sarah Johnson • Kardiologi • 2 hari lalu</small>
            </div>
            <div class="d-flex gap-3 mb-3">
                <span class="badge badge-success-custom">Published</span>
                <span class="badge badge-info-custom"><i class="bi bi-eye"></i> 12,453</span>
                <span class="badge bg-secondary"><i class="bi bi-heart"></i> 892</span>
            </div>
        </div>
        <div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
        </div>
    `;
    modal.show();
};

window.deleteArticle = function (articleId) {
    ModalFunctions.showConfirmDelete("artikel ini", () => {
        ModalFunctions.showSuccess("Artikel berhasil dihapus!");
    });
};

// Service Functions
window.showServiceDetail = function (serviceId) {
    const modal = new bootstrap.Modal(document.getElementById("detailModal"));
    document.getElementById("detailModalTitle").textContent =
        "Detail Layanan KlikHome";
    document.getElementById("detailModalBody").innerHTML = `
        <div class="row g-4">
            <div class="col-md-6">
                <h6 class="mb-3">Informasi Layanan</h6>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="150">ID Layanan:</td>
                        <td>HS001</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Layanan:</td>
                        <td>Tes Lab COVID-19</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Pasien:</td>
                        <td>Andi Wijaya</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Petugas:</td>
                        <td>Perawat Linda</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tanggal & Waktu:</td>
                        <td>2024-12-04 • 09:00</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Harga:</td>
                        <td><span class="text-primary fw-semibold">Rp 250.000</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status:</td>
                        <td><span class="badge badge-info-custom">Terjadwal</span></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="mb-3">Alamat</h6>
                <p class="text-muted">Jl. Sudirman No. 123, Jakarta Selatan</p>
                <div class="bg-light rounded p-3 text-center" style="height: 200px;">
                    <i class="bi bi-geo-alt-fill text-primary" style="font-size: 48px;"></i>
                    <p class="mt-2">Map Preview</p>
                </div>
            </div>
        </div>
    `;
    modal.show();
};

window.showServiceForm = function () {
    const modal = new bootstrap.Modal(document.getElementById("formModal"));
    document.getElementById("formModalTitle").textContent =
        "Jadwalkan Layanan KlikHome";
    document.getElementById("formModalBody").innerHTML = `
        <form id="serviceForm">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Pasien *</label>
                    <select class="form-select" name="patient" required>
                        <option value="">Pilih Pasien...</option>
                        <option value="P001">Andi Wijaya</option>
                        <option value="P002">Budi Santoso</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Layanan *</label>
                    <select class="form-select" name="service" required>
                        <option value="">Pilih Layanan...</option>
                        <option value="tes-lab">Tes Lab COVID-19</option>
                        <option value="vaksinasi">Vaksinasi</option>
                        <option value="vitamin">Vitamin Booster</option>
                        <option value="dokter">Pemeriksaan Dokter</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal *</label>
                    <input type="date" class="form-control" name="date" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Waktu *</label>
                    <input type="time" class="form-control" name="time" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Alamat *</label>
                    <textarea class="form-control" name="address" rows="3" required></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Petugas *</label>
                    <select class="form-select" name="staff" required>
                        <option value="">Pilih Petugas...</option>
                        <option value="linda">Perawat Linda</option>
                        <option value="diana">Perawat Diana</option>
                        <option value="sarah">Perawat Sarah</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Harga</label>
                    <input type="text" class="form-control" name="price" value="Rp 250.000" readonly>
                </div>
            </div>
        </form>
    `;
    modal.show();
};

// Program Functions
window.showProgramDetail = function (programId) {
    const modal = new bootstrap.Modal(document.getElementById("detailModal"));
    document.getElementById("detailModalTitle").textContent = "Detail Program";
    document.getElementById("detailModalBody").innerHTML = `
        <h5 class="mb-3">Program Diabetes Management</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="150">Kategori:</td>
                        <td>Penyakit Kronis</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Durasi:</td>
                        <td>3 bulan</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Peserta:</td>
                        <td>234 orang</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Mulai:</td>
                        <td>1 Jan 2024</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status:</td>
                        <td><span class="badge badge-success-custom">Active</span></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Progress</h6>
                <div class="mb-2">
                    <div class="d-flex justify-content-between small mb-1">
                        <span>Completion Rate</span>
                        <span>65%</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: 65%"></div>
                    </div>
                </div>
            </div>
        </div>
    `;
    modal.show();
};

window.showProgramForm = function () {
    const modal = new bootstrap.Modal(document.getElementById("formModal"));
    document.getElementById("formModalTitle").textContent =
        "Buat Program Kesehatan";
    document.getElementById("formModalBody").innerHTML = `
        <form id="programForm">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Nama Program *</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kategori *</label>
                    <select class="form-select" name="category" required>
                        <option value="">Pilih...</option>
                        <option value="penyakit-kronis">Penyakit Kronis</option>
                        <option value="lifestyle">Lifestyle</option>
                        <option value="nutrisi">Nutrisi</option>
                        <option value="mental-health">Mental Health</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Durasi *</label>
                    <input type="text" class="form-control" name="duration" placeholder="3 bulan" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="description" rows="4"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal Mulai *</label>
                    <input type="date" class="form-control" name="startDate" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Target Peserta</label>
                    <input type="number" class="form-control" name="target">
                </div>
            </div>
        </form>
    `;
    modal.show();
};

// Medical Record Functions
window.showMedicalRecordDetail = function (recordId) {
    const modal = new bootstrap.Modal(document.getElementById("detailModal"));
    document.getElementById("detailModalTitle").textContent =
        "Detail Rekam Medis";
    document.getElementById("detailModalBody").innerHTML = `
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="avatar mx-auto mb-3" style="width: 100px; height: 100px; font-size: 40px;">AW</div>
                <h6>Andi Wijaya</h6>
                <small class="text-muted">MR001</small>
            </div>
            <div class="col-md-8">
                <h6 class="mb-3">Informasi Konsultasi</h6>
                <table class="table table-borderless small">
                    <tr>
                        <td class="text-muted" width="150">Tanggal:</td>
                        <td>2024-12-03</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Dokter:</td>
                        <td>Dr. Sarah Johnson</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Diagnosis:</td>
                        <td><strong>Hipertensi Stage 1</strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Keluhan:</td>
                        <td>Nyeri dada, sesak napas ringan</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tipe:</td>
                        <td><span class="badge badge-info-custom">Konsultasi Online</span></td>
                    </tr>
                </table>
                <h6 class="mb-2 mt-4">Resep Obat</h6>
                <div class="list-group">
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span>Amlodipine 10mg</span>
                            <span class="text-muted small">1x1 sehari</span>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span>Valsartan 80mg</span>
                            <span class="text-muted small">1x1 sehari</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    modal.show();
};

window.showApplicationDetail = function (app) {
    const modal = new bootstrap.Modal(document.getElementById("detailModal"));

    document.getElementById("detailModalTitle").textContent =
        "Detail Pengajuan Dokter";
    document.getElementById("detailModalBody").innerHTML =
        ModalTemplates.applicationDetail(app);

    modal.show();
};

window.showKlikHomeServiceDetail = function (app) {
    const modal = new bootstrap.Modal(document.getElementById("detailModal"));

    document.getElementById("detailModalTitle").textContent =
        "Detail Layanan KlikHome";
    document.getElementById("detailModalBody").innerHTML =
        ModalTemplates.klikhomeServiceDetail(app);

    modal.show();
};

function getCsrfToken() {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    return tokenMeta ? tokenMeta.getAttribute("content") : "";
}

window.saveKlikHomeStatus = function (serviceId) {
    const select = document.getElementById(`klikhome-status-${serviceId}`);
    const isActive = select.value;

    fetch(`/admin/klikhome/services/${serviceId}/status`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": getCsrfToken(),
        },
        body: JSON.stringify({
            is_active: isActive,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                setTimeout(() => location.reload(), 1500);
            }
        })
        .catch((err) => {
            alert("Terjadi kesalahan saat memperbarui status layanan.");
        });
};

window.openEditKlikHomeService = function (data) {
    const modal = new bootstrap.Modal(document.getElementById("detailModal"));

    document.getElementById("detailModalTitle").textContent =
        "Edit Layanan KlikHome";

    document.getElementById("detailModalBody").innerHTML =
        ModalTemplates.klikhomeServiceEdit(data);

    modal.show();
};
window.submitEditKlikHomeService = function () {
    const id = document.getElementById("edit-service-id").value;

    const payload = {
        name: document.getElementById("edit-name").value,
        category: document.getElementById("edit-category").value,
        price: document.getElementById("edit-price").value,
        service_fee: document.getElementById("edit-service-fee").value,
        duration_minutes: document.getElementById("edit-duration").value,
        handled_by: document.getElementById("edit-handled-by").value,
        description: document.getElementById("edit-description").value,
        is_active: document.getElementById("edit-is-active").value,
    };

    fetch(`/admin/klikhome/services/${id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": getCsrfToken(),
            Accept: "application/json",
        },
        body: JSON.stringify(payload),
    })
        .then((res) => {
            if (!res.ok) throw new Error("Gagal update layanan");
            return res.json();
        })
        .then(() => {
            alert("Layanan berhasil diperbarui");
            location.reload(); // atau update DOM manual
        })
        .catch((err) => {
            console.error(err);
            alert("Terjadi kesalahan");
        });
};
window.openCreateKlikHomeService = function () {
    const modal = new bootstrap.Modal(document.getElementById("detailModal"));

    document.getElementById("detailModalTitle").textContent =
        "Tambah Layanan KlikHome";

    document.getElementById("detailModalBody").innerHTML =
        ModalTemplates.klikhomeServiceCreate();

    modal.show();
};

function v($id) {
    return document.getElementById($id).value;
}

window.submitCreateKlikHomeService = function () {
    const payload = {
        name: v("create-name"),
        category: v("create-category"),
        price: +v("create-price"),
        service_fee: +v("create-service-fee"),
        duration_minutes: +v("create-duration"),
        handled_by: v("create-handled-by"),
        description: v("create-description"),
        icon_svg: v("create-icon"),

        benefits: v("create-benefits").split("\n").filter(Boolean),
        inclusions: v("create-inclusions").split("\n").filter(Boolean),
        time_slots: v("create-slots").split("\n").filter(Boolean),

        safety_notes: v("create-safety") ? JSON.parse(v("create-safety")) : [],

        is_active: v("create-is-active") == "1",
    };

    fetch("/admin/klikhome/services", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": getCsrfToken(),
            Accept: "application/json",
        },
        body: JSON.stringify(payload),
    })
        .then((res) => {
            if (!res.ok) throw new Error("Gagal membuat layanan");
            return res.json();
        })
        .then(() => {
            alert("Layanan KlikHome berhasil ditambahkan");
            location.reload();
        })
        .catch((err) => {
            console.error(err);
            alert("Terjadi kesalahan saat menambahkan layanan");
        });
};

console.log("Modal handlers loaded successfully!");
