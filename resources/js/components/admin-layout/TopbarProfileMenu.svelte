<script>
   import {page} from "@inertiajs/svelte";
</script>

<div class="dropdown dropdown-bottom dropdown-end">
<!--    <button tabindex="0" class="btn btn-ghost btn-square rounded-md">-->
<!--        <span class="avatar bg-base-200 rounded-box size-8 overflow-hidden mask mask-squircle">-->
<!--            <img alt="Avatar" src="/images/avatars/1.png" />-->
<!--            <img src="https://api.dicebear.com/9.x/initials/svg?seed={$page.props.user.name}&backgroundType=gradientLinear&fontSize=40" alt="Avatar" />-->
<!--        </span>-->
<!--    </button>-->
    <div class="dropdown-content bg-base-100 rounded-box mt-2 w-44 shadow-sm" tabindex="0" role="menu">
        <ul class="menu w-full p-2">
            <li>
                <a href="/settings">
                    <span class="iconify lucide--settings size-4"></span>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
        <hr class="border-base-300" />
        <ul class="menu w-full p-2">
            <li>
                <a class="text-error hover:bg-error/10" href="/logout">
                    <span class="iconify lucide--log-out size-4"></span>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
