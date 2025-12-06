// Page Templates
const pages = {
    dashboard: {
        title: "Dashboard Admin",
        subtitle: "Kelola dan pantau dashboard",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-2">Total Pasien</p>
                                    <h2 class="stat-value mb-2">12,345</h2>
                                    <small class="text-success">
                                        <i class="bi bi-arrow-up"></i> +12.5% vs bulan lalu
                                    </small>
                                </div>
                                <div class="stat-icon bg-gradient-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-2">Konsultasi Aktif</p>
                                    <h2 class="stat-value mb-2">234</h2>
                                    <small class="text-success">
                                        <i class="bi bi-arrow-up"></i> +8.2% vs bulan lalu
                                    </small>
                                </div>
                                <div class="stat-icon bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-chat-dots-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-2">Revenue Bulan Ini</p>
                                    <h2 class="stat-value mb-2">45.6M</h2>
                                    <small class="text-success">
                                        <i class="bi bi-arrow-up"></i> +15.3% vs bulan lalu
                                    </small>
                                </div>
                                <div class="stat-icon" style="background: rgba(156, 39, 176, 0.1); color: #9c27b0;">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-2">Konsultasi Menunggu</p>
                                    <h2 class="stat-value mb-2">89</h2>
                                    <small class="text-danger">
                                        <i class="bi bi-arrow-down"></i> -3.1% vs bulan lalu
                                    </small>
                                </div>
                                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-clock-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card fade-in">
                        <div class="card-header">
                            <h5 class="mb-1">Konsultasi Aktif</h5>
                            <p class="text-muted mb-0 small">Daftar konsultasi yang sedang berlangsung</p>
                        </div>
                        <div class="card-body">
                            <div class="list-item">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">AW</div>
                                        <div>
                                            <h6 class="mb-1">Andi Wijaya</h6>
                                            <p class="text-muted mb-0 small">Dr. Sarah Johnson • Kardiologi</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="badge badge-success-custom">Berlangsung</span>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Lihat
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="list-item">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">BS</div>
                                        <div>
                                            <h6 class="mb-1">Budi Santoso</h6>
                                            <p class="text-muted mb-0 small">Dr. Michael Chen • Dermatologi</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="badge badge-warning-custom">Menunggu</span>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Lihat
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="list-item">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">CD</div>
                                        <div>
                                            <h6 class="mb-1">Citra Dewi</h6>
                                            <p class="text-muted mb-0 small">Dr. Lisa Anderson • Pediatri</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="badge badge-success-custom">Berlangsung</span>
                                        <button class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Lihat
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100 mt-3">Lihat Semua Konsultasi</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card fade-in">
                        <div class="card-header">
                            <h5 class="mb-1">Dokter Terpopuler</h5>
                            <p class="text-muted mb-0 small">Berdasarkan konsultasi bulan ini</p>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 p-3 mb-2 rounded bg-light">
                                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=48&h=48&fit=crop" 
                                     class="rounded-circle" width="48" height="48" alt="">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Dr. Sarah Johnson</h6>
                                    <small class="text-muted">Kardiologi</small>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">245</div>
                                    <small class="text-warning">★ 4.9</small>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3 p-3 mb-2 rounded bg-light">
                                <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=48&h=48&fit=crop" 
                                     class="rounded-circle" width="48" height="48" alt="">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Dr. Michael Chen</h6>
                                    <small class="text-muted">Dermatologi</small>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">198</div>
                                    <small class="text-warning">★ 4.8</small>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3 p-3 rounded bg-light">
                                <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=48&h=48&fit=crop" 
                                     class="rounded-circle" width="48" height="48" alt="">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Dr. Lisa Anderson</h6>
                                    <small class="text-muted">Pediatri</small>
                                </div>
                                <div class="text-end">
                                    <div class="fw-bold">187</div>
                                    <small class="text-warning">★ 4.9</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },

    pasien: {
        title: "Pasien",
        subtitle: "Kelola dan pantau pasien",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Pasien</p>
                            <h2 class="stat-value">12,345</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Pasien Aktif</p>
                            <h2 class="stat-value text-success">8,234</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Pasien Baru (Bulan Ini)</p>
                            <h2 class="stat-value text-primary">456</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Konsultasi</p>
                            <h2 class="stat-value" style="color: #9c27b0;">45,678</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Pasien</h5>
                    <button class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Tambah Pasien
                    </button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" placeholder="Cari pasien...">
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pasien</th>
                                    <th>Kontak</th>
                                    <th>Kota</th>
                                    <th>Konsultasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>P001</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar">AW</div>
                                            <div>
                                                <div class="fw-semibold">Andi Wijaya</div>
                                                <small class="text-muted">Laki-laki, 35 tahun</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="d-block">📧 andi.wijaya@email.com</small>
                                        <small class="text-muted">📱 081234567890</small>
                                    </td>
                                    <td>Jakarta</td>
                                    <td><span class="badge badge-info-custom">12x</span></td>
                                    <td><span class="badge badge-success-custom">Aktif</span></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>P002</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar">BS</div>
                                            <div>
                                                <div class="fw-semibold">Budi Santoso</div>
                                                <small class="text-muted">Laki-laki, 42 tahun</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="d-block">📧 budi.santoso@email.com</small>
                                        <small class="text-muted">📱 081234567891</small>
                                    </td>
                                    <td>Bandung</td>
                                    <td><span class="badge badge-info-custom">8x</span></td>
                                    <td><span class="badge badge-success-custom">Aktif</span></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>P003</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar">CD</div>
                                            <div>
                                                <div class="fw-semibold">Citra Dewi</div>
                                                <small class="text-muted">Perempuan, 28 tahun</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="d-block">📧 citra.dewi@email.com</small>
                                        <small class="text-muted">📱 081234567892</small>
                                    </td>
                                    <td>Surabaya</td>
                                    <td><span class="badge badge-info-custom">15x</span></td>
                                    <td><span class="badge badge-success-custom">Aktif</span></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        `,
    },

    dokter: {
        title: "Dokter",
        subtitle: "Kelola dan pantau dokter",
        content: "",
        load: async function () {
            const query = window.location.search;
            const res = await fetch("/admin/dokter/html" + query);
            return await res.text();
        },
    },

    konsultasi: {
        title: "Konsultasi Chat",
        subtitle: "Kelola dan pantau konsultasi chat",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Konsultasi Hari Ini</p>
                            <h2 class="stat-value">234</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Sedang Berlangsung</p>
                            <h2 class="stat-value text-success">12</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Menunggu</p>
                            <h2 class="stat-value text-warning">8</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Selesai</p>
                            <h2 class="stat-value text-primary">214</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Konsultasi</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Semua</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Berlangsung</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Menunggu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Selesai</a>
                        </li>
                    </ul>

                    <div class="list-item">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">AW</div>
                                <div>
                                    <h6 class="mb-1">Andi Wijaya</h6>
                                    <p class="text-muted mb-1 small">Dr. Sarah Johnson • Kardiologi</p>
                                    <small class="text-muted">Keluhan: Nyeri dada sebelah kiri</small>
                                </div>
                            </div>
                            <span class="badge badge-success-custom">Berlangsung</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3 small text-muted">
                                <span>ID: C001</span>
                                <span>09:00</span>
                                <span>15 menit</span>
                                <span class="badge badge-info-custom">CHAT</span>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Monitor
                            </button>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">BS</div>
                                <div>
                                    <h6 class="mb-1">Budi Santoso</h6>
                                    <p class="text-muted mb-1 small">Dr. Michael Chen • Dermatologi</p>
                                    <small class="text-muted">Keluhan: Ruam kulit di tangan</small>
                                </div>
                            </div>
                            <span class="badge badge-warning-custom">Menunggu</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3 small text-muted">
                                <span>ID: C002</span>
                                <span>09:15</span>
                                <span>8 menit</span>
                                <span class="badge badge-info-custom">CHAT</span>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Monitor
                            </button>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">CD</div>
                                <div>
                                    <h6 class="mb-1">Citra Dewi</h6>
                                    <p class="text-muted mb-1 small">Dr. Lisa Anderson • Pediatri</p>
                                    <small class="text-muted">Keluhan: Demam anak 2 hari</small>
                                </div>
                            </div>
                            <span class="badge badge-info-custom">Selesai</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3 small text-muted">
                                <span>ID: C003</span>
                                <span>09:30</span>
                                <span>20 menit</span>
                                <span class="badge" style="background: #f3e5f5; color: #9c27b0;">VIDEO</span>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Monitor
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },

    klikhome: {
        title: "KlikHome Service",
        subtitle: "Kelola dan pantau layanan home service",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Layanan Hari Ini</p>
                            <h2 class="stat-value">45</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Sedang Berlangsung</p>
                            <h2 class="stat-value text-success">8</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Terjadwal</p>
                            <h2 class="stat-value text-primary">12</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Revenue Hari Ini</p>
                            <h2 class="stat-value" style="color: #9c27b0;">15.2M</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Layanan KlikHome</h5>
                    <button class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Jadwalkan Layanan
                    </button>
                </div>
                <div class="card-body">
                    <div class="list-item">
                        <div class="d-flex gap-3 mb-3">
                            <div class="avatar" style="background: #ff9800;">
                                <i class="bi bi-house-heart-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1">Tes Lab COVID-19</h6>
                                        <p class="text-muted mb-2 small">Pasien: Andi Wijaya • Perawat Linda</p>
                                        <p class="text-muted mb-0 small">
                                            <i class="bi bi-geo-alt-fill"></i>
                                            Jl. Sudirman No. 123, Jakarta Selatan
                                        </p>
                                    </div>
                                    <span class="badge badge-info-custom">Terjadwal</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-3 small text-muted">
                                        <span>ID: HS001</span>
                                        <span>2024-12-04 • 09:00</span>
                                        <span class="text-primary fw-semibold">Rp 250.000</span>
                                    </div>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>
                                        <button class="btn btn-outline-secondary">
                                            <i class="bi bi-geo-alt"></i> Tracking
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex gap-3 mb-3">
                            <div class="avatar" style="background: #4caf50;">
                                <i class="bi bi-house-heart-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1">Vaksinasi Influenza</h6>
                                        <p class="text-muted mb-2 small">Pasien: Budi Santoso • Perawat Diana</p>
                                        <p class="text-muted mb-0 small">
                                            <i class="bi bi-geo-alt-fill"></i>
                                            Jl. Gatot Subroto No. 45, Jakarta Pusat
                                        </p>
                                    </div>
                                    <span class="badge badge-success-custom">Berlangsung</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-3 small text-muted">
                                        <span>ID: HS002</span>
                                        <span>2024-12-04 • 10:30</span>
                                        <span class="text-primary fw-semibold">Rp 150.000</span>
                                    </div>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>
                                        <button class="btn btn-outline-secondary">
                                            <i class="bi bi-geo-alt"></i> Tracking
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex gap-3 mb-3">
                            <div class="avatar" style="background: #2196f3;">
                                <i class="bi bi-house-heart-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1">Vitamin Booster</h6>
                                        <p class="text-muted mb-2 small">Pasien: Citra Dewi • Perawat Sarah</p>
                                        <p class="text-muted mb-0 small">
                                            <i class="bi bi-geo-alt-fill"></i>
                                            Jl. Thamrin No. 67, Jakarta Pusat
                                        </p>
                                    </div>
                                    <span class="badge bg-secondary">Selesai</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-3 small text-muted">
                                        <span>ID: HS003</span>
                                        <span>2024-12-04 • 11:00</span>
                                        <span class="text-primary fw-semibold">Rp 300.000</span>
                                    </div>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>
                                        <button class="btn btn-outline-secondary">
                                            <i class="bi bi-geo-alt"></i> Tracking
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },

    apotek: {
        title: "Apotek Online",
        subtitle: "Kelola dan pantau apotek online",
        content: "",
        load: async function () {
            const query = window.location.search;
            const res = await fetch("/admin/apotek/html" + query);
            return await res.text();
        },
    },

    // apotek: {
    //     title: 'Apotek Online',
    //     subtitle: 'Kelola dan pantau apotek online',
    //     content: `
    //         <div class="row g-4 mb-4 fade-in">
    //             <div class="col-xl-3 col-md-6">
    //                 <div class="card stat-card">
    //                     <div class="card-body">
    //                         <p class="text-muted mb-2">Total Produk</p>
    //                         <h2 class="stat-value">1,245</h2>
    //                     </div>
    //                 </div>
    //             </div>
    //             <div class="col-xl-3 col-md-6">
    //                 <div class="card stat-card">
    //                     <div class="card-body">
    //                         <p class="text-muted mb-2">Pesanan Hari Ini</p>
    //                         <h2 class="stat-value text-primary">567</h2>
    //                     </div>
    //                 </div>
    //             </div>
    //             <div class="col-xl-3 col-md-6">
    //                 <div class="card stat-card">
    //                     <div class="card-body">
    //                         <p class="text-muted mb-2">Revenue Hari Ini</p>
    //                         <h2 class="stat-value text-success">28.5M</h2>
    //                     </div>
    //                 </div>
    //             </div>
    //             <div class="col-xl-3 col-md-6">
    //                 <div class="card stat-card">
    //                     <div class="card-body">
    //                         <p class="text-muted mb-2">Stok Rendah</p>
    //                         <h2 class="stat-value text-warning">34</h2>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>

    //         <div class="row g-4">
    //             <div class="col-lg-8">
    //                 <div class="card fade-in">
    //                     <div class="card-header d-flex justify-content-between align-items-center">
    //                         <h5 class="mb-0">Daftar Produk</h5>
    //                         <button class="btn btn-primary">
    //                             <i class="bi bi-plus-lg"></i> Tambah Produk
    //                         </button>
    //                     </div>
    //                     <div class="card-body">
    //                         <div class="list-item">
    //                             <div class="d-flex gap-3 align-items-start">
    //                                 <div class="bg-light rounded p-3" style="width: 64px; height: 64px;">
    //                                     <i class="bi bi-capsule-pill" style="font-size: 32px; color: #4fc3f7;"></i>
    //                                 </div>
    //                                 <div class="flex-grow-1">
    //                                     <div class="d-flex justify-content-between align-items-start mb-2">
    //                                         <div>
    //                                             <h6 class="mb-1">Paracetamol 500mg</h6>
    //                                             <p class="text-muted mb-0 small">Analgesik • Kimia Farma</p>
    //                                         </div>
    //                                         <span class="badge badge-success-custom">Tersedia</span>
    //                                     </div>
    //                                     <div class="mb-2">
    //                                         <div class="d-flex justify-content-between small mb-1">
    //                                             <span class="text-muted">Stok</span>
    //                                             <span>1250 / 1000</span>
    //                                         </div>
    //                                         <div class="progress" style="height: 6px;">
    //                                             <div class="progress-bar" style="width: 100%;"></div>
    //                                         </div>
    //                                     </div>
    //                                     <div class="d-flex justify-content-between align-items-center">
    //                                         <div class="d-flex gap-3 small text-muted">
    //                                             <span>ID: PR001</span>
    //                                             <span>Exp: Dec 2025</span>
    //                                             <span class="text-primary fw-semibold">Rp 5.000</span>
    //                                         </div>
    //                                         <div class="btn-group btn-group-sm">
    //                                             <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
    //                                             <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>

    //                         <div class="list-item">
    //                             <div class="d-flex gap-3 align-items-start">
    //                                 <div class="bg-light rounded p-3" style="width: 64px; height: 64px;">
    //                                     <i class="bi bi-capsule-pill" style="font-size: 32px; color: #4fc3f7;"></i>
    //                                 </div>
    //                                 <div class="flex-grow-1">
    //                                     <div class="d-flex justify-content-between align-items-start mb-2">
    //                                         <div>
    //                                             <h6 class="mb-1">Amoxicillin 500mg</h6>
    //                                             <p class="text-muted mb-0 small">Antibiotik • Kalbe Farma</p>
    //                                         </div>
    //                                         <span class="badge badge-warning-custom">Stok Rendah</span>
    //                                     </div>
    //                                     <div class="mb-2">
    //                                         <div class="d-flex justify-content-between small mb-1">
    //                                             <span class="text-muted">Stok</span>
    //                                             <span>45 / 200</span>
    //                                         </div>
    //                                         <div class="progress" style="height: 6px;">
    //                                             <div class="progress-bar bg-warning" style="width: 22.5%;"></div>
    //                                         </div>
    //                                     </div>
    //                                     <div class="d-flex justify-content-between align-items-center">
    //                                         <div class="d-flex gap-3 small text-muted">
    //                                             <span>ID: PR002</span>
    //                                             <span>Exp: Mar 2025</span>
    //                                             <span class="text-primary fw-semibold">Rp 15.000</span>
    //                                         </div>
    //                                         <div class="btn-group btn-group-sm">
    //                                             <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
    //                                             <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
    //                                         </div>
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>

    //             <div class="col-lg-4">
    //                 <div class="card fade-in">
    //                     <div class="card-header">
    //                         <h5 class="mb-0">Pesanan Terbaru</h5>
    //                     </div>
    //                     <div class="card-body">
    //                         <div class="p-3 mb-2 rounded bg-light">
    //                             <div class="d-flex justify-content-between align-items-start mb-2">
    //                                 <div>
    //                                     <h6 class="mb-1">Andi Wijaya</h6>
    //                                     <p class="text-muted mb-0 small">3 item • Rp 125.000</p>
    //                                 </div>
    //                                 <span class="badge badge-info-custom">Diproses</span>
    //                             </div>
    //                             <small class="text-muted">5 menit lalu</small>
    //                         </div>

    //                         <div class="p-3 mb-2 rounded bg-light">
    //                             <div class="d-flex justify-content-between align-items-start mb-2">
    //                                 <div>
    //                                     <h6 class="mb-1">Budi Santoso</h6>
    //                                     <p class="text-muted mb-0 small">5 item • Rp 250.000</p>
    //                                 </div>
    //                                 <span class="badge" style="background: #f3e5f5; color: #9c27b0;">Dikirim</span>
    //                             </div>
    //                             <small class="text-muted">15 menit lalu</small>
    //                         </div>

    //                         <div class="p-3 rounded bg-light">
    //                             <div class="d-flex justify-content-between align-items-start mb-2">
    //                                 <div>
    //                                     <h6 class="mb-1">Citra Dewi</h6>
    //                                     <p class="text-muted mb-0 small">2 item • Rp 75.000</p>
    //                                 </div>
    //                                 <span class="badge badge-success-custom">Selesai</span>
    //                             </div>
    //                             <small class="text-muted">1 jam lalu</small>
    //                         </div>

    //                         <button class="btn btn-outline-primary w-100 mt-3">Lihat Semua Pesanan</button>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>
    //     `
    // },

    artikel: {
        title: "Artikel Kesehatan",
        subtitle: "Kelola dan pantau artikel kesehatan",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Artikel</p>
                            <h2 class="stat-value">234</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Published</p>
                            <h2 class="stat-value text-success">189</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Views</p>
                            <h2 class="stat-value text-primary">1.2M</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Engagement Rate</p>
                            <h2 class="stat-value" style="color: #9c27b0;">8.5%</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Artikel</h5>
                    <button class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Tulis Artikel
                    </button>
                </div>
                <div class="card-body">
                    <div class="list-item">
                        <div class="d-flex gap-3">
                            <div class="bg-secondary rounded" style="width: 96px; height: 96px; flex-shrink: 0;"></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-2">10 Tips Menjaga Kesehatan Jantung di Usia Muda</h6>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <div class="avatar" style="width: 24px; height: 24px; font-size: 10px;">SJ</div>
                                            <small class="text-muted">Dr. Sarah Johnson • Kardiologi</small>
                                        </div>
                                    </div>
                                    <span class="badge badge-success-custom">Published</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-3 small text-muted">
                                        <span><i class="bi bi-eye"></i> 12,453</span>
                                        <span><i class="bi bi-heart"></i> 892</span>
                                        <span>2 hari lalu</span>
                                    </div>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex gap-3">
                            <div class="bg-secondary rounded" style="width: 96px; height: 96px; flex-shrink: 0;"></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-2">Pentingnya Vaksinasi untuk Anak: Panduan Lengkap</h6>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <div class="avatar" style="width: 24px; height: 24px; font-size: 10px;">LA</div>
                                            <small class="text-muted">Dr. Lisa Anderson • Pediatri</small>
                                        </div>
                                    </div>
                                    <span class="badge badge-success-custom">Published</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-3 small text-muted">
                                        <span><i class="bi bi-eye"></i> 8,932</span>
                                        <span><i class="bi bi-heart"></i> 654</span>
                                        <span>3 hari lalu</span>
                                    </div>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex gap-3">
                            <div class="bg-secondary rounded" style="width: 96px; height: 96px; flex-shrink: 0;"></div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-2">Cara Mengatasi Stres dan Anxiety di Tempat Kerja</h6>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <div class="avatar" style="width: 24px; height: 24px; font-size: 10px;">AL</div>
                                            <small class="text-muted">Dr. Amanda Lee • Psikiatri</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-secondary">Draft</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex gap-3 small text-muted">
                                        <span><i class="bi bi-eye"></i> 6,721</span>
                                        <span><i class="bi bi-heart"></i> 423</span>
                                        <span>5 hari lalu</span>
                                    </div>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },

    "cek-kesehatan": {
        title: "Cek Kesehatan",
        subtitle: "Monitor pengecekan kesehatan mandiri",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Pengecekan</p>
                            <h2 class="stat-value">3,516</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Hari Ini</p>
                            <h2 class="stat-value text-primary">345</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Pengguna Aktif</p>
                            <h2 class="stat-value text-success">2,891</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Rata-rata/Hari</p>
                            <h2 class="stat-value" style="color: #9c27b0;">234</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card fade-in">
                        <div class="card-header">
                            <h5 class="mb-0">Riwayat Pengecekan</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-item">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">AW</div>
                                        <div>
                                            <h6 class="mb-1">Andi Wijaya</h6>
                                            <p class="text-muted mb-0 small">Kalkulator BMI</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="text-end">
                                            <small class="text-muted d-block">Hasil: <span class="fw-semibold">Normal</span></small>
                                            <small class="text-primary fw-semibold">Nilai: 22.5</small>
                                        </div>
                                        <span class="badge badge-success-custom">Normal</span>
                                    </div>
                                </div>
                            </div>

                            <div class="list-item">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">BS</div>
                                        <div>
                                            <h6 class="mb-1">Budi Santoso</h6>
                                            <p class="text-muted mb-0 small">Cek Tekanan Darah</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="text-end">
                                            <small class="text-muted d-block">Hasil: <span class="fw-semibold">Tinggi</span></small>
                                            <small class="text-primary fw-semibold">Nilai: 140/90</small>
                                        </div>
                                        <span class="badge badge-danger-custom">Tinggi</span>
                                    </div>
                                </div>
                            </div>

                            <div class="list-item">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">CD</div>
                                        <div>
                                            <h6 class="mb-1">Citra Dewi</h6>
                                            <p class="text-muted mb-0 small">Cek Gula Darah</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="text-end">
                                            <small class="text-muted d-block">Hasil: <span class="fw-semibold">Normal</span></small>
                                            <small class="text-primary fw-semibold">Nilai: 95 mg/dL</small>
                                        </div>
                                        <span class="badge badge-success-custom">Normal</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card fade-in">
                        <div class="card-header">
                            <h5 class="mb-0">Jenis Pengecekan</h5>
                        </div>
                        <div class="card-body">
                            <div class="p-3 mb-3 rounded bg-light">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <div class="stat-icon" style="width: 40px; height: 40px; background: rgba(33, 150, 243, 0.1); color: #2196f3;">
                                        <i class="bi bi-activity"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Kalkulator BMI</h6>
                                        <small class="text-muted">1,234 pengecekan</small>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 mb-3 rounded bg-light">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <div class="stat-icon" style="width: 40px; height: 40px; background: rgba(244, 67, 54, 0.1); color: #f44336;">
                                        <i class="bi bi-heart-pulse"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Cek Tekanan Darah</h6>
                                        <small class="text-muted">892 pengecekan</small>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 mb-3 rounded bg-light">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <div class="stat-icon" style="width: 40px; height: 40px; background: rgba(156, 39, 176, 0.1); color: #9c27b0;">
                                        <i class="bi bi-droplet"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Cek Gula Darah</h6>
                                        <small class="text-muted">756 pengecekan</small>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 rounded bg-light">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <div class="stat-icon" style="width: 40px; height: 40px; background: rgba(255, 152, 0, 0.1); color: #ff9800;">
                                        <i class="bi bi-clipboard-pulse"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Cek Kolesterol</h6>
                                        <small class="text-muted">634 pengecekan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },

    program: {
        title: "Program Kesehatan",
        subtitle: "Kelola program kesehatan",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Program</p>
                            <h2 class="stat-value">69</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Program Aktif</p>
                            <h2 class="stat-value text-success">42</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Peserta</p>
                            <h2 class="stat-value text-primary">1,336</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Completion Rate</p>
                            <h2 class="stat-value" style="color: #9c27b0;">72%</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Program</h5>
                    <button class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Buat Program
                    </button>
                </div>
                <div class="card-body">
                    <div class="list-item">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1">Program Diabetes Management</h6>
                                    <p class="text-muted mb-0 small">Penyakit Kronis</p>
                                </div>
                                <span class="badge badge-success-custom">Active</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span>65%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar" style="width: 65%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3 small text-muted">
                                <span><i class="bi bi-people"></i> 234 peserta</span>
                                <span><i class="bi bi-calendar"></i> 3 bulan</span>
                                <span>Mulai: 1 Jan 2024</span>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1">Quit Smoking Support</h6>
                                    <p class="text-muted mb-0 small">Lifestyle</p>
                                </div>
                                <span class="badge badge-success-custom">Active</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span>42%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar" style="width: 42%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3 small text-muted">
                                <span><i class="bi bi-people"></i> 189 peserta</span>
                                <span><i class="bi bi-calendar"></i> 6 minggu</span>
                                <span>Mulai: 15 Feb 2024</span>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1">Weight Loss Challenge</h6>
                                    <p class="text-muted mb-0 small">Nutrisi</p>
                                </div>
                                <span class="badge badge-success-custom">Active</span>
                            </div>
                            <div class="mb-2">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span>78%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar" style="width: 78%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3 small text-muted">
                                <span><i class="bi bi-people"></i> 456 peserta</span>
                                <span><i class="bi bi-calendar"></i> 2 bulan</span>
                                <span>Mulai: 1 Mar 2024</span>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },

    obat: {
        title: "Manajemen Obat",
        subtitle: "Kelola inventori obat",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Obat</p>
                            <h2 class="stat-value">1,245</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Stok Rendah</p>
                            <h2 class="stat-value text-warning">34</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Hampir Kadaluarsa</p>
                            <h2 class="stat-value" style="color: #ffc107;">12</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Nilai Inventori</p>
                            <h2 class="stat-value" style="color: #9c27b0;">45.2M</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card fade-in">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Daftar Obat</h5>
                            <button class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i> Tambah Obat
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="list-item">
                                <div class="d-flex gap-3">
                                    <div class="bg-light rounded p-3" style="width: 48px; height: 48px;">
                                        <i class="bi bi-capsule-pill" style="font-size: 24px; color: #4fc3f7;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="mb-1">Paracetamol 500mg</h6>
                                                <small class="text-muted">Analgesik • Kimia Farma</small>
                                            </div>
                                            <span class="badge badge-success-custom">Tersedia</span>
                                        </div>
                                        <div class="d-flex gap-3 small text-muted">
                                            <span>Stok: 1250</span>
                                            <span>Exp: Dec 2025</span>
                                            <span class="text-primary fw-semibold">Rp 5.000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="list-item">
                                <div class="d-flex gap-3">
                                    <div class="bg-light rounded p-3" style="width: 48px; height: 48px;">
                                        <i class="bi bi-capsule-pill" style="font-size: 24px; color: #4fc3f7;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="mb-1">Amoxicillin 500mg</h6>
                                                <small class="text-muted">Antibiotik • Kalbe Farma</small>
                                            </div>
                                            <span class="badge badge-warning-custom">Stok Rendah</span>
                                        </div>
                                        <div class="d-flex gap-3 small text-muted">
                                            <span>Stok: 45</span>
                                            <span>Exp: Mar 2025</span>
                                            <span class="text-primary fw-semibold">Rp 15.000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="list-item">
                                <div class="d-flex gap-3">
                                    <div class="bg-light rounded p-3" style="width: 48px; height: 48px;">
                                        <i class="bi bi-capsule-pill" style="font-size: 24px; color: #4fc3f7;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="mb-1">Vitamin C 1000mg</h6>
                                                <small class="text-muted">Vitamin • Kalbe Farma</small>
                                            </div>
                                            <span class="badge badge-success-custom">Tersedia</span>
                                        </div>
                                        <div class="d-flex gap-3 small text-muted">
                                            <span>Stok: 890</span>
                                            <span>Exp: Aug 2025</span>
                                            <span class="text-primary fw-semibold">Rp 25.000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card fade-in mb-4">
                        <div class="card-header bg-warning bg-opacity-10">
                            <h6 class="mb-0 text-warning">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Hampir Kadaluarsa
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="p-3 mb-2 rounded border border-warning">
                                <h6 class="mb-1">Omeprazole 20mg</h6>
                                <small class="text-muted d-block mb-2">Exp: Jan 2025</small>
                                <div class="d-flex justify-content-between">
                                    <small>Stok: 156 unit</small>
                                    <span class="badge badge-warning-custom">28 hari lagi</span>
                                </div>
                            </div>

                            <div class="p-3 mb-2 rounded border border-warning">
                                <h6 class="mb-1">Simvastatin 20mg</h6>
                                <small class="text-muted d-block mb-2">Exp: Feb 2025</small>
                                <div class="d-flex justify-content-between">
                                    <small>Stok: 89 unit</small>
                                    <span class="badge badge-warning-custom">58 hari lagi</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card fade-in">
                        <div class="card-header bg-danger bg-opacity-10">
                            <h6 class="mb-0 text-danger">
                                <i class="bi bi-box-seam me-2"></i>
                                Stok Rendah
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="p-3 mb-2 rounded border border-danger">
                                <h6 class="mb-1">Amoxicillin 500mg</h6>
                                <div class="d-flex justify-content-between">
                                    <small>Stok: 45</small>
                                    <span class="badge badge-danger-custom">Rendah</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },

    "rekam-medis": {
        title: "Rekam Medis",
        subtitle: "Database rekam medis pasien",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Rekam Medis</p>
                            <h2 class="stat-value">8,234</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Bulan Ini</p>
                            <h2 class="stat-value text-primary">567</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Dengan Resep</p>
                            <h2 class="stat-value text-success">6,789</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Pending</p>
                            <h2 class="stat-value text-warning">45</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header">
                    <h5 class="mb-0">Rekam Medis Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="list-item">
                        <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">AW</div>
                                <div>
                                    <h6 class="mb-1">Andi Wijaya</h6>
                                    <p class="text-muted mb-1 small">Diagnosis: <span class="fw-semibold text-dark">Hipertensi Stage 1</span></p>
                                    <small class="text-muted">Dr. Sarah Johnson • Konsultasi Online</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge badge-success-custom">Selesai</span>
                                <span class="badge badge-info-custom">
                                    <i class="bi bi-file-medical"></i> Resep
                                </span>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Lihat
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">BS</div>
                                <div>
                                    <h6 class="mb-1">Budi Santoso</h6>
                                    <p class="text-muted mb-1 small">Diagnosis: <span class="fw-semibold text-dark">Dermatitis Atopik</span></p>
                                    <small class="text-muted">Dr. Michael Chen • Konsultasi Chat</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge badge-success-custom">Selesai</span>
                                <span class="badge badge-info-custom">
                                    <i class="bi bi-file-medical"></i> Resep
                                </span>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Lihat
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">CD</div>
                                <div>
                                    <h6 class="mb-1">Citra Dewi</h6>
                                    <p class="text-muted mb-1 small">Diagnosis: <span class="fw-semibold text-dark">ISPA</span></p>
                                    <small class="text-muted">Dr. Lisa Anderson • KlikHome</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge badge-success-custom">Selesai</span>
                                <span class="badge badge-info-custom">
                                    <i class="bi bi-file-medical"></i> Resep
                                </span>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Lihat
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">DK</div>
                                <div>
                                    <h6 class="mb-1">Dedi Kurniawan</h6>
                                    <p class="text-muted mb-1 small">Diagnosis: <span class="fw-semibold text-dark">Gastritis</span></p>
                                    <small class="text-muted">Dr. James Wilson • Konsultasi Online</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge badge-warning-custom">Pending</span>
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Lihat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },

    laporan: {
        title: "Laporan & Analitik",
        subtitle: "Analitik dan laporan keuangan",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-2">Total Revenue</p>
                                    <h2 class="stat-value mb-2">120.5M</h2>
                                    <small class="text-success">
                                        <i class="bi bi-arrow-up"></i> +18.2%
                                    </small>
                                </div>
                                <div class="stat-icon" style="background: rgba(156, 39, 176, 0.1); color: #9c27b0;">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-2">Total Konsultasi</p>
                                    <h2 class="stat-value mb-2">9,636</h2>
                                    <small class="text-success">
                                        <i class="bi bi-arrow-up"></i> +12.5%
                                    </small>
                                </div>
                                <div class="stat-icon bg-info bg-opacity-10 text-info">
                                    <i class="bi bi-chat-dots-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-2">New Patients</p>
                                    <h2 class="stat-value mb-2">5,739</h2>
                                    <small class="text-success">
                                        <i class="bi bi-arrow-up"></i> +15.8%
                                    </small>
                                </div>
                                <div class="stat-icon bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-2">Avg. Consultation</p>
                                    <h2 class="stat-value mb-2">1,606</h2>
                                    <small class="text-danger">
                                        <i class="bi bi-arrow-down"></i> -2.4%
                                    </small>
                                </div>
                                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-bar-chart-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Performa Bulanan (6 Bulan Terakhir)</h5>
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-download"></i> Export
                    </button>
                </div>
                <div class="card-body">
                    <div class="list-item">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-gradient-primary text-white rounded p-2 fw-bold" style="width: 50px; text-align: center;">
                                    Jan
                                </div>
                                <div>
                                    <h6 class="mb-1">Rp 45.600.000</h6>
                                    <small class="text-muted">1,234 konsultasi • 892 pasien</small>
                                </div>
                            </div>
                            <span class="badge badge-success-custom">
                                <i class="bi bi-arrow-up"></i> +2.5%
                            </span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: 61%;"></div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-gradient-primary text-white rounded p-2 fw-bold" style="width: 50px; text-align: center;">
                                    Feb
                                </div>
                                <div>
                                    <h6 class="mb-1">Rp 52.300.000</h6>
                                    <small class="text-muted">1,456 konsultasi • 1,023 pasien</small>
                                </div>
                            </div>
                            <span class="badge badge-success-custom">
                                <i class="bi bi-arrow-up"></i> +14.7%
                            </span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: 70%;"></div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-gradient-primary text-white rounded p-2 fw-bold" style="width: 50px; text-align: center;">
                                    Mar
                                </div>
                                <div>
                                    <h6 class="mb-1">Rp 61.200.000</h6>
                                    <small class="text-muted">1,678 konsultasi • 1,156 pasien</small>
                                </div>
                            </div>
                            <span class="badge badge-success-custom">
                                <i class="bi bi-arrow-up"></i> +17.0%
                            </span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: 82%;"></div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-gradient-primary text-white rounded p-2 fw-bold" style="width: 50px; text-align: center;">
                                    Apr
                                </div>
                                <div>
                                    <h6 class="mb-1">Rp 55.800.000</h6>
                                    <small class="text-muted">1,523 konsultasi • 1,089 pasien</small>
                                </div>
                            </div>
                            <span class="badge badge-danger-custom">
                                <i class="bi bi-arrow-down"></i> -8.8%
                            </span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar" style="width: 74%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },
    aplikasi: {
        title: "Aplikasi Mitra Dokter",
        subtitle: "Pendaftaran mitra dokter (dummy)",
        content: `
        <div class="row g-4 mb-4 fade-in">

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card">
                    <div class="card-body">
                        <p class="text-muted mb-2">Total Pengajuan</p>
                        <h2 class="stat-value">12</h2>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stat-card">
                    <div class="card-body">
                        <p class="text-muted mb-2">Belum Diverifikasi</p>
                        <h2 class="stat-value text-warning">5</h2>
                    </div>
                </div>
            </div>

        </div>


        <div class="card fade-in">
            <div class="card-header">
                <h5 class="mb-0">Daftar Pengajuan Mitra (Dummy)</h5>
            </div>

            <div class="card-body">

                <!-- ======================= DUMMY 1 ======================= -->
                <div class="list-item d-flex align-items-center justify-content-between py-3 px-2">

                    <!-- LEFT -->
                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                        <div class="avatar">AW</div>
                        <div>
                            <h6 class="mb-1">dr. Andi Wijaya, Sp.JP</h6>
                            <small class="text-muted">Spesialis Jantung • STR-001234</small>
                        </div>
                    </div>

                    <!-- STATUS BADGE -->
                    <span id="status-1" class="badge badge-warning-custom me-3">pending</span>

                    <!-- DROPDOWN -->
                    <div class="dropdown me-3">
                        <button class="btn btn-sm btn-light border dropdown-toggle" data-bs-toggle="dropdown">
                            Ubah Status
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="setStatus(1,'pending')">Pending</a></li>
                            <li><a class="dropdown-item" onclick="setStatus(1,'approved')">Approved</a></li>
                            <li><a class="dropdown-item" onclick="setStatus(1,'rejected')">Rejected</a></li>
                        </ul>
                    </div>

                    <!-- BUTTON DETAIL -->
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailApp1">
                        <i class="bi bi-eye"></i> Detail
                    </button>
                </div>


                <!-- ======================= DUMMY 2 ======================= -->
                <div class="list-item d-flex align-items-center justify-content-between py-3 px-2">

                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                        <div class="avatar">SM</div>
                        <div>
                            <h6 class="mb-1">dr. Sarah Mulyani</h6>
                            <small class="text-muted">Dokter Umum • STR-009988</small>
                        </div>
                    </div>

                    <span id="status-2" class="badge badge-success-custom me-3">approved</span>

                    <div class="dropdown me-3">
                        <button class="btn btn-sm btn-light border dropdown-toggle" data-bs-toggle="dropdown">
                            Ubah Status
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="setStatus(2,'pending')">Pending</a></li>
                            <li><a class="dropdown-item" onclick="setStatus(2,'approved')">Approved</a></li>
                            <li><a class="dropdown-item" onclick="setStatus(2,'rejected')">Rejected</a></li>
                        </ul>
                    </div>

                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailApp2">
                        <i class="bi bi-eye"></i> Detail
                    </button>
                </div>


                <!-- ======================= DUMMY 3 ======================= -->
                <div class="list-item d-flex align-items-center justify-content-between py-3 px-2">

                    <div class="d-flex align-items-center gap-3 flex-grow-1">
                        <div class="avatar">BS</div>
                        <div>
                            <h6 class="mb-1">dr. Budi Santoso</h6>
                            <small class="text-muted">Penyakit Dalam • STR-004422</small>
                        </div>
                    </div>

                    <span id="status-3" class="badge badge-danger-custom me-3">rejected</span>

                    <div class="dropdown me-3">
                        <button class="btn btn-sm btn-light border dropdown-toggle" data-bs-toggle="dropdown">
                            Ubah Status
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="setStatus(3,'pending')">Pending</a></li>
                            <li><a class="dropdown-item" onclick="setStatus(3,'approved')">Approved</a></li>
                            <li><a class="dropdown-item" onclick="setStatus(3,'rejected')">Rejected</a></li>
                        </ul>
                    </div>

                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailApp3">
                        <i class="bi bi-eye"></i> Detail
                    </button>
                </div>

            </div>
        </div>


        <!-- ======================= MODAL DETAIL 1 ======================= -->
        <div class="modal fade" id="detailApp1" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pengajuan — dr. Andi Wijaya, Sp.JP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <h6>Identitas</h6>
                        <p><strong>NIK:</strong> 3178123456789012</p>
                        <p><strong>Jenis Kelamin:</strong> Laki-laki</p>

                        <h6 class="mt-3">Kredensial Medis</h6>
                        <p><strong>STR:</strong> STR-001234</p>
                        <p><strong>SIP:</strong> SIP-56789</p>
                        <p><strong>Spesialisasi:</strong> Spesialis Jantung</p>

                        <h6 class="mt-3">Dokumen</h6>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-download"></i> Download Dokumen STR/SIP
                        </a>
                    </div>

                </div>
            </div>
        </div>


        <!-- ======================= MODAL DETAIL 2 ======================= -->
        <div class="modal fade" id="detailApp2" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pengajuan — dr. Sarah Mulyani</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <h6>Identitas</h6>
                        <p><strong>NIK:</strong> 3178987654321001</p>
                        <p><strong>Jenis Kelamin:</strong> Perempuan</p>

                        <h6 class="mt-3">Kredensial</h6>
                        <p><strong>STR:</strong> STR-009988</p>
                        <p><strong>SIP:</strong> SIP-22334</p>
                        <p><strong>Spesialisasi:</strong> Dokter Umum</p>

                        <h6 class="mt-3">Dokumen</h6>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-download"></i> Download Dokumen STR/SIP
                        </a>
                    </div>

                </div>
            </div>
        </div>


        <!-- ======================= MODAL DETAIL 3 ======================= -->
        <div class="modal fade" id="detailApp3" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pengajuan — dr. Budi Santoso</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <h6>Identitas</h6>
                        <p><strong>NIK:</strong> 3178001122334455</p>
                        <p><strong>Jenis Kelamin:</strong> Laki-laki</p>

                        <h6 class="mt-3">Kredensial</h6>
                        <p><strong>STR:</strong> STR-004422</p>
                        <p><strong>SIP:</strong> SIP-99887</p>
                        <p><strong>Spesialisasi:</strong> Spesialis Penyakit Dalam</p>

                        <h6 class="mt-3">Dokumen</h6>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-download"></i> Download Dokumen STR/SIP
                        </a>
                    </div>

                </div>
            </div>
        </div>


        <!-- ======================= STATUS SCRIPT ======================= -->
        <script>
            function setStatus(id, status) {
                const el = document.getElementById("status-" + id);
                el.className = "badge me-3";

                if (status === "pending") {
                    el.classList.add("badge-warning-custom");
                    el.textContent = "pending";
                }
                if (status === "approved") {
                    el.classList.add("badge-success-custom");
                    el.textContent = "approved";
                }
                if (status === "rejected") {
                    el.classList.add("badge-danger-custom");
                    el.textContent = "rejected";
                }
            }
        </script>
    `,
    },

    notifikasi: {
        title: "Notifikasi",
        subtitle: "Pusat notifikasi sistem",
        content: `
            <div class="row g-4 mb-4 fade-in">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Total Notifikasi</p>
                            <h2 class="stat-value">6</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Belum Dibaca</p>
                            <h2 class="stat-value text-warning">3</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Hari Ini</p>
                            <h2 class="stat-value text-primary">12</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card">
                        <div class="card-body">
                            <p class="text-muted mb-2">Minggu Ini</p>
                            <h2 class="stat-value" style="color: #9c27b0;">47</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Notifikasi</h5>
                    <div class="btn-group">
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-check-all"></i> Tandai Semua Dibaca
                        </button>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="p-3 mb-3 rounded border border-primary bg-primary bg-opacity-10">
                        <div class="d-flex gap-3">
                            <div class="stat-icon bg-primary text-white" style="width: 40px; height: 40px;">
                                <i class="bi bi-chat-dots-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-1">Konsultasi Baru</h6>
                                    <div class="bg-primary rounded-circle" style="width: 8px; height: 8px;"></div>
                                </div>
                                <p class="text-muted mb-2 small">
                                    Andi Wijaya memulai konsultasi dengan Dr. Sarah Johnson
                                </p>
                                <small class="text-muted">2 menit lalu</small>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 mb-3 rounded border border-warning bg-warning bg-opacity-10">
                        <div class="d-flex gap-3">
                            <div class="stat-icon bg-warning text-white" style="width: 40px; height: 40px;">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-1">Stok Obat Rendah</h6>
                                    <div class="bg-warning rounded-circle" style="width: 8px; height: 8px;"></div>
                                </div>
                                <p class="text-muted mb-2 small">
                                    Amoxicillin 500mg stok tersisa 45 unit
                                </p>
                                <small class="text-muted">15 menit lalu</small>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 mb-3 rounded bg-light">
                        <div class="d-flex gap-3">
                            <div class="stat-icon bg-success text-white" style="width: 40px; height: 40px;">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Pembayaran Berhasil</h6>
                                <p class="text-muted mb-2 small">
                                    Pembayaran Rp 150.000 dari Budi Santoso berhasil
                                </p>
                                <small class="text-muted">1 jam lalu</small>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 mb-3 rounded bg-light">
                        <div class="d-flex gap-3">
                            <div class="stat-icon text-white" style="width: 40px; height: 40px; background: #9c27b0;">
                                <i class="bi bi-info-circle-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Jadwal KlikHome</h6>
                                <p class="text-muted mb-2 small">
                                    Layanan vaksinasi untuk Citra Dewi dijadwalkan pukul 10:30
                                </p>
                                <small class="text-muted">2 jam lalu</small>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 rounded border border-danger bg-danger bg-opacity-10">
                        <div class="d-flex gap-3">
                            <div class="stat-icon bg-danger text-white" style="width: 40px; height: 40px;">
                                <i class="bi bi-exclamation-circle-fill"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-1">Obat Hampir Kadaluarsa</h6>
                                    <div class="bg-danger rounded-circle" style="width: 8px; height: 8px;"></div>
                                </div>
                                <p class="text-muted mb-2 small">
                                    Omeprazole 20mg akan kadaluarsa dalam 28 hari
                                </p>
                                <small class="text-muted">3 jam lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },

    pengaturan: {
        title: "Pengaturan",
        subtitle: "Konfigurasi sistem dan profil",
        content: `
            <div class="row g-4 fade-in">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="bi bi-person-circle me-2"></i>
                                Profil Admin
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" 
                                     class="rounded-circle" width="80" height="80" alt="Admin">
                                <div>
                                    <button class="btn btn-primary btn-sm mb-2">Ubah Foto</button>
                                    <div class="small text-muted">JPG, PNG max 2MB</div>
                                </div>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Depan</label>
                                    <input type="text" class="form-control" value="Admin">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Belakang</label>
                                    <input type="text" class="form-control" value="KlikDoc">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="admin@klikdoc.com">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" value="+62 812 3456 7890">
                                </div>
                            </div>
                            
                            <button class="btn btn-primary mt-3">Simpan Perubahan</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="bi bi-shield-lock me-2"></i>
                                Keamanan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Password Saat Ini</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control">
                            </div>
                            
                            <div class="alert alert-light border d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Two-Factor Authentication</h6>
                                    <small class="text-muted">Tambahkan lapisan keamanan ekstra</small>
                                </div>
                                <button class="btn btn-outline-primary btn-sm">Aktifkan</button>
                            </div>
                            
                            <button class="btn btn-primary">Update Password</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-secondary text-start">
                                    <i class="bi bi-bell me-2"></i> Notifikasi
                                </button>
                                <button class="btn btn-outline-secondary text-start">
                                    <i class="bi bi-palette me-2"></i> Tampilan
                                </button>
                                <button class="btn btn-outline-secondary text-start">
                                    <i class="bi bi-key me-2"></i> API Keys
                                </button>
                                <button class="btn btn-outline-secondary text-start">
                                    <i class="bi bi-globe me-2"></i> Bahasa & Region
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Sistem</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Versi</span>
                                <span class="fw-semibold">v2.5.1</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Database</span>
                                <span class="fw-semibold">PostgreSQL</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Storage</span>
                                <span class="fw-semibold">45 GB / 100 GB</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Last Backup</span>
                                <span class="fw-semibold">Hari ini, 00:00</span>
                            </div>
                        </div>
                    </div>

                    <div class="card border-danger">
                        <div class="card-header bg-danger bg-opacity-10 border-danger">
                            <h6 class="mb-0 text-danger">Danger Zone</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-danger">Clear Cache</button>
                                <button class="btn btn-outline-danger">Reset Settings</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `,
    },
};

document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".list-group-item[data-page]");
    const contentEl = document.getElementById("content");
    const pageTitleEl = document.getElementById("pageTitle");
    const pageSubtitleEl = document.getElementById("pageSubtitle");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebarWrapper = document.getElementById("sidebar-wrapper");

    async function loadPage(pageName) {
        const page = pages[pageName];

        if (page.load) {
            contentEl.innerHTML = await page.load();
        } else {
            contentEl.innerHTML = page.content;
        }

        pageTitleEl.textContent = page.title;
        pageSubtitleEl.textContent = page.subtitle;
    }

    navLinks.forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const pageName = link.dataset.page;

            localStorage.setItem("lastPage", pageName);
            if(pageName === "dokter"){
                setTimeout(updateOnlineDoctorCount, 1000) 
            }
            loadPage(pageName);
        });
    });

    if (sidebarToggle) {
        sidebarToggle.addEventListener("click", () => {
            sidebarWrapper.classList.toggle("show");
        });
    }

    const lastPage = localStorage.getItem("lastPage") || "dashboard";
    loadPage(lastPage);
});
