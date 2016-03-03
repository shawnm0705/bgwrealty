<?php
$this->start('css');
echo $this->Html->css('slider');
$this->end();
$this->start('script');
echo $this->Html->script(array('modernizr','bootstrap-slider'));
$this->end();
?>