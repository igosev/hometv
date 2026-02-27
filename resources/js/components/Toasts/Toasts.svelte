<script>
    import {page} from "@inertiajs/svelte";
    import {toasts} from "./toasts.svelte.js";
    import {onMount, untrack} from "svelte";

    onMount(() => {
        toasts.add({
            type: "success",
            message: "Toasts updated successfully",
        })
    })

    $effect(()=>{
        if($page.flash?.message){
            untrack(() => toasts.add($page.flash.message))
        }
    })
</script>

<div class="toast toast-end z-30 max-w-80">
    {#each toasts.value as toast, index}
        <div class="alert flex justify-between items-start"
             class:alert-success={toast.type === "success"}
             class:alert-info={toast.type === "info"}
             class:alert-warning={toast.type === "warning"}
             class:alert-error={toast.type === "error"}
        >
            <span>{toast.message}</span>
            <button
                title="Close toast"
                class="btn btn-xs btn-square"
                class:btn-success={toast.type === "success"}
                class:btn-info={toast.type === "info"}
                class:btn-warning={toast.type === "warning"}
                class:btn-error={toast.type === "error"}
                onclick={() => toasts.remove(index)}
            >
                <span class="iconify lucide--x size-4"></span>
            </button>
        </div>
    {/each}
</div>
