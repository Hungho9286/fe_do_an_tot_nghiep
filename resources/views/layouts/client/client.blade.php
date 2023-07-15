<?php
$accessToken = request()->cookie('access_token');
$id_sinh_vien=request()->cookie('id_sinh_vien');
$url="http://127.0.0.1:8000/api/sinh-vien/".$id_sinh_vien;
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
// curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
// curl_setopt($ch, CURLOPT_POSTFIELDS,
//     "id=".$request->id_sinh_vien);
curl_setopt($ch,CURLOPT_HTTPHEADER,array("Authorization: Bearer $accessToken"));
$head=curl_exec($ch);
//dd($head);
curl_close($ch);
$data=json_decode($head);
//dd($data->khoa_hoc);
?>

<!DOCTYPE html>
<!-- Template by Quackit.com -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Cổng thông tin trực tuyến CKC</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logos/logoct.png') }}" />
    <!-- Bootstrap Core CSS -->

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')

</head>

<body>

@include('layouts.client.block.header')
<div class="container-fluid">
        @include('layouts.client.block.menu')

        @include('layouts.client.block.main')
	  <!-- Right Column -->
	  <div class="col-sm-3">



			<!-- Progress Bars -->
			{{-- <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<span class="glyphicon glyphicon-scale"></span>
						Dramatically Engage
					</h3>
				</div>
				<div class="panel-body">
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100"
						aria-valuemin="0" aria-valuemax="100" style="width:100%">
							100% Proactively Envisioned
						</div>
					</div>
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80"
						aria-valuemin="0" aria-valuemax="100" style="width:80%">
							80% Objectively Innovated
						</div>
					</div>
					<div class="progress">
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45"
						aria-valuemin="0" aria-valuemax="100" style="width:45%">
							45% Portalled
						</div>
					</div>
					<div class="progress">
						<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="35"
						aria-valuemin="0" aria-valuemax="100" style="width:35%">
							35% Done
						</div>
					</div>
				</div>
			</div> --}}

			{{-- <!-- Text Panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						<span class="glyphicon glyphicon-bullhorn"></span>
						Active Predomination
					</h3>
				</div>
				<div class="panel-body">
					<p>Proactively envisioned multimedia based expertise and cross-media growth strategies.</p>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-default">Resource</button>
						<button type="button" class="btn btn-default">Envision</button>
						<button type="button" class="btn btn-default">Niche</button>
					</div>
				</div>
			</div> --}}


	  </div><!--/Right Column -->

	</div><!--/container-fluid-->




    @include('layouts.client.block.footer')

    @yield('script')
    <script>
        $(document).ready(function(){
            $('#formDangXuat').submit(function(e){
                e.preventDefault();
                Swal.fire({
                title: 'Bạn có muốn đăng xuất?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(this).unbind('submit').submit();
                }
                })
            })
        })
    </script>
</body>

</html>
