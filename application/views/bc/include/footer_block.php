<div class="clr"></div>
<div class="shadow-sec"><img src="<?php echo base_url(); ?>assets/image/shadowback.png"></div>
<div class="clr"></div>
<footer>
	<div class="footer">
		<div class="ftr-part">
			<div class="ftr-part2">
				<h4><?php echo $this->lang->line('COMPANY');?></h4>
				<ul>
					<li><a href="#"><?php echo $this->lang->line('ABOUT');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('CAREERS');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('TEAM');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('MEDIA');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('HELP');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('FIND_A_CITY');?></a></li>
				</ul>
			</div>
			<div class="ftr-part2">
				<h4><?php echo $this->lang->line('HOW_IT_WORKS');?></h4>
				<ul>
					<li><a href="#"><?php echo $this->lang->line('RIDE');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('DRIVE');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('BUSINESS_TRAVEL');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('SAFETY');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('PRIVACY');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('TERMS_OF_SERVICE');?></a></li>
				</ul>
			</div>
			<div class="ftr-part2">
				<h4><?php echo $this->lang->line('LANGUAGE');?></h4>
				<div class="clr"></div>
				<div class="select">
					<select id="lang_selector" onchange="lang_changer(this.value);"  data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2">
						<option   value="" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$6">Select</option>
						<option   value="greek" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$6">ελληνικά</option>
						<option   value="english" class="text-black" data-reactid=".pni43nf9c0.0.0.1.0.$footer.2.0.3.0.0.0.2.$7">English</option>
					</select>
				</div>
			</div>
		</div>
		<div class="clr"></div>
		<div class="ftr-part">
			<div class="ftr-part3">
				<div class="ftr-img"> <img src="<?php echo base_url(); ?>assets/image/playstore.png"><img src="<?php echo base_url(); ?>assets/image/googleplay.png"> </div>
			</div>
		</div>
		<div class="clr"></div>
		<div class="ftr-part">
			<div class="ftr-part3">
				<div class="social">
					<div class="social-img"><a  target="_blank" href="<?php echo get_web_meta_data('facebook_link'); ?>"><img src="<?php echo base_url(); ?>assets/image/fb.png"></a></div>
					<div class="social-img"><a  target="_blank" href="<?php echo get_web_meta_data('twitter_link'); ?>"><img src="<?php echo base_url(); ?>assets/image/tweetr.png"></a></div>
					<div class="social-img"><a  target="_blank"  href="<?php echo get_web_meta_data('linkedin_link'); ?>"><img src="<?php echo base_url(); ?>assets/image/IN.png"></a></div>
					<div class="social-img"><a  target="_blank"  href="<?php echo get_web_meta_data('instagram_link'); ?>"><img src="<?php echo base_url(); ?>assets/image/instagram.png"></a></div>
				</div>
				<div class="clr"></div>
				<p>&copy; Urend, 2016 </p>
			</div>
		</div>
	</div>
</footer>
<script>
	<?php  if( $this->input->cookie('lang') == "english" or  $this->input->cookie('lang') == "" ){ ?>
		document.getElementById("lang_selector").value = 'english';
	<?php }else{ ?>
		document.getElementById("lang_selector").value = '<?php echo $this->input->cookie('lang'); ?>';
	<?php } ?>
	function lang_changer(val) {
		var cname = "lang";
		var cvalue = val;
		var exdays = 30;
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires=" + d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		window.location.reload();
	}
	
	
	
</script>
<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?4hyq0HbBDSn0q9lUrKLiOQKswjnXnmqI";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->