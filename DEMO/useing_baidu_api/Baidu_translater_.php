<?php


	/*
	http://developer.baidu.com/wiki/index.php?title=%E5%B8%AE%E5%8A%A9%E6%96%87%E6%A1%A3%E9%A6%96%E9%A1%B5/%E7%99%BE%E5%BA%A6%E7%BF%BB%E8%AF%91/%E7%BF%BB%E8%AF%91API
	*/
	/*
			$.ajax({
			url: "http://openapi.baidu.com/public/2.0/bmt/translate",
			type: "POST",
			data: {"from":"zh","to":"en", "client_id":"V1xgTgEXQFZ355cAYPpUeVgY","q":queryTxt},
			dataType: "json",
			error:function(e){
					console.log("ERROR");
					console.log(e);
			},
			success: function(data){
					console.log("SUCCEED");
					console.log(data);
					document.getElementById("trans_result_div").innerHTML = "-=";
			}
		});
	
	*/
	
	/**
 * $str ԭʼ�����ַ���
 * $encoding ԭʼ�ַ����ı��룬Ĭ��GBK
 * $prefix ������ǰ׺��Ĭ��"&#"
 * $postfix �����ĺ�׺��Ĭ��";"
 */
	function unicode_encode($str, $encoding = 'GBK', $prefix = '&#', $postfix = ';') {
		$str = iconv($encoding, 'UCS-2', $str);
		$arrstr = str_split($str, 2);
		$unistr = '';
		for($i = 0, $len = count($arrstr); $i < $len; $i++) {
			$dec = hexdec(bin2hex($arrstr[$i]));
			$unistr .= $prefix . $dec . $postfix;
		} 
		return $unistr;
	} 

	/**
	* $str Unicode�������ַ���
	* $decoding ԭʼ�ַ����ı��룬Ĭ��GBK
	* $prefix �����ַ�����ǰ׺��Ĭ��"&#"
	* $postfix �����ַ����ĺ�׺��Ĭ��";"
	*/
	function unicode_decode($unistr, $encoding = 'GBK', $prefix = '&#', $postfix = ';') {
		$arruni = explode($prefix, $unistr);
		$unistr = '';
		for($i = 1, $len = count($arruni); $i < $len; $i++) {
			if (strlen($postfix) > 0) {
				$arruni[$i] = substr($arruni[$i], 0, strlen($arruni[$i]) - strlen($postfix));
			} 
			$temp = intval($arruni[$i]);
			$unistr .= ($temp < 256) ? chr(0) . chr($temp) : chr($temp / 256) . chr($temp % 256);
		} 
		return iconv('UCS-2', $encoding, $unistr);
	}
	
	/**
	* rom	Դ�������֣����Դ����auto	��֧���ض���������ϣ�����ᵥ������˵��
	* to	Ŀ���������֣����Դ����auto	��֧���ض���������ϣ�����ᵥ������˵��
	* client_id	�������ڰٶȿ���������ע��õ�����ȨAPI key	���Ķ���λ�ȡapi keyhttp://developer.baidu.com/console#app/project
	* q	����������	���ֶα���ΪUTF-8���룬������GET��ʽ����APIʱ����Ҫ����urlencode���롣
	*/
	function language($value,  $from="auto",  $to="auto")
	{
		#���ȶ�Ҫ��������ֽ��� UTF-8ת��
		$value_code = iconv('GBK', 'UTF-8', $value);	
		#����urlencode ����
		$query_text =urlencode($value_code);
		#��ע���API Key
		$appid="V1xgTgEXQFZ355cAYPpUeVgY";
		#���ɷ���API��URL GET��ַ
		$languageurl = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=V1xgTgEXQFZ355cAYPpUeVgY&q=".$query_text."&from=".$from."&to=".$to;
		//echo $languageurl;
		//echo "<br/>";
		$result_text=language_text($languageurl);
		$returnObj = json_decode($result_text);
		var_dump($returnObj) ; 
		echo "<br/>";



		/*
		$trans_result = $returnObj->trans_result;
		var_dump($trans_result[0]->dst) ; 
		echo "<br/>";
		
		$finall_txt = $trans_result[0]->dst;
		$finall_u =json_encode($finall_txt);
		echo $finall_u."<br/>";
		
		
		//������ת����ԭ�����ģ�
		$jsons = preg_replace("#\\\u([0-9a-f]{4}+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", "\u4eca\u5929");
		echo $jsons."<br/>===";
		

		$text_unicode = '\u4eca\u5929';
		$text_utf8 = '����';
		
		echo iconv('GB2312', 'GBK', "����");
		echo "<br/>===<br/>";
		echo iconv('UCS-2BE', 'GBK', '\u4eca\u5929');
		echo "<br/>===<br/><br/>";
		
		
		echo mb_convert_encoding("����", "UTF-8", "GBK");
		echo "<br/>===<br/><br/>";
		
		echo preg_replace("#\\\u([0-9a-f]{4}+)#ie", "iconv('UCS-2BE', 'GB2312', pack('H4', '\\1'))", $text_unicode);
		 
		
		echo "<br/><br/>===<br/>";

		
		echo "<br/><br/>===<br/>";
		echo iconv('UCS-2BE', 'UTF-8', $finall_u);
		echo "<br/>===<br/>";
		echo iconv('UCS-2BE', 'GBK', '����');
		echo "<br/>===<br/><br/>";
		
		
		echo unicode_decode($finall_u,'GBK', "\\u", '');
		echo "<br/>";
		
		
		$returnObj = json_decode($result_text);
		var_dump($returnObj) ; 
		echo "<br/>";
		
		$text = $returnObj->trans_result;
		
		var_dump( urldecode(json_encode(urlencode($text)))) ; 
		*/
		
		//return urldecode($text[0]->dst);
		
	}
	
	function language_text($url)  #��ȡĿ��URL����ӡ������
	{
		if(!function_exists('file_get_contents')) {
			$file_contents = file_get_contents($url);
		} else {
			$ch = curl_init();
			$timeout = 5;
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$file_contents = curl_exec($ch);
			curl_close($ch);
		}
		return $file_contents;
	}

		function  isUtf8($string) { 
			#ASCII 
			# non-overlong 2-byte 
			# excluding overlongs 
			# straight 3-byte 
			# excluding surrogates 
			# planes 1-3 
			# planes 4-15 
			# plane 16 
			 return preg_match('%^(?: 
						[\x09\x0A\x0D\x20-\x7E]
					|	[\xC2-\xDF][\x80-\xBF]      
					|	\xE0[\xA0-\xBF][\x80-\xBF]      
					| 	[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} 
					| 	\xED[\x80-\x9F][\x80-\xBF]         
					| 	\xF0[\x90-\xBF][\x80-\xBF]{2}     
					|	[\xF1-\xF3][\x80-\xBF]{3}             
					|   \xF4[\x80-\x8F][\x80-\xBF]{2} 
			 )*$%xs', $string);      
		} 

		
	
	//echo language('���������','zh','en');
	echo language('today');

?>