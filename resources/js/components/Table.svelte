<script>
    let {
        data,
        head,
        body,
    } = $props();
</script>

<div class="mt-4 overflow-auto">
    <table class="table">
        <thead>
        <tr>
            {@render head()}
        </tr>
        </thead>

        <tbody>
            {@render body(data.data)}
        </tbody>
    </table>
</div>
