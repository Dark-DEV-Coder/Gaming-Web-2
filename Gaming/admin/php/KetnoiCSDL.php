<?php   
    class CheckConnection{                  
        public static function ExcuteQuery($sql){
            $localhost='localhost';
            $user='root';
            $pass='';
            $data='gaming';
            if (!($connect=mysqli_connect($localhost,$user,$pass)))
                echo '<div style="color:red;">Kết nối localhost thất bại</div>'; 
            if (!(mysqli_select_db($connect,$data))) 
                echo '<div style="color:red;">Kết nối database thất bại</div>';
            if (!(mysqli_query($connect,"set names 'utf8'")))  
                echo '<div style="color:red;">Không thể set utf8</div>'; 
            if (!($result=mysqli_query($connect,$sql)))
                echo "<div style='color:red;'>Thực thi sql thất bại</div>";
                // echo mysqli_error($sql); 
            if (!(mysqli_close($connect)))
                echo '<div style="color:red;">Đóng kết nối thất bại</div>';
            return $result;        
        }
    }      
?>