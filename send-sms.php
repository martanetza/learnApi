<?php

$sMessage = urlencode('Flight number:' . $bookingNumber . 'From:' . $fromCity . 'To:' . $toCity);
$sApiKey = 'IGbfiPPX74MynwibPXq707msvl1AEVfFt2pz36CXy3rIw1cagU';
echo file_get_contents("https://fatsms.com/apis/api-send-sms?to-phone=$phonenumber&message=$sMessage&from-phone=$phonenumber&api-key=xNWvTozq1SyzTlfkBWJ4WYTWhzDscEVbTj46eNETy2xO3D91rn");
