<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <div id="content">
        <div class="page-head">
            <span class="page-heading">Show Scrape Items</span>
            <?php $this->load->view('message'); ?>
        </div>
        <div id="form-wrap">
            <form id="admin-register" method="post" action="<?= base_url(); ?>admin/changepassword">
                <fieldset>
                    <div class="post_wrap">
                        <div class="row">
                            <div class="">
                                <a href="<?= base_url(); ?>items/show/thesource" class="btn_wrap_show" >Show items scraped from www.thesource.ca</a>
                            </div>
                            <div class="">
                                <a href="<?= base_url(); ?>items/show/gianttiger" class="btn_wrap_show" >Show items scraped from www.gianttiger.com</a>
                            </div>
                            <!--                            <div class="">
                                                            <a href="<?= base_url(); ?>items/show/factorydirect" class="btn_wrap_show" >Show items scraped from www.factorydirect.ca</a>
                                                        </div>-->

                            <div class="">
                                <a href="<?= base_url(); ?>items/show/marks" class="btn_wrap_show" >Show items scraped from www.marks.com</a>
                            </div>
                            <div class="">
                                <a href="<?= base_url(); ?>items/show/gencomarketplace" class="btn_wrap_show" >Show items scraped from gencomarketplace</a>
                            </div>
                            <div class="">
                                <a href="<?= base_url(); ?>items/show" class="btn_wrap_show" >Show All Items</a>
                            </div>

                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer'); ?> 