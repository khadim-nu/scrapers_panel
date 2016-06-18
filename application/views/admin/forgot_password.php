<body>
    <?php $this->load->view('include/head'); ?>
    <div id="login-wrap">
        <div class="main-holder">
        	
            <div class="heading-area">
                <STRONG class="heading"> Forgot-Password</STRONG>
            </div>
            <div class="holder">
                <div class="wrapper">
                    <div class="form-wrap">
                        <form id="login" method="post" action="<?= base_url() . $user_role; ?>/forgot_password">
                            <div class="div-wrap">
                                <?php $this->load->view('message'); ?>
                            </div>
                            <br>
                            <fieldset>
                                <div class="input-wrap">
                                    <input type="email" name="email"  placeholder="Enter Your Email ID" value="<?php
                                    if (isset($form_data)) {
                                        echo $form_data['email'];
                                    }
                                    ?>" data-trigger="change" data-parsley-required data-type="email" autocomplete="on">

                                </div>
                                <div class="sign-area mysign-area">
                                    <button class="sign-btn">Request</button>
                                </div>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('include/navigation'); ?>
</body>
</html>