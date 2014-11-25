<?php
include('cfg/cfg.php');
$regmail=filter_text($_POST['regmail']);
$regpass=filter_text($_POST['regpass']);
$cpass=filter_text($_POST['cpass']);

if($cpass ==$regpass)
{
	if(validate_email($regmail)=="notok")
	{
		?>
		<script type="text/javascript">
		window.parent.document.getElementById("errormsglogin").innerHTML="Invalid email.";
		window.parent.document.getElementById("errormsglogin").style.display="block";
		</script>
		<?php
		die();
	}
	else
	{
		$checkQuery="select * from koko_users where usermail='$regmail'";
		$checkSql=@db_query($checkQuery);
		if($checkSql['count']>0)
		{
			?>
		<script type="text/javascript">
		window.parent.document.getElementById("errormsglogin").innerHTML="Email already registerd.";
		window.parent.document.getElementById("errormsglogin").style.display="block";
		</script>
		<?php
		die();
		}
		else
		{
		$regpass=encrypt_str($regpass);
		$insertQuery="insert into koko_users(usermail,userpass,usertype)values('$regmail','$regpass','u')";
		$insertSql=@db_query($insertQuery,3);
		if($insertSql)
		{
			$mailmatter="<p>Thank you for joining $sitename!</p>
									<p>Could you please click the link below to verify that this is your email address?</p>
							<p><a href='".$serverpath."confirmuser/".encrypt_str($insertSql)."'>Click Here To Activate Your Account</a></p>
									<p><strong>$sitename</strong></p>";
									$mail=send_my_mail($regmail,"admin@kokoconnect.com","Please Activate your $sitename account.",$mailmatter);
		?>
		<script type="text/javascript">
		window.parent.document.getElementById("successmsglogin").innerHTML="Congrats , your account is registerd.Please check your mailbox for activation link.";
		window.parent.document.getElementById("successmsglogin").style.display="block";
		</script>
		<?php
		die();
		}
		}
	}
}
else
{
	?>
		<script type="text/javascript">
		window.parent.document.getElementById("errormsglogin").innerHTML="Password and confirm password must be same.";
		window.parent.document.getElementById("errormsglogin").style.display="block";
		</script>
		<?php
		die();
}
?>