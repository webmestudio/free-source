<!DOCTYPE html>
<html>
<head>
	<title>Cara Membuat Sidebar Slide Modern Style</title>
	<meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--bootstrap-CSS-->
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap/css/bootstrap.min.css" />
		
	<style type="text/css">
	.btn {
		position: relative;
		z-index: 10;
	}
	.left-sidebar h3, 
	.right-sidebar h3 {
		padding-top: 80px;
		color: #fff;
	}
 	
	.top-sidebar.slide {
		transform: translateY(0);
	}
	.top-sidebar {
		position: fixed;
		min-height: 60px;
		top: 0;
		right: 0;
		left: 0;
		z-index: 5;
		display: block;
		padding: 0;
		background-color: #2196F3;
		transform: translateY(-60px);
		transform-style: preserve-3d;
		will-change: transform;
		transition-duration: .2s;
		transition-timing-function: cubic-bezier(.4,0,.2,1);
		transition-property: transform;
		z-index: 6;
	}
	
	.left-sidebar.slide {
		transform: translateX(0) !important;
	}
	.left-sidebar {
		position: fixed;
		width: 250px;
		top: 0px;
		bottom: 0;
		left: 0;
		z-index: 5;
		display: block;
		padding: 0;
		overflow-x: hidden;
		overflow-y: hidden;
		background-color: #607D8B;
		color: #fff;
		transform: translateX(-260px);
		transform-style: preserve-3d;
		will-change: transform;
		transition-duration: .2s;
		transition-timing-function: cubic-bezier(.4,0,.2,1);
		transition-property: transform;
		transition-property: transform,-webkit-transform;
		box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
	}
	
	.right-sidebar.slide {
		transform: translateX(0) !important;
	}
	.right-sidebar {
		width: 250px;
		height: calc(100vh - -60px);
		position: fixed;
		right: 0;
		top: 0px;
		z-index: 5;
		background: #F44336;
		-webkit-box-shadow: -2px 2px 5px rgba(0, 0, 0, 0.1);
		-moz-box-shadow: -2px 2px 5px rgba(0, 0, 0, 0.1);
		-ms-box-shadow: -2px 2px 5px rgba(0, 0, 0, 0.1);
		box-shadow: -2px 2px 5px rgba(0, 0, 0, 0.1);
		overflow: hidden;
		transform: translateX(283px);
		transform-style: preserve-3d;
		will-change: transform;
		transition-duration: .2s;
		transition-timing-function: cubic-bezier(.4,0,.2,1);
		transition-property: transform;
		transition-property: transform,-webkit-transform;
		border-top: 1px solid #ddd;
	}
	
	.overlay.active {
		pointer-events: auto;
		opacity: 0.5;
		background-color: rgba(0,0,0,.5);
		visibility: visible;
	}
	.overlay {
		cursor: pointer;
		background-color: rgba(0,0,0,.5);
		opacity: 0;
		transition-property: opacity;
		pointer-events: none;
		position: fixed;
		top: 0;
		left: 0;
		height: 100%;
		width: 100%;
		visibility: hidden;
		transition-property: background-color;
		transition-duration: .2s;
		transition-timing-function: cubic-bezier(.4,0,.2,1);
		z-index: 0;
	}
	</style>
</head>
<body>

<div id="js-top-sidebar" class="top-sidebar">
	<h3 class="text-center" style="color: #fff;">Slide Top</h3>
</div>
<div id="js-left-sidebar" class="left-sidebar">
	<h3 class="text-center">Slide Left</h3>
</div>
<div id="js-right-sidebar" class="right-sidebar">
	<h3 class="text-center">Slide Right</h3>
</div>

<div class="container">
	<div style="margin: 180px auto; max-width: 800px; text-align:center;">
		<h3>Cara Membuat Sidebar Slide Modern Style</h3>
		<hr />
		<div class="row">
			<div class="col-md-4">
				<a href="#!" onclick="$.ws.style.leftsidebar();" class="btn btn-primary btn-lg btn-block">Toggle Sidebar Left</a>
			</div>
			<div class="col-md-4">
				<a href="#!" onclick="$.ws.style.topsidebar();" id="js-toggle-top-sidebar" class="btn btn-primary btn-lg btn-block">Toggle Sidebar Top</a>
			</div>
			<div class="col-md-4">
				<a href="#!" onclick="$.ws.style.rightsidebar();" class="btn btn-primary btn-lg btn-block">Toggle Sidebar Right</a>
			</div>
		</div>
		<hr />
		<span class="help-block">2017 Copyrighted by Webme Studio</span>
	</div>
</div>

<div id="js-overlay" class="overlay" onclick="$.ws.style.overlay(this);"></div>

<!--jQuery-->
<script type="text/javascript" src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="plugins/jquery/jquery.migrate.min.js"></script>
<!--bootstrap-js-->
<script type="text/javascript" src="plugins/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
$.ws = {};

$.ws.style = {
	overlay : function(e) {
		$(e).removeClass('active');
		
		$('#js-right-sidebar').removeClass('slide');
		$('#js-top-sidebar').removeClass('slide');
		$('#js-left-sidebar').removeClass('slide');
	},
	leftsidebar : function() {
		$('#js-left-sidebar').addClass('slide');
		
		$('#js-right-sidebar').removeClass('slide');
		$('#js-top-sidebar').removeClass('slide');
		$('#js-overlay').addClass('active');
	},
	topsidebar : function() {
		$('#js-top-sidebar').addClass('slide');
		
		$('#js-right-sidebar').removeClass('slide');
		$('#js-left-sidebar').removeClass('slide');
		$('#js-overlay').addClass('active');
	},
	rightsidebar : function() {
		$('#js-right-sidebar').addClass('slide');
		
		$('#js-left-sidebar').removeClass('slide');
		$('#js-top-sidebar').removeClass('slide');
		$('#js-overlay').addClass('active');
	},
}
</script>

</body>
</html>