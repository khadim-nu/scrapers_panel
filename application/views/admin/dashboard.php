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
            <form id="admin-register" method="post" action="<?= base_url()?>items/adidas">
                <fieldset>
                    <div class="post_wrap">
                        <div class="row form-group">
                            <div class="col-xs-8 input-wrap" >
                                <label>Write Adidas URL.</label>
                                <input name="domain_url"  type="text" id="domain_url" required="" placeholder="Write Adidas Domain i.e http://www.adidas.com/us"/>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-xs-8">
                                <input type="submit" class="btn_submit" value="Start Scraping"/>
                            </div>
                        </div>  
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer'); ?> 