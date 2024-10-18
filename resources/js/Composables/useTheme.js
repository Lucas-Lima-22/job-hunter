import { ref, computed, onMounted, onBeforeUnmount } from 'vue';

export function useTheme() {
    const theme = ref('');
    const url = computed(() =>
        theme.value === 'dark' ? '/logo-dark.png' : '/logo.png'
    );

    const updateTheme = () => {
        if (localStorage.getItem('theme')) {
            theme.value = localStorage.getItem('theme');
        } else {
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                theme.value = 'dark';
            } else {
                theme.value = 'light';
            }
        }
    };

    const observeThemeChange = () => {
        const htmlElement = document.documentElement;

        const observer = new MutationObserver(() => {
            updateTheme();
        });

        observer.observe(htmlElement, {
            attributes: true,
            attributeFilter: ['data-theme'],
        });

        return observer;
    };

    onMounted(() => {
        updateTheme();
        const observer = observeThemeChange();

        onBeforeUnmount(() => {
            observer.disconnect();
        });
    });

    return {
        theme,
        url,
    };
}
