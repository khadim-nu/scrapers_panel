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
                                $address=  str_replace(', US', '', $row['address']);
                                $address=  str_replace('Street Address:', '', $address);
                                $address=  str_replace('Street Address: ', '', $address);
                                $address=  str_replace(' Street Address: ', '', $address);
                                $address=  str_replace(' Street Address:', '', $address);
                                $address=  str_replace('Street Address', '', $address);
                                $address=  str_replace('street Address', '', $address);
                                $address=  str_replace('Street', ',', $address);
                                $address=  str_replace('street', ',', $address);
                                $address=  str_replace('primary', '', $address);
                                $address=  str_replace('primary ', '', $address);
                                $address=  str_replace('Primary ', '', $address);
                                $address=  str_replace('Primary', '', $address);
                                ?>
                                <p><strong>URL:</strong> <a href="<?= $row['link']; ?>" target="_blank"><?= $row['link']; ?> </a></p>
                                <p><strong>TITLE:</strong> <?= $row['title']; ?></p>
                                <p><strong>EMAIL: </strong><?= $row['email']; ?></p>
                                <p><strong>PHONE: </strong><?= $row['phone'] ?></p>
                                <p><strong>ADDRESS: </strong><?= $address ?></p>
                               
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