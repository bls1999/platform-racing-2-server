#!/usr/bin/php
<?php

<<<<<<< HEAD
require_once('/home/jiggmin/pr2/server/fns/DB.php');
require_once('/home/jiggmin/pr2/server/fns/db_fns.php');
require_once('/home/jiggmin/pr2/server/fns/management_fns.php');
=======
require_once(__DIR__ . '/server/fns/DB.php');
require_once(__DIR__ . '/server/fns/db_fns.php');
require_once(__DIR__ . '/server/fns/management_fns.php');
>>>>>>> shell-fix-prodemote

$db = new DB();

for($i=1; $i<100; $i++) {
	@$server_id = (int) $argv[$i];
<<<<<<< HEAD
	
=======

>>>>>>> shell-fix-prodemote
	if(isset($server_id) && $server_id != 0) {
		try{
			$reply = talk_to_server_id( $db, $server_id, 'shut_down`', true );
			echo "Shutting down server $server_id. Reply: $reply\n";
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}
	else {
		break;
	}
}

<<<<<<< HEAD

?>
=======
?>
>>>>>>> shell-fix-prodemote
