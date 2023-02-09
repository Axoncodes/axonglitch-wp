<html>
    <head>
        <title>-cp-subscribers list</title>
        <style>
            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
    <h1 style="text-align: center;">لیست درخواست های تماس تلفنی - کاسپین پارتنر</h1>
        <?php
            // connection
            include "config.php";

            // ctrl
            $ax_request_content = "SELECT id, Fname, TelNum, reg_data FROM callreq";
            $ax_process_content = $conn->query($ax_request_content);

            
            
        ?>



        <table>
            <tr>
            <th>id</th>
            <th>Name</th>
            <th>Tel</th>
            <th>date</th>
            </tr>
            <?php 
                if($ax_process_content->num_rows >0) {
                    while($row = $ax_process_content->fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."</td><td>".$row["Fname"]."</td><td>".$row["TelNum"]."</td><td>".$row["reg_data"]."</td></tr>";
                    }
                }else{
                    echo "0 results";
                }
            ?>
        </table>



        <?php $conn->close(); ?>


    </body>
</html>