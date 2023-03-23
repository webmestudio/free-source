<!DOCTYPE html>
<html>
<head>
    <title>Upload Foto Dengan Progressbar</title>

    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--handle-upload-trigger-->
    <link accesskey="handle" value="off" />

    <!--bootstrap-CSS-->
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap/css/bootstrap.min.css" />

    <!--style-->
    <style type="text/css">
    	.main-content {
    		margin-top:60px;
    		margin-bottom: 60px;
    	}

    	.fotobox {
    		position: relative;
    	}
    	.fotobox .progressbar-upload {
    		position: absolute;
		    top: 48%;
		    left: 10px;
		    right: 10px;
    	}

    	.progressbar-upload {
    		display: none;
    	}

    	.form-btn {
    		position: relative;
    	}
    	.form-btn form {
			position: absolute;
			width: 100%;
			overflow: hidden;
			height: 100%;
			top: 0;
			left: 0;
    	}
    	.form-btn form > input[type='file'] { 
    		position: absolute;
		    height: 400px;
		    right: 0px;
		    bottom: 0px;
		    font-size: 2000px;
		    cursor: pointer;
    	}
    </style>
</head>
<body>

<div class="container">
	<div class="row">
		
		<!--main-->
		<div class="col-md-6 col-md-offset-3 main-content">
			<h3 class="text-center">Multiple Upload Dalam Satu Proses dengan Progress Bar dan Hapus Foto di Direktori Setelah Membatalkan atau Mereload Halaman</h3>
			<hr />
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-6 col-md-offset-3">

						<div class="fotobox">
							<input type="hidden" name="foto_ori" />
							<input type="hidden" name="foto_200" />
							<input type="hidden" name="foto_100" />

							<div id="js-change-avatar" class="thumbnail">
								<img src="foto/default.png" alt="" />
							</div>

							<div id="js-progress" class="progressbar-upload">
								<div class="progress">
			                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%
			                        </div>
			                    </div>
							</div>
						</div>

						<div id="js-change-button" class="form-upload-box">
							<div class="form-btn">
								<a href="#!" class="btn btn-primary btn-lg btn-block">
									<span>Unggah Foto</span>
									<form id="form-upload" method="post" enctype="multipart/form-data" action="api/uploading.php">
										<input type="file" name="file" id="js-btn-upload" />
									</form>
								</a>
							</div>
						</div>

						<div id="js-cencel-button-trigger" style="display: none; margin-bottom: 10px;">
							<button id="js-cencel-button" type="button" class="btn btn-danger btn-lg btn-block">Batalkan Unggahan</button>
						</div>

						<div id="js-success-button-trigger" style="display: none;">
							<button id="js-success-button" type="button" class="btn btn-success btn-lg btn-block">Selesai</button>
						</div>

					</div>
				</div>
			</div>

		</div>

	</div>
</div>

<!--jQuery-->
<script type="text/javascript" src="plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="plugins/jquery/jquery.migrate.min.js"></script>
<!--bootstrap-js-->
<script type="text/javascript" src="plugins/bootstrap/js/bootstrap.min.js"></script>
<!--jQuery-Form-->
<script type="text/javascript" src="plugins/jquery-form/jquery.form.js"></script>
<!--ajax-upload-->
<script type="text/javascript">
/* ajax upload image */
$('#js-btn-upload').live('change', function(e) {
	var bar = $('.progress-bar');
	   
	$('#form-upload').ajaxForm({
        dataType : 'json',
        cache : false,
        resetForm : true,
		beforeSend: function() {
			var percentVal = '0%';
            $('#js-progress').css('display','block');
			bar.width(percentVal);
		},
		uploadProgress: function(event, position, total, percentComplete) {
			var percentVal = percentComplete + '%';
			bar.width(percentVal);
			bar.text(percentVal);
		},
		success: function(data) {
			var percentVal = '100%';
			bar.width(percentVal);
            
            if(data.error == true) {
                alert('Opps.. Sepertinya ada kesalahan.');
            }
            else if(data.attempt == true)
            {
            	alert('Opps.. Sepertinya file terlalu besar.');
            }
            else if(data.invalid) {
            	alert('Opps.. Sepertinya file tidak valid.');
            }
            else {
                //html
                var html_change_image = '<img class="img-responsive" src="foto/'+ data.foto_200 +'" />';

                //simpan nilai data ke element input[type=hidden]
                $('input[name=foto_ori]').val(data.foto_ori);
                $('input[name=foto_200]').val(data.foto_200);
                $('input[name=foto_100]').val(data.foto_100);
                
                //output html    
                $('#js-change-avatar').html(html_change_image);

                // turn on for handle page reload
                $('link[accesskey=handle]').attr('value', 'on');

                //show button finish
                $('#js-change-button').hide();
                $('#js-cencel-button-trigger').show();
                $('#js-success-button-trigger').show();

            }
		},
		complete: function() {
            //success back to default
            $('#js-progress').hide();
            bar.width('0%');
		},
        error : function() {
            alert('Maaf anda tidak terhubung ke internet');
        }
	}).submit(); 

	e.preventDefault();
});

/* ajax cencel upload image after reload page */
$(window).bind('beforeunload', function () {
    if($('link[accesskey=handle]').attr('value') == 'on') {
        return true;
    }
});
$(window).bind("unload", function () {
	if($('link[accesskey=handle]').attr('value') == 'on') {
        // file removed
        uploading_cencel();
        // handle back to off
        $('link[accesskey=handle]').attr('value', 'off');
    }
});

/* cencel upload with click */
$('#js-cencel-button').live('click', function(e) {
	
	if(confirm("Apakah anda yakin akan membatalkan unggahan ini ?")) {
		uploading_cencel();
        window.location.reload();
	}

    e.preventDefault();
});

/* upload successfull */
$('#js-success-button').live('click', function(e) {
    
    $('link[accesskey=handle]').attr('value', 'off');

    if($('link[accesskey=handle]').attr('value') == 'off') {
        alert('Selamat. Anda berhasil meng-unggah foto dan foto telah di simpan');
        window.location.reload();
    }

    e.preventDefault();
});

/* AJAX jika upload sudah selesai akan tetapi pengguna melakukan reload
maka file yang terdapat di direktori akan di hapus */
function uploading_cencel() {
    var file_in_arr = new Array (
    	$('input[name=foto_ori]').val(),
        $('input[name=foto_200]').val(),
        $('input[name=foto_100]').val()
    );

    $.ajax({
        type : 'post',
        url  : 'api/uploading_cencel.php',
        data : {
        	cencel_upload : true,
            file : file_in_arr
        },
        async : false,
        cache : false,
        dataType : 'json',
        success : function(data) {
            // turn off for handle page reload
            $('link[accesskey=handle]').attr('value', 'off');
        },
        error : function() {
            alert('anda tidak terhubung ke internet');
        }
    });
}
</script>
</body>
</html>