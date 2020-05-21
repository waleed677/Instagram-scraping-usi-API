<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}



function convertAll($str) {
    $regex = "/[@#](\w+)/";

    $hrefs = [
        '#' => 'hashtag/?tag',
        '@' => 'profile/?username'
    ];
    
    $result = preg_replace_callback($regex, function($matches) use ($hrefs) {
         return sprintf(
             '<a class="hashtag" href="%s=%s">%s</a>',
             $hrefs[$matches[0][0]],
             $matches[1], 
             $matches[0]
         );
    }, $str);
        
    return($result);
}


?>