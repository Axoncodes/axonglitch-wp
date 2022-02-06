<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>

    <?php
        // connection
        include "config.php";

        $rate = $_GET["rate"];
        $page_id = $_GET["page_id"];
        
        $insert = "INSERT INTO starrate (Rate, Page_Id) VALUES ('$rate', '$page_id')";
        if($conn->query($insert) === TRUE) echo "inserted";
        else echo "Error inserted: ".$conn->error;


        require('../../../../wp-load.php');
        $ax_rate_content = "SELECT Rate, Page_Id FROM starrate WHERE Page_Id='$page_id'";
        $ax_p_rate_content = $conn->query($ax_rate_content);
        $starraters = 0;
        $totalrate =0;
        $rates = array();
        $bestrate = 0;
        if($ax_p_rate_content->num_rows >0) {
            while($row2 = $ax_p_rate_content->fetch_assoc()) {
                $starraters++;
                $totalrate += $row2["Rate"];
                if($row2["Rate"] > $bestrate) $bestrate = $row2["Rate"];
            }$sum = $totalrate/($starraters);
            $sum =number_format($sum, 1, '.', '');
            update_post_meta($page_id,'_starrate',$sum);
        }

    ?>

</body>
</html>
