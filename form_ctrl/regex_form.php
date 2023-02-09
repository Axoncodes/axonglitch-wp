<?php

    $axdetailedinspect = "/[^ا-يa-zA-Z0-9الف-ی@\.\s]/";
    $axscriptinspect = "/(script)/i";
    $axjavascriptinspect = "/(javascript)/i";
    $str = "a.alire>za@gmail.com";
    echo preg_match($axdetailedinspect, $str)." | ".preg_match($axscriptinspect, $str)." | ".preg_match($axjavascriptinspect, $str);
    if(preg_match($axdetailedinspect, $str) || preg_match($axscriptinspect, $str) || preg_match($axjavascriptinspect, $str))
        echo "go fuck yourself";
    else
        echo "all good";
?>