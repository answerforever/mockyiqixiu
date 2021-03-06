<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html ng-app="app">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-store, must-revalidate">
    <meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
    <meta http-equiv="expires" content="0">
    <base href="/auth/">
    <title><?php echo (C("site_title")); ?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="//cdn.bootcss.com/normalize/3.0.3/normalize.min.css">
    <link rel="stylesheet" href="/resource/css/resource.min.css">
    <!-- inject:css -->
    <link rel="stylesheet" href="/auth/css/auth-49b3954073.min.css">
    <!-- endinject -->
</head>
<body>
<div class="eqc-app">
    <div id="eqi_view" ng-view></div>
    <div class="close" ng-click="close()">&times;</div>
</div>
<script>
    var HOST_BASE       = 'auth';
    var HOST_RESOURCE   = '/resource';
    var HOST_SERVER     = "http://"+window.location.host+"/";
    var HOST_SERVER_S1  = "http://"+window.location.host+"/";
    var HOST_CLIENT     = "http://"+window.location.host+"/";
    var HOST_CDN        = "http://"+window.location.host+"/";
</script>
<script src="//cdn.bootcss.com/angular.js/1.5.5/angular.min.js"></script>
<script src="//cdn.bootcss.com/angular.js/1.5.5/angular-route.min.js"></script>
<!-- inject:js -->
<script src="/auth/js/auth-59608e2478.min.js"></script>
<!-- endinject -->
</body>
</html>