<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <div id="content">
        <div class="page-head">
            <span class="page-heading">Scrape Items</span>
            <?php $this->load->view('message'); ?>
        </div>
        <div class="loading-sheet" style="display: none;">
            <div class="loader">
                <div class="loader-holder">
                    <img src="<?= base_url(); ?>assets/images/progress-bar.gif">
                    <strong>Scraping... Please wait!</strong>
                </div>
            </div>
        </div>
        <div id="form-wrap">
            <form id="admin-register" method="post" action="">
                <fieldset>
                    <div class="post_wrap">
                        <div class="row">
                            <div class="">
                                <a href="<?= base_url(); ?>items/adidas" class="btn_wrap_a" >Scrape Items From adidas</a>
                            </div>
                        </div>  
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer'); ?> 