<script>
    import {page} from "@inertiajs/svelte";
    import PageTitle from "../components/PageTitle.svelte";
    import MainLayout from "../layouts/MainLayout.svelte";
    import Select from "../components/Select.svelte";
    import {onMount} from "svelte";

    console.log($page);

    let paths = $derived($page.props.paths)

    let pathsSelect;
    let filesSelect;

    let pathsShowAll = $state(false);
    let pathsOptions = $derived.by(() => {
        return $page.props.paths.map((path, index) => {
            if (path.hasFile === pathsShowAll) {
                return {
                    label: path.title,
                    value: index,
                }
            }
        }).filter(item => item)
    })
</script>

<MainLayout>
    <PageTitle title="Files" />
    <div class="mt-6">
<!--        <button class="btn" onclick={pathsSelect.updateOptions}>test</button>-->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <Select
                    bind:this={filesSelect}
                    options={$page.props.files.map((file, index) => {
                        return {
                            label: file.name,
                            value: index,
                        }
                    })}
                />
            </div>
            <div>
                <Select
                    bind:this={pathsSelect}
                    options={pathsOptions}
                />
                <span>
                    Show all <input type="checkbox" class="toggle" bind:checked={pathsShowAll} onchange={pathsSelect.updateOptions} />
                </span>
            </div>
        </div>
        <button class="btn btn-primary mt-4" onclick={() => {
            let filesIndex = filesSelect.getSelected()
            let pathsIndex = pathsSelect.getSelected()

            console.log(paths[pathsIndex]);
        }}>Move</button>
    </div>
</MainLayout>
