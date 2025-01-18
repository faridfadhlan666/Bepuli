<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.2.4/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=ABC+Diatype+Mono&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto px-6 py-12">

        <?php
        include "koneksi.php";
        // Mendapatkan ID artikel dari URL
        $id_artikel = $_GET['id_artikel'];
        $query = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id_artikel = $id_artikel");
        $data = mysqli_fetch_assoc($query);
        ?>

        <!-- Article Header -->
        <div class="bg-white shadow-xl rounded-lg p-8 mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-4"><?= $data['judul']; ?></h1>
            <div class="flex items-center text-gray-600 space-x-8 text-sm mb-4">
                <span><strong>Author:</strong> <?= $data['penulis']; ?></span>
                <span><strong>Source:</strong> <?= $data['sumber']; ?></span>
                <span><strong>Date:</strong> <?= $data['tanggal']; ?></span>
            </div>
            <hr class="border-t border-gray-300 mb-6">
        </div>

        <!-- Article Content and Sidebar -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Main Content Column -->
            <div class="md:col-span-2 bg-white shadow-xl rounded-lg p-6 space-y-8">
                <img src="assets/img/<?= $data['gambar']; ?>" alt="Article Image" class="w-full h-96 object-cover rounded-lg mb-6">

                <div class="text-gray-800">
                    <h2 class="text-2xl font-semibold mb-4">Description</h2>
                    <div class="article-description">
                        <?= nl2br($data['deskripsi']); ?>
                    </div>
                </div>
            </div>

            <!-- Sidebar with Related Articles -->
            <div class="bg-white shadow-xl rounded-lg p-6 h-full max-h-[400px] overflow-y-auto">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">More for Wuthering Waves News</h3>
                <ul class="space-y-4">
                    <?php
                    // Query for related articles
                    $related_query = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY id_artikel DESC LIMIT 5");
                    while ($related = mysqli_fetch_assoc($related_query)) {
                    ?>
                        <li><a href="view-article.php?id_artikel=<?= $related['id_artikel']; ?>" class="text-blue-600 hover:underline"><?= substr($related['judul'], 0, 40); ?>...</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="mt-12 text-center text-gray-600">
            <p>&copy; <?= date('Y'); ?> Rozalyne. All Rights Reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@3.2.4/dist/tailwind.min.js"></script>
</body>

</html>