<script lang="ts">
    import Footer from "../components/admin-layout/Footer.svelte";
    import Rightbar from "../components/admin-layout/Rightbar.svelte";
    import Sidebar from "../components/admin-layout/Sidebar.svelte";
    import Topbar from "../components/admin-layout/Topbar.svelte";
    import { adminMenuItems } from "./menu";
    import ConfigProvider from "../contexts/ConfigProvider.svelte";
    import Toasts from "../components/Toasts/Toasts.svelte";

    let { children } = $props();
</script>

<ConfigProvider>
    <div class="size-full">
        <Toasts />
        <div class="flex">
            <Sidebar menuItems={adminMenuItems} />
            <div class="flex h-screen min-w-0 grow flex-col overflow-auto">
                <Topbar />
                <div id="layout-content">{@render children()}</div>
<!--                <Footer />-->
            </div>
        </div>
        <Rightbar />
    </div>
</ConfigProvider>
