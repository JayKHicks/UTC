<?php
class functions{
	// Trims a JSON string to a single line and removes tabs
	public static function trimJson($object) {
		$trim1 = str_replace(array("\n", "\r"), '', $object);
		$trim2 = trim(preg_replace('/\t+/', '', $trim1));
		$trim3 = str_replace('": "', '":"', $trim2);
		$trim4 = str_replace('": {"', '":{"', $trim3);
		return $trim4;
	}
	
	// Standard function for curl using POST
	public static function curlPost($url, $data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(str_replace('&quot;','"',$data)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,30); //Set timeout in seconds
		$response = curl_exec($ch);
		curl_close($ch);
		return html_entity_decode(urldecode($response));
	}
	
	// Standard function for curl using GET
	public static function curlGet($url, $data){
		$fields_string = '';
		foreach($data as $key=>$value){
			$fields_string[] = $key . "=" . urlencode($value) ;
		}
		$urlStringData = $url . "?" . implode ("&", $fields_string);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"Accept: application/vnd.subscriptions.v2",
			"Content-type: application/x-www-form-urlencoded"
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
		curl_setopt($ch, CURLOPT_URL, $urlStringData ); //set the url and get string together
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,30); //Set timeout in seconds
		$response = curl_exec($ch);
		curl_close($ch);
		return html_entity_decode(urldecode($response));
	}
	
	// Output buffering function
	public static function outputBuffer($file, $options = null){
		ob_start();
		include $_SERVER['DOCUMENT_ROOT'] . $file;
		$output = ob_get_contents();
		ob_end_clean();
		return $output;
	}
}