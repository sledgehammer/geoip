<?php
/**
 * GeoIPLookupUtil
 */
namespace Sledgehammer;
/**
 * @package GeoIP
 */
class GeoIPLookupUtil extends Util {

	/**
	 * Constuctor
	 */
	function __construct() {
		parent::__construct('Geolocation for IP', 'module_icons/geoip.png');
	}

	function generateContent() {
		$module = array(
			'path' => dirname($this->paths['utils'])
		);
		if (isset($_GET['ip'])) {
			Framework::$autoLoader->importModule($module);
			$geoip = new GeoIP();
			$result = $geoip->getCountry(value($_GET['ip']));
			return Alert::success('<h3>Maxmind GeoIP</h3>IP: <b>'.$_GET['ip'].'</b> is located in <b>'.$result['country'].'</b> ('.$result['code'].')');
		} else {
			return new Form(array(
				'method' => 'get',
				'fields' => array(
					new Input(array('name' => 'ip', 'placeholder' => 'IP address')),
					new Input(array('type' => 'submit', 'value' => 'Lookup', 'class' => 'btn btn-primary btn-small')),
				),
			));
		}
	}
}

?>
