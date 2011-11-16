<div>
	<?php
		foreach ($statistics->getBrowsers() as $browser) {
			echo $browser[0] . " " . $browser[1]. "<br/>";
		}
	?>
	<?php
		foreach ($statistics->getOperatingSystems() as $os) {
			echo $os[0] . " " . $os[1]. "<br/>";
		}
	?>
</div>
<div>
	<?php
		foreach ($statistics->getCountries() as $country) {
			echo $country[0] . " " . $country[1]. "<br/>";
		}
	?>
	<?php
		foreach ($statistics->getReferers() as $referer) {
			echo $referer[0] . " " . $referer[1]. "<br/>";
		}
	?>
</div>