<?php
session_start();
if(!isset($_SESSION['userlog']) && $_SESSION['userlog'] !== true){header("Location: ../login.php");exit();} 
require_once "../../Connections/kelompok_web.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $tgl = mysqli_real_escape_string($link, $_POST['tanggal']);
    $nama = mysqli_real_escape_string($link, $_POST['nama']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = password_hash(mysqli_real_escape_string($link, $_POST['password']), PASSWORD_DEFAULT);
    $telepon = mysqli_real_escape_string($link, $_POST['telepon']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $alamat = mysqli_real_escape_string($link, $_POST['alamat']);
    $level = mysqli_real_escape_string($link, $_POST['level']);
    $sql = "UPDATE admin  
    SET id = '$id', nama = '$nama', telepon = '$telepon', email = '$email', alamat = '$alamat',
    username = '$username', password = '$password', level = '$level', tgl = '$tgl' 
    WHERE id = '$id'";
    if($stmt = mysqli_query($link, $sql)){
        header("location: daftar.php? edit admin sukses");
        exit();
    }mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Akun</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>a{text-decoration: none;}</style>
</head>
<body>
<?php
    $id = mysqli_real_escape_string($link, $_GET['id']);
    $result = mysqli_query($link, "SELECT * FROM admin WHERE id='$id'");
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    mysqli_close($link);
?>
<table align="center">
  <tr><td>
    <div>
        <div>
            <h2>Edit Akun</h2>
        </div>
        <form action="edit.php" method="post">
            <table align="center" valign="middle">
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $row['nama'];?>"></td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td><input type="text" name="telepon" value="<?php echo $row['telepon'];?>"></td>
            </tr> 
            <tr>
                <td>E-mail</td>
                <td><input type="text" name="email" value="<?php echo $row['email'];?>"></td>
            </tr> 
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?php echo $row['alamat'];?>"></td>
            </tr> 
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" value="<?php echo $row['username'];?>"></td>
            </tr>   
            <tr>
                <td>level</td>
                <td><input type="text" name="level" value="<?php echo $row['level'];?>"></td>
            </tr> 
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr> 
            </table>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <div>
                <input type="hidden" name="tanggal" value="<?php echo date('y-m-d');?>"/>
                <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
            </div>
        </form>
    </div>
  </td></tr>
</table> 
</body>
</html>