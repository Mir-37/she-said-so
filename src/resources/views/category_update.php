<?php include __DIR__ . "/../partials/header.php" ?>

<body class="bg-gray-100">
    <?php include __DIR__ . "/../partials/nav.php" ?>

    <main class="">
        <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
            <img src="/src/public/images/beams.jpg" alt="" class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
            <div class="absolute inset-0 bg-[url(/src/public/images/grid.svg)] bg-center
                [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]">
            </div>

            <div class="relative bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-4xl sm:rounded-lg sm:px-10">

                <h1 class="block text-center font-bold text-2xl bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 inline-block text-transparent bg-clip-text">
                    TruthWhisper</h1>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <div class="mx-auto max-w-xl">
                        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                            <div class="mx-auto w-full max-w-xl text-center px-24">

                                <h3 class="text-gray-500 my-2">Update category</h3>
                            </div>

                            <div class="mt-10 mx-auto w-full max-w-xl">
                                <form class="space-y-6" action="/manage-category/update" method="POST">
                                    <div>
                                        <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Name:</label>
                                        <div class="mt-2">
                                            <input id="category" name="category" type="text" autocomplete="text" required class="block w-full rounded-md border-0 py-2 ps-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?php echo htmlspecialchars($cat["name"]) ?>">
                                        </div>
                                        <input type="hidden" name="id" value=<?php echo $cat["id"] ?>>
                                    </div>

                                    <div>
                                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status:</label>
                                        <div class="mt-2">
                                            <select id="category_status" name="status" class="block w-full rounded-md border-0 py-2 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option value="active" <?php if ($cat["status"] == "active") echo "selected" ?>>Active</option>
                                                <option value="inactive" <?php if ($cat["status"] == "inactive") echo "selected" ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- List, Update, Delete Categories -->
                    <div class="mx-auto max-w-xl">
                        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                            <div class="mx-auto w-full max-w-xl text-center px-24">

                                <h3 class="text-gray-500 my-2">Manage categories</h3>
                            </div>

                            <div class="mt-10 mx-auto w-full max-w-xl">
                                <ul class="space-y-4">
                                    <?php foreach ($cats as $cat) : ?>
                                        <li class="flex justify-between items-center border-b py-2">
                                            <span class="text-gray-900"><?php echo htmlspecialchars($cat["name"]) ?></span>
                                            <div class="flex space-x-2">
                                                <a href="<?php echo "/manage-category/update?id=" . htmlspecialchars($cat["id"]) ?>" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                <a href="/manage-category" class="text-green-600 hover:text-green-900">Add</a>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/../partials/footer.php" ?>
</body>

</html>