   
	/*******6、分类管理的编辑开始*/
		/*拟态框中的编辑开始*/
			//提交更改  
		function class_edit(row,editid) {  
		    var cid=editid;
		    //在表格中提取数据
		    var fname= document.getElementById("classtable").rows[(row+1)].cells[1].innerText;
		    //向模态框传值
		    //alert(cid);
		    $("#fname").val(fname);
		    $("#cid").val(cid);

		}
		
		$("#classup").click(function(){
			var fname=$("#fname").val();
			var path=$("#fid").val();
			var c_id=$("#cid").val();
			if(path!=0){
			var ares=path.split(",");
		    var f_id=ares[1];
		    var path=$("#fid").val()+","+c_id;
		    //alert(f_id)
			}else{
			var f_id=0;
			var path="0,"+c_id;
			//alert(path);
			}
			
			$.ajax({
				type:"post",
				url:"classup",
				data:{"c_id":c_id,"f_id":f_id,"f_name":fname,"path":path},
				success:function(date){
					alert('修改成功！正在跳转');
					window.location.reload();
				}

			});
		})
		 /*6.拟态框添加分类开始*/
		function addCla(){
			var addfuname1=$('#addfuname').val();
			var addfuid1=$('#addfuid').val();
			//alert(addfuname1);
			$.ajax({
		        type:"post",
		        url:"addClass",
		        data:{"addfuname":addfuname1,"addfuid":addfuid1},
		        success:function(add){
		        	//alert(add[0]['c_id']);
		           var str="";
		        	   str+="<tr>";
					   str+="<td class='text-center'>"+add[0]['c_id']+"</td>";
					   str+="<td class='text-center'>"+add[0]['f_name']+"</td>";
					   str+="<td class='text-center'>"+add[0]['f_id']+"</td>";

					   str+="<td class='text-center'>"+alltime(add[0]['add_time'])+"</td>";
					   //alert(add[0]['level']);
					       var addlevel="";
						   switch(add[0]['level']){
						   	case "1":
						   	 addlevel+="一级分类";
						   	 break;
						   	case "2":
						   	 addlevel+="二级分类";
						   	 break;
						   	 case "3":
						   	 addlevel+="三级分类";
						   	 break;
						   }
					   str+="<td class='text-center'>"+addlevel+"</td>";
					   str+="<td class='text-center'>";
					   str+="<button class='icon-edit btn btn-primary' data-toggle='modal' data-target='#edit_classify'>编辑</button>";
					   str+="<button class='icon-trash btn btn-danger'>删除</button>";
					   str+="</td>";
					   str+="</tr>";
					$("#classtable").append(str);						
		        }
			});
		}

		function classdel(del){
            if(confirm('确定要删除该数据？')){
               $.ajax({
               	type:"post",
               	url:"classdel",
               	data:{"c_id":del},
               	success:function(){
               		window.location.reload();
               	}
               });
            }else{
            	window.event.returnValue=false;
            }
		}
