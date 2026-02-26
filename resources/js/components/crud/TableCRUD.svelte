<script>
    import {page, router} from "@inertiajs/svelte";

    import Table from "../Table.svelte";
    import Search from "../Search.svelte";
    import {pluralize} from "inflection";

    let {
        entity,
        plural,
        data,
        request = $bindable(),
        head,
        body,
        add = undefined,
        settings = []
    } = $props();


    const pagination = (page) => {
        if(request){
            request.page = page

            router.get(window.location.pathname, request, { preserveState: true })
        }else{
            router.get(window.location.pathname, {
                page: page
            })
        }
    }

    // const changeLimit = (limit) => {
    //     request.limit = limit
    //
    //     router.get(window.location.pathname, request)
    // }

    // let perPage = $state(20);
//     TODO:
//      - separate table
//      - show columns (later)
//      - sort (later)
//      - add default buttons (view, edit, delete)
//      - add custom buttons
//      - after search is clean, clean url

</script>

<div class="flex items-center justify-between px-5 pt-5">
    <div class="inline-flex items-center gap-3">
        {#if request}
            <Search bind:request placeholder={`Search ${plural.toLowerCase()}`} />
        {/if}
    </div>
    <div class="inline-flex items-center gap-3">
        <!--                <a-->
        <!--                    href="/apps/ecommerce/products/create"-->
        <!--                    aria-label="Create product link"-->
        <!--                    class="btn btn-primary btn-sm max-sm:btn-square">-->
        <!--                    <span class="iconify lucide&#45;&#45;plus size-4"></span>-->
        <!--                    <span class="hidden sm:inline">New {name}</span>-->
        <!--                </a>-->
        {#if add}
            {@render add()}
        {/if}
        {#if settings.length > 0}
            <div class="dropdown dropdown-bottom dropdown-end">
                <div
                    tabIndex={0}
                    role="button"
                    class="btn btn-ghost border-base-300 btn-sm btn-square"
                    aria-label="More option">
                    <span class="iconify lucide--settings-2 size-4"></span>
                </div>
                <div tabIndex={0} class="dropdown-content bg-base-100 rounded-box z-1 w-52 shadow-sm">
                    {#each settings as setting}
                        <ul class="menu w-full p-2">
                            <li>
                                {#if setting?.function}
                                    <button title={setting.name} onclick={() => setting.function()}>
                                        <span class={["iconify size-4", setting.icon]}></span>
                                        {setting.name}
                                    </button>
                                {:else if setting?.href}
                                    <a href={setting.href}>
                                        <span class={["iconify size-4", setting.icon]}></span>
                                        {setting.name}
                                    </a>
                                {:else}
                                    <div>
                                        <span class={["iconify size-4", setting.icon]}></span>
                                        {setting.name}
                                    </div>
                                {/if}
                            </li>
                        </ul>
                        {#if setting?.hr}
                            <hr class="border-base-300" />
                        {/if}
                    {/each}
                </div>
            </div>
        {/if}
    </div>
</div>

<Table name="Group" {data} {head} {body} {add} bind:request />

<div class="flex items-center justify-between p-6 flex-wrap gap-4 sm:flex-nowrap sm:gap-0">
    <div class="text-base-content/80 hover:text-base-content flex gap-2 text-sm">
        <span class="hidden sm:inline">Per page</span>
        <select class="select select-xs w-18" aria-label="Per page">
            <!--                    <option value="10">10</option>-->
            <option value="20" selected>20</option>
            <!--                    <option value="50">50</option>-->
            <!--                    <option value="100">100</option>-->
        </select>
    </div>

    {#if data.to}
        <span class="text-base-content/80 text-sm">
            Showing <span class="text-base-content font-medium">{data.from} to {data.to}</span> of {data.total} items
        </span>
    {/if}

    <div class="flex items-center justify-center gap-1 basis-full sm:basis-0">
        {#if data.last_page === 1}
            <button class="btn btn-ghost btn-circle sm:btn-sm btn-xs">{data.current_page}</button>
        {:else}
            {#if data.last_page < 5}0
                {#each [...Array(data.last_page).keys()] as index}
                    {@const page = index + 1}
                    <button
                        class={["btn btn-circle sm:btn-sm btn-xs", data.current_page === page ? "btn-primary" : "btn-ghost"]}
                        onclick={() => pagination(page)}
                    >{page}</button>
                {/each}
            {:else }
                <button
                    class={["btn btn-circle sm:btn-sm btn-xs", data.current_page === 1 ? "btn-primary" : "btn-ghost"]}
                    onclick={() => pagination(1)}
                >1</button>

                <button title="Prev" class="btn btn-ghost btn-circle sm:btn-sm btn-xs" onclick={() => pagination(data.current_page - 1)} disabled={!data.prev_page_url}>
                    <span class="iconify lucide--chevron-left"></span>
                </button>

                {#if data.current_page <= 2}
                    {#each [...Array(3).keys()] as index}
                        {@const page = index + 2}
                        <button
                            class={["btn btn-circle sm:btn-sm btn-xs", data.current_page === page ? "btn-primary" : "btn-ghost"]}
                            onclick={() => pagination(page)}
                        >{page}</button>
                    {/each}
                {:else if (data.current_page >= data.last_page - 2 && data.current_page <= data.last_page) || data.current_page === data.last_page}
                    {#each [...Array(3).keys()] as index}
                        {@const page = data.last_page - (3 - 1 * index)}
                        <button
                            class={["btn btn-circle sm:btn-sm btn-xs", data.current_page === page ? "btn-primary" : "btn-ghost"]}
                            onclick={() => pagination(page)}
                        >{page}</button>
                    {/each}
                {:else}
                    <button title="Prev" class="btn btn-ghost btn-circle sm:btn-sm btn-xs" onclick={() => pagination(data.current_page - 1)} disabled={!data.prev_page_url}>
                        {data.current_page-1}
                    </button>

                    <button class="btn btn-primary btn-circle sm:btn-sm btn-xs">{data.current_page}</button>

                    <button title="Next" class="btn btn-ghost btn-circle sm:btn-sm btn-xs" onclick={() => pagination(data.current_page + 1)} disabled={!data.next_page_url}>
                        {data.current_page+1}
                    </button>
                {/if}

                <button title="Next" class="btn btn-ghost btn-circle sm:btn-sm btn-xs" onclick={() => pagination(data.current_page + 1)} disabled={!data.next_page_url}>
                    <span class="iconify lucide--chevron-right"></span>
                </button>

                <button
                    class={["btn btn-circle sm:btn-sm btn-xs", data.current_page === data.last_page ? "btn-primary" : "btn-ghost"]}
                    onclick={() => pagination(data.last_page)}
                >{data.last_page}</button>
            {/if}
        {/if}
    </div>
</div>
