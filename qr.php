<?php

/**
 * Class for QR Codes 
 *
 * @author Andrija aidvu Vucinic
 * @version 1.1
 *
 */
class QR {
	/**
	 * Function returns URL to Google API QR Generated image
	 * 
	 * @param url - The URL to be turned to QR Code
	 * @param size - Size of the QR image
	 * @param errorCorrection - Amount of reduntant information the QR code has (L - default, M, Q, H)
	 * @return Google API QR Generated image (to be used directly in img tag)
	 */
	public static function getQRforURL($url, $size, $errorCorrection = "L") {
		$link = "https://chart.googleapis.com/chart?" . 
				"cht=qr" . "&" .
				"chs=$size" . "x$size" . "&" .
				"chl=" . urlencode($url) . "&" .
				"choe=UTF-8" . "&" .
				"chld=$errorCorrection";
		return $link;
	}
}

?>