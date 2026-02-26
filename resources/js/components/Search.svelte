<script>
    import { router } from '@inertiajs/svelte'

    // console.log();
    let {request = $bindable(), placeholder = "Placeholder"} = $props();
    const onclick = () => {
        request.page = 1;
        router.get(window.location.pathname, request, { preserveState: true })
    }

    const clear = () => {
        request.search = undefined;
        request.page = undefined;
        router.get(window.location.pathname, request, { preserveState: true })
    }

    let typingTimeout = $state(undefined);

    const oninput = (e) => {
        if (typingTimeout) {
            clearTimeout(typingTimeout);
        }

        // Start a new timeout
        typingTimeout = setTimeout(() => {
            if(request.search === ""){
                clear()
            }else{
                request.page = 1;
                router.get(window.location.pathname, request, { preserveState: true })
            }
        }, 500);
    }
</script>

<div class="join">
    <div>
        <label class="input input-sm join-item">
            <span class="iconify lucide--search text-base-content/80 size-3.5"></span>

            <input type="search" class="w-24 sm:w-36" {placeholder} bind:value={request.search} size={placeholder.length < 20 ? 20 : placeholder.length} {oninput} />

            <!--{#if request.search}-->
            <!--    <button class="btn btn-xs btn-circle" onclick={() => clear()}>-->
            <!--        <span class="iconify lucide&#45;&#45;x-circle size-4"></span>-->
            <!--    </button>-->
            <!--{/if}-->
        </label>
    </div>
<!--    <button class="btn btn-neutral join-item" {onclick} >Find</button>-->
</div>
