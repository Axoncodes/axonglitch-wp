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


        $FName = $_POST["ax_callreq_username"];
        $input_check = 1;
        if(preg_match($axdetailedinspect, $FName) || preg_match($axscriptinspect, $FName) || preg_match($axjavascriptinspect, $FName)) 
            $FName_check = 1;
        else
            $FName_check = 0;

        $TelNum = $_POST["ax_callreq_tel"];
        $TelNum_check = 1;
        if(preg_match($axdetailedinspect, $TelNum) || preg_match($axscriptinspect, $TelNum) || preg_match($axjavascriptinspect, $TelNum)) 
            $TelNum_check = 1;
        else
            $TelNum_check = 0;
        

        if($FName_check==0 && $TelNum_check==0) {
            $insert = "INSERT INTO callreq (FName, TelNum) VALUES ('$FName', '$TelNum')";
            $conn->query($insert);
        }else{
            $insert = "INSERT INTO callreq (FName, TelNum) VALUES ('$FName_check', '$TelNum_check')";
            $conn->query($insert);
        }

        

    ?>

</body>
</html>
