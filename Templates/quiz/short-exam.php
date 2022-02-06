<?php
    require("../../../../../wp-load.php");
    
    $postid = $_GET['postid'];
    $request = $_GET['req'];
    $no = $_GET['no'];
    switch($request) {
        case 'hint':
            get_hint($no, $postid);
            break;
        case 'opt':
            get_opt($no, $postid);
            break;
        default:
            echo 'wrong req';
            break;
            
    }

    function get_hint($no, $postid) {
        $value = get_post_meta( $postid, '_exercise', true );
        $value = json_decode($value);
        echo $value[$no][3];
    }
    
    
    function get_opt($no, $postid) {
        $value = get_post_meta( $postid, '_exercise', true );
        $value = json_decode($value);
        $opts_ans = array();
        foreach($value as $arr) {
            array_push($opts_ans,$arr[2]);
            array_push($opts_ans,$arr[1]);
        }
        print_r(json_encode($opts_ans));
    }
    

?>