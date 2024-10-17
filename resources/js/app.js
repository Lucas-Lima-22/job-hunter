import "./bootstrap";
import "../css/app.css";
import Layout from "./Layouts/Layout.vue";
import { createApp, h } from "vue";
import { createInertiaApp, Head } from "@inertiajs/vue3";

createInertiaApp({
    title: (title) => title,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Head", Head)
            .mount(el);
    },
});
