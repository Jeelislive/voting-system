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
			href="forgotPassword.css"
		/>
		<title>Voting Portal | Login</title>
	</head>

	<body>
		<div class="wrapper">
			<div class="title"><span>Login Form</span></div>
            <?php if (isset($_GET['forgot-error'])): ?>
                <div class="error-message" style="color: red; text-align: center; margin-top: 15px; font-size: 18px;">
                    Invalid credentials
                </div>
            <?php endif; ?>

			<form
				class="form"
				method="POST"
				action="auth.php"
			>
				<div class="form--row">
					<input
						type="text"
						name="name"
						placeholder="Enter Name"
						required
					/>
				</div>

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
						name="password1"
						placeholder="Enter New Password"
						required
					/>
				</div>

				<div class="form--row">
					<input
						type="password"
						name="password2"
						placeholder="Confirm Password"
						required
					/>
				</div>

				<div class="form--row form--submit-button">
					<input
						type="submit"
						name="submit"
						value="Reset"
					/>
				</div>
			</form>

			<div class="form--switch-auth">
				Remembered your password? <a href="login.php">Back to Login</a>
			</div>
		</div>
	</body>
</html>
