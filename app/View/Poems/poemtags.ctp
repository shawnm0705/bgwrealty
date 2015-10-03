<?php
	echo $this->Field->multiCheckbox('Poemtag','标签', array('category_info' => 
		array('cate_list' => $poemtags, 'form_name' => 'Poemtag', 'checkbox_id' => 'PoemPoemtag')));
?>