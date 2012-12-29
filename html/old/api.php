<?php

    // configuration
    require("../includes/config.php");

    $start_date = query("SELECT `start date` FROM events WHERE `request id` = ?",$_SESSION["request_id"]);
    $end_date = query("SELECT `end date` FROM events WHERE `request id` = ?", $_SESSION["request_id"]);
    $data[] = array('sdate'=>$start_date,'edate'=>$end_date);
    echo json_encode($data);
?>
    
<script>
                    $.ajax({
                        url: '/api.php',
                        dataType:' 'json',
                        succcess:function (data)
                        {
                            var startdate = data[0].substring(data[0].search("t date \":\"")+10,data[0].search("\"}],\""));
                            var enddate = data[1].substring(data[1].search("d date \":\"")+10,data[1].search("\"}]}]"));
                        }
                    })
                    $('test').html('https://www.google.com/calendar/feeds/default/private/full?start-min=' + startdate + 'T00:00:00&start-max=' + enddate + 'T23:59:59'');
                    $.ajax({
                        url: 'https://www.google.com/calendar/feeds/default/private/full?start-min=' + startdate + 'T00:00:00&start-max=' + enddate + 'T23:59:59',
                        dataType: 'xml',
                        success: function (data) 
                        {
                            
                        }
                    })
                </script>  
                
                // send email notification to user 2!
                 $to = $user2;
                $subject = "meetr request";
                $message = "hello! you have a meetr request.";
                $from = "xlinders@gmail.com";
                $headers = "From:" . $from;
                if (mail($to, $subject, $message, $headers))
                {
                    echo("Mail Sent.");
                }
                else
                {
                    echo("Mail failed.");
                } 
                
                
          /*
                $url = //"https://www.google.com/calendar/feeds/default/freebusy/busy-times/xlinders@gmail.com";
                
                "https://www.google.com/calendar/feeds/default/private/full?v=2&start-min=" . $start_date[0]["start_date"] . 
                    "T00:00:00&start-max=" . $end_date[0]["end_date"] . "T23:59:59";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $curlheader[0] = "Authorization: Bearer " . $_SESSION['accessToken'];
	            curl_setopt($ch, CURLOPT_HTTPHEADER, $curlheader);
                $response = curl_exec($ch);
                curl_close($ch); 
                
                echo $response; */
               

                /*calls api and gets the data
function call_api($accessToken,$url){
	$curl = curl_init($url);
 
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);	
	$curlheader[0] = "Authorization: Bearer " . $accessToken;
	curl_setopt($curl, CURLOPT_HTTPHEADER, $curlheader);

	$json_response = curl_exec($curl);
	curl_close($curl);
		
	$responseObj = json_decode($json_response);
	return $responseObj;	    
}

	if (isset($_SESSION['accessToken'])){
		$accountObj = call_api($_SESSION['accessToken'],"https://www.google.com/calendar/feeds/default/private/full?start-min=" . $start_date[0]["start_date"] . 
                    "T00:00:00&start-max=" . $end_date[0]["end_date"] . "T23:59:59");
		echo $accountObj;
		
		//echo "<p class='successMessage'>The name on your Google account is: " . $your_name . "</p>";
		//session_unset();
	}
	if(isset($_REQUEST['error'])){
		echo "<p class='errorMessage'>Error: " . $_REQUEST['error'] . "</p>";
	} */

      
