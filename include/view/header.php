<!DOCTYPE html>
<html lang="en">
  <head>
		<meta charset="utf-8">
		<title>BooRL, The URL Shortener</title>
		<meta name="description" content="URL Shortening service">
		<meta name="author" content="Andrija Vucinic">
		<link rel="stylesheet" href="style.css">
	<?php
	if (strlen(GA_CODE) > 0) { 
	?>
	<script type="text/javascript">
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', '<?php echo GA_CODE;?>']);
	  <?php echo (strlen(DOMAIN) > 0 ? "_gaq.push(['_setDomainName', '" . DOMAIN . "']);" : ""); ?>
	  
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
	<?php
	} 
	?>
	</head>
	<body>
		<div class="container center">
			<div class="header">
				<div class="logo center">
				</div>
			</div>
			<div class="center headerShadow"></div>