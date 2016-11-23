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
                                
                                <p><strong>Ad Title:</strong> <?= $row['ad_title']; ?></p>
                                <p><strong>Address: </strong><?= $row['address']; ?></p>
                                <p><strong>Name: </strong><?= $row['name'] ?></p>
                                <p><strong>Contact: </strong><?= $row['contact'] ?></p>
                                <p><strong>Source Link:</strong> <a href="<?= $row['source_link']; ?>" target="_blank"><?= $row['source_link']; ?> </a></p>
                                <p><strong>Description: </strong><?= $row['adText'] ?></p>

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