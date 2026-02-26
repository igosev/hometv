<script>
    let {btn = undefined, header = "", body} = $props();

    let modal = $state();

    export const open = () => {
        modal.showModal()
    }

    export const close = () => {
        modal.close()
    }
</script>

{#if btn !== undefined}
    {@render btn(open)}
{/if}

<dialog bind:this={modal} class="modal">
    <div class="modal-box w-fit max-w-11/12 h-fit max-h-11/12" >
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="text-lg font-bold">{header}</h3>
        {@render body(close)}
    </div>

    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
