<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{asset('img/logo-fav.png')}}">
    <title>{{-- {{ config('app.name', 'Laravel') }} --}}Manager </title>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/perfect-scrollbar/css/perfect-scrollbar.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/material-design-icons/css/material-design-iconic-font.min.css')}}"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/datatables/css/dataTables.bootstrap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/select2/css/select2.min.css') }} "/>

    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('css/mine.css')}}" type="text/css"/>
</head>
<body>
<div class="be-wrapper">
  <nav class="navbar navbar-default navbar-fixed-top be-top-header">
    <div class="container-fluid">
      <div class="navbar-header"><a href="{{ url('manager/dashboard') }}" class="navbar-brand"></a></div>
      <div class="be-right-navbar">
        <ul class="nav navbar-nav navbar-right be-user-nav">
          <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="{{asset('img/avatar.png')}}" alt="Avatar"><span class="user-name">Túpac Amaru</span></a>
            <ul role="menu" class="dropdown-menu">
              <li>
                <div class="user-info">
                  <div class="user-name">{{ Auth::user()->name }}</div>
                  <div class="user-position online">Available</div>
                </div>
              </li>
{{--               <li><a href="#"><span class="icon mdi mdi-face"></span> Account</a></li>
              <li><a href="#"><span class="icon mdi mdi-settings"></span> Settings</a></li> --}}
              <li>
                <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <span class="icon mdi mdi-power"></span> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>
            </ul>
          </li>
        </ul>
        @if(Auth::user()->role=='manager')
        <div class="page-title"><span>Bengkel Kece Manager</span></div>
        @else
        <div class="page-title"><span>Bengkel Kece Kasir</span></div>
        @endif

      </div>
    </div>
  </nav>
  <div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Blank Page</a>
      <div class="left-sidebar-spacer">
        <div class="left-sidebar-scroll">
          <div class="left-sidebar-content">
            <ul class="sidebar-elements">
              <li class="divider">Menu</li>

              <li class="{{ \Request::is('manager/dashboard*') ?'active':'' }}"><a href="{{route('manager.home')}}"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a></li>
              <li class="{{ \Request::is('manager/sparepart*') ?'active':'' }}"><a href="{{url('manager/sparepart')}}"><i class="icon mdi mdi-shape"></i><span>Spare Part</span></a></li>
              <li class="{{ \Request::is('manager/servis*') ?'active':'' }}"><a href="{{url('manager/servis')}}"><i class="icon mdi mdi-bike"></i><span>Service</span></a></li>
              <li class="{{ \Request::is('manager/montir*') ?'active':'' }}"><a href="{{url('manager/montir')}}"><i class="icon mdi mdi-accounts-alt"></i><span>Montir</span></a></li>
              <li class="{{ \Request::is('manager/kasir*') ?'active':'' }}"><a href="{{url('manager/kasir')}}"><i class="icon mdi mdi-face"></i><span>Kasir</span></a></li>
              <li class="{{ \Request::is('manager/pelanggan*') ?'active':'' }}"><a href="{{url('manager/pelanggan')}}"><i class="icon mdi mdi-accounts"></i><span>Pelanggan</span></a></li>
              <li class="{{ \Request::is('manager/transaksi*') ?'active':'' }}"><a href="{{url('manager/transaksi')}}"><i class="icon mdi mdi-money-box"></i><span>Transaksi</span></a></li>
              <li class="{{ \Request::is('manager/pembelian_part*') ?'active':'' }}"><a href="{{url('manager/pembelian_part')}}"><i class="icon mdi mdi-shape"></i><span>Pembelian Part</span></a></li>
              <li class="{{ \Request::is('manager/cancel_request*') ?'active':'' }}"><a href="{{url('manager/cancel_request')}}"><i class="icon mdi mdi-money-box"></i><span>Request Pembatalan</span></a></li>
              <li class="{{ \Request::is('manager/penyesuaian_stok*') ?'active':'' }}"><a href="{{url('manager/penyesuaian_stok')}}"><i class="icon mdi mdi-shape"></i><span>Penyesuaian Stok</span></a></li>
              <li class="{{ \Request::is('manager/laporan_range*') ?'active':'' }}"><a href="{{url('manager/laporan_range')}}"><i class="icon mdi mdi-book"></i><span>Laporan</span></a></li>
              <li class="{{ \Request::is('manager/laporan') ?'active':'' }}"><a href="{{url('manager/laporan')}}"><i class="icon mdi mdi-book"></i><span>Laporan Harian</span></a></li>
              <li class="{{ \Request::is('manager/laporan_bulanan*') ?'active':'' }}"><a href="{{url('manager/laporan_bulanan')}}"><i class="icon mdi mdi-book"></i><span>Laporan Bulanan</span></a></li>
              <li class="{{ \Request::is('manager/laporan_tahunan*') ?'active':'' }}"><a href="{{url('manager/laporan_tahunan')}}"><i class="icon mdi mdi-book"></i><span>Laporan Tahunan</span></a></li>
              <li class="{{ \Request::is('manager/laporan_part*') ?'active':'' }}"><a href="{{url('manager/laporan_part')}}"><i class="icon mdi mdi-book"></i><span>Laporan Penjualan Part</span></a></li>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="be-content">
    @yield('content')
  </div>
  <nav class="be-right-sidebar">
    <div class="sb-content">
      <div class="tab-navigation">
        <ul role="tablist" class="nav nav-tabs nav-justified">
          <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Chat</a></li>
          <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Todo</a></li>
          <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Settings</a></li>
        </ul>
      </div>
      <div class="tab-panel">
        <div class="tab-content">
          <div id="tab1" role="tabpanel" class="tab-pane tab-chat active">
            <div class="chat-contacts">
              <div class="chat-sections">
                <div class="be-scroller">
                  <div class="content">
                    <h2>Recent</h2>
                    <div class="contact-list contact-list-recent">
                      <div class="user"><a href="#"><img src="{{asset('img/avatar1.png')}}" alt="Avatar">
                          <div class="user-data"><span class="status away"></span><span class="name">Claire Sassu</span><span class="message">Can you share the...</span></div></a></div>
                      <div class="user"><a href="#"><img src="{{asset('img/avatar2.png')}}" alt="Avatar">
                          <div class="user-data"><span class="status"></span><span class="name">Maggie jackson</span><span class="message">I confirmed the info.</span></div></a></div>
                      <div class="user"><a href="#"><img src="{{asset('img/avatar3.png')}}" alt="Avatar">
                          <div class="user-data"><span class="status offline"></span><span class="name">Joel King       </span><span class="message">Ready for the meeti...</span></div></a></div>
                    </div>
                    <h2>Contacts</h2>
                    <div class="contact-list">
                      <div class="user"><a href="#"><img src="{{asset('img/avatar4.png')}}" alt="Avatar">
                          <div class="user-data2"><span class="status"></span><span class="name">Mike Bolthort</span></div></a></div>
                      <div class="user"><a href="#"><img src="{{asset('img/avatar5.png')}}" alt="Avatar">
                          <div class="user-data2"><span class="status"></span><span class="name">Maggie jackson</span></div></a></div>
                      <div class="user"><a href="#"><img src="{{asset('img/avatar6.png')}}" alt="Avatar">
                          <div class="user-data2"><span class="status offline"></span><span class="name">Jhon Voltemar</span></div></a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bottom-input">
                <input type="text" placeholder="Search..." name="q"><span class="mdi mdi-search"></span>
              </div>
            </div>
            <div class="chat-window">
              <div class="title">
                <div class="user"><img src="{{asset('img/avatar2.png')}}" alt="Avatar">
                  <h2>Maggie jackson</h2><span>Active 1h ago</span>
                </div><span class="icon return mdi mdi-chevron-left"></span>
              </div>
              <div class="chat-messages">
                <div class="be-scroller">
                  <div class="content">
                    <ul>
                      <li class="friend">
                        <div class="msg">Hello</div>
                      </li>
                      <li class="self">
                        <div class="msg">Hi, how are you?</div>
                      </li>
                      <li class="friend">
                        <div class="msg">Good, I'll need support with my pc</div>
                      </li>
                      <li class="self">
                        <div class="msg">Sure, just tell me what is going on with your computer?</div>
                      </li>
                      <li class="friend">
                        <div class="msg">I don't know it just turns off suddenly</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="chat-input">
                <div class="input-wrapper"><span class="photo mdi mdi-camera"></span>
                  <input type="text" placeholder="Message..." name="q" autocomplete="off"><span class="send-msg mdi mdi-mail-send"></span>
                </div>
              </div>
            </div>
          </div>
          <div id="tab2" role="tabpanel" class="tab-pane tab-todo">
            <div class="todo-container">
              <div class="todo-wrapper">
                <div class="be-scroller">
                  <div class="todo-content"><span class="category-title">Today</span>
                    <ul class="todo-list">
                      <li>
                        <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                          <input id="todo1" type="checkbox" checked="">
                          <label for="todo1">Initialize the project</label>
                        </div>
                      </li>
                      <li>
                        <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                          <input id="todo2" type="checkbox">
                          <label for="todo2">Create the main structure</label>
                        </div>
                      </li>
                      <li>
                        <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                          <input id="todo3" type="checkbox">
                          <label for="todo3">Updates changes to GitHub</label>
                        </div>
                      </li>
                    </ul><span class="category-title">Tomorrow</span>
                    <ul class="todo-list">
                      <li>
                        <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                          <input id="todo4" type="checkbox">
                          <label for="todo4">Initialize the project</label>
                        </div>
                      </li>
                      <li>
                        <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                          <input id="todo5" type="checkbox">
                          <label for="todo5">Create the main structure</label>
                        </div>
                      </li>
                      <li>
                        <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                          <input id="todo6" type="checkbox">
                          <label for="todo6">Updates changes to GitHub</label>
                        </div>
                      </li>
                      <li>
                        <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                          <input id="todo7" type="checkbox">
                          <label for="todo7" title="This task is too long to be displayed in a normal space!">This task is too long to be displayed in a normal space!</label>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="bottom-input">
                <input type="text" placeholder="Create new task..." name="q"><span class="mdi mdi-plus"></span>
              </div>
            </div>
          </div>
          <div id="tab3" role="tabpanel" class="tab-pane tab-settings">
            <div class="settings-wrapper">
              <div class="be-scroller"><span class="category-title">General</span>
                <ul class="settings-list">
                  <li>
                    <div class="switch-button switch-button-sm">
                      <input type="checkbox" checked="" name="st1" id="st1"><span>
                        <label for="st1"></label></span>
                    </div><span class="name">Available</span>
                  </li>
                  <li>
                    <div class="switch-button switch-button-sm">
                      <input type="checkbox" checked="" name="st2" id="st2"><span>
                        <label for="st2"></label></span>
                    </div><span class="name">Enable notifications</span>
                  </li>
                  <li>
                    <div class="switch-button switch-button-sm">
                      <input type="checkbox" checked="" name="st3" id="st3"><span>
                        <label for="st3"></label></span>
                    </div><span class="name">Login with Facebook</span>
                  </li>
                </ul><span class="category-title">Notifications</span>
                <ul class="settings-list">
                  <li>
                    <div class="switch-button switch-button-sm">
                      <input type="checkbox" name="st4" id="st4"><span>
                        <label for="st4"></label></span>
                    </div><span class="name">Email notifications</span>
                  </li>
                  <li>
                    <div class="switch-button switch-button-sm">
                      <input type="checkbox" checked="" name="st5" id="st5"><span>
                        <label for="st5"></label></span>
                    </div><span class="name">Project updates</span>
                  </li>
                  <li>
                    <div class="switch-button switch-button-sm">
                      <input type="checkbox" checked="" name="st6" id="st6"><span>
                        <label for="st6"></label></span>
                    </div><span class="name">New comments</span>
                  </li>
                  <li>
                    <div class="switch-button switch-button-sm">
                      <input type="checkbox" name="st7" id="st7"><span>
                        <label for="st7"></label></span>
                    </div><span class="name">Chat messages</span>
                  </li>
                </ul><span class="category-title">Workflow</span>
                <ul class="settings-list">
                  <li>
                    <div class="switch-button switch-button-sm">
                      <input type="checkbox" name="st8" id="st8"><span>
                        <label for="st8"></label></span>
                    </div><span class="name">Deploy on commit</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</div>
<script src="{{asset('lib/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/main.js')}}" type="text/javascript"></script>
<script src="{{asset('lib/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('lib/datatables/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/datatables/js/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/app-form-elements.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        //initialize the javascript
      App.init();
      App.formElements();

      $(".numeric").keydown(function (e) {
          // Allow: backspace, delete, tab, escape, enter and .
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
               // Allow: Ctrl+A, Command+A
              (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
               // Allow: home, end, left, right, down, up
              (e.keyCode >= 35 && e.keyCode <= 40)) {
                   // let it happen, don't do anything
                   return;
          }
          // Ensure that it is a number and stop the keypress
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }

      });
      $(".img-prev").click(function(){
        $(this).prev().click();
      });
      $(".file-hidden").change(function() {
        readURL(this);
      });

    });
    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $(input).next().attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }


</script>
@yield('script')

</body>
</html>
