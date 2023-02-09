<?php
function exercise_html( $post ) { 
    $value = get_post_meta( $post->ID, '_exercise', true );
    if(strlen($value)<=0) $value = '[]';
	?>

	<style type="text/css">p#lf_exe_submit, p#lf_exe_add, .lf_exercise_remove {border: 1px solid;width: fit-content;padding: 3px 11px;border-radius: 3px;background-color: #f0f0f0;cursor: pointer;}div#lf_exe_buttons {display: grid;grid-auto-flow: column;width: fit-content;column-gap: 10px;}.lf_exercise_holder > div {display: grid;grid-template-columns: auto auto;}.lf_exercise_holder {border-bottom: 2px solid #000;border-radius: 3px;padding: 3px 20px;display: grid;background-color: #f3f3f3;}#lf_exercise_wrapup {display: grid;row-gap: 24px;}.lf_exercise_holder > div p {display: grid;grid-auto-flow: column;place-content: center;place-items: center;}.lf_exercise_holder > p {width: fit-content;display: grid;margin: 0;}</style>
    <section id="lf_exercise_wrapup"></section>
	<div id="lf_exe_buttons">
        <p id="lf_exe_add" data-last="-1">Add new question</p>
        <p id="lf_exe_submit">Save the quiz</p>
    </div>

    <input type="text" id="lf_exe_submit_field" name="exercise_n">
    
    <script>
        var load_icon = '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><g><rect fill="none" height="24" width="24"/></g><g><g><polygon opacity=".3" points="8,7.5 12,11.5 16,7.5 16,4 8,4"/><polygon opacity=".3" points="8,7.5 12,11.5 16,7.5 16,4 8,4"/><path d="M18,2H6v6l4,4l-3.99,4.01L6,22h12l-0.01-5.99L14,12l4-3.99V2z M16,16.5V20H8v-3.5l4-4L16,16.5z M16,7.5l-4,4l-4-4V4h8V7.5 z"/></g></g></svg>';
        var check_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg>';
        
        var lf_exercise_array = <?php echo $value; ?>, lf_exercise_array_txt, lf_exercise_array_txt_tmp='', i, j;
        if(!lf_exercise_array) lf_exercise_array="";
        document.getElementById("lf_exe_submit_field").value = JSON.stringify(lf_exercise_array);
        var i, newcontentlist_exe='', code=-1;
        for(i=0; i<lf_exercise_array.length; i++) {
            newcontentlist_exe += '<div class="lf_exercise_holder">';
            newcontentlist_exe += '<p>Enter the question:</br> <textarea cols="30" class="lf_exercise_headtext" placeholder="Question head">'+lf_exercise_array[i][0]+'</textarea></p>';
            newcontentlist_exe += '<p>Optioned texts:</p><div>';
            for(j=0; j<4; j++) {
                if(lf_exercise_array[i][2] == j) ex_opts_correct = 'checked';
                else ex_opts_correct = '';
                newcontentlist_exe += '<p><input name="ex_opts_correct_'+i+'" type="radio" '+ex_opts_correct+'/><textarea cols="30" class="lf_exercise_opt_text_'+i+'" type="text" placeholder="Question option text">'+lf_exercise_array[i][4][j]+'</textarea></p>';
            }
            newcontentlist_exe += '</div>';
            newcontentlist_exe += '<p>Hint:</br><textarea cols="30" class="lf_exercise_hint" placeholder="Hint">'+lf_exercise_array[i][3]+'</textarea></p>';
            newcontentlist_exe += '<p>Answer:</br><textarea cols="30" class="lf_exercise_ans" placeholder="Final answer">'+lf_exercise_array[i][1]+'</textarea></p><p class="lf_exercise_remove" data-no="'+i+'">Remove this</p></div>';
            code++;
        }

        document.getElementById("lf_exe_add").setAttribute("data-last", code);
        document.getElementById("lf_exercise_wrapup").innerHTML = newcontentlist_exe;

        document.getElementById("lf_exe_add").addEventListener("click", ()=>{
            var code = document.getElementById("lf_exe_add").getAttribute("data-last");
            if(lf_exercise_array[code] || lf_exercise_array.length == 0) {
                lf_submitData_exercise();
                if(code == -1) document.getElementById("lf_exercise_wrapup").innerHTML = '<div class="lf_exercise_holder"><p> Enter the question:</br> <textarea cols="30" class="lf_exercise_headtext" cols="30" placeholder="Question head"></textarea></p><p>Optioned texts:</p><div> <p><input name="ex_opts_correct_0" type="radio"/><textarea cols="30" class="lf_exercise_opt_text_0" type="text" placeholder="Question option text"></textarea></p><p><input name="ex_opts_correct_0" type="radio"/><textarea cols="30" class="lf_exercise_opt_text_0" type="text" placeholder="Question option text"></textarea></p><p><input name="ex_opts_correct_0" type="radio"/><textarea cols="30" class="lf_exercise_opt_text_0" type="text" placeholder="Question option text"></textarea></p><p><input name="ex_opts_correct_0" type="radio"/><textarea cols="30" class="lf_exercise_opt_text_0" type="text" placeholder="Question option text"></textarea></p></div><p>Hint:</br><textarea cols="30" class="lf_exercise_hint" placeholder="Hint"></textarea></p><p> Answer:</br><textarea cols="30" class="lf_exercise_ans" placeholder="Final answer"></textarea></p><p class="lf_exercise_remove" data-no="0">Remove this</p></div>';
                code++;
                document.getElementById("lf_exe_add").setAttribute("data-last", code);
                var i, newcontentlist_exe='', j, ex_opts_correct='';
                for(i=0; i<code; i++) {
                    newcontentlist_exe += '<div class="lf_exercise_holder">';
                    newcontentlist_exe += '<p>Enter the question:</br> <textarea cols="30" class="lf_exercise_headtext" cols="30" placeholder="question head">'+lf_exercise_array[i][0]+'</textarea></p>';
                    newcontentlist_exe += '<p>Optioned texts:</p><div>';
                    for(j=0; j<4; j++) {
                        if(lf_exercise_array[i][2] == j) ex_opts_correct = 'checked';
                        else ex_opts_correct = '';
                        newcontentlist_exe += '<p><input name="ex_opts_correct_'+i+'" type="radio" '+ex_opts_correct+'/><textarea cols="30" class="lf_exercise_opt_text_'+i+'" type="text" placeholder="Question option text">'+lf_exercise_array[i][4][j]+'</textarea></p>';
                    }
                    newcontentlist_exe += '</div>';
                    newcontentlist_exe += '<p>Hint:</br><textarea cols="30" class="lf_exercise_hint" placeholder="hint">'+lf_exercise_array[i][3]+'</textarea></p>';
                    newcontentlist_exe += '<p>Answer:</br><textarea cols="30" class="lf_exercise_ans" placeholder="Final answer">'+lf_exercise_array[i][1]+'</textarea></p><p class="lf_exercise_remove" data-no="'+i+'">Remove this</p></div>';
                }
                if(code>0) {
                    newcontentlist_exe+='<div class="lf_exercise_holder"><p> Enter the question:</br> <textarea cols="30" class="lf_exercise_headtext" cols="30" placeholder="question head"></textarea></p><p>Optioned texts:</p><div><p><input name="ex_opts_correct_'+code+'" type="radio"/><textarea cols="30" class="lf_exercise_opt_text_'+code+'" type="text" placeholder="Question option text"></textarea></p><p><input name="ex_opts_correct_'+code+'" type="radio"/><textarea cols="30" class="lf_exercise_opt_text_'+code+'" type="text" placeholder="Question option text"></textarea></p><p><input name="ex_opts_correct_'+code+'" type="radio"/><textarea cols="30" class="lf_exercise_opt_text_'+code+'" type="text" placeholder="Question option text"></textarea></p><p><input name="ex_opts_correct_'+code+'" type="radio"/><textarea cols="30" class="lf_exercise_opt_text_'+code+'" type="text" placeholder="Question option text"></textarea></p></div><p>Hint:</br><textarea cols="30" class="lf_exercise_hint" placeholder="Hint"></textarea></p><p> Answer:</br><textarea cols="30" class="lf_exercise_ans" placeholder="Final answer"></textarea></p><p class="lf_exercise_remove" data-no="'+code+'">Remove this</p></div>';
                    document.getElementById("lf_exercise_wrapup").innerHTML = newcontentlist_exe;
                }
                // document.querySelectorAll('section#lf_exercise_wrapup textarea, section#lf_exercise_wrapup input[type="radio"]').forEach(item=>{
                //     item.addEventListener("change", ()=>{lf_submitData_exercise();});
                // });
            }else alert("The last field is empty");
        });
        


        document.getElementById("lf_exe_submit").addEventListener("click", ()=>{lf_submitData_exercise();});
        // document.querySelectorAll('section#lf_exercise_wrapup textarea, section#lf_exercise_wrapup input[type="radio"]').forEach(item=>{
        //     item.addEventListener("change", ()=>{lf_submitData_exercise();});
        // });
        function lf_submitData_exercise() {
            document.getElementById("lf_exe_submit").innerHTML = load_icon;
            if(document.querySelector(".lf_exercise_holder") != null) {
                var lf_headtext, lf_ans, lf_opt=-1, lf_hint, i, icount = document.getElementById("lf_exe_add").getAttribute("data-last");
                icount++;
                lf_exercise_array = [];
                for(i=0; i<icount; i++) {
                    lf_headtext = document.querySelectorAll(".lf_exercise_holder .lf_exercise_headtext")[i].value;
                    lf_ans = document.querySelectorAll(".lf_exercise_holder .lf_exercise_ans")[i].value;
                    lf_hint = document.querySelectorAll(".lf_exercise_holder .lf_exercise_hint")[i].value;
                    if( lf_headtext.length>0 || lf_ans.length>0 || lf_hint.length>0 ) {
                        var j=i*4, jcount=j+4, lf_exercise_array_subopt_text = [], lf_exercise_tmp='';
                        lf_opt=-1;
                        for(j=0; j<4; j++) {
                            if(!document.querySelectorAll(".lf_exercise_holder .lf_exercise_opt_text_"+i+"")[j]) lf_exercise_tmp="";
                            else lf_exercise_tmp = document.querySelectorAll(".lf_exercise_holder .lf_exercise_opt_text_"+i+"")[j].value;

                            if(lf_exercise_tmp.length > 0) lf_exercise_array_subopt_text.push(lf_exercise_tmp);
                            else lf_exercise_array_subopt_text.push("");

                            if(document.querySelectorAll("#lf_exercise_wrapup input[name='ex_opts_correct_"+i+"']")[j].checked) lf_opt = j;
                        }
                        lf_exercise_array_sub = [lf_headtext,lf_ans,lf_opt,lf_hint,lf_exercise_array_subopt_text];
                        lf_exercise_array.push(lf_exercise_array_sub);
                    }
                }
                document.getElementById("lf_exe_submit_field").value = JSON.stringify(lf_exercise_array);

            }else document.getElementById("lf_exe_submit_field").value = "";
            document.getElementById("lf_exe_submit").innerHTML = check_icon;
            setTimeout(function(){ document.getElementById("lf_exe_submit").innerHTML = "Save the questions"; }, 1000);
            document.querySelectorAll(".lf_exercise_remove").forEach(item=>{
                item.addEventListener("click", ()=>{remove_the_quiz(item);});
            });
        }

        
        // remove
        function remove_the_quiz(item) {
            var no = item.getAttribute("data-no");
            var icount = document.getElementById("lf_exe_add").getAttribute("data-last");
            icount--;
            document.getElementById("lf_exe_add").setAttribute("data-last", icount);
            document.querySelectorAll(".lf_exercise_holder")[no].remove();
            lf_exercise_array.splice(no, 1);
            var newcontentlist_exe = '';
            for(i=0; i<lf_exercise_array.length; i++) {
                newcontentlist_exe += '<div class="lf_exercise_holder">';
                newcontentlist_exe += '<p>Enter the question:</br> <textarea cols="30" class="lf_exercise_headtext" placeholder="Question head">'+lf_exercise_array[i][0]+'</textarea></p>';
                newcontentlist_exe += '<p>Optioned texts:</p><div>';
                for(j=0; j<4; j++) {
                    if(lf_exercise_array[i][2] == j) ex_opts_correct = 'checked';
                    else ex_opts_correct = '';
                    newcontentlist_exe += '<p><input name="ex_opts_correct_'+i+'" type="radio" '+ex_opts_correct+'/><textarea cols="30" class="lf_exercise_opt_text_'+i+'" type="text" placeholder="Question option text">'+lf_exercise_array[i][4][j]+'</textarea></p>';
                }
                newcontentlist_exe += '</div>';
                newcontentlist_exe += '<p>Hint:</br><textarea cols="30" class="lf_exercise_hint" placeholder="Hint">'+lf_exercise_array[i][3]+'</textarea></p>';
                newcontentlist_exe += '<p>Answer:</br><textarea cols="30" class="lf_exercise_ans" placeholder="Final answer">'+lf_exercise_array[i][1]+'</textarea></p><p class="lf_exercise_remove" data-no="'+i+'">Remove this</p></div>';
                code++;
            }
            document.getElementById("lf_exercise_wrapup").innerHTML = newcontentlist_exe;
            lf_submitData_exercise();
        }document.querySelectorAll(".lf_exercise_remove").forEach(item=>{item.addEventListener("click", ()=>{remove_the_quiz(item);});});
        
    </script>
    
<?php } ?>