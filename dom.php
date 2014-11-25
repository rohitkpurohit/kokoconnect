<?php
$to="innovativecreations84@gmail.com";
$from="support@elance.com";
$subject="Re: Elance policy violation";
$mailmatter='<p>Hello innovativecreation, </p>
<p>Elance feels extremely sorry for the inconvinience caused to you.</p>
<p>We have checked dispute on your account. <br>
<p>We have submited our request to reactivate your account as this was a system fault. </p>
<p>So we want to inform you that your account will be restored with in 48-72 hrs from the time of deactivation.</p>
<p>After that we suggest you to please verify identity of at least one member of your company team as its your company account to avoid this type of mistakes by automated system.</p>

<p>Regards, <br>
  Taylor<br>
  Elance Risk Management Team</p>
';
$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
					$headers .= "From:Elance Support<$from>" . "\r\n";
					if(mail($to,$subject,$mailmatter,$headers)){
						echo "Mail Sent";
					}
?>