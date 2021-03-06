<?php
require_once('settings.php');
require_once('db.php');

function MakePost($name, $title, $text){

	global $db;

	//Remove HTML n shit from name
	$sane_name = substr(strip_tags($name), 0, 50);

	//Remove HTML n shit from text
	$sane_text = substr(strip_tags($text), 0, 1000);

	//Prepare for insert
	$q = $db->prepare('INSERT INTO posts (name, text, time)
		VALUES (:name, :text, :time)');
	
	//Insert values into DB
	$q->execute([
	'name' => $sane_name,
	'text' => $sane_text,
	'time' => date(DATE_RFC2822),
	]);

	header("Location: https://board.pomf.se");
}

function GetPost(){

	global $db;

	$q = $db->prepare('SELECT * FROM posts ORDER BY id DESC LIMIT 100');
	//$q = bindValue(':limit', MAX_POSTS_SHOWN, PDO::PARAM_INT);
	$q->execute();

	while ($row = $q->fetch(PDO::FETCH_ASSOC)){
		print '<blockquote><b>ID:</b> '.$row['id'].'<br><b>Time:</b> '.$row['time'].'<br><b>Name:</b> '.$row['name'].'</blockquote><pre>'.$row['text'].'</pre><br>';
	}

}
?>
