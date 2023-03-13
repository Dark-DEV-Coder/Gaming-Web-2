<?php 
    session_start();
    if(isset($_GET['dele']))
    {
        $id=$_GET['dele'];
        $_SESSION['stt'] -= $_SESSION['cart'][$id]['SoLuong'];
        $_SESSION['odertotal']-=$_SESSION['cart'][$id]['TongCong'];
        $_SESSION['Tongtien']-=$_SESSION['cart'][$id]['GiaBan']*$_SESSION['cart'][$id]['SoLuong'];
        $_SESSION['Tongtienkm']-=$_SESSION['cart'][$id]['GiaKM']*$_SESSION['cart'][$id]['SoLuong'];
        unset($_SESSION['cart'][$id]);

        // $_SESSION['sum']['Price']-=$_SESSION['cart'][$_GET['dele']]['TotalPrice'];
        // $_SESSION['sum']['Quantity']-=$_SESSION['cart'][$_GET['dele']]['Quantity'];
        // unset($_SESSION['cart'][$_GET['dele']]);
        header("location:http://localhost/Gaming/php/giohang.php");
    }
?>