const createToasts = () => {
    let toasts = $state([]);

    return {
        get value() {
            return toasts
        },

        set value(value) {
            toasts = value
        },

        add(toast) {
            toasts.push(toast);
        },

        remove(index) {
            toasts.splice(index, 1);
        }
    }
}

export const toasts = createToasts();
