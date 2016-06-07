<?php 
include 'includes/header.php';
?>
<form action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="login-form">
	<label for="user">Username: </label><input type="text" name="user"/><br><br>
	<label for="password">Password: </label><input type="password" name="password"/><br><br>
	<input type="submit" name="submit" value="Login" class="login-btn">
</form>

<?php 

include 'config.php';

if(isset($_POST['submit'])){
	if(!empty($_POST['user'])&& !empty($_POST['password'])){
		$userSet = addslashes(trim($_POST['user']));
		$passwordSet = addslashes(trim($_POST['password']));
		if($userSet == $user && $passwordSet == $password){
			session_start();
			$_SESSION['username'] = $user;
			header("Location: admin.php");
		}
		else
			echo '<div class="error">Username or password is incorect</div>';
	}
	else
		echo '<div class="error">Username or password is incorect</div>';
}
?>