document.addEventListener("DOMContentLoaded", function () {

    // 1. Find ALL instances of the slider
    const sliders = document.querySelectorAll('.pegasus-image-diff');

    // 2. Loop through each one and initialize independently
    sliders.forEach(slider => {
        initPegasusSlider(slider);
    });

    function initPegasusSlider(container) {
        // Scope variables strictly to THIS container
        const afterImage = container.querySelector(".pegasus-image-diff__image--after");
        const handle = container.querySelector(".pegasus-image-diff__handle");

        if (!afterImage || !handle) return; // Error safety

        let dragging = false;

        // Helper: Update CSS
        // clipPath: inset(top right bottom left)
        // Clip the after image from the left: BEFORE on left, AFTER on right
        // Invert percentage so drag-right reveals more AFTER
        const setPosition = (percentage) => {
            handle.style.left = `${percentage}%`;
            afterImage.style.clipPath = `inset(0 0 0 ${percentage}%)`;
        };

        // Set Initial State (50%)
        setPosition(50);

        // --- MOUSE EVENTS ---
        handle.addEventListener("mousedown", (e) => {
            dragging = true;
            e.preventDefault();
        });

        // Attach mouseup/move to window so you can drag outside the box
        // We only respond if 'dragging' is true for THIS specific closure
        window.addEventListener("mouseup", () => {
            dragging = false;
        });

        window.addEventListener("mousemove", (e) => {
            if (!dragging) return;
            moveHandler(e.clientX, container, setPosition);
        });

        // --- TOUCH EVENTS ---
        handle.addEventListener("touchstart", (e) => {
            dragging = true;
            e.preventDefault();
        });

        window.addEventListener("touchend", () => {
            dragging = false;
        });

        window.addEventListener("touchcancel", () => {
            dragging = false;
        });

        window.addEventListener("touchmove", (e) => {
            if (!dragging) return;
            moveHandler(e.touches[0].clientX, container, setPosition);
        });
    }

    // Shared Logic
    function moveHandler(clientX, container, callback) {
        const rect = container.getBoundingClientRect();
        const x = clientX - rect.left;

        let widthPercentage = (x / rect.width) * 100;

        // Constraint: Keep between 0 and 100
        widthPercentage = Math.max(0, Math.min(widthPercentage, 100));

        window.requestAnimationFrame(() => {
            callback(widthPercentage);
        });
    }
});
