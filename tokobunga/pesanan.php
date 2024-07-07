<?php
// Sertakan file koneksi database
include('db.php');

// Inisialisasi variabel untuk menyimpan pesan
$errorMessage = "";
$successMessage = "";

// Fungsi untuk menyimpan data pemesanan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_customer']) && isset($_POST['tipe_bunga']) && isset($_POST['penerima']) && isset($_POST['alamat']) && isset($_POST['total_harga']) && isset($_POST['id_pesanan'])) {
        $customerId = $_POST['id_customer'];
        $flowerId = $_POST['tipe_bunga'];
        $receiverName = $_POST['penerima'];
        $address = $_POST['alamat'];
        $total = $_POST['total_harga'];
        $pesananid = $_POST['id_pesanan'];

        // Query untuk memasukkan data pemesanan ke database
        $sql = "INSERT INTO pesanan (id_customer, tipe_bunga, penerima, alamat, total_harga, id_pesanan) 
                VALUES ('$customerId', '$flowerId', '$receiverName', '$address', '$total', '$pesananid')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Pemesanan berhasil!');</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('ERROR: Data Tidak Lengkap.');</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - Flower Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <style>
        /* Additional styling specific to order page */
        .bg-gradient-order {
            background: linear-gradient(90deg, #f54ea2, #c533ec); /* Gradient from pink to purple */
            text-align: center;
            padding: 100px 0;
            color: #fff;
            font-size: 2rem;
        }
        .btn-gradient-order {
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
    <header class="bg-gradient-order">
        <h1>Pemesanan Bunga</h1>
        <p>Lengkapi formulir untuk memesan bunga favorit Anda.</p>
        <a href="index.php" class="btn btn-lg btn-gradient-order">Home Page</a>
    </header>
    <main class="container my-5">
        <div class="row">
            <div class="col-md-6 mx-auto form-container">
                <form id="orderForm" class="shadow-sm p-4 bg-white rounded" method="POST" action="pesanan.php">
                    <div class="form-group">
                        <label for="id_pesanan">ID Pesanan:</label>
                        <input type="text" class="form-control" id="id_pesanan" name="id_pesanan" placeholder="Masukkan ID Pesanan" required>
                    </div>
                    <div class="form-group">
                        <label for="id_customer">ID Customer:</label>
                        <input type="text" class="form-control" id="id_customer" name="id_customer" placeholder="Masukkan ID Customer" required>
                    </div>
                    <div class="form-group">
                        <label for="tipe_bunga">Tipe Bunga:</label>
                        <select class="form-control" id="tipe_bunga" name="tipe_bunga" required>
                            <option value="Mawar Jahat">Mawar Jahat</option>
                            <option value="Matahari Pagi">Matahari Pagi</option>
                            <option value="Lily Was A Little Girl">Lily Was A Little Girl</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="penerima">Nama Penerima:</label>
                        <input type="text" class="form-control" id="penerima" name="penerima" placeholder="Masukkan Nama Penerima" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Penerima:</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Penerima" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="total_harga">Total:</label>
                        <input type="number" class="form-control" id="total_harga" name="total_harga" placeholder="Masukkan Total Pembayaran" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-lg btn-gradient-order">Buat Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-gradient-order text-white text-center py-3">
        <p>&copy; SEHAT SEHAT SEMUA MAKASIH DAH BELI.</p>
    </footer>
</body>
</html>


