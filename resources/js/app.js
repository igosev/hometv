import { createInertiaApp } from '@inertiajs/svelte'
import { mount } from 'svelte'

try {
    const localStorageItem = localStorage.getItem("__NEXUS_CONFIG_v3.0__");
    // console.log(localStorageItem);
    if (localStorageItem) {
        const theme = JSON.parse(localStorageItem).theme;
        if (theme !== "system") {
            document.documentElement.setAttribute("data-theme", theme);
        }
    }
} catch (err) {
    console.log(err);
}

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true })
        return pages[`./Pages/${name}.svelte`]
    },
    setup({ el, App, props }) {
        mount(App, { target: el, props })
    },
})
