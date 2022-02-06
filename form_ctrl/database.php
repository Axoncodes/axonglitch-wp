<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>




    <?php //header("Content-type: text/html; charset=utf-8"); ?>

    <?php
        // connection
        include "config.php";



        if(array_key_exists("new_table", $_POST)){
            $ax_new_table = "CREATE TABLE secretDeals (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                -- FName TEXT NOT NULL,
                -- TelNum TEXT NOT NULL,
                Email TEXT NOT NULL,
                PageId TEXT NOT NULL,
                -- ClientFile TEXT NOT NULL,
                -- Country VARCHAR(10) NOT NULL,
                -- ConferType VARCHAR(30) NOT NULL,
                -- Msg VARCHAR(255) NOT NULL,
                reg_data TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            if($conn->query($ax_new_table) === TRUE){
                echo "Table conferForm created successfully";
            }else{
                echo "Error crearing table: ".$conn->error;
            }
        }
        if (array_key_exists("send", $_POST)) {
            $FName = $_POST["ax_Fname"];
            $TelNum = $_POST["ax_TelNum"];
            $Email = $_POST["ax_Email"];
            $Country = $_POST["ax_Country"];
            $ConferType = $_POST["ax_ConferType"];
            $Msg = $_POST["ax_Msg"];
            $insert = "INSERT INTO conferForm (FName, TelNum, Email, Country, ConferType, Msg) VALUES ('$FName', '$TelNum', '$Email', '$Country', '$ConferType', '$Msg')";
            if($conn->query($insert) === TRUE){
                echo "inserted";
            }else{
                echo "Error inserted: ".$conn->error;
            }
        }
        // create table
        

    ?>
    form1
    <form method="post" action="">
        <input type="submit" value="new table" name="new_table" >
    </form>

    form2
    <form method="POST" action="" accept-charset="utf-8">
        ax_Fname<input type="text" name="ax_Fname" />
        ax_TelNum<input type="text" name="ax_TelNum" />
        ax_Email<input type="text" name="ax_Email" />
        ax_Country<input type="text" name="ax_Country" />
        ax_ConferType<input type="text" name="ax_ConferType" />
        ax_Msg<input type="text" name="ax_Msg" />
        <input type="submit" value="submit" name="send" >
    </form>




    <?php

        $ax_request_content = "SELECT FName, TelNum, Email, Country, ConferType, Msg FROM conferForm";
        $ax_process_content = $conn->query($ax_request_content);

        if($ax_process_content->num_rows >0) {
            while($row = $ax_process_content->fetch_assoc()) {
                echo $row["FName"]."/".$row["TelNum"]."/".$row["Email"]."/".$row["Country"]."/".$row["ConferType"]."/".$row["Msg"]."</br></br></br>";
            }
        }else{
            echo "0 results";
        }

    ?>

</body>
</html>
