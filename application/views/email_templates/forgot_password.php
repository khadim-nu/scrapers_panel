<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>test</title>
        <style>
            img {
                display:block;
                margin:0;
                padding:0;
            }
        </style>
    </head>
    <body>
        <div id="wrapper" style="max-width:750px; margin:0 auto; font-size:18px; line-height:23px; border:2px solid #4472c4; padding:20px;font-family:Arial, Helvetica, sans-serif;">
            <div class="add-txt" style="overflow:hidden; margin:0 0 25px;">
                <p style="margin:0 0 10px;">Hi <?=$name.',' ?></p>
            </div>
            <div class="txt" style="overflow:hidden; padding:0 0 10px; line-height:30px;">
                <p style="margin:0 0 10px;">You recently requested a password reset.</p>
            </div>
            <div class="add-txt" style="overflow:hidden; margin:0 0 25px;">
                <p style="margin:0 0 10px;">To change your test password, click here or paste the following link into your browser:<br><a href="<?= $url;?>" style="color:#53a9eb; text-decoration:none;"> <?= $url; ?> </a></p>
            </div>
            <div class="txt" style="overflow:hidden; padding:0 0 10px; line-height:30px;">
                <p style="margin:0 0 10px;">The link will expire in 24 hours.</p>
            </div>
            <div class="add-txt" style="overflow:hidden; margin:0 0 25px;">
                <p style="margin:0 0 10px;">Have a great day and continue to Play, Compete and Win$ with test.</p>
            </div>
            <div class="txt-box" style="overflow:hidden; margin:0 0 25px;">
                <p style="margin:0 0 2px;">test Team</p>
                <a href="javascript:void(0);">
                    <img src="<?= base_url().'assets/images/logo1.png' ?>" alt="images description">
                </a>
            </div>
            <div class="footer-txt" style="font-size:12px; line-height:15px;">
                <span style="display:block; font-size:14px; line-height:17px; margin:0 0 12px;">This email was intended for</span>
                <p style="margin:0 0 10px;color:#696969;">This message is confidential. It may also be privileged or otherwise protected by work product immunity or other legal rules. If you have received it by mistake, please let us know by forwarding it to <a href="#" style="color:#53a9eb; text-decoration:none;">support@test.com</a> and delete it from your system; you may not copy this message or disclose its contents to anyone. The integrity and security of this message cannot be guaranteed on the Internet.</p>
            </div>
        </div>
    </body>
</html>