<?php    
    require_once("./xulydulieu.php");
    require_once("./KetnoiCSDL.php");
    $p=new CheckConnection();
    $p1=new Xuly();
    if (isset($_POST['tendn']) && isset($_POST['tendn'])){
        $tendn=$_POST['tendn'];
        $mkdn=$_POST['mkdn'];
        $sql="SELECT * FROM tai_khoan WHERE Username='$tendn' AND TinhTrang=1";
        $rs=$p->ExcuteQuery($sql);
        if (mysqli_num_rows($rs)>0){
            $r=mysqli_fetch_row($rs);
            if ($r[1]!='KH'){
                if (password_verify($mkdn,$r[3])){
                    session_start();
                    $_SESSION['matk']=$r[0];
                    $_SESSION['maq']=$r[1];
                    echo 1;
                }
                else
                    echo 0;
            }
            else
                echo -1;
        }
        else
            echo 0;
    }
?>