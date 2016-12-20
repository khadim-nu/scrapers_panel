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
            <form id="admin-register" method="post" action="<?= base_url() ?>items/scrape">
                <fieldset>
                    <div class="post_wrap">
                        <div class="row form-group">
                            <div class="col-xs-8 input-wrap" >
                                <label>Search String</label>
                                <input name="string"  type="text" id="searchTitle" required="" placeholder="Write Item Title"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-8 input-wrap" >
                                <label>Price Range</label>
                                <input name="greaterThan"  type="number" id="searchTitle" required="" placeholder="Greater than"/>
                            </div>
                        </div> 
                        <div class="row form-group">
                            <div class="col-xs-8 input-wrap" >
                                <input name="lessThan"  type="number" id="searchTitle" required="" placeholder="Less than"/>
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