<?php
    // connection
    include "config.php";
    require_once("../../../../wp-load.php");

    $page_href = $_GET['req_page'];
    $theme_dir = get_template_directory_uri();


    // star ctrl
    $ax_rate_content = "SELECT Rate, Page_Id FROM starrate WHERE Page_Id='$page_href'";
    $ax_p_rate_content = $conn->query($ax_rate_content);
    $starraters = 0;
    $totalrate =0;
    $rates = [];
    if($ax_p_rate_content->num_rows >0) {
        while($row2 = $ax_p_rate_content->fetch_assoc()) {
            $starraters++;
            $totalrate += $row2["Rate"];
            switch ($row2["Rate"]) {
                case 0:
                    $rates[$row2["Rate"]]++;
                    break;
                case 1:
                    $rates[$row2["Rate"]]++;
                    break;
                case 2:
                    $rates[$row2["Rate"]]++;
                    break;
                case 3:
                    $rates[$row2["Rate"]]++;
                    break;
                case 4:
                    $rates[$row2["Rate"]]++;
                    break;
                case 5:
                    $rates[$row2["Rate"]]++;
                    break;
                default:
                    break;
            }
        }

        $sum = $totalrate/($starraters);
        
        echo 
        '<li class="lf_starrating_status">

            <ul class="lf_left">
                <li>'.number_format($sum, 1, '.', '').'</li>
                <li><span>'.$starraters.'</span><span>ratings</span></li>
            </ul>
            <ul class="lf_right">
                <li>
                    <p>5</p><div><div style="width:'.(100*$rates[5]/$starraters).'%;"></div></div>
                </li>
                <li>
                    <p>4</p><div><div style="width:'.(100*$rates[4]/$starraters).'%;"></div></div>
                </li>
                <li>
                    <p>3</p><div><div style="width:'.(100*$rates[3]/$starraters).'%;"></div></div>
                </li>
                <li>
                    <p>2</p><div><div style="width:'.(100*$rates[2]/$starraters).'%;"></div></div>
                </li>
                <li>
                    <p>1</p><div><div style="width:'.(100*$rates[1]/$starraters).'%;"></div></div>
                </li>
                
                </ul>
                
        </li>';
    }


    
    $comment_count = $_GET["comment_count"];

    // share ctrl
    $ax_share_content = "SELECT Media, Page_Id FROM share WHERE Page_Id='$page_href'";
    $ax_p_share_content = $conn->query($ax_share_content);
    $sharesharers=0;
    if($ax_p_share_content->num_rows >0) {
        while($row = $ax_p_share_content->fetch_assoc()) {
            $str_income = $row["Media"];
            if(strpos($str_income, "video") === false || strpos($str_income, "audio") !== false) {
                $sharesharers++;
            }
        }
        echo '
            <div>
            <li><span id="lf_share_count">'.$sharesharers.'</span><img alt="test" src="'.$theme_dir.'/assets/icons/share-dark.svg" /></li>
            <li><span>'.$comment_count.'</span><img alt="test" src="'.$theme_dir.'/assets/icons/comment-dark.svg" /></li>
            </div>
        ';
    }



?>
