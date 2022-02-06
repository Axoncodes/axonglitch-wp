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
            $ax_request_content = "SELECT id, Rate ,Page_Id, reg_data FROM starrate";
            $ax_process_content = $conn->query($ax_request_content);

            $ax_rate_content = "SELECT Rate, Page_Id FROM starrate WHERE Page_Id=1";
            $ax_p_rate_content = $conn->query($ax_rate_content);

            
            
        ?>


        <?php
            $star_percent=0;
            $star_percent_count=0;
            if($ax_p_rate_content->num_rows >0) {
                while($row = $ax_p_rate_content->fetch_assoc()) {
                    // echo $row["Rate"]."-";
                    $starraters++;
                    $totalrate += $row["Rate"];
                }
                $sum = 100*$totalrate/($starraters*5);
                // echo "<br/>".$star_percent."||count: ".$star_percent_count."||percent: ".$sum;
                echo $sum."%";
            }else{
                echo "0 %";
            }
        ?>


        <table>
            <tr>
                <th>ID</th>
                <th>rate</th>
                <th>page Id</th>
                <th>Date</th>
            </tr>
            <?php 

                if($ax_process_content->num_rows >0) {
                    while($row = $ax_process_content->fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."<td>".$row["Rate"]."</td><td>".$row["Page_Id"]."</td><td>".$row["reg_data"]."</td></tr>";
                    }
                }else{
                    echo "0 results";
                }

            ?>
        </table>





        <?php $conn->close(); ?>


    </body>
</html>