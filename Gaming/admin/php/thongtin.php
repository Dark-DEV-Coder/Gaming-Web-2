<section class="home-section">
    <div class="home-content">  
      <i class='bx bx-user-circle'></i>
      <?php
        require_once("./KetnoiCSDL.php");
        $p=new CheckConnection();
        $matk=$_SESSION['matk'];
        $sql="SELECT * FROM nhan_vien WHERE MaTK='$matk'";
        $rs=$p->ExcuteQuery($sql);
        $r=mysqli_fetch_row($rs);
        $hoten=$r[2]." ".$r[3];
        echo "<span class='text'>Xin chào, $hoten</span>";        
      ?>      
    </div>
    <?php
        require("./noidung.php"); 
    ?>
</section>