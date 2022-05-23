var app=new Vue({
	el:"#main",
	data:{
		contest:{
			id:'',
			title_zh:'',
			date:'',
			description:'',
			categories:[],
			stages:[{
				'name':'aaa',
				'steel':0,
				'hostage':0,
				'targets':[2,2],
			},{
				'name':'aaa',
				'steel':0,
				'hostage':0,
				'targets':[2,2],
			}],
			stage:{
				'name':'aaa',
				'steel':0,
				'hostage':0,
				'targets':[],
			},
			editing_stage:null,
		},
		errors:[],
		message:"Hello world!",
		products:[],
		members:[],
		alertMessage:"",
	},
	created(){
		axios.get("demos/vue/get_all_products")
		.then(response=>{
			this.products=response.data
		})
	},
	mounted: function(){
		this.message="hihihi";
		//console.log(this.message);
	},
	methods:{
		stage_edit(idx){
			this.contest.stage=JSON.parse(JSON.stringify(this.contest.stages[idx]));
			this.editing_stage=idx;
			$("#targetModal").modal("show");
			console.log("stage_edit"+idx);
		},
		stage_trash(idx){
			if(confirm("stage_trash")){
				this.contest.stages.slice(idx,1);
				console.log("stage_trash"+idx);	
			}
		},
		stage_update(){
			console.log("update stage"+this.editing_stage);
			this.contest.stages[this.editing_stage]=JSON.parse(JSON.stringify(this.contest.stage));	
			this.editing_stage=null;

		},
		stage_add(){
			this.contest.stages.push(JSON.parse(JSON.stringify(this.contest.stage)));
			
		},
		target_add(){
			this.contest.stage.targets.push(2);
		},
		is_valided(){
			this.errors=[];
			if(this.contest.title_zh==''){
				this.errors.push("title_zh is required");
			}
			if(this.contest.date==''){
				this.errors.push("date is required");
			}
			return this.errors.length<=0;
		},
		create_contest(){
			if(this.is_valided()){
				axios.post('./contest/create_contest',this.contest)
					.then((res)=>{
						this.contest.id=res.data;
					})
				console.log("create contest");
			}else{
				alert(this.errors);
			}
		},
		categories_save(){
			axios.post('./contest/save_categories',this.contest)
				.then((res)=>{
					console.log(res);
				})
		},
		in_stage(categoryId,stageId){
			isChecked=this.contest.categories[categoryId].stage_ids.filter(x=>x==stageId);
			console.log(isChecked)
			return isChecked.length>0;
		},
		category_add(){
			this.contest.categories.push({
				id:'', 
				name:"group"+(this.contest.categories.length+1),
				stage_ids:[],
			});
		},
		// add_stage(){
		// 	//axios.post("./contest/add_stage",this.contest_id)
		// 	this.contest.stages.push({
		// 		id:'',
		// 		name:"stage"+(this.contest.stages.length+1),
		// 		checked:false
		// 	});
		// },
		stage_change(event, categoryId, stageId){
			this.contest.categories[categoryId].stage_ids=Array.from($(".category_id_"+categoryId+":checked"),e=> e.value);
		},
		lang($str){
			return $str;
		}

	},
	watch:{
		alertMessage(){
			alert(this.alertMessage);
		}
	},
	computed:{
		somethingDone:function(){
			return this.alertMessage;
		}
	}
});



