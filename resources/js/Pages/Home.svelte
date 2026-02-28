<script lang="ts">
    import {page} from "@inertiajs/svelte";
    import PageTitle from "../components/PageTitle.svelte";
    import MainLayout from "../layouts/MainLayout.svelte";

    const services = [
        {
            name: "Jellyfin",
            link: window.location.origin + ":8096/",
            logo: window.location.origin + ":8096/web/icon-transparent.baba78f2a106d9baee83.png"
        },
        {
            name: "Tunarr",
            link: window.location.origin + ":8000/",
            logo: window.location.origin + ":8000/web/favicon.svg"
        },
        {
            name: "qBittorrent",
            link: window.location.origin + ":8080/",
            logo: window.location.origin + "/qbittorrent-tray.svg"
        },
        {
            name: "Radarr",
            link: window.location.origin + ":7878/",
            logo: window.location.origin + ":7878/Content/Images/logo.png"
        },
        {
            name: "Sonarr",
            link: window.location.origin + ":8989/",
            logo: window.location.origin + ":8989/Content/Images/logo.svg"
        },
    ];

</script>

<MainLayout>
    <PageTitle title="Dashboard" />
    <div class="mt-6 flex flex-col sm:flex-row gap-6 flex-wrap">
        {#each services as service}
            <a href={service.link} target="_blank" class="btn btn-lg gap-4">
                <img src={service.logo} alt="icon" class="h-2/3">
                <span>{service.name}</span>
            </a>
        {/each}
    </div>
</MainLayout>
