<div class="book-content">
	<center>
		<div class="well" style="padding:20px;height:440px;">
			<div style="font-size:18px;">
				<?php 
				if($poem){
					echo $poem['Poem']['number'].'·'.$poem['Poem']['title'];
				}?>
			</div>
		<?php 
		if($poem){
			if($poem['Poem']['like']){
				$like_number = $poem['Poem']['like'];
			}else{
				$like_number = 0;
			}
			echo $poem['Poem']['content'];
			echo '<button type="button" class="btn btn-custom btn-action" onclick = "this.disabled=true;like('.$poem['Poem']['id'].','.$poem['Poem']['like'].');return true;">
					<div id="like_number'.$poem['Poem']['id'].'" style="float:left;">'.$like_number.'</div>&nbsp;<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
				</button>';
		}?>
		</div>
	</center>	
</div>
<!--<span class="page-number"><?php //echo $id;?></span>-->
<script type="text/javascript">
function like(poem_id, poem_like) {
	poem_like = poem_like + 1;
    document.getElementById("like_number" + poem_id).innerHTML = poem_like;
    var xmlhttp = new XMLHttpRequest();
  	xmlhttp.open("GET", "./like/" + poem_id + '?like_number=' + poem_like, true);
    xmlhttp.send();
}
</script>