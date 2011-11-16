<div class="main center">
	<form method="post">
		<div>
			<div class="longBubble">
			</div>
			<div class="explanation">
			</div>
			<div class="shortBubble">
			</div>
		</div>
		<div class="row center">
			<div class="rowContainer center">
				<div class="formElement searchLong">
					<input class="url" type="text" name="url" id="url" value="" />
				</div>
				<div class="formElement">
					<input class="submit" type="submit" value=""/>
				</div>
				<div class="formElement searchShort">
					<input class="url" type="text" name="short" id="short" value="" readonly/>
				</div>
			</div>
		</div>
		<?php if ($submitted) { ?>
		<div class="row">
			<div class="rowContainer center info">
					<br />
					To check where the shortlink leads, just add an "=" (equals) sign at the end of the shortlink: <br />
					<a href="http://<?php echo $shortCodeURL;?>=" /><?php echo $shortCodeURL;?>=</a>
					<br /><br />
					To check the shortlink stats, just add a "+" (plus) sign at the end of the shortlink: <br />
					<a href="http://<?php echo $shortCodeURL;?>+" /><?php echo $shortCodeURL;?>+</a><br />
			</div>
		</div>
		<script type="text/javascript">
			document.getElementById("url").value='<?php echo $url;?>';
			document.getElementById("short").value='<?php echo $shortCodeURL;?>';
			document.getElementById("short").select();
		</script>
		<?php } ?>
	</form>
</div>