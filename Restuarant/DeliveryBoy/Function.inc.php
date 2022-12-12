<?php
	function pre($arr){
		echo '<pre>';
		print_r($arr);
	}
	
	function prx($arr){
		echo '<prx>';
		print_r($arr);
		die();
	}
	//replacement od header function of PHP, we using JS for redirection of pages to avoid error
	function redirect($link){
		?>
		<script>
		window.location.href='<?php echo $link?>';
		</script>
		<?php
		die();
	}

	function generateRandomString($length = 6) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}





?>