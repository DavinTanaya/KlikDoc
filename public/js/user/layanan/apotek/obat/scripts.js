document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("productDetailModal");

    modal.addEventListener("show.bs.modal", function (event) {
        const card = event.relatedTarget;

        // Ambil data dari HTML attributes
        const name = card.getAttribute("data-name");
        const unit = card.getAttribute("data-unit");
        const price = card.getAttribute("data-price");
        const category = card.getAttribute("data-category");
        const description = card.getAttribute("data-description");
        const dosage = card.getAttribute("data-dosage");
        const type = card.getAttribute("data-type");
        const image = card.getAttribute("data-image");

        // Inject ke modal
        document.getElementById("modalProductName").innerText = name;
        document.getElementById("modalProductUnit").innerText = unit;
        document.getElementById("modalProductPrice").innerText = "Rp " + price;

        document.getElementById("modalProductDescription").innerText =
            description;
        document.getElementById("modalProductDosage").innerText = dosage;
        document.getElementById("modalProductType").innerText = type;

        // Badge warna berdasarkan kategori
        const badge = document.getElementById("modalCategoryBadge");
        badge.innerText = category;

        badge.className = "tag-badge big"; // reset class

        if (category === "Obat Bebas") badge.classList.add("blue");
        else if (category === "Vitamin") badge.classList.add("green");
        else if (category === "Resep Dokter") badge.classList.add("red");

        // Gambar
        const img = document.getElementById("modalProductImage");
        if (image) {
            img.src = image;
        } else {
            img.src = "https://via.placeholder.com/120?text=No+Image";
        }
    });
});
