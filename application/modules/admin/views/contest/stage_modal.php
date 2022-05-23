<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#targetModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="stage_name" class="col-sm-2 col-form-label">場名:</label>
          <div class="col-sm-10">
            <input v-model="contest.stage.name" type="text" class="form-control">
          </div>
        </div> 
        <div class="form-group row">
          <label for="steel" class="col-sm-2 col-form-label">鐵靶數:</label>
          <div class="col-sm-2">
            <input v-model="contest.stage.steel" type="text" class="form-control">
          </div>
        </div> 
        <div class="form-group row">
          <label for="hostage" class="col-sm-2 col-form-label">人質數:</label>
          <div class="col-sm-2">
            <input v-model="contest.stage.hostage" type="text" class="form-control">
          </div>
        </div> 
        <div class="form-group row" v-for="(target, idx) in contest.stage.targets" :key="idx">
          <label for="targets" class="col-sm-2 col-form-label">靶位{{idx+1}}:</label>
          <div class="col-sm-2">
            <input v-model="contest.stage.targets[idx]" type="text" class="form-control">
          </div>
          <div class="col-sm-2">
            <i class="fa fa-trash"></i>
          </div>
        </div> 
        <div class="col-sm-6 text-center">
          <button type="button" class="btn btn-default" @click="target_add()">Add Target</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click="stage_update()">Update</button>
        <button type="button" class="btn btn-primary" @click="stage_add()">Add</button>
      </div>
    </div>
  </div>
</div>