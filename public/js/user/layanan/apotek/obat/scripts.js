document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("productDetailModal");

    const qtyMinus = document.querySelector(".qty-minus");
    const qtyPlus = document.querySelector(".qty-plus");
    const qtyInput = document.querySelector(".qty-input");

    const qtyField = document.getElementById("quantityField");
    const addToCartForm = document.getElementById("addToCartForm");

    qtyMinus.addEventListener("click", function () {
        let qty = parseInt(qtyInput.value);
        if (qty > 1) qty--;
        qtyInput.value = qty;
        qtyField.value = qty;
    });

    qtyPlus.addEventListener("click", function () {
        let qty = parseInt(qtyInput.value);
        qty++;
        qtyInput.value = qty;
        qtyField.value = qty;
    });

    modal.addEventListener("show.bs.modal", function (event) {
        const card = event.relatedTarget;

        const id = card.getAttribute("data-id");
        const submitRoute = card.getAttribute("data-submit-route");
        addToCartForm.action = submitRoute;

        qtyInput.value = 1;
        qtyField.value = 1;

        document.getElementById("modalProductName").innerText =
            card.getAttribute("data-name");
        document.getElementById("modalProductUnit").innerText =
            card.getAttribute("data-unit");
        document.getElementById("modalProductPrice").innerText =
            "Rp " + card.getAttribute("data-price");

        document.getElementById("modalProductDescription").innerText =
            card.getAttribute("data-description");
        document.getElementById("modalProductDosage").innerText =
            card.getAttribute("data-dosage");
        document.getElementById("modalProductType").innerText =
            card.getAttribute("data-type");

        const category = card.getAttribute("data-category");
        const badge = document.getElementById("modalCategoryBadge");
        badge.innerText = category;
        badge.className = "tag-badge big";

        if (category === "Obat Bebas") badge.classList.add("blue");
        else if (category === "Vitamin") badge.classList.add("green");
        else if (category === "Resep Dokter") badge.classList.add("red");

        const img = document.getElementById("modalProductImage");
        img.src =
            card.getAttribute("data-image") ||
            "https://via.placeholder.com/120?text=No+Image";
    });

    const params = new URLSearchParams(window.location.search);

    const searchInput = document.getElementById("searchInput");
    const sortSelect = document.getElementById("sortSelect");
    const categoryChecks = document.querySelectorAll(".cat-check");
    const minPrice = document.getElementById("minPrice");
    const maxPrice = document.getElementById("maxPrice");

    // INIT
    if (params.get("search")) searchInput.value = params.get("search");
    if (params.get("filter")) sortSelect.value = params.get("filter");

    const selectedCats = params.getAll("kategori");
    categoryChecks.forEach((ch) => {
        if (selectedCats.includes(ch.value)) ch.checked = true;
    });

    if (params.get("price_min")) minPrice.value = params.get("price_min");
    if (params.get("price_max")) maxPrice.value = params.get("price_max");

    // SEARCH
    searchInput.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
            params.set("search", searchInput.value.trim());
            window.location.search = params.toString();
        }
    });

    // SORT
    sortSelect.addEventListener("change", () => {
        params.set("filter", sortSelect.value);
        window.location.search = params.toString();
    });

    // CATEGORY
    /* ===============================
   CATEGORY USING JSON PARAM
=============================== */

    const catChecks = document.querySelectorAll(".cat-check");
    const allCheck = document.querySelector(".cat-all");

    function getSelectedCategoriesFromURL() {
        try {
            const raw = params.get("kategori_json");
            return raw ? JSON.parse(raw) : [];
        } catch {
            return [];
        }
    }

    function saveCategoriesToURL(selected) {
        const url = new URL(window.location.href);

        if (selected.length === catChecks.length) {
            // kalau semua dipilih → hapus param (mode SEMUA)
            url.searchParams.delete("kategori_json");
        } else {
            url.searchParams.set("kategori_json", JSON.stringify(selected));
        }

        window.location.href = url.toString();
    }

    // INIT
    let selected = getSelectedCategoriesFromURL();

    if (selected.length === 0) {
        // mode SEMUA
        allCheck.checked = true;
        catChecks.forEach((c) => (c.checked = true));
    } else {
        allCheck.checked = false;
        catChecks.forEach((c) => (c.checked = selected.includes(c.value)));
    }

    // Klik SEMUA
    allCheck.addEventListener("change", function () {
        if (this.checked) {
            catChecks.forEach((c) => (c.checked = true));
            saveCategoriesToURL([]); // mode ALL
        }
    });

    // Klik per kategori
    catChecks.forEach((ch) => {
        ch.addEventListener("change", () => {
            const sel = [...catChecks]
                .filter((c) => c.checked)
                .map((c) => c.value);

            if (sel.length === catChecks.length) {
                allCheck.checked = true;
                saveCategoriesToURL([]);
            } else {
                allCheck.checked = false;
                saveCategoriesToURL(sel);
            }
        });
    });

    // PRICE RANGE
    let priceTimer;
    function applyPrice() {
        const p = new URLSearchParams(window.location.search);

        minPrice.value
            ? p.set("price_min", minPrice.value)
            : p.delete("price_min");
        maxPrice.value
            ? p.set("price_max", maxPrice.value)
            : p.delete("price_max");

        window.location.search = p.toString();
    }

    minPrice.addEventListener("input", () => {
        clearTimeout(priceTimer);
        priceTimer = setTimeout(applyPrice, 800);
    });

    maxPrice.addEventListener("input", () => {
        clearTimeout(priceTimer);
        priceTimer = setTimeout(applyPrice, 800);
    });
});
