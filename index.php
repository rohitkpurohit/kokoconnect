<?php
include('cfg/cfg.php');

?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $sitename;?> | Log in</title>
		<?php include('login-header.php'); ?>
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><?php echo $sitename;?>-Login</div>
            <form action="<?php echo $serverpath;?>checkLogin" method="post">
                <div class="body bg-gray"> 
                <div class="alert alert-danger mhidden" id="errormsglogin"></div>
                    <div class="form-group">
                        <input type="email" name="loginmail" id="loginmail" class="form-control" placeholder="Your Registered Email" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="loginpass" id="loginpass" class="form-control" placeholder="Password"/>
                    </div>          
                  
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
                    <p>Not Registered, <a href="<?php echo $serverpath;?>register">Register Here</a></p>
                    
                    	
                </div>
            </form>

            <div class="margin text-center">
                <span>Sign in using Facebook</span>
                <br/>
               <a href="<?php echo $serverpath;?>loginwithfacebook"> <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button></a>
               

            </div>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $serverpath;?>js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>