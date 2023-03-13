<?php
    if (isset($_GET['idchucnang'])){
        $id=$_GET['idchucnang'];
        if ($id=='SP')
            require("./sanpham.php");
        if ($id=='NV')
            require("./nhanvien.php");
        if ($id=='KH')
            require("./khachhang.php");
        if ($id=='LSP')
            require("./loaisp.php");
        if ($id=='NSX')
            require("./nsx.php");
        if ($id=='TK')
            require("./taikhoan.php");
        if ($id=='QTK')
            require("./quyentk.php");
        if ($id=='PBH')
            require("./phieubaohanh.php");
        if ($id=='PNH')
            require("./phieunhaphang.php");
        if ($id=='LN')
            require("./loinhuan.php");
        if ($id=='KM')
            require("./khuyenmai.php");
        if ($id=='HD')
            require("./hoadon.php");
        if ($id=='DG')
            require("./danhgia.php");
    }
    if (isset($_GET['xuly'])){
        $xl=$_GET['xuly'];
        if ($xl=='themquyentk') // quyền tài khoản
            require("./themquyentk.php");
        if ($xl=='suaquyentk')
            require("./suaquyentk.php");
        if ($xl=='xemquyentk')
            require("./xemquyentk.php");

        if ($xl=='themtk')
            require("./themtaikhoan.php");    // tài khoản
        if ($xl=='suatk')
            require("./suataikhoan.php");
        if ($xl=='xemtk')
            require("./xemtaikhoan.php");

        if ($xl=='themnsx')
            require("./themnsx.php");    // nhà sản xuất
        if ($xl=='suansx')
            require("./suansx.php");
        if ($xl=='xemnsx')
            require("./xemnsx.php");

        if ($xl=='themlsp')
            require("./themlsp.php");    // loại sản phẩm
        if ($xl=='sualsp')
            require("./sualsp.php");

        if ($xl=='sualn')
            require("./sualn.php");    // lợi nhuận

        if ($xl=='thempnh')
            require("./thempnh.php");    // phiếu nhập hàng
        if ($xl=='suapnh')
            require("./suapnh.php");
        if ($xl=='xempnh')
            require("./xempnh.php");

        if ($xl=='themsp')
            require("./themsanpham.php");    // phiếu nhập hàng
        if ($xl=='suasp')
            require("./suasanpham.php");
        if ($xl=='xemsp')
            require("./xemsanpham.php");

        if ($xl=='suahd')
            require("./suahd.php");    // hóa đơn
        if ($xl=='xemhd')
            require("./xemhd.php");    
        if ($xl=='thongkehd')
            require("./thongkehd.php"); 
        
        if ($xl=='xemdg')
            require("./xemdanhgia.php");   // đánh giá

        if ($xl=='themkh') // khách hàng
            require("./themkhachhang.php");
        if ($xl=='suakh')
            require("./suakhachhang.php");
        if ($xl=='xemkh')
            require("./xemkhachhang.php");
        if ($xl=='timkiemkhachhang')
            require('timkiemkh.php');

        if ($xl=='themnv') // nhân viên
            require("./themnhanvien.php");
        if ($xl=='suanv')
            require("./suanhanvien.php");
        if ($xl=='xemnv')
            require("./xemnhanvien.php");
        if ($xl=='timkiemnhanvien')
            require('./timkiemnhanvien.php');
            
        if ($xl=='themkm')
            require("./themkm.php");    // km
        if ($xl=='suakm')
            require("./suakm.php");
        if ($xl=='xemkm')
            require("./xemkm.php");
    }
?>