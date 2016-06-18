<?php
$display_msg='';
$class='';
if ($this->session->flashdata('message')) {
    $msg = $this->session->flashdata('message');
    $msg = explode(':', $msg);
    if(count($msg)>1){
    $class = $msg[0];
    $display_msg = $msg[1];
    }
    else{
        $class=SUCCESS_MESSAGE;
      $display_msg = $msg[0];  
    }
}
?>
<span class="<?= $class; ?>">
        <?php if ($this->session->flashdata('message')) { print_r($display_msg); } ?>
</span>