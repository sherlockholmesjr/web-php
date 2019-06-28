<?php
session_start();
if(!isset($_SESSION['userlog']) && $_SESSION['userlog'] !== true){header("Location: ../login.php");exit();} 
require_once "../../Connections/kelompok_web.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tgl = $_POST['tgl'];
    $nama = $_POST['nama'];
    $masa = mysqli_real_escape_string($link, $_POST['masa']);
    $sql = "INSERT INTO wali_kota(masa_jabatan, nama, tgl) VALUE(?, ?, ?)";
    if(!empty($masa) && !empty($nama)){
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, 'sss', $masa, $nama, $tgl);
            if(mysqli_stmt_execute($stmt)){header("Location: ../beranda.php? input Wali-Kota sukses");mysqli_stmt_close($stmt);mysqli_close($link);exit();}
        }else{echo"error : can't open the database, try it later";exit();}
    }else{echo"error : input is empty";exit();}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>wali-kota</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style>
        .header-input h5{text-align:center;font-size:24px;}
        table tr td, td select, td button{font-family:arial; background-color: #ccc; padding:3px 32px;}
        button:hover{background-color:#fff;}
    </style>
    <script src="main.js"></script>
</head>
<body>
    <div class="header-input">
        <h5>Masukkan Wali-Kota</h5>
    </div>
    <form action="input_wali.php" method="post">
        <table align="center" valign="middle">
            <tr>
                <td>Masa Jabatan</td>
                <td><select name="masa">
                    <?php $i=1979; $limit = intval(date('Y')); while($i<=$limit):;?>
                    <option><?php echo $i."/".intval($i+5); $i+=5;?></option>
                    <?php endwhile;?>
                </select></td>
            </tr>
            <tr>
                <td>Nama Wali-Kota</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" name="input">input</button></td>
            </tr>
        </table>
        <input type="hidden" name="tgl" value="<?php echo date('y-m-d');?>">
    </form>
</body>
</html>