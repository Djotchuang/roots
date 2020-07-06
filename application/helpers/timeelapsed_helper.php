<?php

function time_elapsed_string($time)
{
    // $now = new DateTime;
    // $ago = new DateTime($datetime);
    // $diff = $now->diff($ago);

    // $diff->w = floor($diff->d / 7);
    // $diff->d -= $diff->w * 7;

    // $string = array(
    //     'y' => 'year',
    //     'm' => 'month',
    //     'w' => 'week',
    //     'd' => 'day',
    //     'h' => 'hour',
    //     'i' => 'minute',
    //     's' => 'second',
    // );
    // foreach ($string as $k => &$v) {
    //     if ($diff->$k) {
    //         $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
    //     } else {
    //         unset($string[$k]);
    //     }
    // }

    // if (!$full) $string = array_slice($string, 0, 1);
    // return $string ? implode(', ', $string) . ' ago' : 'just now';

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
