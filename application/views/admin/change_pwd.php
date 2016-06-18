<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <div id="content">
        <div class="page-head">
            <span class="page-heading">Change Password</span>
            <?php $this->load->view('message'); ?>
        </div>
        <div id="form-wrap">
            <form id="admin-register" method="post" action="<?= base_url(); ?>admin/changepassword">
                <fieldset>
                    <div class="row">
                        <div class="input-wrap">
                            <input type="password" placeholder="Old Password" name="old-password" data-parsley-required data-parsley-minlength="<?= PASSWORD_MIN_LEN; ?>"  data-parsley-maxlength="<?= PASSWORD_MAX_LEN; ?>" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-wrap">
                            <input id = "new-pwd" placeholder="New Password" type="password" name="new-password" data-parsley-required data-parsley-minlength="<?= PASSWORD_MIN_LEN; ?>"  data-parsley-maxlength="<?= PASSWORD_MAX_LEN; ?>"  > 
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-wrap">
                            <input type="password" placeholder="Confirm New Password" name="confirm-password" data-parsley-required data-parsley-minlength="<?= PASSWORD_MIN_LEN; ?>"  data-parsley-maxlength="<?= PASSWORD_MAX_LEN; ?>"   data-parsley-equalto="#new-pwd">
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