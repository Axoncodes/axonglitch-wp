<?php
  // add shortcodes content
  function lf_content_shortcode($atts, $content) {

    $type = $atts['type'];
    $keyword = $atts['keyword'];

    if(strlen($keyword)>0) $title = " ".ucwords($keyword).": ";
    $altTitle = "title='$keyword'";

    if($type == "code") {
      $code = str_replace("&lt;", "<span class='lf_content_htmltags_tag'>&lt;</span><span class='lf_content_htmltags_element'>", $content);
      $code = str_replace("&gt;", "</span><span class='lf_content_htmltags_tag'>&gt;</span>", $code);

      // js
      $code = str_replace("/+/", "<span class='lf_content_js_comment'>//", $code);
      $code = str_replace("/-/", "</span>", $code);
      $code = str_replace("const", "<span class='lf_content_js_var'>const</span>", $code);
      // $code = str_replace("var", "<span class='lf_content_js_var'>var</span>", $code);
      $code = str_replace("let", "<span class='lf_content_js_var'>let</span>", $code);
      $code = str_replace("return", "<span class='lf_content_js_return'>return</span>", $code);
      $code = str_replace(",", "<span class='lf_content_htmltags_tag'>,</span>", $code);
      $code = str_replace("[", "<span class='lf_content_htmltags_tag'>[</span>", $code);
      $code = str_replace("]", "<span class='lf_content_htmltags_tag'>]</span>", $code);
      $code = str_replace("{", "<span class='lf_content_htmltags_tag'>{</span>", $code);
      $code = str_replace("}", "<span class='lf_content_htmltags_tag'>}</span>", $code);
      $code = str_replace(")", "<span class='lf_content_htmltags_tag'>)</span>", $code);
      $code = str_replace("(", "<span class='lf_content_htmltags_tag'>(</span>", $code);
      $code = str_replace(":", "<span class='lf_content_htmltags_tag'>:</span>", $code);
      $message = "<section class='lf_content_htmltags'><h3>$keyword</h3><section class='lf_content_htmltags_inner'>$code</section></section>";
    }else if($type == "tooltip") {
      $theicon = '<svg class="lf_content_tooltip_icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M11 7h2v2h-2zm0 4h2v6h-2zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>';
      $message = "<span class='lf_content_tooltip'><span class='lf_content_tooltip_keyword'>$keyword</span> $theicon <span class='lf_content_tooltip_content'>$content</span></span>";
    }else if(strpos($type, "inner")>0) $message = "<span class='lf_content_$type' $altTitle> <span style='font-weight:600;'>$title </span> $content </span>";
    else $message = "<div class='lf_content_$type' $altTitle> <span style='font-weight:600;'>$title</span>$content</div>";
    
    return $message;

  }add_shortcode('content', 'lf_content_shortcode');
?>