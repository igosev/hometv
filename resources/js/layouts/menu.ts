import type { ISidebarMenuItem } from "../components/admin-layout/SidebarMenuItem.svelte";

export const adminMenuItems: ISidebarMenuItem[] = [
    {
        id: "home",
        icon: "lucide--home",
        label: "Home",
        url: "/",
    },
    {
        id: "manage-label",
        isTitle: true,
        label: "Manage",
    },
    {
        id: "files",
        icon: "lucide--folder",
        label: "Files",
        url: "/files",
    },
];
