<?php
$surname = "";
$email = "";
$passwd = "";
$address = "";
$state = -1;
$sex = "";

if (isset($_POST['surname'])) $surname = $_POST['surname'];
if (isset($_POST['email'])) $email = $_POST['email'];
if (isset($_POST['passwd'])) $passwd = $_POST['passwd'];
if (isset($_POST['address'])) $address = $_POST['address'];
if (isset($_POST['state'])) $state = $_POST['state'];
if (isset($_POST['sex'])) $sex = $_POST['sex'];
?>
<style>
	body { background-color: #d9d9ff; font-family: Arial; }
	label { float: left; width: 120px; text-align: right; margin-right: 10px; }
	.field { clear: both; margin-bottom: 5px; }
</style>
<h1>Register</h1>
<fieldset>
<legend>Person Details</legend>
<form name="myForm" action="form.php" method="POST">
	<div class="field">
		<label for="surname">Surname</label>
		<input type="text" name="surname" size="31" value="<?php echo $surname; ?>"/>
	</div>
	<div class="field">
		<label for="email">Email address</label>
		<input type="text" name="email" size="31" value="<?php echo $email; ?>"/>
	</div>
	<div class="field">
		<label for="passwd">Password</label>
		<input type="password" name="passwd" size="31" value="<?php echo $passwd; ?>"/>
	</div>
	<div class="field">
		<label for="address">Street Address</label>
		<textarea name="address" rows="3" cols="22"><?php echo $address; ?></textarea>
	</div>
	<div class="field">
		<label for="state">State</label>
		<select name="state">
			<option value="-1" <?php if ($state == -1) echo "selected"; ?>>[choose your state]</option>
			<option value="1" <?php if ($state == 1) echo "selected"; ?>>Australian Capital Territory</option>
			<option value="2" <?php if ($state == 2) echo "selected"; ?>>Queensland</option>
			<option value="3" <?php if ($state == 3) echo "selected"; ?>>Victoria</option>
			<option value="4" <?php if ($state == 4) echo "selected"; ?>>New South Wales</option>
			<option value="5" <?php if ($state == 5) echo "selected"; ?>>Tasmania</option>
			<option value="6" <?php if ($state == 6) echo "selected"; ?>>South Australia</option>
			<option value="7" <?php if ($state == 7) echo "selected"; ?>>Western Australia</option>
			<option value="8" <?php if ($state == 8) echo "selected"; ?>>Northern Territory</option>
		</select>
	</div>
	<div class="field">
		<input type="hidden" name="country" value="Australia">
	</div>
	<div class="field">
		<label for="sex">Gender</label>
		<input type="radio" name="sex" value="male" <?php if ($sex == "male") echo "checked"; ?>/>Male
		<input type="radio" name="sex" value="female" <?php if ($sex == "female") echo "checked"; ?>/>Female
	</div>
	<div class="field">
		<label for="vegetarian">Vegetarian?</label>
		<input type="checkbox" name="vegetarian" <?php if (isset($_POST['vegetarian'])) echo "checked"; ?> />
	</div>
	<div class="field">
		<label>&nbsp;</label>
		<input type="submit" value="Submit" name="submit" /><input type="reset" value="Reset" name="reset" />
	</div>
</form>
</fieldset>
