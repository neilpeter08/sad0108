
<?php

	 if(isset($_POST['regShirt'])){
	 
	 $prodId = filter_input(INPUT_POST, 'prodId');
	 $prodName = filter_input(INPUT_POST, 'prodName');
	 $prodType = filter_input(INPUT_POST, 'prodType');
	 $designName = filter_input(INPUT_POST, 'designName');
	 $textile = filter_input(INPUT_POST, 'textile');
	 $color = filter_input(INPUT_POST, 'color');
	 $specification = filter_input(INPUT_POST, 'specification');
	 $reversible = filter_input(INPUT_POST, 'reversible');
	 $type = filter_input(INPUT_POST, 'shirtType');
	 $font = filter_input(INPUT_POST, 'font');
	 $sizes = isset($_POST['sizes'])?implode(',', $_POST['sizes']):'';
	 $price = filter_input(INPUT_POST, 'price');

	 if($_FILES['attachment']['name']==''){
    //file not selected
	 	
	 	$selected = false;

	} else{
		    //file selected
		if(file_exists($_FILES['attachment']['tmp_name'])){
			$imgFile = file_get_contents($_FILES['attachment']['tmp_name']);
	 		$imgType = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
	 		$selected = true;
		}
	 	
	}
	 
	

	 include_once	'db.php';

	 if(!empty($prodId) && !empty($prodName) && !empty($prodType) && !empty($designName) && !empty($textile) && !empty($color) && !empty($specification) && !empty($reversible) && !empty($type) && !empty($font) && !empty($sizes) &&  !empty($price) && $selected){
	 		
	 	try {
		    
		    $stmt = $dbc->prepare("INSERT INTO products VALUES(
	 		:prodId,
	 		:prodName,
	 		:prodType,
	 		:designName,
	 		:textile,
	 		:color,
	 		:specification,
	 		:reversible,
	 		:type,
	 		:font,
	 		:sizes,
	 		:price,
	 		:img,
	 		:imgType
	 	)");
	 	$stmt->execute(array(
	 		':prodId'=>$prodId,
	 		':prodName'=>$prodName,
	 		':prodType'=>$prodType,
	 		':designName'=>$designName,
	 		':textile'=>$textile,
	 		':color'=>$color,
	 		':specification'=>$specification,
	 		':reversible'=>$reversible,
	 		':type'=>$type,
	 		':font'=>$font,
	 		':sizes'=>$sizes,
	 		':price'=>$price,
	 		':img'=>$imgFile,
	 		'imgType'=>$imgType
	 	));
		}
		catch(Exception $e) {
		    echo 'Exception -> ';
		    var_dump($e->getMessage());
		}

	 	
		 
		 $res = "Product Successfully Added!";
		 $prodId = '';
		 $prodName = '';
		 $prodType = '';
		 $designName = '';
		 $textile = '';
		 $color = '';
		 $specification = '';
		 $reversible = '';
		 $type = '';
		 $font = '';
		 $sizes = '';
		 $price = '';
	 }else{
	 	if(!$selected){
	 		$res = "No file selected!";
	 	}else{
	 		$res = "Please complete all fields!";
	 	}
	 	

	 	
	 }
	 echo $res;
	 }
	 
	 

?>

				
					<form method="post" enctype="multipart/form-data">
					<input type="file" name="attachment"><br>
					<label for="prodId">Product Id:</label>
					<input type="text" readonly name="prodId" value="<?php 

						include_once 'db.php';
						$stmt = $dbc->prepare("SELECT * FROM products");
						$stmt->execute();
						$res = $stmt->rowCount();
						echo   'PD' . str_pad($res+1, 3, "0", STR_PAD_LEFT);

					 ?>"><br>
					<label for="prodName">Product Name:</label>
					<input type="text" name="prodName" value="<?php if(isset($prodName)){echo $prodName;}?>"><br>
					<label for="prodType">Product Type:</label>
					<div class="block">
					<input type="radio" name="prodType" value="Basketball Jersey" <?php if(isset($_POST['prodType']) && $_POST['prodType']=='Basketball Jersey'){ echo ' checked="checked"'; } ?>>Basketball Jersey<br>
					<input type="radio" name="prodType" value="Volleyball Uniform" <?php if(isset($_POST['prodType']) && $_POST['prodType']=='Volleyball Uniform'){ echo ' checked="checked"'; } ?>>Volleyball Uniform<br>
					<input type="radio" name="prodType" value="Badminton Uniform" <?php if(isset($_POST['prodType']) && $_POST['prodType']=='Badminton Uniform'){ echo ' checked="checked"'; } ?>>Badminton Uniform<br>
					<input type="radio" name="prodType" value="Varsity Jacket" <?php if(isset($_POST['prodType']) && $_POST['prodType']=='Varsity Jacket'){ echo ' checked="checked"'; } ?>>Varsity Jacket<br>
					<input type="radio" name="prodType" value="Sublimation" <?php if(isset($_POST['prodType']) && $_POST['prodType']=='Sublimation'){ echo ' checked="checked"'; } ?>>Sublimation
					</div>
					<br>
					<label for="designName">Design Name:</label>
					<input type="text" name="designName" value="<?php if(isset($designName)){echo $designName;}?>"><br>
					<label for="textile">Textile:</label>
					<input type="text" name="textile" value="<?php if(isset($textile)){echo $textile;}?>"><br>
					<label for="color">Color:</label>
					<input type="text" name="color" value="<?php if(isset($color)){echo $color;}?>">
					<label for="specification">Specification:</label>
					<input type="text" name="specification" value="<?php if(isset($specification)){echo $specification;}?>"><br>
					<label for="reversible">Reversible:</label>
					<div class="block">
					<input type="radio" name="reversible" value="Yes" <?php if(isset($_POST['reversible']) && $_POST['reversible']=='Yes'){ echo ' checked="checked"'; } ?>>Yes<br>
					<input type="radio" name="reversible" value="No" <?php if(isset($_POST['reversible']) && $_POST['reversible']=='No'){ echo ' checked="checked"'; } ?>>No<br>
					</div>
					<label for="type">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type:</label>
					
					<div class="block">
					<input type="radio" name="shirtType" value="Tacketwill" <?php if(isset($_POST['shirtType']) && $_POST['shirtType']=='Tacketwill'){ echo ' checked="checked"'; } ?>>Tacketwill<br>
					<input type="radio" name="shirtType" value="Printed" <?php if(isset($_POST['shirtType']) && $_POST['shirtType']=='Printed'){ echo ' checked="checked"'; } ?>>Printed<br>
					</div>
					<br><br>
					<label for="font">Font:</label>
					<div class="block">
					<input type="radio" name="font" value="Collegiate" <?php if(isset($_POST['font']) && $_POST['font']=='Collegiate'){ echo ' checked="checked"'; } ?>>Collegiate<br>
					<input type="radio" name="font" value="Old English" <?php if(isset($_POST['font']) && $_POST['font']=='Old English'){ echo ' checked="checked"'; } ?>>Old English<br>
					<input type="radio" name="font" value="Academic m54" <?php if(isset($_POST['font']) && $_POST['font']=='Academic m54'){ echo ' checked="checked"'; } ?>>Academic m54<br>
					<input type="radio" name="font" value="Dollie Script" <?php if(isset($_POST['font']) && $_POST['font']=='Dollie Script'){ echo ' checked="checked"'; } ?>>Dollie Script<br>
					<input type="radio" name="font" value="Motor" <?php if(isset($_POST['font']) && $_POST['font']=='Motor'){ echo ' checked="checked"'; } ?>>Motor<br>
					<input type="radio" name="font" value="Remachine Script" <?php if(isset($_POST['font']) && $_POST['font']=='Remachine Script'){ echo ' checked="checked"'; } ?>>Remachine Script<br>
					<input type="radio" name="font" value="Birds of Paradise" <?php if(isset($_POST['font']) && $_POST['font']=='Birds of Paradise'){ echo ' checked="checked"'; } ?>>Birds of Paradise<br>
					<input type="radio" name="font" value="Death Maach" <?php if(isset($_POST['font']) && $_POST['font']=='Death Maach'){ echo ' checked="checked"'; } ?>>Death Maach<br>
					<input type="radio" name="font" value="Jersey m54" <?php if(isset($_POST['font']) && $_POST['font']=='Jersey m54'){ echo ' checked="checked"'; } ?>>Jersey m54<br>
					<input type="radio" name="font" value="SF Collegiate" <?php if(isset($_POST['font']) && $_POST['font']=='SF Collegiate'){ echo ' checked="checked"'; } ?>>SF Collegiate<br>
					</div>
					<br><br><br>
					<label for="sizes">Available Sizes:</label>
					<div class="block">
					<input type="checkbox" name="sizes[]" value="XS">XS&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="sizes[]" value="L">L&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="sizes[]" value="3XL">3XL<br>
					<input type="checkbox" name="sizes[]" value="S">S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="sizes[]" value="XL">XL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="sizes[]" value="4XL">4XL<br>
					<input type="checkbox" name="sizes[]" value="M">M&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="sizes[]" value="2XL">2XL&nbsp;&nbsp;&nbsp;
					<input type="checkbox" name="sizes[]" value="5XL">5XL<br><br>
					</div>
					<br>
					<label for="price">Price:</label>
					<input type="text" name="price" value="<?php if(isset($price)){echo $price;}?>">
					<br><br>
					<input type="submit" name="regShirt" id="regShirt" value="Add Product">
					</form>