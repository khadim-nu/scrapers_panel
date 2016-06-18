<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <div id="content">
        <div class="page-head">
            <span class="page-heading">Scrape Data</span>
            <?php $this->load->view('message'); ?>
        </div>
        <div id="form-wrap">
            <form id="admin-register" method="post" action="<?= base_url(); ?>admin/changepassword">
                <fieldset>
                    <div class="post_wrap">
                        <div class="row">
                            <div class="">
                                <a href="#" class="btn_wrap_a" >Scrape from www.thesource.ca</a>
                            </div>
                            <div class="">
                                <a href="#" class="btn_wrap_a" >Scrape from www.gianttiger.com</a>
                            </div>
                            <div class="">
                                <a href="#" class="btn_wrap_a" >Scrape from www.factorydirect.ca</a>
                            </div>
                            <div class="">
                                <a href="#" class="btn_wrap_a" >Scrape from www.walmart.ca</a>
                            </div>
                            <div class="">
                                <a href="#" class="btn_wrap_a" >Scrape from www.marks.com</a>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer'); ?> 