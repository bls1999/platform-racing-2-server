#!/usr/bin/php
<?php

<<<<<<< HEAD
require_once('/home/jiggmin/pr2/server/fns/all_fns.php');
require_once('/home/jiggmin/pr2/server/fns/query_fns.php');
=======
require_once(__DIR__ . '/../fns/all_fns.php');
require_once(__DIR__ . '/../fns/query_fns.php');
>>>>>>> shell-fix-prodemote

$port = $argv[1];
$user_id = $argv[2];

try {
	$db = new DB();
	$first_finder = $db->grab( 'first_finder', 'artifact_find', array($user_id) );
<<<<<<< HEAD
	
=======

>>>>>>> shell-fix-prodemote
	if( $first_finder == $user_id ) {
		award_part( $db, $user_id, 'head', 27 );
		award_part( $db, $user_id, 'body', 21 );
		award_part( $db, $user_id, 'feet', 28 );
	}
}

catch(Exception $e) {
	$message = $e->getMessage();
	echo $message;
	exit;
}

<<<<<<< HEAD
?>
=======
?>
>>>>>>> shell-fix-prodemote
