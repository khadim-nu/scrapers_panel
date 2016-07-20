<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <form id="admin-register" method="post" action="<?= base_url(); ?>items/assign_cats">

        <div id="content">
            <div class="page-head">
                <span class="page-heading"><?= $title; ?></span>
                <?php $this->load->view('message'); ?>
                
            </div>
            <div class="table-wrapper">
                
                <div class="holder">
                    <div class="form-group row pull-right" style="margin-right: 5%">
                    <input class="btn btn-primary btn-lg" type="submit" value="Save"/>
                </div>
                    <div class="block wide-view">
                        <div class="row-fluid">
                            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="sorting">Category Title</th>
                                        <th class="hidden-480">Category ID</th>
                                        <th class="hidden-480">Map Category ID To</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data) {
                                        $i = 1;
                                        foreach ($data as $row) {
                                            ?>
                                            <tr>
                                                <td class="hidden-480"><?= $row['category_title']; ?></td>
                                                <td class="hidden-phone"><?= ($row['cat_id']>0)?$row['cat_id']:$row['category']; ?></td>
                                                <td class="hidden-phone">
                                                    <input name="title_<?= $i; ?>" type="hidden" value="<?= $row['category_title']; ?>" />
                                                    <input name="id_<?= $i; ?>" type="number" min="0" value="<?= ($row['cat_id']>0)?$row['cat_id']:$row['category']; ?>" />
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
<?php $this->load->view('include/footer'); ?> 