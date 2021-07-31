<?php 
	include('path.php');
	include(ROOT_PATH . '/app/controllers/users.php');

	$title = 'Sign In';
?>
<!DOCTYPE html>
<html lang="en">
<?php include(ROOT_PATH . '/app/includes/link_dash_top.php'); ?>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
						<img src="<?php echo LOGO;?>" alt="" class="img-fluid mb-4">
						<h4 class="mb-3 f-w-400">Signin</h4>
						<?php include(ROOT_PATH . '/app/includes/message.php'); ?>
						<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<div class="input-group mb-1">
							<div class="input-group-prepend">
								<span class="input-group-text"><i data-feather="mail"></i></span>
							</div>
							<input type="email" value="<?php echo $email; ?>" name="email" class="form-control" placeholder="Email address">
						</div>
							<small class="badge badge-light-danger "><?php echo $errors['em']; ?></small>
							<small class="badge badge-light-danger "><?php echo $errors['emm']; ?></small>
						<div class="input-group mt-4 mb-1">
							<div class="input-group-prepend">
								<span class="input-group-text"><i data-feather="lock"></i></span>
							</div>
							<input type="password" value="<?php echo $password; ?>" name="password" class="form-control" placeholder="Password">
						</div>
							<small class="badge badge-light-danger "><?php echo $errors['pr']; ?></small>
							<small class="badge badge-light-danger "><?php echo $errors['pri']; ?></small>
							<small class="badge badge-light-danger "><?php echo $errors['psl']; ?></small>
						<div class="form-group text-left mt-2">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input input-primary" id="customCheckdefh2" checked="">
								<label class="custom-control-label" for="customCheckdefh2">Save credentials</label>
							</div>
						</div>
						<button class="btn btn-block btn-primary mb-4" name="signin">Signin</button>
</form>
						<p class="mb-0 text-muted">Forgot your password? Click to Reset <a href="<?php echo BASE_URL . '/forget/'?>" class="f-w-400">Recover</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->
<?php include(ROOT_PATH . '/app/includes/link_dash_bottom.php'); ?>

</body>

</html>
