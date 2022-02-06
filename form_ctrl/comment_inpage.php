<?php
    // connection
    include "config.php";

    $page_href = $_GET['req_page'];

    // ctrl
    $ax_comment_content = "SELECT id, reply_id, Fname, Comment, Page_Id, reg_data FROM comment WHERE Page_Id=1";
    $ax_p_comment_content = $conn->query($ax_comment_content);
    
    
?>
<?php
    if($ax_p_comment_content->num_rows >0) {
        while($row = $ax_p_comment_content->fetch_assoc()) {

            
            // date ctrl
            $date = $row["reg_data"];
            $comment_year = substr($date, 0, 4);
            $comment_month = substr($date, 5, 2);
            $comment_day = substr($date, 8, 2);
            
            $new_date = date("Y/m/d");
            $comment_new_year = substr($new_date, 0, 4);
            $comment_new_month = substr($new_date, 5, 2);
            $comment_new_day = substr($new_date, 8, 2);

            $yyy = $comment_new_year-$comment_year;
            $mmm = $comment_new_month-$comment_month;
            $rm = (12*$yyy)+$mmm;
            $ddd = $comment_new_day-$comment_day;
            $td = (30*$rm)+$ddd;
            if($td == 0)
                $td = "امروز";
            else
                $td= $td." روز قبل ";


            // reply style ctrl
            $reply_id = $row['reply_id'];
            if($reply_id > 0) {

                $reply_id_len = strlen($reply_id);
                $reply_id_sep_pos = strpos($reply_id, "_");
                $reply_id_one_num = substr($reply_id, 0, $reply_id_sep_pos);
                $reply_id_two_len = $reply_id_len-$reply_id_sep_pos+1;
                $reply_id_two_num = substr($reply_id, $reply_id_sep_pos+1, $reply_id_two_len);

                $reply_style = 'style="width:'.(100-$reply_id_two_num*2.5).'%"';
                $reply_class = 'lf_item_comment_reply';

            }else{
                $reply_style=null;
                $reply_class=null;
            }
            echo $reply_id_one_num."||";
            echo $reply_id_two_num;


            echo 
            '<div class="lf_item_comment '.$reply_class.' "'.$reply_style.'>
                <div class="lf_item_comment_body">
                    <div class="lf_item_poster">
                        <img src="../assets/images/authors/comment_poster.png" class="lf_item_img" />
                    </div>
                    <div class="lf_item_content">
                        <div class="lf_item_content_top">
                            <h5 class="lf_comment_username">'.$row["Fname"].'</h5>
                            <p class="lf_comment_time">'.$td.'</p>
                        </div>
                        <p class="lf_item_context">'.$row["Comment"].'</p>
                        <div class="lf_item_content_bottom">
                            <div class="lf_comment_replies">
                                <span class="lf_comment_reply id_'.$row['id'].'">پاسخ</span> 
                            </div>
                            <div class="lf_comment_likes">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/><path d="M13.12 2.06L7.58 7.6c-.37.37-.58.88-.58 1.41V19c0 1.1.9 2 2 2h9c.8 0 1.52-.48 1.84-1.21l3.26-7.61C23.94 10.2 22.49 8 20.34 8h-5.65l.95-4.58c.1-.5-.05-1.01-.41-1.37-.59-.58-1.53-.58-2.11.01zM3 21c1.1 0 2-.9 2-2v-8c0-1.1-.9-2-2-2s-2 .9-2 2v8c0 1.1.9 2 2 2z"/></svg>
                                <span class="lf_comment_likes_count">31</span> 
                            </div>
                            <div class="lf_comment_dislikes">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/><path d="M10.88 21.94l5.53-5.54c.37-.37.58-.88.58-1.41V5c0-1.1-.9-2-2-2H6c-.8 0-1.52.48-1.83 1.21L.91 11.82C.06 13.8 1.51 16 3.66 16h5.65l-.95 4.58c-.1.5.05 1.01.41 1.37.59.58 1.53.58 2.11-.01zM21 3c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2s2-.9 2-2V5c0-1.1-.9-2-2-2z"/></svg>
                                <span class="lf_comment_dislikes_count">8</span> 
                            </div>
                            <div class="lf_comment_replies">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18zM17 14H7c-.55 0-1-.45-1-1s.45-1 1-1h10c.55 0 1 .45 1 1s-.45 1-1 1zm0-3H7c-.55 0-1-.45-1-1s.45-1 1-1h10c.55 0 1 .45 1 1s-.45 1-1 1zm0-3H7c-.55 0-1-.45-1-1s.45-1 1-1h10c.55 0 1 .45 1 1s-.45 1-1 1z"/></svg>
                                <span class="lf_comment_reply_count">8</span> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

        }
    }else{
        echo "هیچ کامنتی یافت نشد";
    }
?>