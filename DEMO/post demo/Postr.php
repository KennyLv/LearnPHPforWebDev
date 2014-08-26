<?php 
	//extract($_POST);
	//set POST variables
	$url ='http://txt89800.com/hoperun/';
	$fields = array(
            'Cell'=>urlencode($_POST["cell"]),
            'Message'=>urlencode($_POST["message"])
        );
		echo $_POST;
	//url-ify the data for the POST
	$fields_string='';
	foreach($fields as $key=>$value) {
		$fields_string.= $key.'='.$value.'&'; 
	}
	$fields_string=rtrim($fields_string,'&');
	//open connection
	$ch = curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
	//execute post
	$result = curl_exec($ch);
	//close connection
	curl_close($ch);
	echo $ch;
?>