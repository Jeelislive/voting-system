<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<link
			rel="stylesheet"
			href="login.css"
		/>
		<title>Voting Portal | Login</title>
	</head>

	<body>
		<div class="wrapper">
			<div class="title"><span>Login Form</span></div>
			<?php if (isset($_GET['login-error'])): ?>
				<div class="error-message" style="color: red; text-align: center; margin-top: 15px; font-size: 18px;">
					Invalid credentials
				</div>
			<?php endif; ?>
			<?php if (isset($_GET['signup-success'])): ?>
				<div class="success-message" style="color: green; text-align: center; margin-top: 15px; font-size: 18px;">
					Signup Successful! You can now log in.
				</div>
			<?php endif; ?>
			<?php if (isset($_GET['password-reset'])): ?>
				<div class="success-message" style="color: green; text-align: center; margin-top: 15px; font-size: 18px;">
					Password reset successfully.
				</div>
			<?php endif; ?>


			<form
				class="form"
				method="POST"
				action="auth.php"
			>
				<div class="form--row">
					<input
						type="number"
						name="mobile"
						placeholder="Enter Mobile No."
						required
					/>
				</div>

				<div class="form--row">
					<input
						type="password"
						name="password"
						placeholder="Enter Password"
						required
					/>
				</div>

				<div class="form--row">
					<select
						name="role"
						required
					>
						<option
							value=""
							disabled
							selected
						>
							Select Role
						</option>
						<option value="voter">Voter</option>
						<option value="party">Party</option>
					</select>
				</div>

				<div class="form--forgot-password"><a href="forgotPassword.php">Forgot password?</a></div>

				<div class="form--row form--submit-button">
					<input
						type="submit"
						name="submit"
						value="Login"
					/>
				</div>
			</form>

			<div class="form--switch-auth">
				New to Voting? <a href="signup.php">Register to Vote</a>
			</div>
		</div>
	</body>
</html>
