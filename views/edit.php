<?php include('_header.php'); ?>
<h2 id="edit-header" class="coloured-banner3 text-center">Επεξεργασία προφίλ</h2>

<?php
$user_name = $_SESSION["user_name"];
$user_email = $_SESSION["user_email"];
$priv = "user";
if (isset($_POST["user_edit"])) {
	$post_user = $_POST["user_name"];
	// clarity comment: an admin that edits his own profile $priv stays with user value
	if(strcmp($post_user, $user_name) !==0 && $login->isUserAdmin()){
		$user_name = $_POST["user_name"];
		$user_email = $_POST["user_email"];
		$priv = "admin";
	}
}
?>
<!-- clean separation of HTML and PHP -->
<!-- <h2> Edit credentials for user <?php echo $user_name; ?> </h2>-->

<div id="edit-forms" class="container-fluid push-down">
	<div class="row">
    	<div class="col-md-12">
			<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
			<form method="post" name="user_edit_form_name">
				<div class="form-group">
					<label for="user_name">New Username</label>
				</div>
				<div class="form-group">
					<input id="user_name" type="text" class="form-control" name="user_name" pattern="[a-zA-Z0-9]{2,64}" placeholder='<?php echo $user_name; ?>' required />
					<input type="hidden" name="user_name_old" value="<?php echo $user_name; ?>">		
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" name="user_edit_submit_name" value="Change username" />
				</div>
			</form><hr/>

			<!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
			<form method="post" name="user_edit_form_email">
				<div class="form-group">
					<label for="user_email">New email: </label>
				</div>
				<div class="form-group">
					<input id="user_email" type="email" class="form-control" name="user_email" placeholder='<?php echo $user_email; ?>' required />
					<input type="hidden" name="user_email_old" value="<?php echo $user_email; ?>">		
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" name="user_edit_submit_email" value="Change email " />
				</div>
			</form><hr/>
<?php
if ($priv == 'user')
{
?>
			<!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
			<form method="post" name="user_edit_form_password">
				<div class="form-group">
					<label for="user_password_old">Old Password: </label>
					<input id="user_password_old" class="form-control" type="password" name="user_password_old" autocomplete="off" />
				</div>
				<div class="form-group">
					<label for="user_password_new">New Password: </label>
					<input id="user_password_new" class="form-control" type="password" name="user_password_new" autocomplete="off" />
				</div>
				<div class="form-group">
					<label for="user_password_repeat">New Password: </label>
					<input id="user_password_repeat" class="form-control" type="password" name="user_password_repeat" autocomplete="off" />
				</div>
				<div class="form-group">
				<input type="submit" class="btn btn-primary" name="user_edit_submit_password" value="Change Password" />
				</div>
			</form><hr/>
<?php
}
?>
		</div>
	</div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="views/js/bootstrap.min.js"></script>
</body>
</html>
