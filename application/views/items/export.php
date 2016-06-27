<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>

    <div id="content">
        <div class="page-head">
            <span class="page-heading">Export Items TO CSV</span>
            <?php $this->load->view('message'); ?>
        </div>
        <div id="form-wrap">
            <?php $form_data = $this->session->flashdata('form_data'); ?>
            <form id="admin-register" method="post" action="<?= base_url(); ?>items/export_items">
                <fieldset>
                    <div class="row">
                        <div class="input-wrap">
                            <input type="number" min="0" name="price" placeholder="Price to be added in each item" data-trigger="change" data-parsley-required />
                        </div>
                    </div>
                    
                    <div class="row">
                        <input type="submit" value="Export">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
 <?php $this->load->view('include/footer'); ?> 