<?php $this->load->view('include/admin/header'); ?>
<div id="main">
    <?php $this->load->view('include/admin/sidebar'); ?>
    <div id="content">
        <div class="page-head">
            <span class="page-heading">Admins</span>
            <?php $this->load->view('message'); ?>
        </div>
        <div class="table-wrapper">
            <div class="holder">
                <div class="block wide-view">
                    <div class="row-fluid">
                        <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="sorting">Name</th>
                                    <th class="hidden-480">Email</th>
                                    <th class="hidden-480">Role</th>
                                    <th class="hidden-480">status</th>
                                    <th class="hidden-480">created_at</th>
                                    <th class="hidden-480">updated_at</th>
                                    <?php
                                    if ($this->session->userdata('user_data')->email == ADMIN_EMAIL) {
                                        echo '<th class="hidden-480">Change Status</th>';
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                if ($data) {
                                    foreach ($data as $row) {
                                        ?>
                                        <tr>
                                            <td><?= $row['name']; ?></td>
                                            <td class="hidden-480"><?= $row['email']; ?></td>
                                            <td class="hidden-480"><?= get_role_string($row['role_id']); ?></td>
                                            <td class="hidden-phone"><?= get_status($row['status']); ?></td>
                                            <td class="hidden-phone"><?= ($row['created_at']); ?></td>
                                            <td class="hidden-phone"><?=  $row['updated_at'];?>
                                            </td>
                                            <?php
                                            if ($this->session->userdata('user_data')->email == ADMIN_EMAIL) {
                                                echo "<td class='hidden-phone'><a href='" . base_url() . "admin/change_status/" . $row['id'] . "/" . $row['status'] . "'>".change_status($row['status'])."</a></td>";
                                            }
                                            ?>
                                        </tr>
                                        <?php
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
</div>
 <?php $this->load->view('include/footer'); ?> 