<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <div id="content">
        <div class="page-head">
            <span class="page-heading">Account detail</span>
            <?php $this->load->view('message'); ?>
        </div>
        <div class="all-detail">
            <div class="holder-wrap">
                <div class="image-area">
                    <div class="holder">
                        <div class="image">
                            <img src="<?= $this->session->userdata('user_data')->image_url; ?>" alt="">
                        </div>
                    </div>
                </div>
                <ul>
                    <li><span class="title">Name</span><span><?= $this->session->userdata('user_data')->name; ?></span></li>
                    <li><span class="title">Email</span><span><?= $this->session->userdata('user_data')->email; ?></span></li>
                    <br>
                    <li><span class="title">Created Date</span><span><?= $this->session->userdata('user_data')->created_at; ?></span></li>
                    <li><span class="title">Updated Date</span><span><?= $this->session->userdata('user_data')->updated_at; ?></span></li>
                </ul>
                <div class="btn-row">
                <a class="btn" href="<?= base_url(); ?>admin/edit_basic_info">Edit</a>
            </div>
            </div>

            
        </div>
    </div>
</div>
 <?php $this->load->view('include/footer'); ?> 
