<?php
$data['general']['date_start'] = "2017-03-28 10:05:02";
$data['general']['date_end'] = "2017-04-09 12:05:02";
$data['client']['lastname'] = "shyam";
$data['client']['firstname'] = "radhe";
$data['client']['fathername'] = "siya ram";
$data['client']['birthdate'] = "1991-02-02";
$data['client']['sex'] = "Α";
$data['client']['afm'] = "077674685";
$data['client']['street'] = "ΑΝΘΕΩΝ";
$data['client']['street_no'] = "5";
$data['client']['zip_code'] = "13561";
$data['client']['telephone_number'] = "2102387207";
$data['client']['fax'] = "";
$data['client']['email'] = "aoomsn@jhsa.com";
$data['vehicle']['licence_plate'] = "ΖΜΥ3456";
$data['vehicle']['vehicle_model'] = "00017874"; //audi
$data['vehicle']['vehicle_color'] = "0005";
$data['vehicle']['first_licence_date'] = "2002-01-01";
$data['vehicle']['insured_value'] = "1800";
$data['vehicle']['frame_number'] = "12345678901234567890";

//$ch = curl_init("https://pilot.allianz.gr/UnderwritingRulesWS/urend/postoffer?username=urend&hash=" . md5("urendurend#123") . "&md5=" . md5(json_encode($data) . "10.126.32.86"));
$ch = curl_init("https://pilot.allianz.gr/UnderwritingRulesWS/urend/postoffer?md5=" . md5(json_encode($data) . "10.126.32.86"));

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Content-Length: ' . strlen(json_encode($data)))
);

$result = curl_exec($ch);
curl_close($ch);
print_r($result);

/* * ************************ ******************************* */
?>

<?php
die;
$con = mysql_connect('localhost', 'root', 'urendapp');
if (!$con) {
	echo "Cannot connect to the database ";
	die();
}
mysql_select_db('urend_pro');
$result = mysql_query('show tables');
while ($tables = mysql_fetch_array($result)) {
	foreach ($tables as $key => $value) {
		mysql_query("ALTER TABLE $value CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");
	}
}
echo "The collation of your database has been successfully changed!";
die;
?>






$servername = "localhost";
$username = "root";
$password = "urendapp";

// Create connection
$conn = new mysqli($servername, $username, $password, "urend_pro");

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT * FROM urend_users ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while ($row = $result->fetch_assoc()) {
$uid = $row['userId'];
$sql = "INSERT INTO urend_users_settings (

fk_user_id ,
setting_type ,
state
)
VALUES ( $uid , 'chat_notification',  '1'),
($uid , 'favourite_my_car', '1'),
($uid , 'remind_to_rate_trip', '1'),
($uid , 'promotions_announcements', '1') ,
($uid, 'push_request', '1'),
($uid, 'push_message', '1'),
($uid, 'push_other', '1'),	
($uid, 'email_request', '1'),
($uid, 'email_message', '1'),
($uid, 'email_other', '1')";

$conn->query($sql);
}
} else {
echo "0 results";
}
$conn->close();
?>
