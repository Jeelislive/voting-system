<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<link
			rel="stylesheet"
			href="signup.css"
		/>
		<title>Voting Portal | Signup</title>
	</head>

	<body>
		<div class="wrapper">
			<div class="title"><span>Signup Form</span></div>
			<?php if (isset($_GET['signup-error'])): ?>
				<div class="error-message" style="color: red; text-align: center; margin-top: 15px; font-size: 18px;">
					Invalid credentials. Please try again.
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
						placeholder="Enter Your Name"
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
						placeholder="Create password"
						required
					/>
				</div>

				<div class="form--row">
					<input
						type="password"
						name="password2"
						placeholder="Confirm password"
						required
					/>
				</div>

				<div class="form--row">
					<input
						type="text"
						name="address"
						placeholder="Enter Your Address"
						required
					/>
				</div>

				<div class="form--row">
					<input
						type="url"
						name="image_link"
						placeholder="Enter Image Link (Optional)"
						value=""
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
							Select Your Role
						</option>
						<option value="voter">Voter</option>
						<option value="party">Party</option>
					</select>
				</div>

				<div class="form--policy">
					<input
						type="checkbox"
						id="accept-policy"
						name="accept-policy"
						required
					/>
					<label for="accept-policy">I accept all terms & conditions</label>
				</div>

				<div class="form--row form--submit-button">
					<input
						type="submit"
						name="submit"
						value="Register"
					/>
				</div>
			</form>

			<div class="form--switch-auth">
				Already a Voter? <a href="login.php">Login to Vote </a>
			</div>
		</div>
	</body>
</html>
