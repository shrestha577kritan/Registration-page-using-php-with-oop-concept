<?php


// set default values 
$name = '';
$email = '';
$password = '';

if(count($_POST) > 0){
  require('user.php');
  require('database.php');
  $User = new User();
	$errors = $User->signup($_POST);

  if(count($errors) == 0){
    header('location:users_Profile.php');
    die();

  }

  extract($_POST);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <link rel="stylesheet" href="css/style.css" class="src">
</head>
<body>

<div class="registration-form">
 <form method="post" class="form">
    <?php if(isset($errors) && is_array($errors) && count($errors) > 0):?>
			<div class="error">
				<?php foreach($errors as $error):?>
				<?=$error?><br>
				<?php endforeach;?>
			</div>
		<?php endif;?>
 
		<h1>Create an account</h1>
    <p>Name</p>
		<input class="textbox" type="text" name="name" placeholder="Enter your name" value="<?=$name?>"  autocomplete="off" >

    <p>Email Address</p>
		<input class="textbox" type="email" name="email" placeholder="Enter your email" value="<?=$email?>"  autocomplete="off">

    <p>Password</p>
		<input class="textbox" type="password" name="password" placeholder=" Enter your password" value="<?=$password?>"  autocomplete="off">

    <h5>You agree to our terms and condition & privacy policies</h5>
    <div class="btn">
    <input type="submit" value="Signup">
     </div>
     
	</form>

</div>
 







 

  
</body>
</html>
