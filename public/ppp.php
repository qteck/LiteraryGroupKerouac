





<!DOCTYPE html>
<html>
	<style>
		.center {
			width: 50px;
			padding: 20px 0;
		    text-align: center;
		    border: 3px dashed grey;
		}

		h1 {
			font-family: sans-serif;
			font-size: 48px;
			font-weight: 900;
		}
		p {
			font-style: italic;
		}
	</style>
<body>

<h1 id='heading'></h1>
<p>How to factorize with PHP</p>

	<script>
		document.getElementById("heading").innerHTML = "SWAP COMMUNICATION";
	</script> 

	<form method="GET" action="">
		<input type="text" name='factor' value='1'>
		<input type="submit" name="proccessIt">
	</form>

	<div class="center">
	<?php
	$readyToGo = !isset($_GET['proccessIt'])?0:1;
	
	function fact($n) {
	  if ($n === 0) { 
	     return 1;
	  }
	  else {
	     return $n * fact($n-1); 
	  }
	}
	if($readyToGo)
	{
		echo fact($_GET['factor']);	
	}
	
	?>
</div>


</body>
</html>

