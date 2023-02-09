<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>




    <?php //header("Content-type: text/html; charset=utf-8"); ?>

    <?php
        // connection
        include "config.php";
        
        $axdetailedinspect = "/[^ا-يa-zA-Z0-9الف-ی@\.\s]/";
        $axscriptinspect = "/(script)/i";
        $axjavascriptinspect = "/(javascript)/i";


        $Email = $_POST["ax_sub_email"];
        if(preg_match($axdetailedinspect, $Email) || preg_match($axscriptinspect, $Email) || preg_match($axjavascriptinspect, $Email)) {
            $insert = "INSERT INTO subscriberlist (Email) VALUES ('1')";
            if($conn->query($insert) === TRUE){
                echo "inserted";
            }else{
                echo "Error inserted: ".$conn->error;
            }
        }else{
            $insert = "INSERT INTO subscriberlist (Email) VALUES ('$Email')";
            if($conn->query($insert) === TRUE){
                echo "inserted";
            }else{
                echo "Error inserted: ".$conn->error;
            }
        }


        
        

        

    ?>

</body>
</html>
