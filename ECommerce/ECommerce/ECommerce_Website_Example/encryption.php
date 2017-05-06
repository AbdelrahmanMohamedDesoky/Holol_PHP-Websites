<?php
Class Encryption {
static function encrypt($str){
	 $result = '';
	 $key = "thelongestkeyinthewholeworld1231231231231231231";
	for($i=0; $i<strlen($str); $i++) {
		$char = substr($str, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)+ord($keychar));
		$result.= $char ;
		}
	return urlencode(base64_encode($result));
}

static function decrypt($str){
  $str = base64_decode(urldecode($str));
  $result = '';
  $key = "thelongestkeyinthewholeworld1231231231231231231";
  for($i=0; $i<strlen($str); $i++) {
    $char = substr($str, $i, 1);
    $keychar = substr($key, ($i % strlen($key))-1, 1);
    $char = chr(ord($char)-ord($keychar));
    $result.=$char;
  }
return $result;	
}
}
?>