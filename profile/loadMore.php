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
     $url = $_POST['url'];
    // $url = 'https://www.instagram.com/graphql/query/?query_hash=e769aa130647d2354c40ea6a439bfc08&id=1450891773&first=30&after=QVFDYWdhQm9fVlRBS1ViQ2hsVFFwMllva25tYW9qdTNVWC04OFVvQlcyRW5jSHlvYmpJWi11eEtRcFVYLVFaN2xSRzR2S0tad0ZwX0xEY05pd1FvMTlCaA==';
	$urls = file_get_contents($url);
	$response = json_decode($urls);
	$posts = $response->data->user->edge_owner_to_timeline_media->edges;
	$j=0;
	$nextPage = $response->data->user->edge_owner_to_timeline_media->page_info->has_next_page;
	if($nextPage){
$after = $response->data->user->edge_owner_to_timeline_media->page_info->end_cursor;
}else{
	$after = "";
}
	
	$temp['data']['next_page_url'] = $after;
	$temp['data']['has_next_page'] = $nextPage;
	foreach($posts as $profile){
	    if($profile->node->edge_media_to_caption->edges[0] != ""){
          $caption = $profile->node->edge_media_to_caption->edges[0]->node->text;
          }else{
              $caption = "";
          }
     $date = '@'.$profile->node->taken_at_timestamp;
     $time = time_elapsed_string($date);
	 $temp['data']['posts'][$j++] = array(
	'shortcode'  =>  $profile->node->shortcode,
	'caption' => $caption,
	'comment' => $profile->node->edge_media_to_comment->count,
	'likes'	 => $profile->node->edge_media_preview_like->count,
	'url' => $profile->node->display_url,
	'is_video' => $profile->node->is_video,
	'date' => $time,
	
	);
	    
	}
	echo json_encode($temp);



?>