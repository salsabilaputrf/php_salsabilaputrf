<?php
session_start(); 

$step = isset($step) ? $step : 0;

// Handle untuk setiap form yang disubmit
if (isset($_POST['step1'])) {
    $_SESSION['name'] = $_POST['name']; // Menyimpan nama ke session
    $step = 1;
} elseif (isset($_POST['step2'])) {
    $_SESSION['age'] = $_POST['age']; // Menyimpan umur ke session
    $step = 2;
} elseif (isset($_POST['step3'])) {
    $_SESSION['hobby'] = $_POST['hobby']; // Menyimpan hobi ke session
    $step = 3;
} elseif (isset($_POST['reset'])) {
    session_unset(); 
    session_destroy(); 
    $step = 0; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            border: 2px solid black; 
            width: 400px;
            margin: 20px auto;
        }
        td {
            padding: 10px;
        }
        input, button {
            padding: 5px;
            font-size: 16px;
        }
        label, button {
            font-weight: bold; 
        }
        button {
            border: 1px solid black;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php if ($step == 0): ?>
    <!-- Tampilan awal -->
    <form method="POST">
        <table>
            <tr>
                <td><label for="name">Nama Anda:</label></td>
                <td><input type="text" id="name" name="name" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;"><button type="submit" name="step1">SUBMIT</button></td>
            </tr>
        </table>
    </form>

<?php elseif ($step == 1): ?>
    <!-- Tampilan step 1 -->
    <form method="POST">
        <table>
            <tr>
                <td><label for="age">Umur Anda:</label></td>
                <td><input type="number" id="age" name="age" value="<?php echo isset($_SESSION['age']) ? $_SESSION['age'] : ''; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;"><button type="submit" name="step2">SUBMIT</button></td>
            </tr>
        </table>
    </form>

<?php elseif ($step == 2): ?>
    <!-- Tampilan step 2 -->
    <form method="POST">
        <table>
            <tr>
                <td><label for="hobby">Hobi Anda:</label></td>
                <td><input type="text" id="hobby" name="hobby" value="<?php echo isset($_SESSION['hobby']) ? $_SESSION['hobby'] : ''; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;"><button type="submit" name="step3">SUBMIT</button></td>
            </tr>
        </table>
    </form>

<?php elseif ($step == 3): ?>
    <!-- Tampilan step 3: Menampilkan Nama, Umur, dan Hobi -->
    <table>
        <tr>
            <td>Nama: <?php echo $_SESSION['name']; ?></td>
        </tr>
        <tr>
            <td>Umur: <?php echo $_SESSION['age']; ?></td>
        </tr>
        <tr>
            <td>Hobi: <?php echo $_SESSION['hobby']; ?></td>
        </tr>
    </table>
    <form method="POST">
        <button type="submit" name="reset">RESET</button>      
    </form>

<?php endif; ?>

</body>
</html>
