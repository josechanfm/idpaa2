<h3>Score</h3>

<?php
echo json_encode($contest);
echo '<br>';
echo json_encode($categories);
echo '<br>';
echo json_encode($stages);
echo '<br>';
?>

<div class="container">
	<div class="row text-center">
		<h3><?=$contest->name_zh;?></h3>
		<h4>計分	</h4>
	</div>
	<hr>
	<div class="row">
	</div>
	<hr>
</div>