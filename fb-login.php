<?php
include("cfg/cfg.php");
include('sdk/facebook.php');
	$config = array(
			'appId' => $fbappId,
			'secret' => $fbappsecret,
			'cookie' => true
		  );


   $facebook=new Facebook($config);
   if(isset($_GET['state']))
		  {
			   try{
				 $userInfo=$facebook->api('/me/');
				 $username=$userInfo['username'];
				 $username=$userInfo['username'];
				 $userId=$userInfo['id'];
					if(!$username)
					{
						$username=$userId;
					}
				 $fName=$userInfo['first_name'];
				 $mName=$userInfo['middle_name'];
				 $lName=$userInfo['last_name'];
				 $gender=$userInfo['gender'];
				 if($gender=="male")
				 {
					 $gender="m";
				 }
				 else
				 {
					 $gender="f";
				 }
				 $email=$userInfo['email'];
				$checkquery="select * from koko_users where fbId='$userId' or usermail='$email'";
				$checksql=@db_query($checkquery);
				if($checksql['count']>0)
				{
					
						if($checksql['rows']['0']['fbId'] != $userId)
						{
								$updQuery="update koko_users set fbId='$userId' where userId=".$checksql['rows']['0']['userId'];
								$updSql=@db_query($updQuery);
						}
						$_SESSION['buId']=$checksql['rows']['0']['userId'];
						?>
							<script type="text/javascript">
								window.location="<?=$serverpath;?>dashboard";
								</script>
						<?php
					
					
				}
				else
				{
					$insert_query="insert into koko_users(usermail,fbId,usertype)";
					$insert_query.="values('$email','$userId','u')";
					$insert_sql=@db_query($insert_query,3);
					if($insert_sql)
					{
						$f_name=$fName." ".$mName;
						$insert_query2="insert into koko_userprofile(userId)";
						$insert_query2.="values($insert_sql)";
						$insert_sql2=@db_query($insert_query2);
						$_SESSION['buId']=encrypt_str($insert_sql);
						?>
						<script type="text/javascript">
						
						window.location="<?=$serverpath;?>dashboard";
						</script>
						<?php
					}
				}
				
				
				
			 }
			 catch (FacebookApiException $e) {
			$login_url = $facebook->getLoginUrl(array('scope' => 'email','redirect_uri' => $serverpath."loginwithfacebook"));
	?>
<script type="text/javascript">
	window.location="<?php echo $login_url;?>";
	</script>
<?php
	 
  }
		  }
		  else
		  {
			  $login_url = $facebook->getLoginUrl(array(
                       'scope' => 'email',
					   'redirect_uri' => $serverpath."loginwithfacebook",
					    ));
	?>
<script type="text/javascript">
	window.location="<?php echo $login_url;?>";
	</script>
<?php						
		  }
?>