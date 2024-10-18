import { onMounted, watch } from 'vue';

export function useDropdownContent(user) {
    const fetchDropdownContent = () => {
        const dropdownItems = document.querySelectorAll('.dropdown-content');

        dropdownItems.forEach((item) => {
            item.addEventListener('click', () => {
                const dropdown = item.closest('.dropdown');
                const focusedElement = dropdown.querySelector(':focus');
                if (focusedElement) {
                    focusedElement.blur();
                }
            });
        });
    };

    onMounted(() => {
        fetchDropdownContent();
    });

    watch(user, (newValue) => {
        if (newValue) {
            fetchDropdownContent();
        }
    });
}
