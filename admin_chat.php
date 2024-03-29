<?php

	//You need to change this with your RealtimeDB url and add 'collection_name.json' to the end
	//In my case, my collection name is 'messages'
	//the resulting url is given below
    //$URL = "https://cs306-phase5-default-rtdb.europe-west1.firebasedatabase.app/messages.json";
	$URL = "https://cs306-project-85be9-default-rtdb.firebaseio.com/messages.json";

    function get_messages() { 
        global $URL;
        $ch = curl_init();
        curl_setopt_array($ch, [ CURLOPT_URL => $URL,
                                CURLOPT_POST => FALSE, // It will be a get request 
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_SSL_VERIFYPEER => false, ]);
        $response = curl_exec($ch); 
        curl_close($ch);
        return json_decode($response, true); 
    }
    $msg_res_json = get_messages();

?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>

<div class="menu">
<a href="../index.php">
	<div class="back">
		<i class="fa fa-chevron-left"></i>
		<img src="https://imgur.com/NUiBhHg.png" draggable="false"/>
	</div>
</a>
<div class="name">ADMIN</div>
<div class="last"><?=date("jS F Y h:i:s A")?></div>
</div>
<ol class="chat">
<?php
	if($msg_res_json != null)
	{
		$keys = array_keys($msg_res_json);
		if($keys != null)
		{
			for ($i = 0; $i < count($keys); $i++){
				$chat_msg = $msg_res_json[$keys[$i]];
				$name = $chat_msg['sender'];
				$msg = $chat_msg['message'];
				$time = $chat_msg['time'];
				if ($name == 'admin') {
					$from = 'self';
					$imge = 'https://imgur.com/NUiBhHg.png';
				} else {
					$from = 'other';
					$imge = 'https://imgur.com/YcmJ0LD.png';
				}
			   echo  '
			   <li class="'.$from.'">
			   <div class="avatar">
						<img src="'.$imge.'" draggable="false"/>
					</div>
						<div class="msg">
							<p><b>'.$name.'</b></p>
							<p>'.$msg.'</p>
							<time>'.$time.'</time>
						</div>
					</li>';
			}
		}
	}
?>
</ol>
<form name="form" action = "new_admin_message.php?sender=admin" method="POST">
    <input name="usermsg" class="textarea" type="text" placeholder="Type here!"/>
    <input type="submit" style="display: none" />
</form>