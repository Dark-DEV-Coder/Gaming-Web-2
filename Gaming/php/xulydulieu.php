<?php
    class Xuly{
        public static function Chuyenngaythuan($s){
            $s1=substr($s,8).'-'.substr($s,5,2).'-'.substr($s,0,4);            
            return $s1;
        }
        public static function Chuyenngaynguoc($s){
            $s1=substr($s,6).'-'.substr($s,3,2).'-'.substr($s,0,2);            
            return $s1;
        }
        public static function Chuyentien($s){
            $s1="";
            $d=0;
            $len=strlen($s);
            for ($i=$len-1;$i>=0;$i--){
                $d++;
                if ($d%3==0 && $i!=0){
                    $s1=','.substr($s,$i,$d).$s1;
                    $d=0;
                }
                if ($i==0)
                    $s1=substr($s,$i,$d).$s1;
            }
            return $s1;
        }
        public static function LayNgayHienTai(){
            $now=getdate();
            if ($now['mon']<10)
                $today=$now['year']."-0".$now['mon']."-".$now['mday'];
        }
    }
?>