<ol>
<?php
foreach($shooters as $shooter){
	echo '<li>'.$shooter->name;
	if(!$shooter->is_member){
		echo "&nbsp;<button class='set_member' data-id='{$shooter->id}/1'>會員</a>";
	}
	echo '</li>';
}
?>　
</ol>

<script>
$(function(){
	$("body").on("click",".set_member",function(){
		$.post("shooter/is_member/"+$(this).data("id"),function(data){
		})
	})
})

</script>