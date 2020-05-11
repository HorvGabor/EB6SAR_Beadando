<?php 
require_once PROTECTED_DIR.'userManager.php';
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
	$postData = [
		'fname' => $_POST['first_name'],
		'lname' => $_POST['last_name'],
		'email' => $_POST['email'],
		'password' => $_POST['password'],
		'password1' => $_POST['password1']
	];

	if(empty($postData['fname']) || empty($postData['lname']) || empty($postData['email']) || empty($postData['password']) || empty($postData['password1'])) {
		echo "Hiányzó adat(ok)!";
	} else if(!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
		echo "Hibás email formátum!";
	} else if ($postData['password'] != $postData['password1']) {
		echo "A jelszavak nem egyeznek!";
	} else if(strlen($postData['password']) < 6) {
		echo "A jelszó túl rövid! Legalább 6 karakter hosszúnak kell lennie!";
	} else if(!UserRegister($postData['email'], $postData['password'], $postData['fname'], $postData['lname'])) {
		echo "Sikertelen regisztráció!";
	}

	$postData['password'] = $postData['password1'] = "";
}
?>

<form method="post">
<center>
	<div class="form-group">
		<div class="form-group col-md-4">
			<label for="registerFirstName">First Name</label>
			<input type="text" class="form-control" id="registerFirstName" name="first_name" value="<?=isset($postData) ? $postData['fname'] : "";?>">
		</div>
		<div class="form-group col-md-4">
			<label for="registerLastName">Last Name</label>
			<input type="text" class="form-control" id="registerLastName" name="last_name" value="<?=isset($postData) ? $postData['lname'] : "";?>">
		</div>
	</div>

	<div class="form-group">
		<div class="form-group col-md-4">
			<label for="registerEmail">Email</label>
			<input type="email" class="form-control" id="registerEmail" name="email" value="<?=isset($postData) ? $postData['email'] : "";?>">
		</div>
	</div>

	<div class="form-group">
		<div class="form-group col-md-4">
			<label for="registerPassword">Password</label>
			<input type="password" class="form-control" id="registerPassword" name="password" value="">
		</div>
		<div class="form-group col-md-4">
			<label for="registerPassword1">Confirm Password</label>
			<input type="password" class="form-control" id="registerPassword1" name="password1" value="">
		</div>
	</div>

	<button type="submit" class="btn btn-primary" name="register">Register</button>
</center>
</form>
