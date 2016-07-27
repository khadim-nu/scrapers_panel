<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <div id="content">
        <div class="page-head">
            <span class="page-heading">Total <?= $id ?> Items:<?= $total; ?></span>
            <span class="page-heading" id="export_a"><a href="<?= base_url() . "items/export_to_CSV/" . $id; ?>">Export <?= $id ?> To CSV</a></span>
            <?php $this->load->view('message'); ?>
        </div>
        <div class="table-wrapper">
            <div class="holder">
                <div class="block wide-view">
                    <div class="row-fluid">


                        <?php
                        if ($data) {
                            foreach ($data as $row) {
                                ?>
                                <p><strong>product title:</strong> <?= $row['title']; ?></p>
                                <p><strong>product id:</strong> <?= $row['p_id']; ?></p>
                                <p><strong>category:</strong> <?= $row['category_title']; ?></p>
                                <p>
                                    <?php
                                    $imgArr = explode(',', $row['image_url']);
                                    $img    = (isset($imgArr[1])) ? $imgArr[1] : "";
                                    ?>
                                    <img src="<?= $img; ?>" height="200px" width="300px" />
                                </p>
                                <p><strong>product link:</strong> <a href="<?= $row['link']; ?>"><?= $row['link']; ?></a></p>
                                <p><strong>product price: </strong><?= $row['price']; ?></p>
                                <p><strong>Description:</strong></p>
                                <p><?= $row['description'] ?></p>
        <!--                                <p><strong>Specification:</strong></p>
                                        <p><?= $row['specification'] ?></p>-->
                                <br><hr>
                                <br>
                                <?php
                            }
                        }
                        ?>
                    </div> 
                </div>
            </div>

        </div>
    </div>
</div>
<?php $this->load->view('include/footer'); ?> 