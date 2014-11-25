<?php
include('cfg/cfg.php');
$userId=filter_text($_GET['userId']);
$checkQuery="select * from koko_users where md5(md5(md5(md5(userId))))='$userId'";

$checkSql=@db_query($checkQuery);
if($checkSql['count']>0)
{
}
else
{
	?>
	<script type="text/javascript">
	window.location="<?php echo $serverpath;?>";
	</script>
	<?php
}
?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $sitename;?> | Activate account</title>
		<?php include('login-header.php'); ?>
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><?php echo $sitename;?>-Activate account</div>
            <form action="<?php echo $serverpath;?>activateaccount" method="post" enctype="multipart/form-data">
            <input type="hidden" name="userId" id="userId" value="<?php echo $checkSql['rows']['0']['userId'];?>" />
                <div class="body bg-gray"> 
                <div class="alert alert-danger mhidden" id="errormsglogin"></div>
                <div class="alert alert-success mhidden" id="successmsglogin"></div>
                 <div class="form-group">
                        <input type="username" required name="username" id="username" class="form-control" placeholder="Desired Username" />
                    </div>
                    <div class="form-group">
                        <input type="fname" required name="fname" id="fname" class="form-control" placeholder="First Name" />
                    </div>
                    <div class="form-group">
                        <input type="lname" required name="lname" id="lname" class="form-control" placeholder="Last Name"/>
                    </div>          
                  <div class="form-group">
                        <select name="country" id="country" class="form-control" placeholder="Country">
                        	<option value="0">Your Country</option>
                            <?php $countries=get_countries();
							for($i=0;$i<$countries['count'];$i++)
							{
								?>
								<option value="<?php echo $countries['rows'][$i]['id'];?>"><?php echo $countries['rows'][$i]['countryname'];?></option>
								<?php
							}
							?>
                        </select>
                    </div>
					<div class="form-group">
                    <label for="profileimage">Your Profile Image</label>
					<input type="file" name="profileimage" id="profileimage" />
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Activate My Account</button>  
                    
                </div>
            </form>

           
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $serverpath;?>js/bootstrap.min.js" type="text/javascript"></script>        
<iframe name="targetframe" id="targetframe" class="mhidden"></iframe>
    </body>
</html>