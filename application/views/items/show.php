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
                                <p><strong>Title:</strong><?= $row['title']; ?></p>
                                <p><strong>published date:</strong><?= $row['published_at']; ?></p>
                                <p><strong>Available:</strong><?= $row['status']; ?></p>
                                <p><strong>URL:</strong><a href="<?= $row['link']; ?>" target="blank"><?= $row['link']; ?></a></p>
                                <p><strong>Price:</strong>$<?= $row['price']; ?></p>
                                <p><strong>Images:</strong><?= $row['image_url']; ?></p>
                                <p><strong>Type:</strong><?= $row['category']; ?></p>
                                <p><strong>Vendor:</strong><?= $row['vendor']; ?></p>
                                <p><strong>Description:</strong><?= $row['description']; ?></p>
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