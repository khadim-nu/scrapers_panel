<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <div id="content">
        <div class="page-head">
            <span class="page-heading"><?= $title; ?></span>
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
            <form id="admin-register" method="post" action="<?= base_url() ?>items/startPosting">
                <fieldset>
                    <div class="post_wrap">
                        <div class="row form-group">
                            <div class="col-xs-8 input-wrap" >
                                <label>%age  in each item (original+shipping) price</label>
                                <select name="price" required="">
                                    <option selected="selected" value="0">0 %age</option>
                                    <?php for ($i = 1; $i <= 100; $i++) { ?>
                                        <option value="<?= $i; ?>"><?= $i; ?> %age</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="row form-group">
                            <div class="col-xs-8 input-wrap" >
                                <label for="Section">Section</label><br/>
                                <select name="section" id="section" required="">
                                    <option selected="selected" value="0">--Select Section--</option>
                                    <option value="1">Classifieds &amp; Buy Now</option>
                                    <option value="2">Cars &amp; Parts</option>
                                    <option value="3">Property</option>
                                    <option value="4">Jobs</option>
                                    <option value="11">Events</option>

                                </select>
                            </div>
                        </div> 
                        <div class="row form-group">
                            <div class="col-xs-8 input-wrap" >
                                <label for="Category">Category</label><br/>
                                <select name="category" id="category"  required="required">
                                    <option selected="selected" value="0">--Select Category--</option>
                                </select>

                            </div>
                        </div> 
                        <div class="row form-group">
                            <div class="col-xs-8 input-wrap" >
                                <label for="Type">"WANTED" listing?<br></label>
                                <input id="wanted" type="checkbox" value="1" name="wanted">
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-xs-8">
                                <input type="submit" class="btn_submit" value="Start Posting"/>
                            </div>
                        </div>  
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer'); ?> 