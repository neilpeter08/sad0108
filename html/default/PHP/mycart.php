
<?php

	include_once   '../db.php';

	session_start();
	if(isset($_SESSION['cart'])){

	$id = $_SESSION['cart']['prodID'];
	$quantity = $_SESSION['cart']['quantity'];
	
	
	for ($i=0; $i < count($id); $i++) { 
		$stmt = $dbc->prepare("SELECT * FROM products WHERE prod_id = :id");
		$stmt->execute(array(':id'=>$id[$i]));
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		$img = '<img src="data:image/$imgType;base64,' . base64_encode( $res['prod_img'] ) . '" width=100 height=100 align="left" />';
		$name = $res['prod_name'];
		$price = $res['price'];
		$prodID = $res['prod_id'];
		echo "<div class='box' id=$i>";
    	echo '<div class="close_box">X</div>';
    	$total = $quantity[$i] * $price;
    		echo $img;
    		echo "<h2 id='prodID'>$prodID</h2>";
    		echo "<h2 id='prodName'>$name</h2>";
    		echo "<div id='prodPrice'>$price</div>";
    		echo "<input type='text' id='prodQuantity' value=$quantity[$i]>";
    		echo "<div id='prodTotal'>$total</div>";

		echo '</div>';
	}
	echo'
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="7LMBZ8ZN2AXM2">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>';

	}else{
		echo "<h2>You dont have any orders!</h2>";
	}
?>

