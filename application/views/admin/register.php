<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>

    <div id="content">
        <div class="page-head">
            <span class="page-heading">Admin registration</span>
            <?php $this->load->view('message'); ?>
        </div>
        <div id="form-wrap">
            <?php $form_data = $this->session->flashdata('form_data'); ?>
            <form id="admin-register" method="post" action="<?= base_url(); ?>admin/admin_registration">
                <fieldset>
                    <div class="row">
                        <div class="input-wrap">
                            <input type="text" name="name" value="<?php
                            if (isset($form_data)) {
                                echo $form_data['name'];
                            }
                            ?>" placeholder="Name" data-trigger="change" data-parsley-pattern="<?= NAME_PATTERN; ?>" data-parsley-required data-parsley-minlength="<?= TITLE_LIMIT_MIN; ?>" data-parsley-maxlength="<?= TITLE_LIMIT_MAX;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-wrap">
                            <input type="email" name="email" value="<?php
                            if (isset($form_data)) {
                                echo $form_data['email'];
                            }
                            ?>" placeholder="Email ID" data-trigger="change" data-parsley-required data-type="email"  data-parsley-required data-parsley-minlength="<?= TITLE_LIMIT_MIN ?>" data-parsley-maxlength="<?= EMAIL_LIMIT_MAX ?>">
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" value="Register">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
 <?php $this->load->view('include/footer'); ?> 