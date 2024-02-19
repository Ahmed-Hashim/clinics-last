<?php

function generate_guid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    } else {
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid =  substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
        return $uuid."-".round(microtime(true));
    }
}

function test_inputs($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function test_inputs_2($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlentities($data);
   $data = str_replace("'","",$data);
   return $data;
}


function printer($dt = ''){
	$rr = html_entity_decode($dt);
	return $rr;
}




function upload_file($file_req, $sizer = 3000, $directory='uploads', $pointers='../../'){
	if(isset($_FILES[$file_req])){
		$targer_dir = $pointers.$directory."/";

		//data collection
		$fileName = $_FILES[$file_req]["name"]; // The file name
		$fileTmpLoc = $_FILES[$file_req]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES[$file_req]["type"]; // The type of file it is
		$fileSize = $_FILES[$file_req]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES[$file_req]["error"]; // 0 for false... and 1 for true
		
		if (!$fileTmpLoc) { // if file not chosen
			return false;
		}
		
		//check extensions
		$ths_ext = $fileType;
		if(!($ths_ext == 'image/jpeg' || $ths_ext == 'image/jpg' || $ths_ext == 'image/png' || $ths_ext == 'application/pdf')){
			//file is NOT ACCEPTED
			return false;
		}
		
		
		//check sizes
		$ths_size = $fileSize;
		$ths_size = round($ths_size/1024);
		if($ths_size > $sizer){
			return false;
		}
		
		/*
		//manipulate image width and height
		$x = 480;
		$y = 540;
		$nw_img = @imagecreate($x, $y);
		*/
		
			$ext = explode(".", $fileName);
			$extensiom = end($ext);
			$New_name = 'p_'.generate_guid();
			$db_file_name = $New_name.'.'.$extensiom;
			if(move_uploaded_file($fileTmpLoc, $targer_dir.$New_name.'.'.$extensiom)){
				return $db_file_name;
			} else {
				return false;
			}
		
		
		
		
		
		
	}//end of isset
}

function upload_picture($file_req, $sizer = 3000, $directory='uploads', $pointers='../../'){
	if(isset($_FILES[$file_req])){
		$targer_dir = $pointers.$directory."/";

		//data collection
		$fileName = $_FILES[$file_req]["name"]; // The file name
		$fileTmpLoc = $_FILES[$file_req]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES[$file_req]["type"]; // The type of file it is
		$fileSize = $_FILES[$file_req]["size"]; // File size in bytes
		$fileErrorMsg = $_FILES[$file_req]["error"]; // 0 for false... and 1 for true
		
		if (!$fileTmpLoc) { // if file not chosen
			return false;
		}
		
		//check extensions
		$ths_ext = $fileType;
		if(!($ths_ext == 'image/jpeg' || $ths_ext == 'image/jpg' || $ths_ext == 'image/png' || $ths_ext == 'application/pdf')){
			//file is NOT ACCEPTED
			return false;
		}
		
		
		//check sizes
		$ths_size = $fileSize;
		$ths_size = round($ths_size/1024);
		if($ths_size > $sizer){
			return false;
		}
		
		/*
		//manipulate image width and height
		$x = 480;
		$y = 540;
		$nw_img = @imagecreate($x, $y);
		*/
		
			$ext = explode(".", $fileName);
			$extensiom = end($ext);
			$New_name = 'p_'.generate_guid();
			$db_file_name = $New_name.'.'.$extensiom;
			if(move_uploaded_file($fileTmpLoc, $targer_dir.$New_name.'.'.$extensiom)){
				return $db_file_name;
			} else {
				return false;
			}
		
		
		
		
		
		
	}//end of isset
}




function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function detectDevice(){
	$userAgent = $_SERVER["HTTP_USER_AGENT"];
	$devicesTypes = array(
        "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
        "tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
        "mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
        "bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
    );
 	foreach($devicesTypes as $deviceType => $devices) {           
        foreach($devices as $device) {
            if(preg_match("/" . $device . "/i", $userAgent)) {
                $deviceName = $deviceType;
            }
        }
    }
    return ucfirst($deviceName);
 	}
 	
 	
 	
 	

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}



?>