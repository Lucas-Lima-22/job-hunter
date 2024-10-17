let themeRef;
let urlRef;

function setValues(theme, url) {
    themeRef = theme;
    urlRef = url;
}

function updateThemeBasedOnLocalStorage() {
    themeRef.value = localStorage.getItem("theme")
        ? localStorage.getItem("theme")
        : window.matchMedia("(prefers-color-scheme: dark)").matches
        ? "dark"
        : "light";

    updateLogoUrl();
}

function initializeThemeObserver() {
    const observer = new MutationObserver((mutationsList) => {
        for (const mutation of mutationsList) {
            if (
                mutation.type === "attributes" &&
                mutation.target === document.documentElement
            ) {
                if (themeRef) {
                    themeRef.value =
                        document.documentElement.getAttribute("data-theme");
                    updateLogoUrl();
                }
            }
        }
    });

    observer.observe(document.documentElement, { attributes: true });
}

function updateLogoUrl() {
    if (themeRef) {
        urlRef.value = themeRef.value === "dark" ? "/logo-dark.png" : "/logo.png";
    }
}

export default {
    setValues,
    updateThemeBasedOnLocalStorage,
    initializeThemeObserver,
};
