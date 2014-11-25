<?php
ini_set('display_errors',0);
ini_set('magic_quotes_gpc',1);
ini_set("session.cookie_httponly", 1);
session_start();
$_SESSION['generated'] = time();
$GLOBALS['debug_sql'] = array();
$sitedef = $_SERVER[ 'SERVER_NAME'];
$twitterlink="#";
$fblink="#";
$instagramlink="#";
$pintlink="#";

if ("localhost" == $sitedef || $sitedef=="192.168.1.3")
{
	$__dbhost = "localhost";
	$__dbname = "dbkokoconnect";
	$__dbuser = "root";
	$__dbpass = "deep";
	define( 'HTTP_ROOT', '/' );
	define( 'DEBUG', false );
	$serverpath = "http://".$_SERVER['HTTP_HOST']."/kokoconnect/";
	define( 'SERVERPATH', $serverpath );
	$adminpath = $serverpath."xadmin/";
	define( 'ADMINPATH', $adminpath );
	$upload_path=$_SERVER['DOCUMENT_ROOT']."kokoconnect/uploads/";
	setcookie("serverpath",$serverpath);
	$sitename="KokoConnect";
	$currency="USD";
	$fbappId="1506631419620938";
	$fbappsecret="ef783f5749f0b2490a164faa119a07f8";
}
if ("kokoconnect.innovativecreation.co.in" == $sitedef )
{
	 $__dbhost = "182.50.133.174";
	 $__dbname = "dbbetterapp";
	 $__dbuser = "dbbetterapp";
	$__dbpass = "Better@123";
	define( 'HTTP_ROOT', '/' );
	define( 'DEBUG', false );
	$serverpath = "http://".$_SERVER['HTTP_HOST']."/";
	define( 'SERVERPATH', $serverpath );
	$adminpath = $serverpath."xadmin/";
	define( 'ADMINPATH', $adminpath );
	$upload_path=$_SERVER['DOCUMENT_ROOT']."/uploads/";
	setcookie("serverpath",$serverpath);
	$sitename="KokoConnect";
	$sitename="KokoConnect";
	$currency="USD";
	$fbappId="1506631419620938";
	$fbappsecret="ef783f5749f0b2490a164faa119a07f8";
}

db_connect();
// base functions to follow this line ###################################################################
function db_connect() {

	$srv = $GLOBALS['__dbhost'];
	$unm = $GLOBALS['__dbuser'];
	$pwd = $GLOBALS['__dbpass'];
	$db  = $GLOBALS['__dbname'];
	$GLOBALS['db_con'] = mysqli_connect($srv,$unm,$pwd,$db);
	return is_object($GLOBALS['db_con']);
}

function db_query($sql='',$type=0)
{
	if (!is_object($GLOBALS['db_con']) || $sql == '')
	 {
		die('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Server Maintenance</title>
			</head>
			<body style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:14px;">
			The server is currently under maintenance.<br /><br />
			Please check back later.
			</body>
			</html>
		');
		exit;
	  } 
	else
		{
			$result = mysqli_query($GLOBALS['db_con'],$sql);
			if (eregi('^insert.*',$sql) || eregi('^update.*',$sql) || eregi('^delete.*',$sql)) 
			{
				$num_rows = mysqli_affected_rows($GLOBALS['db_con']);
			} 
			else
			{
				$num_rows = mysqli_num_rows($result);
			}
			if ($type == 0 || $type == 4)
			{  // return results & num of rows
				if ($num_rows)
				{
					if ($type == 0)
					{
						while ($row = mysqli_fetch_array($result))
						{
							if (count($row) > 1)
							{
								$rows[] = $row;
							}
							else
							{
								$rows[] = $row[0];
							}
						}
					 }
					 else
					 {
						while ($row = mysqli_fetch_row($result))
						{
							if (count($row) > 1)
							{
								$rows[] = $row;
							}
							else
							{
								$rows[] = $row[0];
							}
						}
					}
					$return_val = array(0=>true,'rows'=>$rows,'count'=>$num_rows);
				 }
				else
				{
					$return_val = array(0=>false,'count'=>0);
				}
			 }
			 elseif ($type == 1)
			 {  // return num of rows
				$return_val = $num_rows;
			 }
			 elseif ($type == 3)
			 {  // return last_insert_id
				$return_val = mysqli_insert_id($GLOBALS['db_con']);
			 } 
			 elseif($type==5)
			 {
				 $return_val=mysqli_affected_rows($GLOBALS['db_con']);
			 }
			 else
			 {
				$return_val = $num_rows;
			 }
			 // clean up my result set, eh?
			 @mysqli_free_result($result);
		}
	if (mysqli_error($GLOBALS['db_con']))
	{
		// there was an error, add it to the global array
		$GLOBALS['debug_sql'][] = array('PROBLEM SQL',$sql,mysqli_error($GLOBALS['db_con']));
	}
	return $return_val;
}
function db_close() {
        return mysqli_close($GLOBALS['db_con']);
}
function mysql_res($string='')
{
	// shorthand mysql_real_escape_string
	return mysqli_real_escape_string($GLOBALS['db_con'],$string);
}
function encrypt_str($str){
	$str=md5(md5(md5(md5($str))));
return $str;
}
function filter_text($str)
{
	$str=ltrim(rtrim($str));
	$str=strip_tags($str);
	$str=addslashes($str);
	

	return $str;
}
function filter_rich_text($str)
{
	$str=addslashes(ltrim(rtrim($str)));
	return $str;
}
function get_user_Info($userId)
{
$query="select * from exp_users where md5(md5(md5(md5(userId))))='$userId'";	
$sql=@db_query($query);
if($sql['count']>0)
{
return $sql['rows']['0'];	
}
}

function validate_email($email){
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
  	{
		  return "notok";
  	}
}

function send_my_mail($to,$from,$subject,$mailmatter)
{
	$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
					$headers .= "From:$from" . "\r\n";
					$mail=mail($to,$subject,$mailmatter,$headers);	
}
function get_countries()
{
	$query="select * from koko_countries order by countryname";
	$sql=@db_query($query);
	if($sql['count']>0)
	{
		return $sql;
	}
}
?>