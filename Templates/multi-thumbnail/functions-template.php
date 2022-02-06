<?php

function second_thumbnail_html( $post ) { 
    $value = get_post_meta( $post->ID, '_second_thumbnail', true ); 	
	?>
	<style>
		.secondthumbnail_cover {
			background-color: #2323239e;
			width: 90.9vw;
			height: 80vh;
			padding: 10vh 4vw;
			left: 0;
			z-index: 14000;
			position: fixed;
			top: 0;
			display: none;
		}
		.secondthumbnail_cover.active {
			display: block;
		}
		.secondthumbnail_list li {
			width: 13.66vw;
			height: fit-content;
		}
		.secondthumbnail_list li.active img, .secondthumbnail_list li.active embed {
			border-color: #1976d2;
		}
		.secondthumbnail_list li img, .secondthumbnail_list li embed {
			width: 100%;
			max-height: 15vh;
			border: 5px solid #0000;
			border-radius: 1px;
		}
		.secondthumbnail_list {
			display: flex;
			flex-flow: wrap;
			column-gap: 9px;
			overflow-y: scroll;
			background-color: #fff;
			padding: 30px;
			height: 56vh;
			position: relative;
			margin: 0px;
		}
		body.active {
			overflow: hidden;
		}
		.secondthumbnail_head p {
			font-size: 1rem;
			margin: 14px 0;
			font-weight: 600;
		}
		.secondthumbnail_head {
			background-color: #eaeaea;
			display: grid;
			grid-template-columns: auto min-content;
			padding: 0 2%;
		}
		.secondthumbnail_submit, .displayattachmentslist {
			background-color: #1976d2;
			width: fit-content;
			padding: 9px;
			font-weight: 600;
			color: #fff;
			border-radius: 3px;
			margin-left: auto;
			margin-right: 4%;
		}
		.secondthumbnail_bottom {
			display: grid;
			background-color: #eaeaea;
		}
		.displayattachmentslist {
			margin-left: 0;
		}
		.displayattachment_preview {
			width: 50%;
		}
	</style>
	<section id="second_thumbnail_cover">
		<section id="second_thumbnail" class="secondthumbnail_cover">
			<div class="secondthumbnail_head">
				<p>second_thumbnail_cover</p>
				<p><svg class="close_secondthumbnail" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/></svg></p>
			</div>
			<ul class="secondthumbnail_list">
			<?php
				$args = array('post_type'=>'attachment' , 'post_mime_type'=>'image' , 'posts_per_page'=>-1);
				$theattachmentslistarr = [];
				$second_thumbnaildom = '';
				foreach( get_posts( $args ) as $image) {
					$imgmainsrc = wp_get_attachment_url( $image->ID );
					$imgmainsrc2 = '"'.$imgmainsrc.'"';
					$baseimgsrc = substr($imgmainsrc, 0, strripos($imgmainsrc, '.'));
					$exeimgsrc = substr($imgmainsrc, strripos($imgmainsrc, '.'));
					$generalimgexe = $exeimgsrc;
					$newimgsrcset = $baseimgsrc.$exeimgsrc;
					$newimgsrcset1 = $baseimgsrc."-small".$generalimgexe;
					$second_thumbnaildom .= '<li class="thumbnaillistimg thumbnaillistid_'.$image->ID.'" onclick="second_thumbnailclick('.$image->ID.')" data-class="'.$image->ID.'" data-url="'.$imgmainsrc.'"><img src="'.$newimgsrcset1.'"></li>';
					$theattachmentslistarr[$image->ID] = wp_get_attachment_url( $image->ID );
				}
			?>
			</ul>
			<div class="secondthumbnail_bottom">
				<p class="secondthumbnail_submit">Submit the image</p>
			</div>
		</section>
		<p class="displayattachmentslist">Set feature image</p>
		<img src="<?php echo wp_get_attachment_url( $value ) ?>" class="displayattachment_preview">
		<input name="second_thumbnail_n" class="second_thumbnail_n" value="<?php echo $value; ?>" type="text" />

		<script>
			var second_thumbnail_json = <?php echo json_encode($theattachmentslistarr); ?>;
			var second_thumbnail_lastactiveid = "<?php echo $value; ?>";
			function second_thumbnailclick(id) {
				document.querySelectorAll("#second_thumbnail_cover .secondthumbnail_list .thumbnaillistimg").forEach(item=>{item.classList.remove('active');});
				document.querySelector("#second_thumbnail_cover .thumbnaillistid_"+id+"").classList.add('active');
			}
			const second_thumbnail = document.querySelector('#second_thumbnail_cover .secondthumbnail_cover');
			var second_thumbnaildom = '<?php echo $second_thumbnaildom; ?>';
			document.querySelector('#second_thumbnail_cover .displayattachmentslist').addEventListener('click', ()=>{
				second_thumbnail.classList.add('active');
				document.body.classList.add('active');
				document.querySelector('#second_thumbnail_cover .secondthumbnail_list').innerHTML += second_thumbnaildom;
				if(second_thumbnail_lastactiveid)
					document.querySelector("#second_thumbnail_cover .secondthumbnail_list .thumbnaillistid_"+second_thumbnail_lastactiveid+"").classList.add("active");
			});
			document.querySelector("#second_thumbnail_cover .secondthumbnail_submit").addEventListener("click", ()=>{
				document.querySelector('#second_thumbnail_cover .second_thumbnail_n').value = second_thumbnail_lastactiveid;
				document.querySelector('#second_thumbnail_cover .second_thumbnail_n').setAttribute("value", second_thumbnail_lastactiveid);
				document.querySelector('#second_thumbnail_cover .displayattachment_preview').setAttribute("src", second_thumbnail_json[second_thumbnail_lastactiveid]);
				second_thumbnail.classList.remove("active");
				document.body.classList.remove("active");
				document.querySelector('#second_thumbnail_cover .secondthumbnail_list').innerHTML = "";
				second_thumbnail_lastactiveid = id;
			});
			document.querySelector("#second_thumbnail_cover .close_secondthumbnail").addEventListener("click", ()=>{
				second_thumbnail.classList.remove("active");
				document.body.classList.remove("active");
				document.querySelector('#second_thumbnail_cover .secondthumbnail_list').innerHTML = "";
			});
		</script>
	</section>

<?php }

function download_print_text_html( $post ) { 
	$value = get_post_meta( $post->ID, '_download_print_text', true );
	?>
		<textarea class="download_print_text_n" name="download_print_text_n"><?php echo $value; ?></textarea>
	<?php
}


function download_print_html( $post ) { 
    $value = get_post_meta( $post->ID, '_download_print', true ); 	
	?>
	<section id="download_print_cover">
		<section id="download_print" class="secondthumbnail_cover">
			<div class="secondthumbnail_head">
				<p>download_print_cover</p>
				<p><svg class="close_secondthumbnail" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10 10-4.47 10-10S17.53 2 12 2zm5 13.59L15.59 17 12 13.41 8.41 17 7 15.59 10.59 12 7 8.41 8.41 7 12 10.59 15.59 7 17 8.41 13.41 12 17 15.59z"/></svg></p>
			</div>
			<ul class="secondthumbnail_list">
			<?php
				$theattachmentslistarr = [];
				$download_printdom = '';
				$args = array('post_type'=>'attachment' , 'post_mime_type'=>'application/pdf' , 'posts_per_page'=>-1);
				foreach( get_posts( $args ) as $image) {
					$imgmainsrc = wp_get_attachment_url( $image->ID );
					$download_printdom .= '<li class="pdfselecting thumbnaillistimg thumbnaillistid_'.$image->ID.'" onclick="download_printclick('.$image->ID.')" data-class="'.$image->ID.'" data-url="'.$imgmainsrc.'"><embed src="'.$imgmainsrc.'"></li>';
					$theattachmentslistarr[$image->ID] = wp_get_attachment_url( $image->ID );
				}

				$args = array('post_type'=>'attachment' , 'post_mime_type'=>'image' , 'posts_per_page'=>-1);
				foreach( get_posts( $args ) as $image) {
					$imgmainsrc = wp_get_attachment_url( $image->ID );
					$imgmainsrc2 = '"'.$imgmainsrc.'"';
					$baseimgsrc = substr($imgmainsrc, 0, strripos($imgmainsrc, '.'));
					$exeimgsrc = substr($imgmainsrc, strripos($imgmainsrc, '.'));
					$generalimgexe = $exeimgsrc;
					$newimgsrcset = $baseimgsrc.$exeimgsrc;
					$newimgsrcset1 = $baseimgsrc."-small".$generalimgexe;
					$download_printdom .= '<li class="imgselecting thumbnaillistimg thumbnaillistid_'.$image->ID.'" onclick="download_printclick('.$image->ID.')" data-class="'.$image->ID.'" data-url="'.$imgmainsrc.'"><img src="'.$newimgsrcset1.'"></li>';
					$theattachmentslistarr[$image->ID] = wp_get_attachment_url( $image->ID );
				}
			?>
			</ul>
			<div class="secondthumbnail_bottom">
				<p class="secondthumbnail_submit">Submit the image</p>
			</div>
		</section>
		<p class="displayattachmentslist">Set feature image</p>
		<section class="thepreviewcase">
			<?php $arrvalue=json_decode($value);for($i=0; $i<count($arrvalue); $i++) { ?>
				<embed src="<?php echo wp_get_attachment_url( $arrvalue[$i] ) ?>" class="displayattachment_preview">
			<?php } ?>
		</section>
		<input name="download_print_n" class="download_print_n" value="" />
		<script>
			var download_print_json = <?php echo json_encode($theattachmentslistarr); ?>;
			var download_print_lastactiveid = <?php echo $value; ?>;
			document.querySelector('#download_print_cover .download_print_n').value = JSON.stringify(download_print_lastactiveid);
			document.querySelector('#download_print_cover .download_print_n').setAttribute("value", JSON.stringify(download_print_lastactiveid));
			function download_printclick(id) {
				var thecurrentelementdom = document.querySelector("#download_print_cover .thumbnaillistid_"+id+"");
				if(thecurrentelementdom.classList.contains("pdfselecting")) {
					document.querySelectorAll("#download_print_cover .secondthumbnail_list .pdfselecting").forEach(item=>{
						item.classList.remove('active');
					});
					thecurrentelementdom.classList.add('active');
				}else{
					if(thecurrentelementdom.classList.contains("active")) thecurrentelementdom.classList.remove('active');
					else thecurrentelementdom.classList.add('active');
				}
			}
			const download_print = document.querySelector('#download_print_cover .secondthumbnail_cover');
			var download_printdom = '<?php echo $download_printdom; ?>';
			document.querySelector('#download_print_cover .displayattachmentslist').addEventListener('click', ()=>{
				download_print.classList.add('active');
				document.body.classList.add('active');
				document.querySelector('#download_print_cover .secondthumbnail_list').innerHTML += download_printdom;
				if(download_print_lastactiveid) 
					for(i=0; i<download_print_lastactiveid.length; i++)
					document.querySelector("#download_print_cover .secondthumbnail_list .thumbnaillistid_"+download_print_lastactiveid[i]+"").classList.add("active");
			});
			document.querySelector("#download_print_cover .secondthumbnail_submit").addEventListener("click", ()=>{
				download_print_lastactiveid = [];
				document.querySelectorAll("#download_print_cover .secondthumbnail_list .active").forEach(item=>{ download_print_lastactiveid.push(item.getAttribute("data-class")); });
				document.querySelector('#download_print_cover .download_print_n').setAttribute("value", JSON.stringify(download_print_lastactiveid));
				document.querySelector('#download_print_cover .download_print_n').value = JSON.stringify(download_print_lastactiveid);
				download_print.classList.remove("active");
				document.body.classList.remove("active");
				document.querySelector("#download_print_cover .thepreviewcase").innerHTML = "";
				for(i=0; i<download_print_lastactiveid.length; i++) document.querySelector("#download_print_cover .thepreviewcase").innerHTML += '<embed src="'+ download_print_json[download_print_lastactiveid[i]] +'" class="displayattachment_preview" />';
				document.querySelector('#download_print_cover .secondthumbnail_list').innerHTML = "";
			});
			document.querySelector("#download_print_cover .close_secondthumbnail").addEventListener("click", ()=>{
				download_print.classList.remove("active");
				document.body.classList.remove("active");
				document.querySelector('#download_print_cover .secondthumbnail_list').innerHTML = "";
			});
		</script>
	</section>
<?php }
