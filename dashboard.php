<?php
	session_start();

	// Set the MySQL port to 3307
	$conn = new mysqli("127.0.0.1", "root", "", "voting_portal", 3307);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$userMobile = $_SESSION['mobile'];

	$userStmt = $conn->prepare("SELECT name, mobile, address, has_voted, image_link FROM users WHERE mobile = ?");
	$userStmt->bind_param("s", $userMobile);
	$userStmt->execute();
	$userResult = $userStmt->get_result();

	if ($userResult->num_rows === 1) {
		$user = $userResult->fetch_assoc();
		$userStatus = $user['has_voted'] ? 'Voted' : 'Not Voted';
		$userName = $user['name'];
		$userMobile = $user['mobile'];
		$userAddress = $user['address'];
		$userImageLink = $user['image_link'] ?: 'https://i.pravatar.cc/100';
	} else {
		$userName = $userMobile = $userAddress = $userImageLink = 'N/A';
		$userStatus = 'Unknown';
	}

	$partyStmt = $conn->prepare("SELECT name, mobile FROM users WHERE role = 'party'");
	$partyStmt->execute();
	$partyResult = $partyStmt->get_result();

	$parties = [];

	while ($party = $partyResult->fetch_assoc()) {
		$parties[] = $party;
	}

	if (isset($_POST['vote'])) {
		$updateStmt = $conn->prepare("UPDATE users SET has_voted = 1 WHERE mobile = ?");
		$updateStmt->bind_param("s", $userMobile);
		$updateStmt->execute();
		header("Location: dashboard.php");
		exit();
	}
?>
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
			href="dashboard.css"
		/>
		<title>Voting Portal | Dashboard</title>
	</head>

	<body>
		<header>
			<h1>Empower Your Vote</h1>
			<form action="auth.php" method="POST">
				<input type="hidden" name="submit" value="Logout">
				<button type="submit">Logout</button>
			</form>
		</header>

		<main>
			<div class="user-data">
				<div class="user-img">
					<img src="<?php echo $userImageLink; ?>" alt="<?php echo $userName; ?>" />
				</div>

				<div class="user-details">
					<p>Name: <span><?php echo htmlspecialchars($userName); ?></span></p>
					<p>Mobile: <span><?php echo htmlspecialchars($userMobile); ?></span></p>
					<p>Address: <span><?php echo htmlspecialchars($userAddress); ?></span></p>
					<p>Status: <span style="font-weight: 600; color: <?php echo $userStatus === 'Voted' ? '#4caf50' : 'red'; ?>;"><?php echo htmlspecialchars($userStatus); ?></span></p>
				</div>
			</div>

			<div class="available-parties">
				<ul class="parties-list">
					<?php foreach ($parties as $party): ?>
						<li class="party">
							<div class="party-details">
								<p>Name: <span><?php echo htmlspecialchars($party['name']); ?></span></p>
								<p>Contact: <span><?php echo htmlspecialchars($party['mobile']); ?></span></p>
								<form action="dashboard.php" method="POST">
									<button type="submit" name="vote" <?php echo $userStatus === 'Voted' ? 'disabled' : ''; ?>>
										<?php echo $userStatus === 'Voted' ? 'Voted' : 'Vote'; ?>
									</button>
								</form>
							</div>

							<div class="party-img">
								<img src="https://i.pravatar.cc/100" alt="<?php echo htmlspecialchars($party['name']); ?>" />
							</div>
						</li>
						<hr />
					<?php endforeach; ?>
				</ul>
			</div>
		</main>
	</body>
</html>
<?php
	$conn->close();
?>
