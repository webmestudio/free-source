<!DOCTYPE html>
<html>
<head>
    <title>Mengambil url dan mendapatkan nilai meta tag semua situs</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--bootstrap-CSS-->
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap/css/bootstrap.min.css" />

    <style type="text/css">
	.main-content {
		margin-top:60px;
		margin-bottom: 60px;
	}
	.site-info-link {
		display: block;
		color: #333;
		text-decoration: none;
	}
	.site-info-link:hover, .site-info-link:focus { 
		text-decoration: none;
	}
	.siteinfo {
		background-color: #fff;
		border: 1px solid #ddd;
		padding: 10px 15px 10px;
	}
	.site-img {
		overflow: hidden;
		height: 118px;
		width: 120px;
	}
    </style>
</head>
<body>

<div class="container">
	<div class="row">

		<!--main-->
		<div class="col-md-6 col-md-offset-3 main-content">
			<h3 class="text-center">Mengambil url dan mendapatkan nilai meta tag semua situs</h3>
			<hr />
			<!--URL-->
			<div class="panel panel-default">
				<div class="panel-body">
					<form id="fetch-url" method="post" action="api/embed-respons.php">
						<div class="row">
							<div class="col-md-8">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
										<input type="url" class="form-control" name="url" placeholder="http://">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<button type="submit" id="js-btn-fetch-url" class="btn btn-primary btn-block">Fetch URL</button>
							</div>
						</div>
					</form>
					<div id="js-progress">
						<div class="progress" style="margin-bottom: 0;">
	                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
	                    </div>
					</div>
				</div>
			</div>
			<!--/.URL-->

			<hr />

			<!--retrive-informasi-->
			<div id="js-load-url">
				<!--<a href="#" class="site-info-link">
					<div class="media siteinfo">
						<div class="media-left media-middle">
							<div class="site-img">
								<img class="media-object img-responsive" src="holder.js/120x118" />
							</div>
						</div>
						<div class="media-body">
							<p class="media-heading"><b>Middle aligned media</b></p>
							<p>Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
							<b>www.facebook.com</b>
						</div>
					</div>
				</a>-->
			</div>
			<!--/.retrive-informasi-->

		</div>

	</div>
</div>

<!--jQuery-->
<script type="text/javascript" src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="plugins/jquery/jquery.migrate.min.js"></script>
<!--bootstrap-js-->
<script type="text/javascript" src="plugins/bootstrap/js/bootstrap.min.js"></script>
<!--holder-js-->
<script type="text/javascript" src="plugins/bootstrap/js/holder.js"></script>
<!--jQuery-Form-->
<script type="text/javascript" src="plugins/jquery-form/jquery.form.js"></script>

<script type="text/javascript">
$('#js-btn-fetch-url').live('click', function(e) {

	if($('input[name=url]').val() != '')
	{
		$('.progress-bar').css({
	        width: 50 + '%'
	    });
	    $('.progress-bar').text(50 + '%');

	    setTimeout(function() {

	    	$.ajax({
			type: 'POST',
			url: $('#fetch-url').attr('action'),
			data: { 
				url : $('input[name=url]').val() 
			},
			dataType : 'json',
			xhr: function () {
			    var xhr = new window.XMLHttpRequest();
			    xhr.upload.addEventListener("progress", function (evt) {
			        if (evt.lengthComputable) {
			            var percentComplete = evt.loaded / evt.total;
			            $('.progress-bar').css({
			                width: percentComplete * 100 + '%'
			            });
			            $('.progress-bar').text(percentComplete * 100 + '%');
			        }
			    }, true);
			    xhr.addEventListener("progress", function (evt) {
			        if (evt.lengthComputable) {
			            var percentComplete = evt.loaded / evt.total;
			            $('.progress-bar').css({
			                width: percentComplete * 100 + '%'
			            });
			            $('.progress-bar').text(percentComplete * 100 + '%');
			        }
			    }, true);
			    return xhr;
			},
			success: function (data) {
				$('.progress-bar').css({
	                width: 0 + '%'
	            });
	            $('.progress-bar').text(0 + '%');

	            if(data.errorLink == true)
				{
					alert('URL tidak valid....');
				}
				else if(data.errorSocket == true)
				{
					alert('Anda tidak terhubung dengan internet');
				}
				else
				{
					if(data.image == null)
					{
						$('#js-load-url').fadeIn('slow').html('<a href="'+ data.url +'" class="site-info-link" rel="nofollow" target="_blank"><div class="media siteinfo"><div class="media-left media-middle"><div class="site-img"><img class="media-object img-responsive" src="'+ data.providerIcons[3].value +'"/></div></div><div class="media-body"><p class="media-heading"><b>'+ data.title +'</b></p><p>'+ data.description +'</p><b>'+ data.providerUrl +'</b></div></div></a>');
					}
					else
					{
						$('#js-load-url').fadeIn('slow').html('<a href="'+ data.url +'" class="site-info-link" rel="nofollow" target="_blank"><div class="media siteinfo"><div class="media-left media-middle"><div class="site-img"><img class="media-object img-responsive" src="'+ data.image +'"/></div></div><div class="media-body"><p class="media-heading"><b>'+ data.title +'</b></p><p>'+ data.description +'</p><b>'+ data.providerUrl +'</b></div></div></a>');
					}
					
				}
			},
			error : function() {
				$('.progress-bar').css({
	                width: 0 + '%'
	            });
	            $('.progress-bar').text(0 + '%');

	            alert('Anda tidak terhubung dengan internert');
			}
		});

	    }, 1500);

	}
	else
	{
		alert('plase insert your link...');
	}

	e.preventDefault();
});
</script>

</body>
</html>