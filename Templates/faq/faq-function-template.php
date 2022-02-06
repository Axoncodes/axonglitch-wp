<?php
function faq_html( $post ) {
    $value = get_post_meta( $post->ID, '_faq', true );
	?>
	
    <ul id="lf_faqmetabox_list_main">
        <li class="lf_faqmetabox_list0">
            <input class="lf_faqmetabox_title" name="lf_faqmetabox_title0" type="text" />
            <textarea cols="40" class="lf_faqmetabox_textarea" name="lf_faqmetabox_textarea0"></textarea>
            <button class="lf_faqmetabox_remove" data-list="lf_faqmetabox_list0">remove</button>
        </li>
        <li class="lf_faqmetabox_list1">
            <input class="lf_faqmetabox_title" name="lf_faqmetabox_title1" type="text" />
            <textarea cols="40" class="lf_faqmetabox_textarea" name="lf_faqmetabox_textarea1"></textarea>
            <button class="lf_faqmetabox_remove" data-list="lf_faqmetabox_list1">remove</button>
        </li>
        <li class="lf_faqmetabox_list2">
            <input class="lf_faqmetabox_title" name="lf_faqmetabox_title2" type="text" />
            <textarea cols="40" class="lf_faqmetabox_textarea" name="lf_faqmetabox_textarea2"></textarea>
            <button class="lf_faqmetabox_remove" data-list="lf_faqmetabox_list2">remove</button>
        </li>
    </ul>
    <p id="lf_faqmetabox_addnew">Add new</p>
    <input id="lf_faqmetabox_counter_input" name="lf_faqmetabox_counter_input" type="text" value="3">
    <script>
        const lf_faqmetabox_addnew = document.getElementById("lf_faqmetabox_addnew");
        const lf_faqmetabox_list_main = document.getElementById("lf_faqmetabox_list_main");
        const lf_faqmetabox_counter_input = document.getElementById("lf_faqmetabox_counter_input");
        var lf_faqmetabox_counter_val=0;
        lf_faqmetabox_addnew.addEventListener("click", (e)=>{
            e.preventDefault();
            lf_faqmetabox_counter_val = lf_faqmetabox_counter_input.value;
            lf_faqmetabox_list_main.innerHTML += '<li class="lf_faqmetabox_list'+lf_faqmetabox_counter_val+'"><input class="lf_faqmetabox_title" name="lf_faqmetabox_title'+lf_faqmetabox_counter_val+'" type="text" /><textarea cols="40" class="lf_faqmetabox_textarea" name="lf_faqmetabox_textarea'+lf_faqmetabox_counter_val+'"></textarea><button class="lf_faqmetabox_remove" data-list="lf_faqmetabox_list'+lf_faqmetabox_counter_val+'">remove</button></li>';
            lf_faqmetabox_counter_val++;
            lf_faqmetabox_counter_input.setAttribute('value', lf_faqmetabox_counter_val);
        });
    </script>
    
<?php } ?>