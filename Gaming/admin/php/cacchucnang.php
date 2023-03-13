<div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-menu' ></i>
      <span class="logo_name">Danh mục</span>
    </div>
    <ul class="nav-links">
        <?php
            require_once("./KetnoiCSDL.php");
            $p=new CheckConnection();
            $matk=$_SESSION['matk'];
            $maq=$_SESSION['maq'];
            $sql="SELECT ctq.MaQuyen,ctq.MaChucNang,cn.TenChucNang,cn.HinhAnh 
            FROM tai_khoan as tk,chi_tiet_quyen as ctq,chuc_nang as cn 
            WHERE tk.MaTK='$matk' AND tk.MaQuyen='$maq' 
            AND tk.MaQuyen=ctq.MaQuyen AND ctq.MaChucNang=cn.MaChucNang";
            $rs=$p->ExcuteQuery($sql);
            $s="";
            while($r=mysqli_fetch_array($rs)){
                $s=$s."<li>
                            <div class='iocn-link'>
                            <a href='./quanly.php?idchucnang=$r[1]'>
                                $r[3]
                                <span class='link_name'>$r[2]</span>
                            </a>
                            </div>      
                        </li>";
            }
            echo $s;
        ?>                     
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="../img/logo.png" alt="profileImg">
                </div>
                <div class="name-job">
                    <div class="profile_name">Quản trị viên</div>
                    <div class="job">Web Gaming</div>
                </div>
                <a href="../index.php"><i class='bx bx-log-out bx-tada bx-rotate-180' ></i></a>
            </div>
        </li>
    </ul>
</div>