<div id="menu" class="closed">
	<div class="menu-wrap">
	<a class="cross-btn" href="javascript:void(null)">
      	<span onclick="$('#menu').dialog('close');">
        	<img src="<?=IMAGE_URL?>icon-cross.png">
        </span>
    </a>
    <div class="logo">
        <a href="#">
            <img src="<?= IMAGE_URL ?>logo-menu.png" alt=""/>
        </a>
    </div>
	  <ul class="added" >
			<li class="active"><a href="javascript:void(0);" onclick=" $('.main').moveTo(1);$('#menu').dialog('close');" >Home</a></li>
			<!--<li><a href="javascript:void(0);" onclick=" $('.main').moveTo(2); $('#menu').removeClass('opened').addClass('closed');" >Games</a></li>-->
			<li><a href="javascript:void(0);" onclick=" $('.main').moveTo(2);" >Games</a></li>
			<li><a href="javascript:void(0);" onclick=" $('.main').moveTo(3);$('#menu').dialog('close');" >How it works</a></li>
			<li><a href="javascript:void(0);" onclick=" $('.main').moveTo(4);$('#menu').dialog('close');" >About us</a></li>
			<li><a href="javascript:void(0);" class="develop">Developers</a></li>
			<li><a href="<?= BASE_URL ?>pdf/privacy_policy.pdf" target="_blank">Privacy Policy </a></li>
			<li><a href="<?= BASE_URL ?>pdf/terms_conditions.pdf" target="_blank">Terms of Use</a></li>
	  </ul>
      </div>
      <div class="my-social">
          <ul>
            <li><a href="https://www.facebook.com/pages/Ozoneplay/1556884104589980?fref=ts" target="_blank"><img src="images/icon-fb-footer.png" alt="FB"></a></li>
            <li><a href="https://plus.google.com/108227514903366059643/posts" target="_blank"><img src="images/icon-google-footer.png" alt="G+"></a></li>
            <li><a href="https://twitter.com/ozone_play" target="_blank"><img src="images/icon-twitter-footer.png" alt="TW"></a></li>
            <li><a href="https://www.linkedin.com/company/ozoneplay" target="_blank"><img src="images/icon-linkedin-footer.png" alt="LI"></a></li>        
          </ul>
          <p>Copyright &copy; <?= date("Y") ?> <a href="http://www.ozoneplay.com/" target="_blank"> Ozoneplay.com </a> All Rights Reserved.</p>
      </div>
</div>