/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            minHeight: {
                inherit: "inherit",
            },
            maxHeight: {
                default: "calc(100vh - 5em)",
            },
        },
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")["light"],
                },
                dark: {
                    ...require("daisyui/src/theming/themes")["dark"],
                },
            },
        ],
    },
};
