<?php

function time_elapsed_string($time)
{
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    $now = time();

    $difference = $now - $time;
    $tense = "ago";

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if ($difference != 1) {
        $periods[$j] .= "s";
    }

    return "$difference $periods[$j] $tense ";
}

// function time_ago($time)
// {
//     $time = time();
//     $time_formats = [
//         [60, 'seconds', 1], // 60
//         [120, '1 minute ago', '1 minute from now'], // 60*2
//         [3600, 'minutes', 60], // 60*60, 60
//         [7200, '1 hour ago', '1 hour from now'], // 60*60*2
//         [86400, 'hours', 3600], // 60*60*24, 60*60
//         [172800, 'Yesterday', 'Tomorrow'], // 60*60*24*2
//         [604800, 'days', 86400], // 60*60*24*7, 60*60*24
//         [1209600, 'Last week', 'Next week'], // 60*60*24*7*4*2
//         [2419200, 'weeks', 604800], // 60*60*24*7*4, 60*60*24*7
//         [4838400, 'Last month', 'Next month'], // 60*60*24*7*4*2
//         [29030400, 'months', 2419200], // 60*60*24*7*4*12, 60*60*24*7*4
//         [58060800, 'Last year', 'Next year'], // 60*60*24*7*4*12*2
//         [2903040000, 'years', 29030400], // 60*60*24*7*4*12*100, 60*60*24*7*4*12
//         [5806080000, 'Last century', 'Next century'], // 60*60*24*7*4*12*100*2
//         [58060800000, 'centuries', 2903040000] // 60*60*24*7*4*12*100*20, 60*60*24*7*4*12*100
//     ];
//     $seconds = (time() - $time) / 1000;
//     $token = 'ago';
//     $list_choice = 1;

//     if ($seconds == 0) {
//         return 'Just now';
//     }
//     if ($seconds < 0) {
//         $seconds = abs($seconds);
//         $token = 'from now';
//         $list_choice = 2;
//     }
//     $i = 0;
//     while ($format = $time_formats[$i++])
//         if ($seconds < $format[0]) {
//             if (gettype($format[2]) == 'string')
//                 return $format[$list_choice];
//             else
//                 return floor($seconds / $format[2]) + ' ' + $format[1] + ' ' + $token;
//         }
//     return $time;
// }
