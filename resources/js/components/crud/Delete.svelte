<script>
    import {router} from "@inertiajs/svelte";
    import {pluralize, singularize} from "inflection";

    let {id, entity = undefined, plural = undefined} = $props();

    if (!entity) {
        plural = window.location.pathname.split("/")[1]
        entity = singularize(plural)
    }

    if (!plural) {
        plural = pluralize(entity);
    }
</script>

<button
    title={`Delete ${entity}`}
    class="btn btn-sm btn-soft btn-error btn-square"
    onclick={() => {
        if (confirm(`Are you sure you want to delete ${entity}?`)){
            router.delete(`/${plural}/${id}`);
        }
    }}
>
    <span class="iconify lucide--trash-2 size-4"></span>
</button>
