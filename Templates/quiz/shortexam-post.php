<?php
        $postid=$post->ID;
        $value = get_post_meta( $postid, '_exercise', true );
        if(strlen($value)>5): 
        $value = json_decode($value);
            $i=-1;
            $j=$i+1
        ?>
        <section id="lf_landing_exercise">
            <h2>Short Quiz</h2>
            <?php 
                foreach($value as $item) { 
                $i++;
                $j++;
            ?>
                <div class="lf_item">
                    <p class="lf_head"><?php echo "$j: $item[0]"; ?></p>
                    <div>
                        <label class="ex_opts_correct_<?php echo $i; ?>"><input name="ex_opts_correct_<?php echo $i; ?>" type="radio"/>a. <?php echo $item[4][0]; ?></label>
                        <label class="ex_opts_correct_<?php echo $i; ?>"><input name="ex_opts_correct_<?php echo $i; ?>" type="radio"/>b. <?php echo $item[4][1]; ?></label>
                        <label class="ex_opts_correct_<?php echo $i; ?>"><input name="ex_opts_correct_<?php echo $i; ?>" type="radio"/>c. <?php echo $item[4][2]; ?></label>
                        <label class="ex_opts_correct_<?php echo $i; ?>"><input name="ex_opts_correct_<?php echo $i; ?>" type="radio"/>d. <?php echo $item[4][3]; ?></label>
                    </div>
                    <p class="lf_des"></p>
                    <?php if(strlen($item[3])>1 ){ ?>
                        <button class="lf_exercise_hint_btn" data-no="<?php echo $i; ?>">Hint</button>
                    <?php } ?>
                </div>
            <?php } ?>
            <div id="lf_exer_ctrl">
                <button id="lf_exercise_submit">Checkout</button>
                <button id="lf_exercise_reset">Reset</button>
                <div id="lf_exer_hint">
                    <p>The hint text preview</p>
                </div>
            </div>
            <script>
            var thearropt;
            if(document.getElementById("lf_landing_exercise")) {
                var load_icon = '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="#6f6f6f" width="18px" height="18px"><g><rect fill="none" height="24" width="24"/></g><g><g><polygon opacity=".3" points="8,7.5 12,11.5 16,7.5 16,4 8,4"/><polygon opacity=".3" points="8,7.5 12,11.5 16,7.5 16,4 8,4"/><path d="M18,2H6v6l4,4l-3.99,4.01L6,22h12l-0.01-5.99L14,12l4-3.99V2z M16,16.5V20H8v-3.5l4-4L16,16.5z M16,7.5l-4,4l-4-4V4h8V7.5 z"/></g></g></svg>';
                var tick_icon = '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><g><rect fill="none" height="24" width="24"/></g><g><g><g><path d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M17,18H7v-2h10V18z M10.3,14L7,10.7l1.4-1.4l1.9,1.9 l5.3-5.3L17,7.3L10.3,14z"/></g></g></g></svg>';
                var x_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/></svg>';
                function lf_exer_ajax(no, req) {
                    var lf_exer_req = new XMLHttpRequest();
                    lf_exer_req.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(req == "hint") document.querySelectorAll("#lf_landing_exercise .lf_des")[no].innerHTML = this.responseText;
                            else if(req == "opt") lf_exer_hightligh(this.responseText);
                        }
                    }
                    lf_exer_req.open("GET", "<?php echo get_template_directory_uri(); ?>/Templates/quiz/short-exam.php?postid="+post_id+"&req="+req+"&no="+no+"", true);
                    lf_exer_req.send();
                }
                
                
                // hint
                document.querySelectorAll("#lf_landing_exercise .lf_exercise_hint_btn").forEach(item=>{
                    item.addEventListener("click", ()=>{
                        var no = item.getAttribute("data-no");
                        document.querySelectorAll("#lf_landing_exercise .lf_des")[no].innerHTML = load_icon;
                        if(document.querySelectorAll("#lf_landing_exercise .lf_exercise_hint_btn")[no]) document.querySelectorAll("#lf_landing_exercise .lf_exercise_hint_btn")[no].style.display = "none";
                        lf_exer_ajax(no, "hint");
                    });
                });
                
                // submit
                var the_opt_arr=[];
                document.getElementById("lf_exercise_submit").addEventListener("click", ()=>{
                    document.getElementById("lf_exercise_submit").innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><g><rect fill="none" height="24" width="24"/></g><g><g><polygon opacity=".3" points="8,7.5 12,11.5 16,7.5 16,4 8,4"/><polygon opacity=".3" points="8,7.5 12,11.5 16,7.5 16,4 8,4"/><path d="M18,2H6v6l4,4l-3.99,4.01L6,22h12l-0.01-5.99L14,12l4-3.99V2z M16,16.5V20H8v-3.5l4-4L16,16.5z M16,7.5l-4,4l-4-4V4h8V7.5 z"/></g></g></svg>';
                    the_opt_arr=[];
                    var the_opt_no = "", the_opt_check="", got_something=0;
                    var forlength = "<?php echo $i; ?>";
                    for(i=0; i<=forlength; i++) {
                        the_opt_no = "ex_opts_correct_"+i;
                        for(j=0; j<4; j++) {
                            the_opt_check = document.querySelectorAll("#lf_landing_exercise .lf_item input[name='"+the_opt_no+"']")[j].checked;
                            if(the_opt_check) {the_opt_arr.push(j); got_something=1;};
                        }
                        if(!got_something) document.querySelectorAll("#lf_landing_exercise .lf_item")[i].classList.add("lf_leftout");
                        else document.querySelectorAll("#lf_landing_exercise .lf_item")[i].classList.remove("lf_leftout");
                        got_something=0;
                    }
                    if(the_opt_arr.length-1 < forlength) {
                        inpage_notification(8000, "Fill all the questions!");
                        document.getElementById("lf_exercise_submit").innerHTML = "Checkout";
                    }
                    else {
                        lf_exer_ajax("", "opt");
                        
                    };
                });
                
                function lf_exer_hightligh(arr) {
                    var i=0, j=0; corrects=0, correct_opt_each=0;
                    var arr = JSON.parse(arr);
                    document.querySelectorAll("#lf_landing_exercise .lf_item div input").forEach(item=>{
                        item.disabled = true;
                    });
                    document.querySelectorAll("#lf_landing_exercise .lf_item").forEach(item=>{
                        the_opt_no = "ex_opts_correct_"+i;
                        document.querySelectorAll("#lf_landing_exercise .lf_item ."+the_opt_no+"")[arr[j]].classList.add("lf_true");
                        document.querySelectorAll("#lf_landing_exercise .lf_item ."+the_opt_no+"")[arr[j]].innerHTML += tick_icon;
                        if(the_opt_arr[i] == arr[j]) {
                            corrects++;
                            document.querySelectorAll("#lf_landing_exercise .lf_item")[i].classList.add("lf_true");
                        }else{
                            document.querySelectorAll("#lf_landing_exercise .lf_item")[i].classList.add("lf_false");
                            document.querySelectorAll("#lf_landing_exercise .lf_item ."+the_opt_no+"")[the_opt_arr[i]].classList.add("lf_false");
                            document.querySelectorAll("#lf_landing_exercise .lf_item ."+the_opt_no+"")[the_opt_arr[i]].innerHTML += x_icon;
                        }
                        document.querySelectorAll("#lf_landing_exercise .lf_des")[i].innerHTML = arr[++j];
                        if(document.querySelectorAll("#lf_landing_exercise .lf_exercise_hint_btn")[i]) document.querySelectorAll("#lf_landing_exercise .lf_exercise_hint_btn")[i].style.display = "none";
                        i++;
                        j++;
                    });
                    document.getElementById("lf_exercise_submit").innerHTML = "Checkout";
                    var state = ((corrects*100)/(i-1));
                    if(state>=90) state = "Excellent";
                    else if(state<90 && state>=80) state = "Good";
                    else if(state<70 && state>=80) state = "Not bad";
                    else state = "Failed. Please revision the lesson again and take the test after it.";
                    state = "<p>"+corrects+"/"+(i)+" corrects</p><p>"+state+"</p>";
                    inpage_notification(8000, state);
                    
                }
                
                // reset
                document.getElementById("lf_exercise_reset").addEventListener("click", ()=>{
                    document.querySelectorAll("#lf_landing_exercise .lf_item div input").forEach(item=>{
                        item.disabled = false;
                        item.checked = false;
                    });
                    document.querySelectorAll("#lf_landing_exercise .lf_item div label").forEach(item=>{
                        item.classList.remove("lf_true");
                        item.classList.remove("lf_false");
                    });
                    document.querySelectorAll("#lf_landing_exercise .lf_item .lf_exercise_hint_btn").forEach(item=>{
                        item.style.display = "block";
                    });
                    document.querySelectorAll("#lf_landing_exercise .lf_des").forEach(item=>{
                        item.innerHTML="";
                    });
                    document.querySelectorAll("section#lf_landing_exercise .lf_item > div label svg").forEach(item=>{
                        item.remove();
                    });
                    document.querySelectorAll("#lf_landing_exercise .lf_item").forEach(item=>{
                        item.classList.remove("lf_true");
                        item.classList.remove("lf_false");
                    });
                    document.querySelectorAll("#lf_landing_exercise .lf_item").forEach(item=>{
                        item.classList.remove("lf_leftout");
                    });
                    inpage_notification(3000, "Exam reseted");
                });
            }
            </script>
        </section>
        
        
        <?php
        endif;
        ?>