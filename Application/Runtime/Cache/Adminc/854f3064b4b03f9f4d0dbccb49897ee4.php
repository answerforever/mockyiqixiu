<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>移动场景系统后台管理登陆</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="/Public/media/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/media/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/media/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/media/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/media/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/media/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/media/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="/Public/media/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    
    
     
       <link href="/Public/media/css/search.css" rel="stylesheet" type="text/css"/>
     <link href="/Public/media/css/error.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/media/css/invoice.css" rel="stylesheet" type="text/css"/>
    <link href="/Public/media/css/inbox.css" rel="stylesheet" type="text/css"/>
 <link href="/Public/media/css/bootstrap-fileupload.css" rel="stylesheet" type="text/css"/>
 
	<!-- END GLOBAL MANDATORY STYLES -->
	<link rel="shortcut icon" href="/favicon.ico" />
      <script type="text/javascript">
	    function unselectall(thisform){
        if(thisform.chkAll.checked){
            thisform.chkAll.checked = thisform.chkAll.checked&0;
        }   
    }
    function CheckAll(thisform){
        for (var i=0;i<thisform.elements.length;i++){
            var e = thisform.elements[i];
			debugger;
            if (e.name != "chkAll"&&e.disabled!=true){
                e.checked = thisform.chkAll.checked; 
			   if(i==0)alert(e.value);
			}
        }
    }
	 function changeSceneType(type_int){
	   var biztypeId=$('#scenetypeB').val();
	   $.get('?c=scene&a=getSceneTag',{type_int:type_int,biztypeId:biztypeId},function(data){
		    if(data.status==1){
			  $('#scenetypeS').html(data.info);	
			}
		 },'json');
	}
	  </script>      
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="/adminc.php">
				<img src="/Public/media/image/logo.png" alt="logo" />

				</a>

				<!-- END LOGO -->

				<!-- BEGIN HORIZANTAL MENU -->

			  <div class="navbar hor-menu hidden-phone hidden-tablet">
					<div class="navbar-inner">
						<ul class="nav">
							<li class="visible-phone visible-tablet">
								<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
								<form class="sidebar-search">

									<div class="input-box">

										<a href="javascript:;" class="remove"></a>

										<input type="text" placeholder="Search..." />            

										<input type="button" class="submit" value=" " />

									</div>

								</form>

								<!-- END RESPONSIVE QUICK SEARCH FORM -->

							</li>

							<li class="<?php echo ($ui["index"]); ?>">
								<a href="<?php echo U('/index');?>">
								管理首页
								<span class="selected"></span>
								</a>
							</li>
							<li class="<?php echo ($ui["sys_set"]); echo ($ui["sys"]); ?>  <?php echo ($ui["sys_setmail"]); echo ($ui["sys_wxapi"]); ?> <?php echo ($ui["Update"]); ?> <?php echo ($ui["Database"]); echo ($ui["sys_pay"]); ?>">
								<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
								站点设置
								<span class="arrow"></span>     
								</a>
								<ul class="dropdown-menu">
									     	<li class="<?php echo ($ui["sys_set"]); ?>"><a href="<?php echo U('sys/set');?>">网站信息设置</a></li>
    	<li class="<?php echo ($ui["sys_homeset"]); ?>"><a href="<?php echo U('sys/homeset');?>">首页配置</a></li>
    	 <?php if(C('sys_link_arr')): ?> <li class="<?php echo ($ui["sys_scenelink"]); ?>"><a href="<?php echo U('sys/scenelink');?>">相关状态场景</a></li> <?php endif; ?> 
                	<li class="<?php echo ($ui["sys_pay"]); ?>"><a href="<?php echo U('sys/pay');?>">支付配置</a></li>
                    	<li class="<?php echo ($ui["otherlogin"]); ?>"><a href="<?php echo U('sys/otherlogin');?>">第三方登录</a></li>
				<li class="<?php echo ($ui["sys_setmail"]); ?>"><a href="<?php echo U('sys/setmail');?>">邮件服务器</a></li>
				<li class="<?php echo ($ui["sys_wxapi"]); ?>"><a href="<?php echo U('sys/wxapi');?>">SDK分享</a></li>
               
		        <li class="<?php echo ($ui["Update"]); ?>"> <a href="<?php echo U('/Update');?>"> 在线更新</a> </li>
                <li class="<?php echo ($ui["Database"]); ?>"> <a href="<?php echo U('/Database/index/type/export');?>"> 数据备份</a> </li>                  
                   
								</ul>

								<b class="caret-out"></b>                        

							</li>

							<li  class="<?php echo ($ui["useranli"]); ?>">
								<a data-toggle="dropdown" class="dropdown-toggle" href="">案例管理<span class="arrow"></span></a>
                                <ul class="dropdown-menu">
                                    <li class="<?php if(($flag) == "useranli"): echo ($ui["anli_index"]); endif; ?>"> <a  href="<?php echo U('/Scene/index/flag/useranli');?>"> 用户案例管理</a> </li>
                        <li class="<?php if(($flag) == "template"): echo ($ui["anli_index"]); endif; ?>"> <a href="/adminc.php?c=scene&flag=template"> 申请模板案例</a> </li>
                         <li class="<?php if(($flag) == "promotion"): echo ($ui["anli_index"]); endif; ?>"> <a href="/adminc.php?c=scene&flag=promotion"> 申请推荐案例</a> </li>
								</ul>
								<b class="caret-out"></b>         
							</li>

							<li class="<?php echo ($ui["users"]); ?> <?php echo ($ui["users_add"]); ?> <?php echo ($ui["user_group"]); ?>">
								<a data-toggle="dropdown" class="dropdown-toggle" href="">用户管理
								<span class="arrow"></span>
								</a>

								<ul class="dropdown-menu">
               <li class="<?php echo ($ui["users"]); ?>"> <a href="<?php echo U('user/index');?>"> 前台用户管理</a> </li>
		       <li class="<?php echo ($ui["users_add"]); ?>"> <a href="<?php echo U('user/add');?>"> 添加新用户</a> </li>
               <li class="<?php echo ($ui["user_group"]); ?>"> <a href=adminc.php?c=group> 用户组管理</a> </li>
								</ul>
								<b class="caret-out"></b>                        
							</li>
							<li>
								<a href="/adminc.php?c=sys&a=clearcache">清理缓存</a>
							</li>
					<li>
								<a href="/" target="_blank">网站首页</a>
							</li>
							<li>
								<span class="hor-menu-search-form-toggler">&nbsp;</span>
								<div class="search-form hidden-phone hidden-tablet">
									<form class="form-search">
										<div class="input-append">

											<input type="text" placeholder="Search..." class="m-wrap">

											<button type="button" class="btn"></button>

										</div>

									</form>

								</div>

							</li>

						</ul>

					</div>

				</div>

				<!-- END HORIZANTAL MENU -->

				<!-- BEGIN RESPONSIVE MENU TOGGLER -->

				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

				<img src="/Public/media/image/menu-toggler.png" alt=""/>

				</a>          

	       

				<!-- BEGIN TOP NAVIGATION MENU -->              

				<ul class="nav pull-right">

					<!-- BEGIN USER LOGIN DROPDOWN -->

					<li class="dropdown user">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<img alt="" src="assets/images/defaultuser.jpg " style="width:30px;"/>

						<span class="username"><?php echo ($Adminusername); ?></span>

						<i class="icon-angle-down"></i>

						</a>

						<ul class="dropdown-menu">
                        
                         
                    <li> <a href="<?php echo U('sys/admin');?>"> <i class="icon-user"></i>  管理员管理</a> </li>
                 <li> <a href="/adminc.php?c=sys&a=edit&id=<?php echo ($Adminuserid); ?>"><i class="icon-calendar"></i> 修改密码</a> </li>
		        <li > <a href="/adminc.php?c=auth&a=logout"><i class=" icon-share"></i>  退出</a> </li>

						

						</ul>

					</li>

					<!-- END USER LOGIN DROPDOWN -->

			  </ul>

				<!-- END TOP NAVIGATION MENU --> 

			</div>

		</div>

		<!-- END TOP NAVIGATION BAR -->

	</div>

	<!-- END HEADER -->

	<!-- BEGIN CONTAINER -->   

	<div class="page-container row-fluid" >

		<!-- BEGIN HORIZONTAL MENU PAGE SIDEBAR1 -->
		<div class="page-sidebar nav-collapse collapse">
		  <!-- BEGIN SIDEBAR MENU -->
		  <ul class="page-sidebar-menu">
		    <li>
		      <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		      <div class="sidebar-toggler hidden-phone"></div>
		      <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
	        </li>
		    <li>
		      <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
		      <form class="sidebar-search">
		        <div class="input-box"> <a href="javascript:;" class="remove"></a>
		          <input type="text" placeholder="Search..." />
		          <input type="button" class="submit" value=" " />
	            </div>
	          </form>
		      <!-- END RESPONSIVE QUICK SEARCH FORM -->
	        </li>
		    <li class="<?php echo ($ui["index"]); ?>"> <a href="<?php echo U('/index');?>"> <i class="icon-home"></i> 
            <span class="title">管理首页</span> <span class="selected"></span> </a> </li>
  
		    <li class="<?php echo ($ui["sys_set"]); echo ($ui["sys"]); echo ($ui["sys_setmail"]); echo ($ui["sys_wxapi"]); echo ($ui["Update"]); echo ($ui["sys_pay"]); ?>"> 
            <a href="javascript:;"> <i class="icon-cogs"></i> <span class="title">站点设置</span> 
             <span class="selected "></span> </a>
		      <ul class="sub-menu">
              	   	<li class="<?php echo ($ui["sys_set"]); ?>"><a href="<?php echo U('sys/set');?>">网站信息设置</a></li>
    	<li class="<?php echo ($ui["sys_homeset"]); ?>"><a href="<?php echo U('sys/homeset');?>">首页配置</a></li>
    	 <?php if(C('sys_link_arr')): ?> <li class="<?php echo ($ui["sys_scenelink"]); ?>"><a href="<?php echo U('sys/scenelink');?>">相关状态场景</a></li> <?php endif; ?> 
                	<li class="<?php echo ($ui["sys_pay"]); ?>"><a href="<?php echo U('sys/pay');?>">支付配置</a></li>
                    	<li class="<?php echo ($ui["otherlogin"]); ?>"><a href="<?php echo U('sys/otherlogin');?>">第三方登录</a></li>
				<li class="<?php echo ($ui["sys_setmail"]); ?>"><a href="<?php echo U('sys/setmail');?>">邮件服务器</a></li>
				<li class="<?php echo ($ui["sys_wxapi"]); ?>"><a href="<?php echo U('sys/wxapi');?>">SDK分享</a></li>
               
		        <li class="<?php echo ($ui["Update"]); ?>"> <a href="<?php echo U('/Update');?>"> 在线更新</a> </li>
                <li class="<?php echo ($ui["Database"]); ?>"> <a href="<?php echo U('/Database/index/type/export');?>"> 数据备份</a> </li>                   
	          </ul>
			  </li>
    
             <li class="<?php echo ($ui["sys_admin"]); echo ($ui["sys_edit"]); echo ($ui["sys_add"]); ?>"> <a href="javascript:;"> 
             <i class="icon-user"></i> <span class="title">管理员管理</span> 
             <span class="selected "></span> </a>
		      <ul class="sub-menu">
                <li class="<?php echo ($ui["sys_admin"]); ?>"> <a href="<?php echo U('sys/admin');?>"> 管理员管理</a> </li>
                 <li class="<?php echo ($ui["sys_edit"]); ?>"> <a href="/adminc.php?c=sys&a=edit&id=<?php echo ($Adminuserid); ?>"> 修改密码</a> </li>
		        <li class="<?php echo ($ui["sys_add"]); ?>"> <a href="<?php echo U('sys/add');?>"> 添加管理员</a> </li>
		        
		    
	          </ul>
	        </li>
            
		    <li class="<?php echo ($ui["users"]); echo ($ui["users_e"]); echo ($ui["users_add"]); echo ($ui["user_group"]); ?>"> <a href="javascript:;"> 
            <i class="icon-user"></i> <span class="title">用户管理</span> 
            <span class="selected "></span> </a>
		      <ul class="sub-menu">
               <li class="<?php echo ($ui["users"]); ?>"> <a href="<?php echo U('user/index');?>"> 前台用户管理</a> </li>
		       <li class="<?php echo ($ui["users_add"]); ?>"> <a href="<?php echo U('user/add');?>"> 添加新用户</a> </li>
               <li class="<?php echo ($ui["user_group"]); ?>"> <a href=adminc.php?c=group> 用户组管理</a> </li>
			   
			   
	          </ul>
	        </li>
			
			
		    <li class="<?php echo ($ui["scene_anli"]); ?>"> <a href="javascript:;"> 
            <i class="icon-table"></i> <span class="title">用户案例管理</span> 
            <span class="selected "></span> </a>
		      <ul class="sub-menu">
		              <li class="<?php if(($flag) == "useranli"): echo ($ui["anli_index"]); endif; ?>"> <a  href="<?php echo U('/Scene/index/flag/useranli');?>"> 用户案例管理</a> </li>
                        <li class="<?php if(($flag) == "template"): echo ($ui["anli_index"]); endif; ?>"> <a href="/adminc.php?c=scene&flag=template"> 申请模板案例</a> </li>
                         <li class="<?php if(($flag) == "promotion"): echo ($ui["anli_index"]); endif; ?>"> <a href="/adminc.php?c=scene&flag=promotion"> 申请推荐案例</a> </li>
					 
	          </ul>
	        </li>
		    <li class="<?php if(($flag) == "useranli"): else: ?> <?php echo ($ui["scene_index"]); echo ($ui["Reptile"]); echo ($ui["yxcj"]); endif; ?> "> <a href="javascript:;"> 
            <i class="icon-briefcase"></i> 
            <span class="title">系统模板管理</span> <span class="selected "></span> </a>
		      <ul class="sub-menu">
              	<li class="<?php echo ($ui["scene_index"]); ?>"><a href="<?php echo U('/scene/index');?>" >模板列表</a></li>
                 <li class="<?php if($_GET['from']=='0'): ?>active <?php else: endif; ?>"><a href="/adminc.php?c=reptile&from=0" ><i class="fa "></i>采集官方</a></li>
				 <li class="<?php if($_GET['from']=='70'): ?>active <?php else: endif; ?>"><a href="/adminc.php?c=reptile&from=70" ><i class="fa "></i>采集70c</a></li>
                  <li class="<?php echo ($ui); ?>"><a href="?c=reptile&from=other" >采集同行</a></li>
				  
	          </ul>
	        </li>
            
            
             <li class="<?php echo ($ui["goods"]); ?>"> <a href="javascript:;"> 
            <i class="icon-collapse"></i> <span class="title">商品管理</span> 
            <span class="selected "></span> </a>
		      <ul class="sub-menu">
		        <li  class="<?php echo ($ui["goods_index"]); ?>"> <a href="<?php echo U('/goods');?>"> 商品管理</a> </li>
		        <li class="<?php echo ($ui["goods_add"]); ?>" > <a href="?c=goods&a=add"> 添加商品</a> </li>
		    
		     
	          </ul>
	        </li>
             <li class=" <?php echo ($ui["order_info"]); ?>"> <a href="javascript:;"> 
            <i class="icon-yen"></i> <span class="title">订单管理</span> 
            <span class="selected "></span> </a>
		      <ul class="sub-menu">
		        <li class="<?php echo ($ui["order_info_index"]); ?>"> <a href="<?php echo U('/order');?>"> 订单管理</a> </li>
		    
		     
	          </ul>
	        </li>
            <li class=" <?php echo ($ui["article"]); ?>"> <a href="javascript:;"> 
            <i class="icon-collapse"></i> <span class="title">文章管理</span> 
            <span class="selected "></span> </a>
		      <ul class="sub-menu">
		        <li class="<?php echo ($ui["article_index"]); ?>"> <a href="<?php echo U('/article');?>"> 文章管理</a> </li> 
	          </ul>
	        </li>
		    <li class="<?php echo ($ui["File_index"]); ?>"> <a href="javascript:;"> <i class="icon-gift"></i> 
            <span class="title">系统素材管理</span> <span class="selected "></span> </a>
		      <ul class="sub-menu">
		    <!--<li class="<?php if(($filetype) == "0"): echo ($ui["File_index"]); endif; ?>"><a href="/adminc.php?c=File&a=index&filetype=0" ><i class="fa "></i>背景素材</a></li>-->
		    <li class="<?php if(($filetype) == "1"): echo ($ui["File_index"]); endif; ?>"><a href="/adminc.php?c=File&a=index&filetype=1" ><i class="fa "></i>图片素材</a></li>
		    <li class="<?php if(($filetype) == "2"): echo ($ui["File_index"]); endif; ?>"><a href="/adminc.php?c=File&a=index&filetype=2" ><i class="fa "></i>音乐素材</a></li>
	   
	          </ul>
	        </li>
            
            
            
            <li class="<?php echo ($ui["userancs"]); ?>"> <a href="javascript:;"> <i class="icon-gift"></i> 
            <span class="title">用户素材管理</span> <span class="selected "></span> </a>
		      <ul class="sub-menu">
		    <li class="<?php if(($filetype) == "0"): echo ($ui["File_index"]); endif; ?>"><a href="/adminc.php?c=File&a=userancs&filetype=0" ><i class="fa "></i>背景素材</a></li>
		    <li class="<?php if(($filetype) == "1"): echo ($ui["File_index"]); endif; ?>"><a href="/adminc.php?c=File&a=userancs&filetype=1" ><i class="fa "></i>图片素材</a></li>
		    <li class="<?php if(($filetype) == "2"): echo ($ui["File_index"]); endif; ?>"><a href="/adminc.php?c=File&a=userancs&filetype=2" ><i class="fa "></i>音乐素材</a></li>
	   
	          </ul>
	        </li>
            
            
              <li class="<?php echo ($ui["cate"]); echo ($ui["tag_index"]); ?>"> <a href="javascript:;"> 
            <i class="icon-briefcase"></i> 
            <span class="title">系统分类管理</span> <span class="selected "></span> </a>
		      <ul class="sub-menu">          
              
                 <li  class="<?php if(($type) == "tpType"): echo ($ui["cate_index"]); endif; ?>"><a href="/adminc.php?c=cate&filetype=tpType" >图片分类</a></li>
					 <!-- <li class="<?php if(($type) == "bgType"): echo ($ui["cate_index"]); endif; ?>"><a href="/adminc.php?c=cate&filetype=bgType"  >背景分类</a></li> -->
					 <li class="<?php if(($type) == "musType"): echo ($ui["cate_index"]); endif; ?>"><a href="/adminc.php?c=cate&filetype=musType" >音乐分类</a></li>
				 <li class="<?php if(($type) == "scene_type"): echo ($ui["cate_index"]); endif; ?>"><a href="/adminc.php?c=cate&filetype=scene_type">场景分类</a></li> 
                 <?php if(C('VI_SCENECODE')): ?>
                 <li class="<?php if(($type) == "mytpl_type"): echo ($ui["cate_index"]); endif; ?>"><a href="/adminc.php?c=cate&filetype=mytpl_type">我的模板分类</a></li>     <?php endif; ?>
	          </ul>
	        </li>
            
            
              <li class="<?php echo ($ui["Database"]); ?>"> 
            <a href="javascript:;"> <i class="icon-cogs"></i> <span class="title">数据库备份</span> 
             <span class="selected "></span> </a>
		      <ul class="sub-menu">
               <li class=""> <a href="<?php echo U('/Database/index/type/export');?>"> 数据库备份</a> </li>
                <li class=""> <a href="<?php echo U('/Database/index/type/import');?>"> 数据库还原</a> </li>

	          </ul>
	        </li>
            
            
                     <li class="<?php echo ($ui["Ad_msgList"]); echo ($ui["Ad_msgadd"]); echo ($ui["ad_friendlinks"]); ?>"> <a href="javascript:;"> 
             <i class="icon-bookmark-empty"></i>  <span class="title">公告&友情链接</span> 
             <span class="selected "></span> </a>
		      <ul class="sub-menu">
               <li class="<?php echo ($ui["Ad_msgList"]); ?>"> <a href="<?php echo U('/Ad/msglist');?>"> 公告管理</a> </li>
                <li class="<?php echo ($ui["Ad_msgadd"]); ?>"> <a href="<?php echo U('/Ad/msgadd');?>"> 新增公告</a> </li>
     		   <li class="<?php echo ($ui["ad_friendlinks"]); ?>"> <a href="<?php echo U('Ad/friendlinks');?>"> 友情链接管理</a> </li>

		    
	          </ul>
	        </li>
            <li class="<?php echo ($ui["Ad_index"]); echo ($ui["Ad_d"]); ?>"> <a href="javascript:;"> 
             <i class="icon-bookmark-empty"></i>  <span class="title">Logo图片管理</span> 
             <span class="selected "></span> </a>
		      <ul class="sub-menu">
              
                <li class="<?php echo ($ui["Ad_index"]); ?>"> <a href="<?php echo U('/Ad/index');?>"> 广告图片管理</a> </li>
 <li class="<?php echo ($ui["Ad_d"]); ?>"> <a href="<?php echo U('/Ad/add');?>"> 新增广告</a> </li>
		    
	          </ul>
	        </li>
            
	
		    
		
		  
	      </ul>
		  <!-- END SIDEBAR MENU -->
</div>
		<!-- END BEGIN HORIZONTAL MENU PAGE SIDEBAR -->

		<!-- BEGIN PAGE -->

		<div class="page-content">

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM--><!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
  
    
            	<script src="/Public/media/js/jquery-1.10.1.min.js" type="text/javascript"></script>
                <style>
                  div.radio input {
opacity: 11;}
.radio input[type="radio"], .checkbox input[type="checkbox"] {
	margin-left: 0 !important;}</style>
<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->   

  <div class="row-fluid">

					<div class="span12 blog-page">

						<!-- BEGIN STYLE CUSTOMIZER --><!-- END BEGIN STYLE CUSTOMIZER -->  

						<h4 class="page-title">

							管理员管理

							 <small>advance form layout samples</small>

					  </h4>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="index.html">管理首页</a> 

								<span class="icon-angle-right"></span>

							</li>

							<li>

								<a href="#">用户管理</a>

								<span class="icon-angle-right"></span>

							</li>

							<li><a href="#"> <?php if(($isAdd) == "1"): ?>添加 <?php else: ?>编辑<?php endif; ?>管理员</a></li>

						</ul>

	</div>

				</div>

				<!-- END PAGE HEADER-->
                
   
                            
               <div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
			 <li class="<?php echo ($ui["sys_admin"]); ?>"> <a href="<?php echo U('sys/admin');?>"> 管理员管理</a> </li>
		        <li class="<?php echo ($ui["sys_add"]); ?>"> <a href="<?php echo U('sys/add');?>">  添加管理员</a> </li>
                 <li class="<?php echo ($ui["sys_edit"]); ?>"> <a href="/adminc.php?c=sys&a=edit&id=<?php echo ($Adminuserid); ?>"> 修改密码</a> </li>
							</ul>
                        
                </div>
<hr />
						
        	<div class="row-fluid">
					<div class="span12 ">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
							<div class="portlet-body">
                            
				
				<!-- END PAGE HEADER-->

			<!-- BEGIN PAGE CONTENT-->          
			
                            
                            
                            <div class="portlet-body form">

								<!-- BEGIN FORM-->

				<input name="ctl00$ContentPlaceHolder1$txt" type="hidden" id="ctl00_ContentPlaceHolder1_txt" />
                <form action="" class="form-horizontal" method="post">

									<div class="control-group">

										<label class="control-label"></label>

										<div class="controls">

							<img src="/Uploads/<?php echo ((isset($user["headimg"]) && ($user["headimg"] !== ""))?($user["headimg"]):"defaultuser.jpg"); ?>" width="120" height="120" />

										</div>

									</div>
                            

							<div class="portlet-body form">

								<!-- BEGIN FORM-->

								

									<div class="control-group">

										<label class="control-label">登录名</label>

										<div class="controls">
            <input name="user[USERNAME]" type="text"   class="m-wrapt" style="width: 200px;" value="<?php echo ($user["username"]); ?>" />

							

											<span class="help-inline"></span>

										</div>

									</div>

	<!--div class="control-group">

										<label class="control-label">登陆邮箱</label>
										<div class="controls">
											<div class="input-icon left">
												<i class="icon-envelope"></i>
      <input name="user[email_varchar]" type="text"   class="m-wrapt" value="<?php echo ($user["email_varchar"]); ?>" />
											</div>
										</div>
								  </div-->

								
								
									<div class="control-group">

										<label class="control-label">登陆密码</label>

										<div class="controls">
                                        
                                        
                            <input name="userpassword" type="password"  class="m-wrap" value="" />            
										

										</div>

									</div>

								<!--div class="control-group">

										<label class="control-label">到期时间</label>

										<div class="controls">

	<div class="input-append date date-picker" data-date="2015-05-04" data-date-format="yyyy-mm-dd" data-date-viewmode="years">

												<input class="m-wrap m-ctrl-medium "name="user[end_time]"  readonly size="16" type="text" value="<?php if($user['end_time'] != ''): echo (date("Y-m-d",$user["end_time"])); endif; ?>"><span class="add-on"><i class="icon-calendar"></i></span>

										  </div>

										</div>

								  </div>

								
<div class="control-group">

													<label class="control-label">用户等级</label>

													<div class="controls">
                                       <select class="small m-wrap" name="user['level_int']">
                       <option value="0" <?php if(($user['level_int']) == "0"): ?>selected<?php endif; ?> >普通用户</option>
                       <option value="1" <?php if(($user['level_int']) == "1"): ?>selected<?php endif; ?> >企业用户</option> 
                       <option value="2" <?php if(($user['level_int']) == "2"): ?>selected<?php endif; ?> >高级用户</option> 
                       <option value="3" <?php if(($user['level_int']) == "3"): ?>selected<?php endif; ?> >服务商用户</option> 
                       <option value="4" <?php if(($user['level_int']) == "4"): ?>selected<?php endif; ?>>钻石用户</option> 
                       </select>             

													</div>

												</div--->
								

								
                                
                                <div class="control-group">
													<label class="control-label">用户状态</label>
													<div class="controls">
														<label class="radio">
														<div class="radio"><span class="checked">
                 <input id="ctl00_ContentPlaceHolder1_rdiIsEnable_help_0" type="radio" name="user[USERIS]" value="1" <?php if(($user['useris']) == "1"): ?>checked="checked"<?php endif; ?>/><label for="ctl00_ContentPlaceHolder1_rdiIsEnable_help_0">
                                                        </span></div>
启用
														</label>
														<label class="radio">
														<div class="radio"><span class="">
            <input id="ctl00_ContentPlaceHolder1_rdiIsEnable_help_1" type="radio"   name="user[USERIS]" value="0" <?php if(($user['useris']) == "0"): ?>checked="checked"<?php endif; ?>/><label for="ctl00_ContentPlaceHolder1_rdiIsEnable_help_1">
                                                        </span></div>
禁用
														</label>  


													</div>

												</div>
							

								

									<div class="form-actions">
     <input type="hidden"  name="id" value="<?php echo ($user["userid"]); ?>" />
										<button type="submit" class="btn blue">确定提交</button>

										<button type="button" class="btn">放弃</button>                            

									</div>

								</form>

								<!-- END FORM-->       

							</div>

						</div>

						<!-- END SAMPLE FORM PORTLET-->

					</div>

				</div>

		

						<!-- END EXTRAS PORTLET-->

					</div>

			<!-- END PAGE CONTENT--><!-- END PAGE CONTAINER-->

		</div>
	</div>

	<!-- END CONTAINER -->

	<!-- BEGIN FOOTER -->

	<div class="footer">

		<div class="footer-inner">2015 ©</div>

		<div class="footer-tools">

			<span class="go-top">

			<i class="icon-angle-up"></i>

			</span>

		</div>

	</div>

	<!-- END FOOTER -->

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	<!-- BEGIN CORE PLUGINS -->

	<script src="/Public/media/js/jquery-1.10.1.min.js" type="text/javascript"></script>

	<script src="/Public/media/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

	<script src="/Public/media/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      

	<script src="/Public/media/js/bootstrap.min.js" type="text/javascript"></script>

	<!--[if lt IE 9]>

	<script src="/Public/media/js/excanvas.min.js"></script>

	<script src="/Public/media/js/respond.min.js"></script>  

	<![endif]-->   

	<script src="/Public/media/js/jquery.slimscroll.min.js" type="text/javascript"></script>

	<script src="/Public/media/js/jquery.blockui.min.js" type="text/javascript"></script>  

	<script src="/Public/media/js/jquery.cookie.min.js" type="text/javascript"></script>

	<script src="/Public/media/js/jquery.uniform.min.js" type="text/javascript" ></script>

	<!-- END CORE PLUGINS -->

	<!-- BEGIN PAGE LEVEL PLUGINS -->

	<script type="text/javascript" src="/Public/media/js/ckeditor.js"></script>  

	<script type="text/javascript" src="/Public/media/js/bootstrap-fileupload.js"></script>

	<script type="text/javascript" src="/Public/media/js/chosen.jquery.min.js"></script>

	<script type="text/javascript" src="/Public/media/js/select2.min.js"></script>

	<script type="text/javascript" src="/Public/media/js/wysihtml5-0.3.0.js"></script> 

	<script type="text/javascript" src="/Public/media/js/bootstrap-wysihtml5.js"></script>

	<script type="text/javascript" src="/Public/media/js/jquery.tagsinput.min.js"></script>

	<script type="text/javascript" src="/Public/media/js/jquery.toggle.buttons.js"></script>

	<script type="text/javascript" src="/Public/media/js/bootstrap-datepicker.js"></script>

	<script type="text/javascript" src="/Public/media/js/bootstrap-datetimepicker.js"></script>

	<script type="text/javascript" src="/Public/media/js/clockface.js"></script>

	<script type="text/javascript" src="/Public/media/js/date.js"></script>

	<script type="text/javascript" src="/Public/media/js/daterangepicker.js"></script> 

	<script type="text/javascript" src="/Public/media/js/bootstrap-colorpicker.js"></script>  

	<script type="text/javascript" src="/Public/media/js/bootstrap-timepicker.js"></script>

	<script type="text/javascript" src="/Public/media/js/jquery.inputmask.bundle.min.js"></script>   

	<script type="text/javascript" src="/Public/media/js/jquery.input-ip-address-control-1.0.min.js"></script>

	<script type="text/javascript" src="/Public/media/js/jquery.multi-select.js"></script>   

	<script src="/Public/media/js/bootstrap-modal.js" type="text/javascript" ></script>

	<script src="/Public/media/js/bootstrap-modalmanager.js" type="text/javascript" ></script> 

	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->

	<script src="/Public/media/js/app.js"></script>

	<script src="/Public/media/js/form-components.js"></script>     

	<!-- END PAGE LEVEL SCRIPTS -->

	<script>

		jQuery(document).ready(function() {       

		   // initiate layout and plugins

		   App.init();

		   FormComponents.init();

		});

	</script>

	<!-- END JAVASCRIPTS -->   

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script>


</body>

<!-- END BODY -->

</html>