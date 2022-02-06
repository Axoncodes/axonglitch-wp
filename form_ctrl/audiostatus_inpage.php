<?php
    // connection
    include "config.php";

    $page_href = $_GET['req_page'];

    // share ctrl
    $ax_audio_content = "SELECT Media, Page_Id FROM share WHERE Page_Id='$page_href'";
    $ax_p_audio_content = $conn->query($ax_audio_content);

    $audioplay=0;
    $audiolike=0;
    $audiodislike=0;
    $audiodownload=0;
    if($ax_p_audio_content->num_rows >0) {
        while($row = $ax_p_audio_content->fetch_assoc()) {
            $str_income = $row["Media"];
            if(strpos($str_income, "audio") !== false)  {
                if(strpos($str_income, "audioPlay") !== false) {
                    $audioplay++;
                }else if(strpos($str_income, "audioLike") !== false) {
                    $audiolike++;
                }else if(strpos($str_income, "audiodisLike") !== false) {
                    $audiodislike++;
                }else if(strpos($str_income, "audioDownload") !== false) {
                    $audiodownload++;
                }
            }
        }
        $audiolike -= $audiodislike;
        echo '
            <div class="lf_audio_likes">
                <p><span id="lf_audio_likes_count">'.$audiolike.'</span> لایک </p>
            </div>
            <div class="lf_audio_plays">
                <p><span id="lf_audio_plays_count">'.$audioplay.'</span> بازدید </p>
            </div>
            ';
        }
        // <div class="lf_audio_downs">
        //     <svg id="lf_audio_down_trigger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4.01 8.54C5.2 9.23 6 10.52 6 12s-.81 2.77-2 3.46V18h16v-2.54c-1.19-.69-2-1.99-2-3.46s.81-2.77 2-3.46V6H4l.01 2.54zm6.72 1.68L12 7l1.26 3.23 3.47.2-2.69 2.2.89 3.37L12 14.12 9.07 16l.88-3.37-2.69-2.2 3.47-.21z" opacity=".3"/><path d="M20 4H4c-1.1 0-1.99.9-1.99 2v4c1.1 0 1.99.9 1.99 2s-.89 2-2 2v4c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2v-4c-1.1 0-2-.9-2-2s.9-2 2-2V6c0-1.1-.9-2-2-2zm0 4.54c-1.19.69-2 1.99-2 3.46s.81 2.77 2 3.46V18H4v-2.54c1.19-.69 2-1.99 2-3.46 0-1.48-.8-2.77-1.99-3.46L4 6h16v2.54zM9.07 16L12 14.12 14.93 16l-.89-3.36 2.69-2.2-3.47-.21L12 7l-1.27 3.22-3.47.21 2.69 2.2z"/></svg>
        //     <p><span id="lf_audio_down_count">'.$audiodownload.'</span> دانلود </p>
        // </div>
