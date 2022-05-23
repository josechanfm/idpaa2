

<div id="main">
	<?php echo $form->messages(); ?>
	<div class="row">
		<div class="col-md-6">
			<div class="card box-primary">
				<div class="card-header">
					<h3 class="card-title">User Info</h3>
				</div>
				<div class="card-body">
					<form action="/idpaa2/admin/contest/create" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
						<div class="form-group">
							<label for="title" v-html="lang('title_zh')"></label>
							<input v-model="contest.title_zh" type="text" name="title" id="title" class="form-control" required>
						</div> 
						<div class="form-group">
							<label for="date">Date</label>
							<div class="input-group">
								<div class="input-group-text">
									<i class="fa fa-calendar"></i>
								</div>
								<input v-model="contest.date" type="text" name="date" id="date" class="form-control">
							</div>
						</div> 
						<div class="form-group">
							<label for="description">description</label>
							<br><textarea v-model="contest.description" name="description" cols="40" rows="10" id="description" class="texteditor form-control" style="width: 100%;"></textarea>
						</div>
						<div class="col-sm-12">
							<ul class="nav flex-column">
								<li class="nav-item" v-for="(stage, idx) in contest.stages" :key="stage">
									<i class="fa fa-trash pull-right" @click="stage_trash(idx)"></i>
									<i class="fa fa-edit pull-right" @click="stage_edit(idx)"></i>
									Name: {{stage.name}}</br>
									Steel: {{stage.steel}}</br>
									hostage: {{stage.hostage}}</br>
									Targets {{stage.targets}}</br>
								</li>
							</ul>
						</div>
						<button type="button" @click="create_contest" v-if="contest.id==''">Create Contest</button>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add Stage</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card box-primary">
				<div class="card-header">
					<h3 class="card-title">User Info</h3>
				</div>
				<div class="card-body">
					<form id="form2" action="/idpaa2/admin/contest/save_categories" method="post">
						<div class="row" id="contest_setup" v-if="contest.id==''">
							<div class="col-md-12">
								<a @click="category_add()" class="btn btn-success">Add Category</a>
								<a @click="stage_add()" class="btn btn-success">Add Stage</a>
									{{contest.categories}}
							</div>
							<div class="col-md-12">
								<ul class="nav flex-column">
									<li class="nav-item" v-for="(category, category_id) in contest.categories" :key="category_id"	>
										<div class="form-group">
											<label for="categiries">categories</label>
											<div class="checkbox-group">
												<div class="checkbox-item">
													<input v-model="category.name" type="text">
												</div>
											</div>
										</div> 
										<ul class="nav flex-column">
											<li class="nav-item" v-for="(stage, stage_id) in contest.stages" :key="stage_id">
												<input 
													type="checkbox"
													:class="'category_id_'+category_id"
													:checked="in_stage(category_id,stage_id)"
													:value="stage_id"
													@change="stage_change($event, category_id, stage_id)"/>
												<input v-model="stage.name">

											</li>
										</ul>
									</li>
								</ul>
							</div>
						<button type="button" @click="categories_save">Save categories</button>
						<input type="submit">
						</div>
					</form>
				</div>
			</div>

		</div>
		
	</div>	
	<?php $this->load->view('stage_modal');?>

</div>


<script>
$(document).ready(function() {
});
$(function(){
	$("#date").datepicker({
		dateFormat:"yy-mm-dd",
		onSelect:function(){
			app.contest.date=$(this).val();
		}
	})
})
</script>

