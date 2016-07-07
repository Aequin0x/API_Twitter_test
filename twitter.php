<?php
require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', 'j6WTpjrynB4mIV3YoqKrwl2GS');
define('CONSUMER_SECRET', 'rqGKPK9spnjQO1dlwUixRhjBe1F8v5jaf1XbqsvA0iomg9flav');
$access_token = '472230100-9efALTuTcT5Keilv2SmZsyKaIzaofA9nQr8HnLrg';
$access_token_secret = 'GIG7k198NY4KFoHlbVfEHZ7UDTlogxPpdZ6qwdtsm0CHK';

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
$content = $connection->get("account/verify_credentials");

// echo $content->name;



// Pour ecrire un tweet //

// $connection->post("statuses/update", array("status" => "https://horsjeu.football/ "));


// Pour suivre quelqu'un //

// $connection->post("friendships/create", array("screen_name" => "Ass059"));


// Pour lister des users par un mot clef //

$suggestions = $connection->get('users/search', array('q' => 'web', 'count' => 5));
// Pour les suivres //
foreach ($suggestions as $suggestion) {
	echo $suggestion->screen_name;
	$connection->post('friendships/create', array('screen_name' => $suggestion->screen_name));
}

// Tweeter une image via lorempixel

// $media1 = $connection->upload('media/upload', ['media' => 'http://qnimate.com/wp-content/uploads/2014/03/images2.jpg']); // Your img here
// $parameters = [
// 	'status' => 'img',
// 	'media_ids' => implode(',', [$media1->media_id_string])
// ];
// $result = $connection->post('statuses/update', $parameters);


// Pour voir tout ses tweets //

$tweets = $connection->get('statuses/user_timeline', array('user_id' => $content->id));
//var_dump($tweets);

// Pour mettre en forme ses tweets grace // 
foreach ($tweets as $tweet) {
	$embedTweet = $connection->get('statuses/oembed', array('url' => 'https://twitter.com/'.$content->screen_name.'/status/'.$tweet->id));
	echo $embedTweet->html;
}

?>