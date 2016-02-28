<?php
$this->start('css');
//echo $this->Html->css('//cdn.datatables.net/1.10.6/css/jquery.dataTables.min.css');
echo $this->Html->css('jquery.dataTables.min.css');
$this->end();
$this->start('script');
//echo $this->Html->script('//cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js');
echo $this->Html->script(array('jquery.dataTables.min.js', 'datatable'));
$this->end();
?>