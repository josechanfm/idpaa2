<div class="form-group">
	<label for="categiries">categories</label>
	<div class="checkbox-group" v-for="(category, key, index) in contest.categories" :key="index">
		{{category}}
		<div class="checkbox-item">
			<input v-model="category.value" type="checkbox" name="categiries">{{category.name}}
		</div>
	</div>
</div> 
<div class="form-group">
	<label for="stages">stages</label>
	<div class="checkbox-group">
		<div class="checkbox-item">
			<input type="checkbox" name="stages" value="1">stage1
		</div>
	</div>
</div> 

<div class="row">
	<ul>
		<li>
			<input type="checkbox">
		</li>
	</ul>
</div>
<div class="row">
	<a @click="add_category" class="btn btn-success">Add Category</a>
	<a @click="add_stage" class="btn btn-success">Add Stage</a>
	<div class="col-md-12">
		<div class="card card-outline card-danger" v-for="(category, category_id) in contest.categories">
			<div class="card-header">
				<h3 class="card-title">
					<input v-model="category.name">
				</h3>
			</div>
			<div class="card-body">
				<ul>
					<li v-for="(stage, stage_id) in contest.stages" :key="stage_id">
						<input 
							type="checkbox"
							:class="'category_id_'+category_id"
							:checked="in_stage(category_id,stage_id)"
							:value="stage_id"
							@change="stage_change($event, category_id, stage_id)"/>
						{{stage_id}}
						<input v-model="stage.name">
					</li>
				</ul>
			</div>
		</div>

	</div>
</div>
	


