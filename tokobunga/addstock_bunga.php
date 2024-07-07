<?php
// Sertakan file koneksi database
include('db.php');

// Fungsi untuk menambah stok bunga
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_stock'])) {
    $flowerId = $_POST['flower_id'];
    $flowerType = $_POST['flower_type'];
    $size = $_POST['size'];
    $price = 0;

    // Tentukan harga berdasarkan ukuran
    switch($size) {
        case 'Small':
            $price = 25000;
            break;
        case 'Medium':
            $price = 50000;
            break;
        case 'Large':
            $price = 150000;
            break;
    }

    // Query untuk menambahkan stok bunga ke database
    $sql = "INSERT INTO bunga (id_bunga, tipe_bunga, harga_bunga, ukuran_bunga) VALUES ('$flowerId', '$flowerType', '$price', '$size')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Stok bunga berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}

// Query untuk mengambil jumlah stok bunga yang tersedia
$sql_count = "SELECT COUNT(*) AS total FROM bunga";
$result = $conn->query($sql_count);
$totalBunga = $result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bunga - Flower Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <style>
        /* Additional styling specific to order page */
        .bg-gradient-flowers {
            background: linear-gradient(90deg, #f54ea2, #c533ec); /* Gradient from pink to purple */
            text-align: center;
            padding: 100px 0;
            color: #fff;
            font-size: 2rem;
        }
        .btn-gradient-flowers {
            background: linear-gradient(90deg, #f54ea2, #c533ec);
            border-color: #f54ea2;
            color: #fff;
            transition: transform 0.3s ease;
        }
        .btn-gradient-order:hover {
            transform: scale(1.05); /* Scale up on hover */
        }
        .form-container {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .form-container:hover {
            transform: translateY(-10px); /* Move up on hover */
        }
        form input,
        form select,
        form textarea {
            margin-top: 10px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        form input:focus,
        form select:focus,
        form textarea:focus {
            border-color: #f54ea2; /* Highlight border on focus */
        }
        form button {
            margin-top: 20px;
            padding: 15px 30px;
            background-color: #f54ea2; /* Pink color */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #de3b8e; /* Darker pink color on hover */
        }
    </style>
</head>
<body>
    <header class="bg-gradient-flowers">
        <h1>Daftar Bunga</h1>
        <p>Pilih bunga favorit Anda.</p>
        <a href="index.html" class="btn btn-lg btn-gradient-flowers">HOME PAGE</a>
    </header>
    <main class="container my-5">
        <div class="center-form">
            <div class="form-container">
                <div class="flower-info">
                    <p>Jumlah bunga yang tersedia saat ini: <strong><?php echo $totalBunga; ?></strong></p>
                </div>
                <form action="addstock_bunga.php" method="POST">                 
                    <div class="form-group">
                        <label for="flower_id">ID Bunga:</label>
                        <input type="text" class="form-control" id="flower_id" name="flower_id" placeholder="Masukkan ID Bunga" required>
                    </div>                
                    <div class="form-group">
                        <label for="flower_type">Tipe Bunga:</label>
                        <select class="form-control" id="flower_type" name="flower_type" required>
                            <option value="Mawar Jahat">Mawar Jahat</option>
                            <option value="Matahari Pagi">Matahari Pagi</option>
                            <option value="Lily Was a Little Girl">Lily Was a Little Girl</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="size">Ukuran Bunga:</label>
                        <select class="form-control" id="size" name="size" required>
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Large">Large</option>
                        </select>
                    </div>
                    <button type="submit" name="add_stock" class="btn btn-lg btn-gradient-flowers">Tambah Stok</button>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-gradient-flowers text-white text-center py-3">
        <p>&copy; SEHAT SEHAT SEMUA MAKASIH DAH BELI.</p>
    </footer>
</body>
</html>



