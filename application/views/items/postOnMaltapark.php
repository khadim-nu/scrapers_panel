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
                                <label>Search String</label>
                                <input name="title"  type="text" id="searchTitle" required="" placeholder="Write Item Title"/>
                            </div>
                        </div> 
                        <div class="row form-group">
                            <div class="col-xs-8 input-wrap" >
                                <label for="Section">Section</label><br/>
                                <select name="section" required="">
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
                                <select name="category"  required="required">
                                        <option selected="selected" value="0">--Select Category--</option>
                                        <option value="2">Antiques</option>
                                        <option value="3">Art</option>
                                        <option value="4">Baby</option>
                                        <option value="5">Books</option>
                                        <option value="6">Business &amp; Industrial</option>
                                        <option value="7">Cameras &amp; Photo</option>
                                        <option value="10">Clothing &amp; Accessories</option>
                                        <option value="12">Collectibles</option>
                                        <option value="13">Computers &amp; Office</option>
                                        <option value="14">Consumer Electronics</option>
                                        <option value="15">Dolls &amp; Bears</option>
                                        <option value="16">DVDs &amp; Movies</option>
                                        <option value="42">Everything Else</option>
                                        <option value="18">Food &amp; Wine</option>
                                        <option value="19">Gifts &amp; Occasions</option>
                                        <option value="20">Health &amp; Beauty</option>
                                        <option value="21">Hobbies &amp; Crafts</option>
                                        <option value="23">Home &amp; Furniture</option>
                                        <option value="22">Home Appliances</option>
                                        <option value="24">Jewelry, Gems, Watches</option>
                                        <option value="43">Marine</option>
                                        <option value="27">Music &amp; Instruments</option>
                                        <option value="29">Networking &amp; Telecom</option>
                                        <option value="30">PDAs</option>
                                        <option value="31">Pet Supplies</option>
                                        <option value="32">Pottery &amp; Glass</option>
                                        <option value="44">Services &amp; Trades</option>
                                        <option value="35">Sporting Goods</option>
                                        <option value="36">Sports Memorabilia</option>
                                        <option value="37">Stamps</option>
                                        <option value="1569">Tickets &amp; Vouchers</option>
                                        <option value="38">Toys</option>
                                        <option value="39">Travel</option>
                                        <option value="40">TV</option>
                                        <option value="41">Video Games</option>
                                        <option value="1573">Tools</option>

                                    </select>

                            </div>
                        </div> 
                        <div class="row form-group">
                            <div class="col-xs-8 input-wrap" >
                                <label for="Type">"WANTED" listing?<br></label>
                                <input id="wanted" type="checkbox" name="wanted" required="">
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