
<?


$email = trim($_POST['email']);
$phonenumber = trim($_POST['phonenumber']);


$sData = file_get_contents('users.json');
$jUsersData = json_decode($sData);


// foreach ($jUsersData as $userData) {
//     if ($userData->email == $email) {
//         echo "user exsits";
//     }
$jUser = new stdClass();

$jUser->email = $email;
$jUser->$phonenumber = $phonenumber;
array_push($jUsersData, $jUser);
// }

$sUsersData = json_encode($jUsersData, JSON_PRETTY_PRINT);


file_put_contents('users.json', $sUsersData);
