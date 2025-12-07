// Modal Templates and Functions

const ModalTemplates = {
    applicationDetail: (data) => `
        <div class="row g-4">

            <div class="col-md-4 text-center">
                <div class="avatar mx-auto mb-3" 
                    style="width: 100px; height: 100px; font-size: 40px;">
                    ${data.full_name
                        .split(" ")
                        .map((n) => n[0])
                        .join("")}
                </div>
                <h5>${data.full_name}</h5>
                <p class="text-muted">${data.spesialisasi}</p>
            </div>

            <div class="col-md-8">
                <h6 class="mb-3">Informasi Pengajuan</h6>

                <table class="table table-borderless">
                    <tr><td class="text-muted" width="150">NIK:</td><td>${
                        data.nik
                    }</td></tr>
                    <tr><td class="text-muted">Jenis Kelamin:</td><td>${
                        data.gender
                    }</td></tr>
                    <tr><td class="text-muted">STR:</td><td>${
                        data.str
                    }</td></tr>
                    <tr><td class="text-muted">SIP:</td><td>${
                        data.sip ?? "-"
                    }</td></tr>
                    <tr><td class="text-muted">Spesialisasi:</td><td>${
                        data.spesialisasi
                    }</td></tr>
                    <tr><td class="text-muted">Spesialisasi:</td><td>${
                        data.spesialisasi
                    }</td></tr>
                    <tr><td class="text-muted">Pengalaman (Tahun):</td><td>${
                        data.experience_years
                    }</td></tr>

                    <tr>
                        <td class="text-muted">Dokumen:</td>
                        <td>
                            ${
                                data.document
                                    ? `<a href="documents/applicants/${data.document}" target="_blank" class="text-primary">Lihat Dokumen</a>`
                                    : "Tidak ada dokumen"
                            }
                        </td>
                    </tr>
                </table>
                <form action="/admin/applications/update-status/${
                    data.appId
                }" method="GET">

                <label class="form-label mt-2">Ubah Status</label>
                <select name="status" class="form-select form-select-sm mb-3" required>
                    <option value="pending"  ${
                        data.status === "pending" ? "selected" : ""
                    }>Pending</option>
                    <option value="approved" ${
                        data.status === "approved" ? "selected" : ""
                    }>Approved</option>
                    <option value="rejected" ${
                        data.status === "rejected" ? "selected" : ""
                    }>Rejected</option>
                    <option value="disabled" ${
                        data.status === "disabled" ? "selected" : ""
                    }>Disabled</option>
                </select>

                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-save"></i> Simpan Status
                </button>
            </form>
            </div>

        </div>
    `,
    klikhomeServiceDetail: (data) => `
    <div class="row g-4">
    <div class="col-md-4 text-center">
        <div class="avatar mx-auto mb-3"
        style="width:90px;height:90px;font-size:32px;">
        ${data.name
            .split(" ")
            .map((w) => w[0])
            .join("")}
        </div>

        <h5>${data.name}</h5>
        <span class="badge bg-primary">${data.category}</span>
    </div>

    <div class="col-md-8">
        <h6 class="mb-3">Informasi Layanan</h6>

        <table class="table table-borderless table-sm">
        <tr>
            <td class="text-muted" width="160">Harga</td>
            <td>Rp ${data.price.toLocaleString()}</td>
        </tr>
        <tr>
            <td class="text-muted">Biaya Layanan</td>
            <td>Rp ${data.service_fee.toLocaleString()}</td>
        </tr>
        <tr>
            <td class="text-muted">Durasi</td>
            <td>${data.duration_minutes} menit</td>
        </tr>
        <tr>
            <td class="text-muted">Ditangani oleh</td>
            <td>${data.handled_by}</td>
        </tr>

        <tr>
            <td class="text-muted">Status</td>
            <td>
            <select class="form-select form-select-sm"
                    id="klikhome-status-${data.id}">
                <option value="1" ${
                    data.is_active ? "selected" : ""
                }>Aktif</option>
                <option value="0" ${
                    !data.is_active ? "selected" : ""
                }>Nonaktif</option>
            </select>
            </td>
        </tr>
        </table>

        <div class="mt-3">
        <strong>Deskripsi</strong>
        <p class="text-muted small mt-1">${data.description ?? "-"}</p>
        </div>

        <div class="mt-4 d-flex gap-2">
        <button class="btn btn-success btn-sm"
            onclick="saveKlikHomeStatus(${data.id})">
            <i class="bi bi-save"></i> Simpan Status
        </button>

        <button class="btn btn-primary btn-sm"
            onclick='openEditKlikHomeService(${JSON.stringify(data)})'>
            <i class="bi bi-pencil"></i> Edit
        </button>
        </div>
    </div>
    </div>
    `,
    klikhomeServiceEdit: (data) => `
        <form id="editKlikHomeForm" class="row g-3">

            <input type="hidden" id="edit-service-id" value="${data.id}">

            <div class="col-md-6">
                <label class="form-label">Nama Layanan</label>
                <input type="text" class="form-control form-control-sm"
                    id="edit-name"
                    value="${data.name}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Kategori</label>
                <input type="text" class="form-control form-control-sm"
                    id="edit-category"
                    value="${data.category}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Harga</label>
                <input type="number" class="form-control form-control-sm"
                    id="edit-price"
                    value="${data.price}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Biaya Layanan</label>
                <input type="number" class="form-control form-control-sm"
                    id="edit-service-fee"
                    value="${data.service_fee}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Durasi (menit)</label>
                <input type="number" class="form-control form-control-sm"
                    id="edit-duration"
                    value="${data.duration_minutes}">
            </div>

            <div class="col-md-12">
                <label class="form-label">Ditangani Oleh</label>
                <input type="text" class="form-control form-control-sm"
                    id="edit-handled-by"
                    value="${data.handled_by}">
            </div>

            <div class="col-md-12">
                <label class="form-label">Deskripsi</label>
                <textarea rows="3"
                    id="edit-description"
                    class="form-control form-control-sm">${
                        data.description ?? ""
                    }</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select class="form-select form-select-sm" id="edit-is-active">
                    <option value="1" ${
                        data.is_active ? "selected" : ""
                    }>Aktif</option>
                    <option value="0" ${
                        !data.is_active ? "selected" : ""
                    }>Nonaktif</option>
                </select>
            </div>

            <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                <button type="button" class="btn btn-success btn-sm"
                    onclick="submitEditKlikHomeService()">
                    <i class="bi bi-save"></i> Simpan
                </button>

                <button type="button" class="btn btn-outline-secondary btn-sm"
                    data-bs-dismiss="modal">
                    Batal
                </button>
            </div>
        </form>
        `,
    klikhomeServiceCreate: () => `
<form id="createKlikHomeForm" class="row g-3 klikhome-create-form">

    <!-- BASIC INFO -->
    <div class="col-12">
        <h6 class="section-title">
            <i class="bi bi-info-circle"></i> Informasi Dasar
        </h6>
    </div>

    <div class="col-md-6">
        <label class="form-label">Nama Layanan</label>
        <input type="text" class="form-control form-control-sm"
            id="create-name" placeholder="Contoh: Immune Booster Infusion" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Kategori</label>
        <input type="text" class="form-control form-control-sm"
            id="create-category" placeholder="Vitamin Booster / Vaksinasi" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Harga (Rp)</label>
        <input type="number" class="form-control form-control-sm"
            id="create-price" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Biaya Layanan (Rp)</label>
        <input type="number" class="form-control form-control-sm"
            id="create-service-fee" value="5000" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Durasi (menit)</label>
        <input type="number" class="form-control form-control-sm"
            id="create-duration" required>
    </div>

    <div class="col-md-12">
        <label class="form-label">Ditangani Oleh</label>
        <input type="text" class="form-control form-control-sm"
            id="create-handled-by" placeholder="Perawat / Dokter Umum" required>
    </div>

    <!-- DESCRIPTION -->
    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea rows="3"
            id="create-description"
            class="form-control form-control-sm"
            placeholder="Deskripsi singkat layanan..."></textarea>
    </div>

    <!-- ICON -->
    <div class="col-12">
        <label class="form-label">Icon SVG (Optional)</label>
        <textarea rows="2"
            id="create-icon"
            class="form-control form-control-sm"
            placeholder="<svg>...</svg>"></textarea>
    </div>

    <!-- ARRAYS -->
    <div class="col-12">
        <h6 class="section-title mt-3">
            <i class="bi bi-list-check"></i> Detail Tambahan
        </h6>
    </div>

    <div class="col-md-6">
        <label class="form-label">Manfaat (1 per baris)</label>
        <textarea rows="3"
            id="create-benefits"
            class="form-control form-control-sm"
            placeholder="✅ Meningkatkan imun&#10;✅ Menambah stamina"></textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label">Yang Termasuk (1 per baris)</label>
        <textarea rows="3"
            id="create-inclusions"
            class="form-control form-control-sm"
            placeholder="💉 Infus set&#10;🧤 Alat steril"></textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label">Prosedur Keamanan (JSON)</label>
        <textarea rows="3"
            id="create-safety"
            class="form-control form-control-sm"
            placeholder='[{"title":"Steril","desc":"Alat steril"}]'></textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label">Time Slots (1 per baris)</label>
        <textarea rows="3"
            id="create-slots"
            class="form-control form-control-sm"
            placeholder="09:00 - 10:00&#10;10:00 - 11:00"></textarea>
    </div>

    <!-- STATUS -->
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select class="form-select form-select-sm" id="create-is-active">
            <option value="1" selected>Aktif</option>
            <option value="0">Nonaktif</option>
        </select>
    </div>

    <!-- ACTION -->
    <div class="col-12 d-flex justify-content-end gap-2 mt-4">
        <button type="button" class="btn btn-success btn-sm px-4"
            onclick="submitCreateKlikHomeService()">
            <i class="bi bi-plus-circle"></i> Tambah Layanan
        </button>

        <button type="button"
            class="btn btn-outline-secondary btn-sm px-4"
            data-bs-dismiss="modal">
            Batal
        </button>
    </div>
</form>
`,

    patientDetail: (data) => `
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="avatar mx-auto mb-3" style="width: 120px; height: 120px; font-size: 48px;">
                    ${data.initials}
                </div>
                <h5>${data.name}</h5>
                <p class="text-muted">${data.id}</p>
            </div>
            <div class="col-md-8">
                <h6 class="mb-3">Informasi Pribadi</h6>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="150">Jenis Kelamin:</td>
                        <td>${data.gender}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Usia:</td>
                        <td>${data.age} tahun</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email:</td>
                        <td>${data.email}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Telepon:</td>
                        <td>${data.phone}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Alamat:</td>
                        <td>${data.city}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Total Konsultasi:</td>
                        <td><span class="badge badge-info-custom">${data.consultations}x</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status:</td>
                        <td><span class="badge badge-success-custom">${data.status}</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kunjungan Terakhir:</td>
                        <td>${data.lastVisit}</td>
                    </tr>
                </table>
            </div>
        </div>
    `,

    // Patient Form Modal
    patientForm: (data = {}) => `
        <form id="patientForm">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" class="form-control" name="name" value="${
                        data.name || ""
                    }" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">ID Pasien</label>
                    <input type="text" class="form-control" name="id" value="${
                        data.id || ""
                    }" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email *</label>
                    <input type="email" class="form-control" name="email" value="${
                        data.email || ""
                    }" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nomor Telepon *</label>
                    <input type="tel" class="form-control" name="phone" value="${
                        data.phone || ""
                    }" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Jenis Kelamin *</label>
                    <select class="form-select" name="gender" required>
                        <option value="">Pilih...</option>
                        <option value="Laki-laki" ${
                            data.gender === "Laki-laki" ? "selected" : ""
                        }>Laki-laki</option>
                        <option value="Perempuan" ${
                            data.gender === "Perempuan" ? "selected" : ""
                        }>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Usia *</label>
                    <input type="number" class="form-control" name="age" value="${
                        data.age || ""
                    }" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Kota *</label>
                    <input type="text" class="form-control" name="city" value="${
                        data.city || ""
                    }" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea class="form-control" name="address" rows="3">${
                        data.address || ""
                    }</textarea>
                </div>
            </div>
        </form>
    `,

    // Doctor Detail Modal
    doctorDetail: (data) => `
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <img src="${
                    data.image
                }" class="rounded-circle mb-3" width="120" height="120" alt="${
        data.name
    }">
                <h5>${data.name}</h5>
                <p class="text-muted">${data.specialty}</p>
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge ${
                        data.status === "online"
                            ? "badge-success-custom"
                            : "bg-secondary"
                    }">${data.status}</span>
                    <span class="badge bg-warning text-dark">★ ${
                        data.rating
                    }</span>
                </div>
            </div>
            <div class="col-md-8">
                <h6 class="mb-3">Informasi Dokter</h6>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="150">ID Dokter:</td>
                        <td>${data.id}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Spesialisasi:</td>
                        <td>${data.specialty}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Pengalaman:</td>
                        <td>${data.experience}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Total Konsultasi:</td>
                        <td><span class="badge badge-info-custom">${
                            data.consultations
                        }x</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Rating:</td>
                        <td><span class="text-warning">★★★★★</span> ${
                            data.rating
                        }/5.0</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Tarif:</td>
                        <td><span class="text-primary fw-semibold">${
                            data.price
                        }</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email:</td>
                        <td>${data.email}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Telepon:</td>
                        <td>${data.phone}</td>
                    </tr>
                </table>
                <div class="mt-3">
                    <button class="btn btn-primary btn-sm me-2">
                        <i class="bi bi-pencil"></i> Edit Profil
                    </button>
                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-calendar"></i> Jadwal Praktik
                    </button>
                </div>
            </div>
        </div>
    `,

    // Doctor Form Modal
    doctorForm: (data = {}) => `
        <form id="doctorForm">
            <div class="row g-3">
                <div class="col-12 text-center mb-3">
                    <div class="position-relative d-inline-block">
                        <img src="${
                            data.image || "https://via.placeholder.com/120"
                        }" 
                             class="rounded-circle" width="120" height="120" alt="Doctor" id="doctorImagePreview">
                        <button type="button" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle">
                            <i class="bi bi-camera"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" class="form-control" name="name" value="${
                        data.name || ""
                    }" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Spesialisasi *</label>
                    <select class="form-select" name="specialty" required>
                        <option value="">Pilih...</option>
                        <option value="Kardiologi" ${
                            data.specialty === "Kardiologi" ? "selected" : ""
                        }>Kardiologi</option>
                        <option value="Dermatologi" ${
                            data.specialty === "Dermatologi" ? "selected" : ""
                        }>Dermatologi</option>
                        <option value="Pediatri" ${
                            data.specialty === "Pediatri" ? "selected" : ""
                        }>Pediatri</option>
                        <option value="Orthopedi" ${
                            data.specialty === "Orthopedi" ? "selected" : ""
                        }>Orthopedi</option>
                        <option value="Psikiatri" ${
                            data.specialty === "Psikiatri" ? "selected" : ""
                        }>Psikiatri</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email *</label>
                    <input type="email" class="form-control" name="email" value="${
                        data.email || ""
                    }" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nomor Telepon *</label>
                    <input type="tel" class="form-control" name="phone" value="${
                        data.phone || ""
                    }" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Pengalaman (tahun) *</label>
                    <input type="number" class="form-control" name="experience" value="${
                        data.experience || ""
                    }" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tarif Konsultasi *</label>
                    <input type="text" class="form-control" name="price" value="${
                        data.price || ""
                    }" placeholder="Rp 150.000" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Nomor STR *</label>
                    <input type="text" class="form-control" name="str" value="${
                        data.str || ""
                    }" required>
                </div>
            </div>
        </form>
    `,

    // Consultation Monitor Modal
    consultationMonitor: (data) => `
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">${data.patient} → ${
        data.doctor
    }</h6>
                            <small class="text-muted">${data.specialty} • ${
        data.type
    }</small>
                        </div>
                        <span class="badge ${
                            data.status === "ongoing"
                                ? "badge-success-custom"
                                : "badge-warning-custom"
                        }">
                            ${
                                data.status === "ongoing"
                                    ? "Sedang Berlangsung"
                                    : "Menunggu"
                            }
                        </span>
                    </div>
                    <div class="card-body" style="height: 400px; overflow-y: auto; background: #f8f9fa;">
                        <div class="chat-message mb-3">
                            <div class="d-flex gap-2">
                                <div class="avatar" style="width: 32px; height: 32px; font-size: 14px;">P</div>
                                <div class="flex-grow-1">
                                    <div class="bg-white p-3 rounded shadow-sm">
                                        <p class="mb-0">${data.complaint}</p>
                                    </div>
                                    <small class="text-muted">10:30</small>
                                </div>
                            </div>
                        </div>
                        <div class="chat-message mb-3">
                            <div class="d-flex gap-2 justify-content-end">
                                <div class="flex-grow-1 text-end">
                                    <div class="bg-primary text-white p-3 rounded shadow-sm d-inline-block">
                                        <p class="mb-0">Baik, saya akan periksa terlebih dahulu. Bisa jelaskan lebih detail?</p>
                                    </div>
                                    <div><small class="text-muted">10:31</small></div>
                                </div>
                                <div class="avatar" style="width: 32px; height: 32px; font-size: 14px;">D</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="mb-0">Info Konsultasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block">ID Konsultasi</small>
                            <strong>${data.id}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Waktu Mulai</small>
                            <strong>${data.startTime}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Durasi</small>
                            <strong>${data.duration}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Tipe</small>
                            <span class="badge badge-info-custom">${
                                data.type
                            }</span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-file-earmark-text"></i> Lihat Riwayat
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-telephone"></i> Join Call
                            </button>
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-x-circle"></i> Akhiri Konsultasi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,

    // Product Detail Modal
    productDetail: (data) => `
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="bg-light rounded p-5 mb-3">
                    <i class="bi bi-capsule-pill" style="font-size: 80px; color: #4fc3f7;"></i>
                </div>
            </div>
            <div class="col-md-8">
                <h5 class="mb-3">${data.name}</h5>
                <table class="table table-borderless">
                    <tr>
                        <td class="text-muted" width="150">ID Produk:</td>
                        <td>${data.id}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kategori:</td>
                        <td>${data.category}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Manufacturer:</td>
                        <td>${data.manufacturer}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Stok:</td>
                        <td><span class="badge badge-info-custom">${
                            data.stock
                        } unit</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Terjual:</td>
                        <td>${data.sold}x</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Harga:</td>
                        <td><span class="text-primary fw-semibold">${
                            data.price
                        }</span></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Kadaluarsa:</td>
                        <td>${data.expiryDate}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status:</td>
                        <td><span class="badge ${
                            data.status === "available"
                                ? "badge-success-custom"
                                : "badge-warning-custom"
                        }">${data.statusText}</span></td>
                    </tr>
                </table>
                <div class="progress mb-3">
                    <div class="progress-bar" style="width: ${
                        data.stockPercentage
                    }%"></div>
                </div>
            </div>
        </div>
    `,

    // Article Form Modal
    articleForm: (data = {}) => `
        <form id="articleForm">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Judul Artikel *</label>
                    <input type="text" class="form-control" name="title" value="${
                        data.title || ""
                    }" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kategori *</label>
                    <select class="form-select" name="category" required>
                        <option value="">Pilih...</option>
                        <option value="Kardiologi">Kardiologi</option>
                        <option value="Pediatri">Pediatri</option>
                        <option value="Dermatologi">Dermatologi</option>
                        <option value="Psikiatri">Psikiatri</option>
                        <option value="Endokrinologi">Endokrinologi</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Penulis *</label>
                    <select class="form-select" name="author" required>
                        <option value="">Pilih Dokter...</option>
                        <option value="Dr. Sarah Johnson">Dr. Sarah Johnson</option>
                        <option value="Dr. Michael Chen">Dr. Michael Chen</option>
                        <option value="Dr. Lisa Anderson">Dr. Lisa Anderson</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Gambar Thumbnail</label>
                    <input type="file" class="form-control" accept="image/*">
                </div>
                <div class="col-12">
                    <label class="form-label">Konten Artikel *</label>
                    <textarea class="form-control" name="content" rows="10" required>${
                        data.content || ""
                    }</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tags</label>
                    <input type="text" class="form-control" name="tags" placeholder="pisahkan dengan koma">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status *</label>
                    <select class="form-select" name="status" required>
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                        <option value="scheduled">Scheduled</option>
                    </select>
                </div>
            </div>
        </form>
    `,
};

// Modal Functions
const ModalFunctions = {
    showPatientDetail: (patientData) => {
        const modal = new bootstrap.Modal(
            document.getElementById("detailModal")
        );
        document.getElementById("detailModalTitle").textContent =
            "Detail Pasien";
        document.getElementById("detailModalBody").innerHTML =
            ModalTemplates.patientDetail(patientData);
        modal.show();
    },

    showPatientForm: (patientData = null) => {
        const modal = new bootstrap.Modal(document.getElementById("formModal"));
        document.getElementById("formModalTitle").textContent = patientData
            ? "Edit Pasien"
            : "Tambah Pasien Baru";
        document.getElementById("formModalBody").innerHTML =
            ModalTemplates.patientForm(patientData || {});
        modal.show();
    },

    showDoctorDetail: (doctorData) => {
        const modal = new bootstrap.Modal(
            document.getElementById("detailModal")
        );
        document.getElementById("detailModalTitle").textContent =
            "Detail Dokter";
        document.getElementById("detailModalBody").innerHTML =
            ModalTemplates.doctorDetail(doctorData);
        modal.show();
    },

    showDoctorForm: (doctorData = null) => {
        const modal = new bootstrap.Modal(document.getElementById("formModal"));
        document.getElementById("formModalTitle").textContent = doctorData
            ? "Edit Dokter"
            : "Tambah Dokter Baru";
        document.getElementById("formModalBody").innerHTML =
            ModalTemplates.doctorForm(doctorData || {});
        modal.show();
    },

    showConsultationMonitor: (consultationData) => {
        const modal = new bootstrap.Modal(
            document.getElementById("monitorModal")
        );
        document.getElementById("monitorModalBody").innerHTML =
            ModalTemplates.consultationMonitor(consultationData);
        modal.show();
    },

    showProductDetail: (productData) => {
        const modal = new bootstrap.Modal(
            document.getElementById("detailModal")
        );
        document.getElementById("detailModalTitle").textContent =
            "Detail Produk";
        document.getElementById("detailModalBody").innerHTML =
            ModalTemplates.productDetail(productData);
        modal.show();
    },

    showArticleForm: (articleData = null) => {
        const modal = new bootstrap.Modal(document.getElementById("formModal"));
        document.getElementById("formModalTitle").textContent = articleData
            ? "Edit Artikel"
            : "Tulis Artikel Baru";
        document.getElementById("formModalBody").innerHTML =
            ModalTemplates.articleForm(articleData || {});
        modal.show();
    },

    showConfirmDelete: (itemName, onConfirm) => {
        const modal = new bootstrap.Modal(
            document.getElementById("confirmModal")
        );
        document.getElementById(
            "confirmModalBody"
        ).textContent = `Apakah Anda yakin ingin menghapus ${itemName}?`;

        const confirmBtn = document.getElementById("confirmBtn");
        confirmBtn.onclick = () => {
            onConfirm();
            modal.hide();
        };

        modal.show();
    },

    showSuccess: (message) => {
        // Create toast notification
        const toast = document.createElement("div");
        toast.className =
            "toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-3";
        toast.setAttribute("role", "alert");
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle me-2"></i>${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toast);
        const bsToast = new bootstrap.Toast(toast);
        bsToast.show();

        setTimeout(() => {
            toast.remove();
        }, 5000);
    },
};
