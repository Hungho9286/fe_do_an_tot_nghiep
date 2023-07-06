 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('giangvien/vendor/jquery/jquery.min.js')}}"></script>
 <script src="{{asset('giangvien/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

 <!-- Core plugin JavaScript-->
 <script src="{{asset('giangvien/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

 <!-- Custom scripts for all pages-->
 <script src="{{asset('giangvien/js/sb-admin-2.min.js')}}"></script>
 <script src="{{asset('giangvien/js/view/view.js')}}"></script>
 <script src="{{asset('giangvien/js/view/modal.js')}}"></script>

 <!-- Page level plugins -->
 <script src="{{asset('giangvien/vendor/chart.js/Chart.min.js')}}"></script>
 
 <!-- Page level custom scripts -->
 <script src="{{asset('giangvien/js/demo/chart-area-demo.js')}}"></script>
 <script src="{{asset('giangvien/js/demo/chart-pie-demo.js')}}"></script>
 <script>
        
        $(document).ready(function(){

            $.ajax({
            type: "GET",
            url:'{{env('SERVER_URL')}}/api/giang-vien/{{Session::get('ma_gv')}}',
            headers:{
                    "Authorization":"Bearer {{Session::get('access_token_gv')}} " 
                }
        }).done(function($data){
            console.log("voo Ajax");
            console.log($data);
            $('#ten_giang_vien').append($data.ten_giang_vien);
        })
    })
        

        
    
    </script>
 @yield('js')
