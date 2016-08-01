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
                                $upc    = explode("_", $row['p_id']);
                                ?>
                                <p><strong>URL:</strong> <a href="<?= $row['link']; ?>" target="_blank"><?= $row['link']; ?> </a></p>

                                <p><strong>TITLE:</strong> <?= $row['title']; ?></p>
                                <p><strong>UPC:</strong> <?= $upc[1]; ?></p>
                                <p><strong>PRICE: </strong><?= $row['price']; ?></p>
                                <p>
                                    <?php
                                    $imgArr = explode(',', $row['image_url']);
                                    $img    = (isset($imgArr[1])) ? $imgArr[1] : $row['image_url'];
                                    ?>
                                    <img src="<?= $img; ?>" height="200px" width="300px" />
                                </p>

                                <p><strong>Features:</strong></p>
                                <p><?= $row['specification'] ?></p>
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