<?php
require_once "../Connections/kelompok_web.php";
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Tolong masukkan username.";
    } else{
        $sql = "SELECT id FROM admin WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Orang lain sudah memakai username yang sama.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Ada masalah, coba lagi nanti.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Tolong masukkan password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password harus setidaknya 6 karakter.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "tolong konfirmasi password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password tidak cocok.";
        }
    }
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $tgl = $_POST['tanggal'];
        $nama = $_POST['nama'];
        $telepon = $_POST['telepon'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $level = $_POST['level'];
        $sql = "INSERT INTO 
                admin (nama, telepon, email, alamat, username, password, level, tgl) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssssss", $nama, $telepon, $email, $alamat, $param_username, $param_password, $level, $tgl);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
                exit();
            } else{
                echo "Ada masalah, tolong coba lagi nanti.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>a{text-decoration: none;}</style>
</head>
<body>
<table align="center">
  <tr><td>
    <div>
        <div>
            <h2>Sign Up</h2>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Nama</label>
                <input type="text" name="nama">
            </div>
            <div>
                <label>Telepon</label>
                <input type="text" name="telepon">
            </div> 
            <div>
                <label>E-mail</label>
                <input type="text" name="email">
            </div> 
            <div>
                <label>Alamat</label>
                <input type="text" name="alamat">
            </div> 
            <div>
                <label>Username</label>
                <input type="text" name="username">
            </div>
            <div>
                <label>level</label>
                <input type="text" name="level">
            </div>    
            <div>
                <label>Password</label>
                <input type="password" name="password">
            </div> 
            <div>
                <label>Konfirmasi Password</label>
                <input type="password" name="confirm_password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <div>
                <input type="hidden" name="tanggal" value="<?php echo date('y-m-d');?>"/>
            </div>
            <div>
                <p>Sudah punya akun? <a href="login.php">Login disini</a>.</p>
            </div>
        </form>
    </div>
  </td></tr>
</table> 
</body>
</html>