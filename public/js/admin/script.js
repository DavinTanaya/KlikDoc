// Page Templates
const pages = {
    dashboard: {
        title: "Dashboard Admin",
        subtitle: "Kelola dan pantau dashboard",
        content: "",
        load: async function () {
            const query = window.location.search;
            const res = await fetch("/admin/dashboard/html" + query);
            return await res.text();
        },
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
        content: "",
        load: async function () {
            const query = window.location.search;
            const res = await fetch("/admin/konsultasi/html" + query);
            return await res.text();
        },
    },

    klikhome: {
        title: "KlikHome Service",
        subtitle: "Kelola dan pantau layanan home service",
        content: "",
        load: async function () {
            const query = window.location.search;
            const res = await fetch("/admin/klikhome/html" + query);
            return await res.text();
        },
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

    artikel: {
        title: "Artikel Kesehatan",
        subtitle: "Kelola dan pantau artikel kesehatan",
        content: "",
        load: async function () {
            const query = window.location.search;
            const res = await fetch("/admin/artikel/html" + query);
            return await res.text();
        },
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
                                    <input type="email" class="form-control" value="admin@klikdoc.online">
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
                                <span class="fw-semibold">v8.0.44-0ubuntu0.24.04.1 (Ubuntu)</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Database</span>
                                <span class="fw-semibold">MySQL</span>
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
            if (pageName === "dokter") {
                setTimeout(updateOnlineDoctorCount, 1000);
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
