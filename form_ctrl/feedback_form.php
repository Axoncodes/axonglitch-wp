<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>
<?php



    include "config.php";


    $q1 = $_GET["q1"];
    $q2 = $_GET["q2"];
    $page_id = $_GET["page_id"];

    $insert = "INSERT INTO feedback (q1, q2, Page_Id) VALUES ('$q1', '$q2', '$page_id')";
    if($conn->query($insert) === TRUE){
        echo "inserted";
    }else{
        echo "Error inserted: ".$conn->error;
    }





?>
</body>
</html>
