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


        $FName = $_POST["ax_name"];
        $input_check = 1;
        if(preg_match($axdetailedinspect, $FName) || preg_match($axscriptinspect, $FName) || preg_match($axjavascriptinspect, $FName)) 
            $FName_check = 1;
        else
            $FName_check = 0;

        $TelNum = $_POST["ax_tel"];
        $TelNum_check = 1;
        if(preg_match($axdetailedinspect, $TelNum) || preg_match($axscriptinspect, $TelNum) || preg_match($axjavascriptinspect, $TelNum)) 
            $TelNum_check = 1;
        else
            $TelNum_check = 0;
        

        $Email = $_POST["ax_email"];
        $Email_check = 1;
        if(preg_match($axdetailedinspect, $Email) || preg_match($axscriptinspect, $Email) || preg_match($axjavascriptinspect, $Email)) 
            $Email_check = 1;
        else
            $Email_check = 0;   
        

        $Country = $_POST["ax_select"];
        $Country_check = 1;
        if(preg_match($axdetailedinspect, $Country) || preg_match($axscriptinspect, $Country) || preg_match($axjavascriptinspect, $Country)) 
            $Country_check = 1;
        else
            $Country_check = 0;
        

        $ConferType = $_POST["ax_type"];
        $ConferType_check = 1;
        if(preg_match($axdetailedinspect, $ConferType) || preg_match($axscriptinspect, $ConferType) || preg_match($axjavascriptinspect, $ConferType)) 
            $ConferType_check = 1;
        else
            $ConferType_check = 0;
        

        $Msg = $_POST["ax_msg"];
        $Msg_check = 1;
        if(preg_match($axdetailedinspect, $Msg) || preg_match($axscriptinspect, $Msg) || preg_match($axjavascriptinspect, $Msg)) 
            $Msg_check = 1;
        else
            $Msg_check = 0;
        

        if($FName_check==0 && $TelNum_check==0 && $Email_check==0 && $Country_check==0 && $ConferType_check==0 && $Msg_check==0) {
            $insert = "INSERT INTO conferForm (FName, TelNum, Email, Country, ConferType, Msg) VALUES ('$FName', '$TelNum', '$Email', '$Country', '$ConferType', '$Msg')";
            $conn->query($insert);
        }else{
            $insert = "INSERT INTO conferForm (FName, TelNum, Email, Country, ConferType, Msg) VALUES ('$FName_check', '$TelNum_check', '$Email_check', '$Country_check', '$ConferType_check', '$Msg_check')";
            $conn->query($insert);
        }

        

    ?>

</body>
</html>
