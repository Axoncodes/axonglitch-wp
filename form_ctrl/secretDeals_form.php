<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>

    <?php
        // connection
        include "config.php";
        $Email = $_GET["Email"];
        $page_id = $_GET["PageId"];
        

        $axdetailedinspect = "/[^a-zA-Z0-9@\.\s]/";
        $axscriptinspect = "/(script)/i";
        $axjavascriptinspect = "/(javascript)/i";

        if(preg_match($axdetailedinspect, $Email) || preg_match($axscriptinspect, $Email) || preg_match($axjavascriptinspect, $Email)) {
            $Email_check = 1;
        } else {
            $Email_check = 0;
        }


        if($Email_check != 1) {
            $insert = "INSERT INTO secretDeals (Email, PageId) VALUES ('$Email', '$page_id')";
            if($conn->query($insert) === TRUE){
                echo "inserted";
            }else{
                echo "Error inserted: ".$conn->error;
            }
        }else{
            echo 'invalid';
        }

    ?>

</body>
</html>
