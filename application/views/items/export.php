<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>

    <div id="content">
        <div class="page-head">
            <span class="page-heading"><?= $title ?></span>
            <?php $this->load->view('message'); ?>
        </div>
        <div id="form-wrap">
            <?php $form_data = $this->session->flashdata('form_data'); ?>
            <form id="admin-register" method="post" action="<?= base_url() . "items/export_items/" . $id; ?>">
                
                 <fieldset>
                    <div class="row">
                        <div class="input-wrap">
                             <label>Quantity</label>
                            <input type="number" min="1" name="quantity" placeholder="Quantity" data-trigger="change" data-parsley-required />
                        </div>
                    </div>
                </fieldset>
               
                
                    <fieldset>
                    <div class="row">
                        <div class="input-wrap">
                             <label>Buy Now price (For Fixed Price)</label>
                            <input type="number" min="0" name="buynow_price" placeholder="Buy Now Price to be added in each item" data-trigger="change" data-parsley-required />
                        </div>
                    </div>

                </fieldset>
                
                
                 <fieldset>
                    <div class="row">
                        <div class="input-wrap">
                            <label>Auction Type</label>
                            <select name="auction_type" class="form-control" id="sel1">
                                <option value="fixed">Fix</option>
                                <option value="regular">Regular</option>
                                <option value="classified">Classified</option>
                            </select>
                        </div>
                    </div>
                </fieldset> 
                   <fieldset>
                    <div class="row">
                        <div class="input-wrap">
                             <label>Starting price ( For Auction)</label>
                            <input type="number" min="0" name="starting_price" placeholder="Starting Price to be added in each item" data-trigger="change" data-parsley-required />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="row">
                        <div class="input-wrap">
                             <label>Items Less than CAD are Under auction</label>
                            <input type="number" min="0" name="auction_split" placeholder="Items less than CAD" data-trigger="change" data-parsley-required />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="row">
                        <div class="input-wrap">
                             <label>Price to be added for items under auction</label>
                            <input type="number" min="0" name="auction_price" placeholder="Price to be added for auction items" data-trigger="change" data-parsley-required />
                        </div>
                    </div>
                </fieldset>
               
              
                
               
               

                <fieldset>

                    <div class="row">
                        <input type="submit" value="Export">
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer'); ?> 