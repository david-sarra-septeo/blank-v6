document.addEventListener('DOMContentLoaded', function () {

    // INLINE POPUP
    const popupLink = document.querySelector(".popup-link");
    if (!popupLink) { } else {
        const inlineLightbox = GLightbox({
            selector: ".popup-link a, a.popup-link",
            skin: "inline-popup"
        });
    }

})