<?php require("commonforapi.php");


//Procedures to get data from service


//using get Method 
function getJsonfromurl($url)
	{
		if(checkService())
			{
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json'));
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);		 
				try{
					$result = curl_exec($ch);
					$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
					// $json=json_decode($result,true);
					return $result;
					}
				catch(Exception $ex)
					{
					echo $ex->message;
					}
			}
			else
			{
				return "Service is not running";
			}
	}
	
//Using Post message

function getJsonViaPost($url, $parameters)
	{
		if(checkService())
		{
			$jsonObject = json_encode($parameters);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, true);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonObject);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				try{
					$result = curl_exec($ch);
					$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		 			curl_close($ch);
					return $result;
					}
				catch(Exception $ex)
					{
					echo $ex->message;
					}
		}
		else
		{
			return "Service is not running";
		}
	}

function getJsonfromurldecoded($url)
	{
	if(checkService())
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json'));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		 
		try{
		$result = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$json=json_decode($result);


		return $json;
		}
		catch(Exception $ex)
		{
		echo $ex->message;
		}
}
else
{
	return "Service is not running";
}

}
function checkService()
{ 
$host = '192.168.1.15';
	if($socket =@ fsockopen($host, 8000, $errno, $errstr, 30))
		 {
		return true;
		fclose($socket);
		}	 

	else
	 	{
		return false;
		}
}



 if(isset($_GET['param']) && isset($_GET['value']))
	 {
 		$param=strtolower($_GET['param']);
 		$value=strtolower($_GET['value']);
 		
 		if($param=="status")
	 		{
	 			
	 			if(isset($_GET['datefrom']) && isset($_GET['dateto']))
	 			{
		 			$datefrom=urldecode($_GET['datefrom']);
	             	$dateto=urldecode($_GET['dateto']); 
	             	$url=SERVICE_URL."/getfullStatusbydate";
	             	$parameters = array('opcid' => $value, "datefrom" => $datefrom, "dateto" => $dateto);
	             //	echo json_encode($parameters);
	             	$json=getJsonViaPost($url,$parameters);
	             	echo $json;
	            
	             	}
             	else
             	{
             	$url=SERVICE_URL."/sts_full?id=".urlencode($value);
	 			$json=getJsonfromurl($url);
	           	
	            echo $json;
             	}
            }
		else if($param=="getalarms")
			{
				$url=SERVICE_URL."/getAlarms?id=".urlencode($value);
	            $json=getJsonfromurl($url);
	            echo $json;
			} 
 		else if($param=="getdevices")
 		{
 			if($value=="all")
 				{
 					$url=SERVICE_URL."/getopcs";
				}
				else
				{
					 $url=SERVICE_URL."/getConfig?id=".urlencode($value);
            	}
			$json=getJsonfromurl($url);
			echo $json;

 		}
		
 		else if($param=="current_status")
 		{
 			if($value=="all")
 				{
 					$url=SERVICE_URL."/sts_last_all";
 					$json=getJsonfromurl($url);
					echo $json;
				}
				else
				{
					 $url=SERVICE_URL."/sts_last?id=".urlencode($value);
					  $json=getJsonfromurl($url);
					 echo "[".$json."]";
            	}
            
             
 		}
		else if($param=="device_types")
		 		{
					$url=SERVICE_URL."/gettypes";
            		$json=getJsonfromurl($url);
            		echo $json;
		 		}
 		else if($param=="devices_by_type")
		 		{
					$url=SERVICE_URL."/getTypeCountry?type=".urlencode($value);
	            	$json=getJsonfromurl($url);
	            	echo $json;
		 		}
 		else if($param=="sts_last")
		 		{
					
		 		}
		 		else
 		{
 			echo "test";	

 		}

        
 	}

else
{
	echo "function not implimented";
}

  
?>






