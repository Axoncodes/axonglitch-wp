<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>

    <?php
        // connection
        include "config.php";

        $media = $_GET["media"];
        $page_id = $_GET["req_page"];
        
        $insert = "INSERT INTO share (media, Page_Id) VALUES ('$media', '$page_id')";
        if($conn->query($insert) === TRUE){
            echo "inserted";
        }else{
            echo "Error inserted: ".$conn->error;
        }

    ?>

</body>
</html>
