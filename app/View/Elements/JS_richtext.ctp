<?php
$this->start('script');
//echo $this->Html->script('//tinymce.cachefly.net/4.0/tinymce.min.js');
echo $this->Html->script('/ckeditor/ckeditor.js?v='.date('YmdHis'));
echo $this->Html->script('richtext');
$this->end();
?>