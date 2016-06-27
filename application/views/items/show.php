<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <div id="content">
        <div class="page-head">
            <span class="page-heading">Total Items:<?= $total; ?></span>
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
                                    <img src="<?= $row['image_url']; ?>" height="200px" width="300px" />
                                </p>
                                <p><strong>product link:</strong> <a href="<?= $row['link']; ?>"><?= $row['link']; ?></a></p>
                                <p><strong>product price: </strong><?= $row['price']; ?></p>
                                <p><?= $row['description'] ?></p>
                                <p><?= $row['specification'] ?></p>
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