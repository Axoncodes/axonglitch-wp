<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>
    <?php
        // connection
        include "config.php";

        $axdetailedinspect = "/[^ا-يa-zA-Z0-9الف-ی@\.\s]/";
        $axscriptinspect = "/(script)/i";
        $axjavascriptinspect = "/(javascript)/i";


        $FName = $_POST["lf_joinus_form_name"];
        $input_check = 1;
        if(preg_match($axdetailedinspect, $FName) || preg_match($axscriptinspect, $FName) || preg_match($axjavascriptinspect, $FName)) 
            $FName_check = 1;
        else
            $FName_check = 0;

        $TelNum = $_POST["lf_joinus_form_tel"];
        $TelNum_check = 1;
        if(preg_match($axdetailedinspect, $TelNum) || preg_match($axscriptinspect, $TelNum) || preg_match($axjavascriptinspect, $TelNum)) 
            $TelNum_check = 1;
        else
            $TelNum_check = 0;

        $Email = $_POST["lf_joinus_form_email"];
        $input_check = 1;
        if(preg_match($axdetailedinspect, $Email) || preg_match($axscriptinspect, $Email) || preg_match($axjavascriptinspect, $Email)) 
            $Email_check = 1;
        else
            $Email_check = 0;

        $Select = $_POST["lf_joinus_form_subj"];
        $input_check = 1;
        if(preg_match($axdetailedinspect, $Select) || preg_match($axscriptinspect, $Select) || preg_match($axjavascriptinspect, $Select)) 
            $Select_check = 1;
        else
            $Select_check = 0;

      

        if (isset($_FILES['lf_joinus_form_attach'])) {
            echo $_SERVER['REQUEST_URI'];
            $errors = [];

            $path = "joinus/";
            $extensions = ['pdf', 'jpg', 'jpeg', 'png'];
    
            // $all_files = count($_FILES['lf_joinus_form_attach']['tmp_name']);
    
            // for ($i = 0; $i < $all_files; $i++) {
                $file_name = $_FILES['lf_joinus_form_attach']['name'];
                $file_tmp = $_FILES['lf_joinus_form_attach']['tmp_name'];
                $file_type = $_FILES['lf_joinus_form_attach']['type'];
                $file_size = $_FILES['lf_joinus_form_attach']['size'];
    
                $file_ext = explode('.', $file_name)[1];
                
                $file = $path . basename($_FILES["lf_joinus_form_attach"]["name"]);
            
    
                // extention filter
                if (!in_array($file_ext, $extensions)) {
                    $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
                }
    
                // file size filter
                if ($file_size > 2097152) {
                    $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
                }

                if (file_exists($file)) {
                    echo "Sorry, file already exists.";
                  }
                if (empty($errors)) {
                    if(move_uploaded_file($file_tmp, $file)) {
                        echo "UPLOAD";
                    }else{
                        echo "CANCEL";
                    }
                    
                }
            // }
            if ($errors) {
                print_r($errors);
            } else {
                echo $file;
            }


            $ClientFile = $file_name;
            $input_check = 1;
            if(preg_match($axdetailedinspect, $ClientFile) || preg_match($axscriptinspect, $ClientFile) || preg_match($axjavascriptinspect, $ClientFile)) 
                $ClientFile_check = 1;
            else
                $ClientFile_check = 0;
    
        }else{
            $ClientFile = 'empty';
            $ClientFile_check = 0;
        }
            


        if($FName_check==0 && $TelNum_check==0 && $Email_check==0 && $Select_check==0) {
            $insert = "INSERT INTO joinus (FName, TelNum, Email, Country, ClientFile) VALUES ('$FName', '$TelNum', '$Email', '$Select', '$ClientFile')";
            $conn->query($insert);

            


        }else{
            $insert = "INSERT INTO joinus (FName, TelNum, Email, Country, ClientFile) VALUES ('$FName_check', '$TelNum_check', '$Email_check', '$Select_check', '$ClientFile_check')";
            $conn->query($insert);
        }

    ?>

</body>
</html>
