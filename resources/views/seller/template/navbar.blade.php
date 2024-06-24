<nav
	class="layout-navbar  navbar navbar-expand-xl align-items-center bg-navbar-theme"
	id="layout-navbar"
	style="position: -webkit-sticky; padding-right: 10px; position: sticky; top: 0;z-index: 1;" >
	<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
		<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
			<i class="bx bx-menu bx-sm"></i>
		</a>
	</div>

	<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


		<ul class="navbar-nav flex-row align-items-center ms-auto">


			<!-- Nama yang login -->
            <li class="nav-item lh-1 me-3">
                <a href="{{url('/')}}">

                    <button class="btn btn-primary">Belanja</button>
                </a>
            </li>
			<li class="nav-item lh-1 me-3">
				{{$user->username}}
			</li>

			<!-- User -->
			<li class="nav-item navbar-dropdown dropdown-user dropdown">
				<a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
					<div class="avatar ">
						<img src="{{asset('img/down.png')}}" alt class="w-px-40 h-auto rounded-circle" />
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li>
						<a class="dropdown-item" href="#">
							<div class="d-flex">
								<div class="flex-shrink-0 me-3">
									<div class="avatar avatar-online">
										<img src="" alt class="w-px-40 h-auto rounded-circle" />
									</div>
								</div>
								<div class="flex-grow-1">
									<span class="fw-semibold d-block">{{$user->username}}</span>
									<small class="text-muted">{{$user->email}}</small>
								</div>
							</div>
						</a>
					</li>





					<li>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" style="background: transparent; border:none">
                            <a class="dropdown-item">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out </span>
                            </a>
                        </button>
                        </form>
					</li>
				</ul>
			</li>
			<!--/ User -->
		</ul>
	</div>
</nav>
