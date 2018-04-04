    /*-----	8、用户管理 删除  -----*/
		function del(uid){ 
			if(confirm("确认要删除？")){ 
			//alert(uid);
			$(this).click(function(){
				$.post("del",{id:uid},function(){
					top.location.reload();
					});
				});
		      
			} else{
				window.event.returnValue = false;
				}
		} 


    /*8.拟态框中的用户管理的编辑开始*/
	    //提交更改  
		function update() {  
		    //获取模态框数据  
		    var str=$('#hidden').val();
		    //定义一数组
		    var strs= new Array(); 
		    //字符分割，分割出id
		        strs=str.split("_"); 
		    //id的值  
		    var id=strs[1];
		    //gro的gid
		    var stuno = $('#stuno').val();  
		    //用户的密码
		    var pass = $('#pass').val();
		    //用户名  
		    var name = $('#name').val();  
				  // alert(stuno);
			$.ajax({
				type:"post",
				url:"update",
				data:{"idd":id , "stunoo":stuno , "passs": pass , "namee":name},
				//ajax成功后返回的数据
			  success:function(data){
				      //alert(data);
			    // data的值是json字符串，这行把字符串转成object  
			    var json = eval("("+data+")");
			    //移除Id为Result的表格里的行，从第二行开始（这里根据页面布局不同页变） 
			    $("#tr_"+json.id).remove();
			    //更新编辑后的表格以及值
			    var str ="";
			        str+="<tr id='tr_"+json.id+"'>";
					str+="<td class='text-center' >"+json.id+"</td>";
					str+="<td class='text-center' >"+json.name+"</td>";
					str+="<td class='text-center' >"+json.user+"</td>";
					str+="<td class='text-center' >"+json.pwd+"</td>";
					str+="<td class='text-center' >"+alltime(json.cretime)+"</td>";
					str+="<td class='text-center'>";
					str+="<button class='icon-edit btn btn-primary' data-toggle='modal' data-target='#edit_user' onclick='editInfo('tr_"+json.id+"')'> 编辑</button>";
					str+="<button onclick='return del("+json.id+")' class='icon-trash btn btn-danger'>删除</button>";
				   str+="</td></tr>";
				//将返回的数据追加到表格
			    $("#table").append(str);
			  }
			});
		} 


    /****8.分页代码开始***/ 
		//触发模态框的同时调用此方法  
		function up_offset(off){
			var offset=off;
			//alert(offset);
		  $.ajax({
		    	type:"post",
		    	url:"up_page",
		    	data:{"page":offset},
		  //ajax成功的时候返回
		      success:function(off){
			      $("#table td").remove();
			      //循环遍历返回的对象
			    for(var i = 0; i < off.length; i++){
		           //返回的id
		       	    var strId=off[i]['id'];
		            var str ="";
		                str+="<tr id='tr_"+strId+"'>";
						str+="<td class='text-center' >"+strId+"</td>";
						str+="<td class='text-center' >"+off[i]['name']+"</td>";
						str+="<td class='text-center' >"+off[i]['user']+"</td>";
						str+="<td class='text-center' >"+off[i]['pwd']+"</td>";
						str+="<td class='text-center' >"+alltime(off[i]['cretime'])+"</td>";
						str+="<td class='text-center'>";
						str+="<button class='icon-edit btn btn-primary' data-toggle='modal' data-target='#edit_user' onclick=editInfo('tr_"+strId+"')> 编辑</button>";
						str+="<button onclick='return del("+strId+")' class='icon-trash btn btn-danger'>删除</button>";
					   str+="</td></tr>";
			         $("#table").append(str);
			           //alert(tr_"+off[i]['id']+"')');
		        }
		      }
		   });
		}


    /*8.back页面编辑*/
		function editInfo(obj) {  
		    var id =obj;
		       // alert(id);
		    //获取表格中的一行数据  
		    var pass = document.getElementById("table").rows[id].cells[3].innerText;  
		    var name = document.getElementById("table").rows[id].cells[2].innerText;  
		       //alert(name);
		    //向模态框中传值  
		    $('#pass').val(pass);  
		    $('#name').val(name);
		    $('#hidden').val(id);  
		    $('.modal fade').modal('show');  
		} 


    /*8.添加用户开始*/
		function useradd(){
			var str=$('#stuname').val();
			var adduser = $('#add_name').val();
			var addpwd = $('#add_pwd').val();
			
			$.ajax({
		    	type:"post",
		    	url:"useradd",
		    	data:{"sel_gro":str,"add_user":adduser,"add_pwd":addpwd},
		    	success:function(){
		    	 /*window.reload(); */
					window.location.reload();
		    	}
		    });
		} 
