<?php
$user_name = $_SESSION["login"]["user"] ?? "";
?>
<header class="bg-white">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="/" class="-m-1.5 p-1.5">
                <span class="sr-only">TruthWhisper</span>
                <span class="block font-bold text-lg bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">TruthWhisper</span>
            </a>
        </div>
        <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <?php if (isset($_SESSION["login"])) : ?>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">

                <span class="text-sm font-semibold leading-6 text-gray-900 pr-4">
                    <a href="/dashboard">Feedbacks</a><br>
                </span>

                <span class="text-sm font-semibold leading-6 text-gray-900 pr-4">
                    <a href="/manage-category">Manage Categories</a><br>
                </span>

                <span class="text-sm font-semibold leading-6 text-gray-900 pr-4">
                    <?php echo $user_name ?><br>
                </span>

                <span class="text-sm font-semibold leading-6 text-gray-900">
                    <a class="text-sm font-semibold leading-6 text-gray-900" href="/logout">
                        Logout
                    </a>
                </span>
            </div>
        <?php endif; ?>
    </nav>
</header>