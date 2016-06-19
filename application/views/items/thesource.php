<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <div id="content">
        <div class="page-head">
            <span class="page-heading"><?= $title; ?></span>
            <?php $this->load->view('message'); ?>
        </div>
        <div class="table-wrapper">
            <div class="holder">
                <div class="block wide-view">
                    <div class="row-fluid">
                        

                                <?php
                                if ($data) {
                                    foreach ($data as $row) {
                                        ?>
                                         <p>product id: <?= $row['id'];?></p>
                                         <p>product title: <?= $row['title'];?></p>
                                         <p>product link: <a href="<?= $row['link'];?>"><?= $row['link'];?></a></p>
                                         <p>product price: <?= $row['price'];?></p>
                                         <p><?= $row['prod_details']?></p>
                                         <p><?= $row['prod_specification']?></p>
                                         <br>
                                         <br>
                                        <?php
                                    }
                                }
                                ?>
                    </div> 
                </div>
            </div>

        </div>
    </div>
</div>
 <?php $this->load->view('include/footer'); ?> 