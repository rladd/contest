<?

function showBoolean($value)
{
    $returnValue = "No";

    if ($value == 1) { $returnValue = "Yes"; }
    else { $returnValue = "No"; }

    return $returnValue;
}

function sendEmail($arrConfigEmail, $arrResults)
{
	// Define the subject and headers
	$headers = "From: " . $arrConfigEmail['emailFrom']. "\r\n";
	$headers.= "Reply-To: " . $arrConfigEmail['emailFrom']. "\r\n";
	
	// Define the message to be sent.
    $message = "Trail Website - Contest Results / Submission \r\n";
	$message.= "\r\n\r\n";

    // Build the email message / body
    foreach ($arrResults as $key => $value)
    {
        $message .= $arrResults[$key]['title'] . ": " . $arrResults[$key]['value'] . "\r\n";
    }

    // For each defined email recipient -> build and send the message
    foreach ($arrConfigEmail['emailTo'] as $recipient)
    {
        // Send the email
        $mail_sent = @mail( $recipient, $arrConfigEmail['subject'], $message, $headers );
        #print("Boink - email was sent! Email: " . $recipient . "<br/>\r\n");
    }

	//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
	#echo $mail_sent ? "Mail sent" : "Mail failed";

}


?>
