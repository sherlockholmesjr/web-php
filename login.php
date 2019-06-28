<?php 
session_start();
if(isset($_SESSION['loginuser']) && $_SESSION['loginuser'] === true){
    header("Location: beranda.php");
    exit();
}
require_once '../Connections/kelompok_web.php';
$username = $password = "";
$username_err = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    if(empty($username)){
        $username_err = "username tidak boleh kosong";
    }
    if(empty($password)){
        $password_err = "password tidak boleh kosong";
    }
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, nama, telepon, email, alamat, username, password FROM admin WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, 's', $username);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $nama, $telepon, $email, $alamat, $user, $hashPassword);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashPassword)){
                            session_start();
                            $_SESSION['userlog'] = true;$_SESSION['usernamelog'] = $user;$_SESSION['namalog'] = $nama;
                            $_SESSION['emlog'] = $email;$_SESSION['alamatlog'] = $alamat;$_SESSION['telplog'] = $telepon;
                            $_SESSION['idlog'] = $id;header("Location: beranda.php");exit();
                        }
                        else{
                            $password_err = "password salah";
                        }
                    }
                }
                else{
                    $username_err = "tidak ada akun yang ditemukan";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>a{text-decoration: none;}</style>
</head>
<body>
<table align="center">
    <tr><td>
        <div class="wrapper">
        <div>
            <h2>Login</h2>
            </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>    
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                    <div>
                        <p>Belum punya akun? <a href="signup.php">Sign up sekarang</a>.</p>
                    </div>
                </form>
            </div>   
    </td></tr>
</table> 
</body>
</html>