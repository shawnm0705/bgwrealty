<?php 
//echo $this->Form->end(array('label' => '提交', 'class' => 'btn btn-custom', 'id' => 'submit-button', 'onclick' => 'this.disabled=true;this.form.submit();return true;', 'div' => array('class' => 'div-button'))); 
echo '<div class="div-button">';
echo $this->Form->button('提交', array('type' => 'button' , 'class' => 'btn btn-custom', 'id' => 'submit-button', 'onclick' => 'this.disabled=true;this.form.submit();return true;')); 
echo '</div></form>';
?>