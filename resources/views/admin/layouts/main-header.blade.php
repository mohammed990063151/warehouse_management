<header class="main-header">

	{{--<!-- Logo -->--}}
	<a href="{{ asset('dashboard') }}/index2.html" class="logo">
		{{--<!-- mini logo for sidebar mini 50x50 pixels -->--}}
		<span class="logo-mini"><b>O</b>TC</span>
		<span class="logo-lg"><b>Obiy</b>TradingCompany</span>
	</a>

	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">

				<!-- Messages: style can be found in dropdown.less-->
				{{-- <li class="dropdown messages-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope-o"></i>
						<span class="label label-success">4</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">You have 4 messages</li>
						<li>
							<!-- inner menu: contains the actual data -->
							<ul class="menu">
								<li><!-- start message -->
									<a href="#">
										<div class="pull-left">
											<img src="{{ asset('dashboard_files/img/user2-160x160.png') }}" class="img-circle" alt="User Image">
										</div>
										<h4>
											Support Team
											<small>
												<i class="fa fa-clock-o"></i> 5 mins
											</small>
										</h4>
										<p>Why not buy a new awesome theme?</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="footer">
							<a href="#">See All Messages</a>
						</li>
					</ul>
				</li> --}}

				{{--<!-- Notifications: style can be found in dropdown.less -->--}}
				{{-- <li class="dropdown notifications-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i>
						<span class="label label-warning">10</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">You have 10 notifications</li>
						<li>
							<!-- inner menu: contains the actual data -->
							<ul class="menu">
								<li>
									<a href="#">
										<i class="fa fa-users text-aqua"></i> 5 new members joined today
									</a>
								</li>
							</ul>
						</li>
						<li class="footer">
							<a href="#">View all</a>
						</li>
					</ul>
				</li> --}}
				<li class="dropdown notifications-menu">
					<a href="#" class="dropdown-toggle "  data-target="#exampleModal1"  data-toggle="modal">
						<i class="fa fa-calculator"></i>
						
					</a>
					
				</li>

				{{--<!-- Tasks: style can be found in dropdown.less -->--}}
				<li class="dropdown tasks-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i></a>
					<ul class="dropdown-menu">
						<li>
							{{--<!-- inner menu: contains the actual data -->--}}
							<ul class="menu">
								@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
									<li>
										<a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" style="
										color: #000;">
											{{ $properties['native'] }}
										</a>
									</li>
								@endforeach
							</ul>
						</li>
					</ul>
				</li>

				{{--<!-- User Account: style can be found in dropdown.less -->--}}
				<li class="dropdown user user-menu">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{ asset('dashboard_files/img/user2-160x160.png') }}" class="user-image" alt="User Image">
						{{-- <span class="hidden-xs">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span> --}}
					</a>
					<ul class="dropdown-menu">

						{{--<!-- User image -->--}}
						<li class="user-header">
							<img src="{{ asset('dashboard_files/img/user2-160x160.png') }}" width="10px" class="img-circle" style="
							height: 125px;
							width: auto;
							border-radius: 50%;
						" alt="User Image">

							<p>
								{{-- {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} --}}
								<small>{{ Auth::user()->email }}</small>
							</p>
						</li>

						{{--<!-- Menu Footer-->--}}
						<li class="user-footer">


							<a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();">@lang('site.logout')</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>

						</li>
					</ul>
				</li>
			</ul>
		</div>



		<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">آلة حاسبة</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
		
					<div class="calculator-grid">
						<div class="output">
						  <div data-previous-operand class="previous-operand"></div>
						  <div data-current-operand class="current-operand"></div>
						</div>
						<button data-all-clear class="span-two">AC</button>
						<button data-delete>DEL</button>
						<button data-operation>÷</button>
						<button data-number>1</button>
						<button data-number>2</button>
						<button data-number>3</button>
						<button data-operation>*</button>
						<button data-number>4</button>
						<button data-number>5</button>
						<button data-number>6</button>
						<button data-operation>+</button>
						<button data-number>7</button>
						<button data-number>8</button>
						<button data-number>9</button>
						<button data-operation>-</button>
						<button data-number>.</button>
						<button data-number>0</button>
						<button data-equals class="span-two">=</button>
					  </div>
			   
			  </div>
			</div>
		</div>
</nav>

</header>