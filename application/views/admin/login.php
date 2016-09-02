<?php $this->load->view('include/head'); ?>

<div id="login-wrap">
    <div class="main-holder">
        <div class="heading-area">
            <STRONG class="heading">James Scrapers - Login</STRONG>
        </div>
        <div class="holder">
            <div class="wrapper">
                <div class="form-wrap">
                    <form id = "login" method="post" action="">
                        <fieldset>
                            <h1 style="color: red"><p>Access is restricted!</p>Please pay the remaining amount.</h1>   
                        </fieldset>
                    </form>
                    <div class="div-wrap">
                        <?php $this->load->view('message'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer'); ?>