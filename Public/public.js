

        /***全选和取消****/
		/**  
         * 1. 给标题栏的checkbox绑定事件  
         * 2. 获取标题栏的checkbox的值  
         * 3. 给标题栏下边的checkbox设置值  
         */  
         function allcheackbox(allid){
         	//alert(allid);
        	//全选时选中所有input框
            var isChecked = $("#"+allid).prop("checked");  
            $("#tb_"+allid+" input").prop("checked", isChecked);                
        
         }
        

        /**  
         * 1. 给标题栏下边的checkbox绑定事件  
         * 2. 获取到标题栏下边的checkbox的总数量  
         * 3. 获取标题栏下边的checkbox中选中的数量  
         * 4. 判断这两个数量，如果相等，就让标题栏的选中  
         */  
        function checkbox(tdid){
        	var allLength = $("#tb_"+tdid+" input").length; 
            var checkedLength = $("#tb_"+tdid+" input:checked").length;  
            //alert(allLength);
            if(allLength == checkedLength){  
                $("#"+tdid).prop("checked",true); 
            }else {  
                $("#"+tdid).prop("checked",false);  
            }
        }

        /*******js时间格式函数*******/
        function alltime(now){
            //获取用户的当前时间
            var up_time =new Date(parseInt(now) * 1000).getUTCFullYear();
            var up_month=(new Date(parseInt(now) * 1000).getUTCMonth()+1);
                if(up_month<10){
                    up_month="0"+up_month;
                }
            var up_day=new Date(parseInt(now) * 1000).getUTCDate();
                if(up_day<10){
                    up_day="0"+up_day;
                }
            var str_time=up_time+"-"+up_month+"-"+up_day;
            return str_time;
        }

    /*-----  点击显示article  -----*/
        function articleShow(article_name){ 
            var a='.'+article_name; 
            $("#blog_content article").hide();
            $(a).slideDown().show();
        }


    /*----- KindEditor  -----*/
        KindEditor.ready(function(K){
            window.editor = K.create('#ke_content',{
                cssPath: 'kindeditor/plugins/code/prettify.css', 
                allowFileManager: true, 
                resizeType:1 ,
                allowPreviewEmotions : true,
            });
        });


        $(function(){   
                
        /*----- 弹 出 框 -----*/
            $('#mana_page').popover();
            $('#mana_tag').popover();

        /*----- aside 添加    active  ------*/
            $(".aside a").click(function(){
                $(".aside a").removeClass('active');
                $(this).addClass('active');
            })

        /*-----  article show  ------*/
            $("#mana_center").click(function() { articleShow("mana_center_a"); });
            $("#new_blog").click(function() {   articleShow("new_blog_a"); });
            $("#mana_blog").click(function() {  articleShow("mana_blog_a"); });
            $("#mana_comment").click(function() {   articleShow("mana_comment_a"); });
            $("#mana_classify").click(function() {  articleShow("mana_classify_a"); });
            $("#mana_user").click(function() {  articleShow("mana_user_a"); });
        });

