<?php
include('cfg/cfg.php');

?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $sitename;?> | Signup</title>
		<?php include('login-header.php'); ?>
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><?php echo $sitename;?>-Signup</div>
            <form action="<?php echo $serverpath;?>signupuser" method="post" target="targetframe">
                <div class="body bg-gray"> 
                <div class="alert alert-danger mhidden" id="errormsglogin"></div>
                <div class="alert alert-success mhidden" id="successmsglogin"></div>
                    <div class="form-group">
                        <input type="email" required name="regmail" id="regmail" class="form-control" placeholder="Email you want to register" />
                    </div>
                    <div class="form-group">
                        <input type="password" required name="regpass" id="regpass" class="form-control" placeholder="Password"/>
                    </div>          
                  <div class="form-group">
                        <input type="password" required name="cpass" id="cpass" class="form-control" placeholder="Confirm Password"/>
                    </div>

                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Register Me</button>  
                    
                </div>
            </form>

            <div class="margin text-center">
                <span>Sign up using Facebook</span>
                <br/>
               <a href="<?php echo $serverpath;?>loginwithfacebook"> <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button></a>
               

            </div>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo $serverpath;?>js/bootstrap.min.js" type="text/javascript"></script>        
<iframe name="targetframe" id="targetframe" class="mhidden"></iframe>
    </body>
</html>