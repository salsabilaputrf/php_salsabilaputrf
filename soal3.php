<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "testdb";

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$searchQuery = "";
$conditions = [];
$params = [];
$types = ""; 

if (isset($_POST['search'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $hobi = $_POST['hobi'];

    if (!empty($nama)) {
        $conditions[] = "p.nama LIKE ?";
        $params[] = "%$nama%";
        $types .= "s"; 
    }
    if (!empty($alamat)) {
        $conditions[] = "p.alamat LIKE ?";
        $params[] = "%$alamat%";
        $types .= "s";
    }
    if (!empty($hobi)) {
        $conditions[] = "h.hobi LIKE ?";
        $params[] = "%$hobi%";
        $types .= "s";
    }

    if (count($conditions) > 0) {
        $searchQuery = " WHERE " . join(" AND ", $conditions);
    }
}

// Query dasar
$sql = "SELECT p.id, p.nama, p.alamat, GROUP_CONCAT(h.hobi SEPARATOR ', ') AS hobi 
        FROM person p
        LEFT JOIN hobi h ON p.id = h.person_id
        $searchQuery
        GROUP BY p.id";


$stmt = $conn->prepare($sql);


if (count($params) > 0) {
    // Menggunakan bind_param untuk mengikat nilai-nilai input ke query
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        label, button {
            font-weight: bold;
        }
        table {
            border-collapse: collapse;
            width: 50%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        button {
            padding: 5px 10px;
            font-size: 14px;
        }
   
        .search-table {
            width: 30%;
        }
        .search-table td {
            border: none;
            padding: 8px;
        }
    </style>
</head>
<body>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Hobi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['nama']}</td>
                            <td>{$row['alamat']}</td>
                            <td>{$row['hobi']}</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Data tidak ditemukan</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h3>Form Search</h3>
    <form method="POST">
        <table class="search-table">
            <tr>
                <td><label for="nama">Nama: </label></td>
                <td><input type="text" id="nama" name="nama" value="<?php echo isset($nama) ? $nama : ''; ?>" /></td>
            </tr>
            <tr>
                <td><label for="alamat">Alamat: </label></td>
                <td><input type="text" id="alamat" name="alamat" value="<?php echo isset($alamat) ? $alamat : ''; ?>" /></td>
            </tr>
            <tr>
                <td><label for="hobi">Hobi: </label></td>
                <td><input type="text" id="hobi" name="hobi" value="<?php echo isset($hobi) ? $hobi : ''; ?>" /></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit" name="search">SEARCH</button>
                </td>
            </tr>
        </table>
    </form>

</body>
</html>

<?php

// Menutup statement setelah query selesai
$stmt->close();
// Menutup koneksi setelah query selesai
$conn->close();
?>
