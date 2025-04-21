<?php 
require 'config.php';
$transaksi1 = $conn->query("
    SELECT t.*, b.nama, b.harga 
    FROM transaksi1 t 
    JOIN barang b ON t.barang_id = b.id
    ORDER BY t.created_at DESC LIMIT 5
");
$barang = $conn->query("SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-red-800 text-white p-4">
            <div class="flex items-center space-x-2 mb-8">
                <i class="fas fa-solid fa-pen text-2xl text-yellow-300"></i>
                <h1 class="text-xl font-bold">Stationary Mart</h1>
            </div>
            <nav>
                <a href="index.php" class="flex items-center space-x-2 p-2 rounded hover:bg-red-700 mb-2">
                    <i class="fas fa-solid fa-table-columns"></i>
                    <span>Dashboard</span>
                </a>
                <a href="create.php" class="flex items-center space-x-2 p-2 rounded hover:bg-red-700 mb-2">
                    <i class="fas fa-cash-register"></i>
                    <span>Transaksi Baru</span>
                </a>
                <a href="manage.php" class="flex items-center space-x-2 p-2 rounded hover:bg-red-700 mb-2">
                    <i class="fas fa-solid fa-box-open"></i>
                    <span>Kelola Barang</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Card Statistik -->
                <div class="bg-white rounded-lg shadow p-6 flex items-center">
                    <div class="p-3 bg-red-100 rounded-full mr-4">
                        <i class="fas fa-receipt text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-red-500">Transaksi Hari Ini</p>
                        <h3 class="text-2xl font-bold">15</h3>
                    </div>
                </div>

                <!-- Card lainnya bisa ditambah di sini -->
            </div>

            <!-- Daftar Transaksi Terakhir -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-red-700">Transaksi Terakhir</h2>
                    <a href="create.php" class="btn-primary">
                        <i class="fas fa-plus mr-2"></i> Baru
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-red-100 text-red-800">
                                <th class="p-3 text-left">Barang</th>
                                <th class="p-3 text-left">Harga</th>
                                <th class="p-3 text-left">Jumlah</th>
                                <th class="p-3 text-left">Subtotal</th>
                                <th class="p-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $transaksi1->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-red-50">
                                <td class="p-3"><?= $row['nama'] ?></td>
                                <td class="p-3">Rp <?= number_format($row['harga']) ?></td>
                                <td class="p-3"><?= $row['jumlah'] ?></td>
                                <td class="p-3">Rp <?= number_format($row['subtotal']) ?></td>
                                <td class="p-3">
                                    <a href="#" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
