document.addEventListener("DOMContentLoaded", () => {
    const slider = document.querySelector(".promo-scroll-container");
    const indicatorsContainer = document.querySelector(".promo-indicators");
    const items = document.querySelectorAll(".promo-card-item");

    if (slider && items.length > 0) {
        let isDown = false;
        let startX;
        let scrollLeft;
        let autoScrollInterval;
        let currentActiveIndex = 0;

        if (indicatorsContainer) {
            indicatorsContainer.innerHTML = "";

            items.forEach((_, index) => {
                const dot = document.createElement("div");
                dot.classList.add("promo-dot");
                if (index === 0) dot.classList.add("active");

                dot.addEventListener("click", () => {
                    stopAutoScroll();
                    scrollToItem(index);
                    setTimeout(startAutoScroll, 5000);
                });

                indicatorsContainer.appendChild(dot);
            });
        }

        const updateActiveDot = () => {
            if (!indicatorsContainer) return;

            const dots = document.querySelectorAll(".promo-dot");
            const maxScrollLeft = slider.scrollWidth - slider.clientWidth;
            const currentScroll = slider.scrollLeft;

            let newActiveIndex = 0;

            if (Math.ceil(currentScroll) >= maxScrollLeft - 5) {
                newActiveIndex = items.length - 1;
            }
            else if (currentScroll <= 0) {
                newActiveIndex = 0;
            }
            else {
                const centerLine = currentScroll + slider.offsetWidth / 2;

                let minDistance = Infinity;
                items.forEach((item, index) => {
                    const itemCenter = item.offsetLeft + item.offsetWidth / 2;
                    const dist = Math.abs(centerLine - itemCenter);

                    if (dist < minDistance) {
                        minDistance = dist;
                        newActiveIndex = index;
                    }
                });
            }
            if (newActiveIndex !== currentActiveIndex) {
                dots.forEach((dot) => dot.classList.remove("active"));
                if (dots[newActiveIndex])
                    dots[newActiveIndex].classList.add("active");
                currentActiveIndex = newActiveIndex;
            }
        };

        const scrollToItem = (index) => {
            if (index < 0 || index >= items.length) return;
            const item = items[index];

            let targetScroll =
                item.offsetLeft - slider.offsetWidth / 2 + item.offsetWidth / 2;

            const maxScroll = slider.scrollWidth - slider.clientWidth;
            targetScroll = Math.max(0, Math.min(targetScroll, maxScroll));

            slider.scrollTo({
                left: targetScroll,
                behavior: "smooth",
            });

            currentActiveIndex = index;
            const dots = document.querySelectorAll(".promo-dot");
            dots.forEach((d) => d.classList.remove("active"));
            if (dots[index]) dots[index].classList.add("active");
        };

        slider.addEventListener("mousedown", (e) => {
            isDown = true;
            slider.classList.add("dragging");
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
            stopAutoScroll();
        });

        const stopDragging = () => {
            if (!isDown) return;
            isDown = false;
            slider.classList.remove("dragging");
            startAutoScroll();
        };

        slider.addEventListener("mouseleave", stopDragging);
        slider.addEventListener("mouseup", stopDragging);

        slider.addEventListener("mousemove", (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 1.5;
            slider.scrollLeft = scrollLeft - walk;
        });

        slider.addEventListener("scroll", updateActiveDot);

        function startAutoScroll() {
            stopAutoScroll(); // Clear existing
            autoScrollInterval = setInterval(() => {
                let nextIndex = currentActiveIndex + 1;

                // Jika sudah di akhir, balik ke awal
                if (nextIndex >= items.length) {
                    nextIndex = 0;
                }

                scrollToItem(nextIndex);
            }, 4000);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        updateActiveDot();
        startAutoScroll();
        slider.addEventListener("mouseenter", stopAutoScroll);
    }
});
