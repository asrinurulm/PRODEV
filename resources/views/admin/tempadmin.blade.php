<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <link href="{{ asset('img/prod.png') }}" rel="icon">
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('build/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('lib/advanced-datatable/css/jquery.dataTables.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}">
    <link href="{{ URL::asset('css/dataTables.min.css') }}">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col" style="min-height:1280;">
          <div class="left_col scroll-view" >
            <div class="navbar nav_title" style="border: 2;">
              <a href="{{route('lala')}}" class="site_title"><i class="fa fa-laptop"></i><img src="{{ asset('img/logo.png') }}" width="70%" alt="..."></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
					  <div class="profile clearfix">
            <center>
              <a href="{{route('lala')}}"><img style="width:110px" src="{{ asset('img/pro.png') }}" alt="..." class="profile_img"></a><br>
              <span style="font-weight: bold;color:white;">Welcome, {{ Auth::user()->role->role }}</span>
                @if( auth()->check() )
                <h2 style="color:white;">{{ Auth::user()->name }}</h2>
                @endif</center>
              <div class="clearfix"></div>
            </div><br>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img width="30px" height="30px" src="{{ asset('img/pro.png') }}" alt="">{{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('MyProfile') }}"> Profile</a></li>
                    <li><a href="{{ route('signout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
          @yield('content')
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="text-right">
            Created By Asrul4238 :)
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  
    <!-- jQuery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('lib/dropzoneJS/dropzone.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" language="javascript" src="{{ asset('lib/advanced-datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js')}}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('build/js/custom.min.js') }}"></script>
    <script>
      $(document).ready(function(){
      //ajax setup
      $.ajaxSetup({
        headers:{
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
          }
        });
      });
    </script>
    <script src="{{ asset('vendors/validator/validator.js') }}"></script>
    @yield('s')

    <script type="text/javascript">$('.Table').DataTable({
      "language": {
        "search": "Cari :",
        "lengthMenu": "Tampilkan _MENU_ data",
        "zeroRecords": "Tidak ada data",
        "emptyTable": "Tidak ada data",
        "info": "Menampilkan data _START_  - _END_  dari _TOTAL_ data",
        "infoEmpty": "Tidak ada data",
        "paginate": {
          "first": "Awal",
          "last": "Akhir",
          "next": ">",
          "previous": "<"
        }
      }
      });
    </script>
  </body>
</html>
