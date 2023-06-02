@extends('layouts.giangvien.giangvien')

@section('css')
<style>
a:hover,
a:focus{
    text-decoration: none;
    outline: none;
}
.vertical-tab{
    background: linear-gradient(#fff,#f5f5f5,#fff);
    font-family: 'Poppins', sans-serif;
    display: table;
    padding: 10px;
    border-radius: 20px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}
.vertical-tab .nav-tabs{
    background-color: #fff;
    display: table-cell;
    width: 25%;
    min-width: 25%;
    padding: 10px;
    border: none;
    border-radius: 10px;
    vertical-align: top;
}
.vertical-tab .nav-tabs li{ float: none; }
.vertical-tab .nav-tabs li a{
    color: #2e86de;
    background: #fff;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-align: center;
    padding: 12px 10px 10px;
    margin: 0 0 10px;
    border-radius: 10px;
    border: none;
    overflow: hidden;
    position: relative;
    z-index: 1;
    transition: all 0.5s ease 0.1s;
}
.vertical-tab .nav-tabs li a:hover,
.vertical-tab .nav-tabs li.active a,
.vertical-tab .nav-tabs li.active a:hover{
    color: #fff;
    background: #2e86de;
    border: none;
    box-shadow: 0 0 10px -4px #2e86de;
}
.vertical-tab .nav-tabs li a:before{
    content: '';
    background-color: #2e86de;
    height: 100%;
    width: 0;
    border-radius: 10px;
    position: absolute;
    right: 0;
    top: 0;
    z-index: -1;
    transition: all 0.4s ease 0s;
}
.vertical-tab .nav-tabs li a:hover:before,
.vertical-tab .nav-tabs li.active a:before,
.vertical-tab .nav-tabs li.active a:hover:before{
    width: 100%;
    opacity: 0;
}
.vertical-tab .tab-content{
    color: #888;
    background: transparent;
    font-size: 13px;
    letter-spacing: 0.5px;
    line-height: 21px;
    padding: 15px 15px 10px 15px;
    display: table-cell;
}
.vertical-tab .tab-content h3{
    color: #2e86de;
    font-size: 18px;
    font-weight: 600;
    text-transform: capitalize;
    margin: 0 0 4px;
}
@media only screen and (max-width: 479px){
    .vertical-tab .nav-tabs{
        width: 100%;
        display: block;
    }
    .vertical-tab .nav-tabs li:last-child a{ margin: 0; }
    .vertical-tab .tab-content{
        font-size: 14px;
        display: block;
    }
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="vertical-tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">Section 1</a></li>
                    <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">Section 2</a></li>
                    <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">Section 3</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                        <h3>Section 1</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius, mi eros viverra massa.</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section2">
                        <h3>Section 2</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius, mi eros viverra massa.</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section3">
                        <h3>Section 3</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper, magna a ultricies volutpat, mi eros viverra massa, vitae consequat nisi justo in tortor. Proin accumsan felis ac felis dapibus, non iaculis mi varius, mi eros viverra massa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://pagead2.googlesyndication.com/pagead/managed/js/adsense/m202305300101/show_ads_impl_fy2021.js" id="google_shimpl"></script><script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

@endsection
