<?php
echo json_encode($stage);
echo '<br>';
echo json_encode($contest);
echo '<br>';

?>

<div class="container-fluid">
	<div class="row text-center">
		<h3 id="contest_title"><?=$contest->title_zh?></h3>
		<h3>場境設置 (<?=isset($stage)?'修改':'新增'?>)</h3>
	</div>
	<div class="col-md-4">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">設置</h3>
			</div>
			<div class="box-body">
				<?php echo $form->open(); ?>
				<input type="hidden" name="stage_id" value="<?=isset($stage)?$stage->id:''?>">
				<div class="form-group">
					<label for="stage_name" class="col-xs-4">場名:</label>
					<div class="col-xs-8">
						<input type="text" name="stage_name" value="<?=isset($stage)?$stage->name_zh:''?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="metal" class="col-xs-4">鐵靶數:</label>
					<div class="col-xs-8">
						<input type="number" name="metal" value="<?=isset($stage)?$stage->metal:''?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="no_shoot" class="col-xs-4">人質:</label>
					<div class="col-xs-8">
						<input type="number" name="no_shoot" value="<?=isset($stage)?$stage->no_shoot:''?>" class="form-control">
					</div>
				</div>
				<div id="targets">
					<?php
					if(isset($stage->targets)){
						foreach(explode(',', $stage->targets) as $i=>$target){
						?>
							<div class="form-group">
								<label for="target" class="col-xs-4">靶位<?=($i+1)?>:</label>
								<div class="col-xs-7">
									<input type="text" name="target[]" value="<?=$target?>" class="form-control">
								</div>
								<div class="col-xs-1 operation">
									
								</div>
							</div>

						<?php
						}
					}
					?>

				</div>
				<div class="form-group text-center">
					<button type="button" id="btn_add_arget">增加靶位</button>
				</div>
				<?php echo $form->bs3_submit('保存'); ?>
				<a class="btn btn-default" href="contest/">返回主頁</a>
				<?php if(isset($stage)){
					echo '<a class="btn btn-danger" href="#" data-href="contest/stage_delete/<?=$stage->id?>" data-toggle="modal" data-target="#confirm-delete">刪除</a>';
				}?>
				
				<?php echo $form->close(); ?>
			</div>
		</div>
	</div>
</div>

<div id="target_tmpl" style="display:none">
	<div class="form-group">
		<label for="target" class="col-xs-4">靶位1:</label>
		<div class="col-xs-7">
			<input type="text" name="target[]" value="" class="form-control">
		</div>
		<div class="col-xs-1 operation">
			
		</div>
	</div>
</div>



<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                是否確定刪除?
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>

$('#confirm-delete').on('show.bs.modal', function(e) {
	$(this).find(".modal-body").html($("#contest_title").html());
	$(this).find(".modal-body").append('<br>'+$("select[name='group_id'] option:selected").html());
	$(this).find(".modal-body").append('<br>'+$("input[name='stage_name']").val());
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});




if($("#targets .form-group").length==0){
	target=$("#target_tmpl").clone();
	target.find("label").text("靶位1");
	$("#targets").append(target.html());
}
$("#btn_add_arget").click(function(){
	$(".operation").empty();
	btn_trash='<a class="delete_target"><i class="fa fa-trash"></i></a>';
	cnt=$("#targets .form-group").length+1;
	target=$("#target_tmpl").clone();
	target.find("label").text("靶位"+cnt);
	target.find(".operation").append(btn_trash);
	$("#targets").append(target.html());
})
$(".delete_target").click(function(){
	$(this).closest(".form-group").remove();
})
</script>
<style>
.delete_target{
	color:red;
}	
</style>