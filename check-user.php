<?php
include('cfg/cfg.php');
$email=filter_text($_POST['loginmail']);
$password=filter_text($_POST['loginpass']);

if($email && $password)
{

	if(validate_email($email)=="notok")
	{
		
		?>
		<script type="text/javascript">
		window.parent.document.getElementById("errormsglogin").innerHTML="Invalid email.";
		window.parent.document.getElementById("errormsglogin").style.display="block";
		</script>
		<?php
		die();
	}
	
	$userpass=encrypt_str($password);
	$checkQuery="select * from koko_users where usermail='$email' and usertype <> 'a'";
	$checkSql=@db_query($checkQuery);
	if($checkSql['count']>0)
	{
		$_SESSION['buId']=encrypt_str($checkSql['rows']['0']['userId']);
		?>
		<script type="text/javascript">
		window.parent.location="<?=$serverpath;?>dashboard";
		</script>
		<?php
		
	}
	else
	{
		?>
		<script type="text/javascript">
		window.parent.document.getElementById("errormsglogin").innerHTML="<i class='fa fa-ban'></i> Invalid email/password.";
		window.parent.document.getElementById("errormsglogin").style.display="block";
		</script>
		<?php
		die();
	}
	
}
?>