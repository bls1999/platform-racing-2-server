#!/usr/bin/php
<?php

<<<<<<< HEAD
require_once('/home/jiggmin/pr2/server/fns/db_fns.php');
=======
require_once(__DIR__ . '/../fns/db_fns.php');
>>>>>>> shell-fix-prodemote

$port = $argv[1];
$user_id = $argv[2];
$power = $argv[3];

try{
	$connection = user_connect();
	$safe_user_id = addslashes($user_id);
	$safe_power = addslashes($power);
	$safe_time = addslashes(time());
	$safe_min_time = addslashes(time()-(60*60*24*12));
<<<<<<< HEAD
	
=======

>>>>>>> shell-fix-prodemote
	//throttle mod promotions
	if($power > 1) {
		$result = $connection->query("SELECT COUNT(*) as recent_promotion_count
										FROM promotion_log
										WHERE power > 1
										AND time > $safe_min_time");
		if(!$result) {
			throw new Exception('Could not check promotion throttle.');
		}
<<<<<<< HEAD
		
=======

>>>>>>> shell-fix-prodemote
		$row = $result->fetch_object();
		if($row->recent_promotion_count > 0) {
			throw new Exception('Someone has already been promoted to moderater recently.');
		}
	}
<<<<<<< HEAD
	
=======

>>>>>>> shell-fix-prodemote
	//log the power change
	$result = $connection->query("INSERT INTO promotion_log
								 	SET message = 'user_id: $safe_user_id has been promoted to power $safe_power',
										power = '$safe_power',
										time = '$safe_time'");
	if(!$result) {
		throw new Exception('Could not record power change.');
	}
<<<<<<< HEAD
	
=======

>>>>>>> shell-fix-prodemote
	//do the power change
	$result = $connection->query("update users
									set power = '$safe_power'
									where user_id = '$safe_user_id'");
	if(!$result){
		throw new Exception("Could not promote $user_id to moderator");
	}
<<<<<<< HEAD
	
=======

>>>>>>> shell-fix-prodemote
	//call_socket_function($port, "process_message`update user power ran ok", 'localhost');
}

catch(Exception $e){
	$message = $e->getMessage();
	echo $message;
	//call_socket_function($port, "process_message`$message", 'localhost');
	exit;
}

<<<<<<< HEAD
?>
=======
?>
>>>>>>> shell-fix-prodemote
