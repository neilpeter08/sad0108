
				<?php

				

				?>
				<div class="main">
					<a href="#" class="m-btn-grey grey-btn">request a demo</a>
					<section class="cols">
						<div class="cl">&nbsp;</div>
					</section>
					<section class="cnus">
					<center>
					<h1>Your Order Summary</h1>
					</center>
					<?php

						include_once 'db.php';
						
						$stmt = $dbc->prepare("SELECT account_id from accounts WHERE username = :user");
						$stmt->execute(array(':user'=>$_SESSION['activeclient']));
						$res = $stmt->fetch(PDO::FETCH_ASSOC);
						$id = $res['account_id'];
						$stmt = $dbc->prepare("SELECT * from users WHERE account_id = :id");
						$stmt->execute(array(':id'=>$id));
						$res = $stmt->fetch(PDO::FETCH_ASSOC);
						$name = $res['first_name'] . " " . $res['last_name'];
						$add = $res['address'];
						$email = $res['email'];
						$cnum = $res['contact_num'];
						$date = date('M d, Y');
						

					?>
					<Br><br><br>
					<span>Name:</span><?php echo $name ?>
					<span style="float:right;">Date: <?php echo $date ?> </span><br>
					<span>Address:</span><?php echo $add ?><br>
					<span>Contact Number:</span><?php echo $cnum ?><br>
					<span>Email:</span><?php echo $email ?><br><br>
					<div class="summaryContent">
					<h3 style="display:inline">Description:</h3>
					<h3 style="float:right;">Amount:</h3>
					<?php
							
							$inner = $_SESSION['inner'];
							$outer = $_SESSION['outer'];
							$tname = $_SESSION['tname'];
							$fPos = $_SESSION['fPos'];
							$cfType =$_SESSION['cfType'];
							$pName = $_SESSION['pName'];
							$textile = $_SESSION['textile'];
							$logoPosition =$_SESSION['logoPosition'];
							$sizes =$_SESSION['sizes'];
							$quantity =$_SESSION['quantity'];
				
						










							
	
							echo "<h5>Inner: $inner</h5>";
							echo "<h5>Outer: $outer</h5>";
							echo "<h5>Team Name: $tname</h5>";
							echo "<h5>Position: $fPos</h5>";
							echo "<h5>Font Type: $cfType</h5>";
							echo "<h5>Player Name Position: $pName</h5>";
							echo "<h5>Textile: $textile</h5>";
							echo "<h5>Logo Position: $logoPosition</h5>";
							echo "<h5>Sizes: $sizes</h5>";
							echo "<h5>Quantity: $quantity</h5>";
							
							$total = 1000 * $quantity;
						

						echo "<h3 class='topdown'>Total Amount: " . $total .  "</h3>"
					?>
					

					</div><br><br>
					<form name="_xclick" id="_customPay" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="stargamesportswear@yahoo.com">
	<input type="hidden" name="currency_code" value="PHP">
	<input type="hidden" name="item_name" value="shirt">
	<input type="hidden" id='payPrice' name="amount" value="<?php echo $total ?>">
	
	</form>
			<input type="button" id="btnCustomSummary" class="login" value="Finish">
					
					
					</section>
				</div>
				
				<!-- end of main -->
				