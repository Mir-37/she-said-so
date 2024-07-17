<?php
$feedback_link = trim(BASE_URL, "/") . "/feedback/" . $_SESSION["login"]["feedback_uid"];
?>

<?php include __DIR__ . "/../partials/header.php" ?>

<body class="bg-gray-100">

    <?php include __DIR__ . "/../partials/nav.php" ?>

    <main class="">
        <div class="relative flex min-h-screen overflow-hidden bg-gray-50 py-6 sm:py-12">
            <img src="/src/public/images/beams.jpg" alt="" class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" width="1308" />
            <div class="absolute inset-0 bg-[url(./src/public/images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>

            <div class="relative max-w-7xl mx-auto">
                <div class="flex justify-end">
                    <span class="block text-gray-600 font-mono border border-gray-400 rounded-xl px-2 py-1">Your feedback form link: <strong>
                            <a href="<?php echo $feedback_link ?>">
                                <?php
                                echo $feedback_link
                                ?>
                            </a>
                        </strong></span>
                </div>
                <h1 class="text-xl text-indigo-800 text-bold my-10">Received feedback</h1>
                <?php if (count($received_feedbacks) == 0) : ?>
                    <div class="flex justify-center items-center h-64 border border-gray-300 bg-white px-6 py-5 shadow-sm">
                        <p class="text-gray-500">No feedbacks received</p>
                    </div>
                <?php else : ?>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <?php foreach ($received_feedbacks as $feedback) : ?>
                            <div class="relative flex flex-col space-y-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                                <div class="focus:outline-none">
                                    <p class="text-gray-500"><?php echo htmlspecialchars($feedback["feedback"]); ?></p>
                                </div>
                                <div class="mt-auto pt-4 border-t border-gray-200">
                                    <div class="flex justify-between text-xs text-gray-400">
                                        <p>Date added: <span class="font-semibold text-gray-600"><?php echo htmlspecialchars($feedback['created_at']); ?></span></p>
                                    </div>
                                </div>
                                <div class="py-2 flex justify-between text-xs text-gray-400">

                                    <p>Category: <span class="font-semibold text-gray-600"><?php echo htmlspecialchars($feedback['category']); ?></span></p>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <h1 class="text-xl text-indigo-800 text-bold my-10">Given feedbacks</h1>
                <?php if (count($given_feedbacks) == 0) : ?>
                    <div class="flex justify-center items-center h-64 border border-gray-300 bg-white px-6 py-5 shadow-sm">
                        <p class="text-gray-500">No feedbacks given</p>
                    </div>
                <?php else : ?>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <?php foreach ($given_feedbacks as $feedback) : ?>
                            <div class="relative flex flex-col space-y-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                                <div class="focus:outline-none">
                                    <p class="text-gray-500"><?php echo htmlspecialchars($feedback["feedback"]); ?></p>
                                </div>
                                <div class="mt-auto pt-4 border-t border-gray-200">
                                    <div class="flex justify-between text-xs text-gray-400">

                                        <p>Date added: <span class="font-semibold text-gray-600"><?php echo htmlspecialchars($feedback['created_at']); ?></span></p>

                                        <a href="<?php echo "/feedback/delete?id=" . $feedback["id"] ?>" class="px-2 font-semibold text-red-600 hover:text-red-900">Delete</a>
                                    </div>
                                </div>
                                <div class="py-2 flex justify-between text-xs text-gray-400">

                                    <p>Category: <span class="font-semibold text-gray-600"><?php echo htmlspecialchars($feedback['category']); ?></span></p>

                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include __DIR__ . "/../partials/footer.php" ?>
</body>

</html>