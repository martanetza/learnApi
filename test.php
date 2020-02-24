<?php
$time = "01:10";
$waitingTimeToArray = explode(':',  $time);
$iWaitingTimeToSeconds = (intval($waitingTimeToArray[0]) * 60 * 60) + (intval($waitingTimeToArray[1]) * 60);
$iMinutesToSeconds = intval($waitingTimeToArray[1]) * 60;
$iHour = intval($waitingTimeToArray[0]) * 60 * 60;

print_r($waitingTimeToArray);
echo $iWaitingTimeToSeconds . '///';
echo $iMinutesToSeconds  . '///';
echo $iHour  . '///';

$epoch1 = 1582495200;
$epoch2 = 1582500060;
$flyingTime = gmdate("H:i", ($epoch2 - $epoch1));
$flyingTime = gmdate("H:i", (10800));

echo $flyingTime;
?>
<script>
    String.prototype.toHHMM = function() {
        var sec_num = parseInt(this, 10); // don't forget the second param
        var hours = Math.floor(sec_num / 3600);
        var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
        // var seconds = sec_num - (hours * 3600) - (minutes * 60);

        if (hours < 10) {
            hours = "0" + hours;
        }
        if (minutes < 10) {
            minutes = "0" + minutes;
        }
        // if (seconds < 10) {
        //     seconds = "0" + seconds;
        // }
        return hours + ':' + minutes;
    }

    console.log("10800".toHHMM())
    var utcSeconds = 1582500060;
    var d = new Date(0);
    d.setUTCSeconds(utcSeconds);
    var b = d.getDate();
    console.log(b);
    console.log(d)
</script>