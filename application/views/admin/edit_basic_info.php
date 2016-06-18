<?php $this->load->view('include/admin/header'); ?>

<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>

    <div id="content">
        <div class="page-head">
            <span class="page-heading">Edit Basic Information</span>
            <?php $this->load->view('message'); ?>
        </div>
        <div id="form-wrap">
            <form id="admin-register" method="post" action="<?= base_url(); ?>admin/edit_basic_info" enctype="multipart/form-data">
                <fieldset>
                    <div class="row">
                        <div class="input-wrap">
                            <input type="text" name="name" placeholder="Name" value="<?= $user->name; ?>" data-trigger="change" data-parsley-required data-parsley-pattern="<?= NAME_PATTERN; ?>" data-parsley-minlength="<?= TITLE_LIMIT_MIN; ?>" data-parsley-maxlength="<?= TITLE_LIMIT_MAX;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-wrap file">
                            <input type="file" name="profileImage" id="profileImage" data-trigger="change" data-jcf='{"buttonText": "Browse", "placeholderText": "Profile image (optional)"}'>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="Save">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
 <?php $this->load->view('include/footer'); ?> 