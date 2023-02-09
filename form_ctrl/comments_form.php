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


        $FName = $_POST["lf_comment_name"];
        $input_check = 1;
        if(preg_match($axdetailedinspect, $FName) || preg_match($axscriptinspect, $FName) || preg_match($axjavascriptinspect, $FName)) 
            $FName_check = 1;
        else
            $FName_check = 0;

        $lfEmail = $_POST["lf_comment_email"];
        $lfEmail_check = 1;
        if(preg_match($axdetailedinspect, $lfEmail) || preg_match($axscriptinspect, $lfEmail) || preg_match($axjavascriptinspect, $lfEmail)) 
            $lfEmail_check = 1;
        else
            $lfEmail_check = 0;
        

        $lfText = $_POST["lf_comment_text"];
        $lfText_check = 1;
        if(preg_match($axdetailedinspect, $lfText) || preg_match($axscriptinspect, $lfText) || preg_match($axjavascriptinspect, $lfText)) 
            $lfText_check = 1;
        else
            $lfText_check = 0;   



        $Page_Id = 1;
        $reply_id = "1_1";
        
        

        if($FName_check==0 && $lfEmail_check==0 && $lfText_check==0 && $Country_check==0 && $ConferType_check==0 && $Msg_check==0) {
            $insert = "INSERT INTO comment (Fname, reply_id, Email, Comment, Page_Id) VALUES ('$FName', '$reply_id', '$lfEmail', '$lfText', '$Page_Id')";
            if ($conn->query($insert) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "1Error: " . $sql . "<br>" . $conn->error;
            }
        }else{
            $insert = "INSERT INTO comment (Fname, reply_id, Email, Comment, Page_Id) VALUES ('$FName_check','$reply_id', '$lfEmail_check', '$lfText_check', '$Page_Id')";
            if ($conn->query($insert) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "2Error: " . $sql . "<br>" . $conn->error;
            }
        }

        

    ?>

</body>
</html>
