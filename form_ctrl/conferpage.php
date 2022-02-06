<html>
    <head>
        <title>-cp-confer list</title>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>

    <h1 style="text-align: center;">لیست فرم مشاوره - کاسپین پارتنر</h1>

        <?php
            // connection
            include "config.php";

            // ctrl
            $ax_request_content = "SELECT id ,FName, TelNum, Email, Country, ConferType, Msg, reg_data FROM conferForm";
            $ax_process_content = $conn->query($ax_request_content);

            
            
        ?>



        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Target Country</th>
                <th>Confer Type</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            <?php 

                if($ax_process_content->num_rows >0) {
                    while($row = $ax_process_content->fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."<td>".$row["FName"]."</td><td>".$row["TelNum"]."</td><td>".$row["Email"]."</td><td>".$row["Country"]."</td><td>".$row["ConferType"]."</td><td>".$row["Msg"]."</td><td>".$row["reg_data"]."</td></tr>";
                    }
                }else{
                    echo "0 results";
                }

            ?>
        </table>



        <?php $conn->close(); ?>


    </body>
</html>