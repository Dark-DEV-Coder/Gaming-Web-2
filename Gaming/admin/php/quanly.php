<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset="UTF-8">
        <title>Gaming4D</title>        
        <link href="../css/bootstrap.css" rel="stylesheet">   
        <link rel="stylesheet" href="../css/style2.css">
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>                                                                   
        <script type="text/javascript" src="../js/jquery1.js"></script>
        <style>
            body{
                position: relative;
                width: 100%;
                height: 100%;
                background-color: #E4E9F7;
            }
        </style>
    </head>
    <body>
        <?php
            session_start();
            if (isset($_SESSION['matk']) && isset($_SESSION['maq'])){
                require("./thongtin.php");
                require("./cacchucnang.php");               
            }
        ?>
    </body>
</html>