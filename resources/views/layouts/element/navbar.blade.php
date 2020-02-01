<!-- Navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="javascript:;">
        Wikrama Shop
    </a>
    <!-- User -->
    <ul class="navbar-nav align-items-center d-none d-md-flex">
        <li class="nav-item dropdown">
            <a class="nav-link pb-3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ni ni-bell-55"></i>
              <span class="text-white font-weight-bold">
                  {{ @$hitung }}

                  
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right dropdown-menu-xl ">
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                    <h1 class="text-muted">
                      <strong class="text-primary">
                          Stok Hampir Habis
                      </strong>
                    </h1>
                </div>
                <!-- List group -->
                <div class="list-group list-group-flush">
                    
                    @foreach($sisas as $s)

                    <a href="#!" class="list-group-item list-group-item-action">
                      <div class="row align-items-center">

                          <div class="col ml--2 px-4">
                            <div class="d-flex justify-content-between align-items-center">
                              <div>
                                <h1 class="mb-0 text-lg text-dark">
                                   {{ ucwords($s->name.' - '.$s->unit->name) }}
                                </h1>
                              </div>
                              <div class="text-right text-muted">
                                <small>
                                    Stok Sekarang. {{ number_format( $s->stok ) }}
                                </small>
                              </div>
                            </div>
                            <p class="text-sm mb-0">
                                
                            </p>
                          </div>
                      </div>
                    </a>
                    @endforeach
                </div>
                <div class="pl-4 pr-4 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="text-primary">
                                <strong>
                                    
                                </strong>
                            </h2>
                        </div>
                        <div class="text-right">
                            <h2 class="text-muted">
                                <strong>
                                    
                                </strong>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="px-3 py-3">
                    <a href="{{ route('suppliers.index') }}" class="text-white text-lg font-weight-bold">
                        <div class="bg-primary text-center p-2">
                            Lihat
                        </div>
                    </a>
                </div>

            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link pb-3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ni ni-cart"></i>
              <span class="text-white font-weight-bold">
                  {{ @$count }}
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right dropdown-menu-xl ">
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                    <h1 class="text-muted">
                      <strong class="text-primary">
                          Keranjang
                      </strong>
                    </h1>
                </div>
                <!-- List group -->
                <div class="list-group list-group-flush">
                    @foreach (@$carts as $c)
                    <a href="#!" class="list-group-item list-group-item-action">
                      <div class="row align-items-center">

                          <div class="col ml--2 px-4">
                            <div class="d-flex justify-content-between align-items-center">
                              <div>
                                <h1 class="mb-0 text-lg text-dark">
                                    {{ ucwords($c->product->name.' - '.$c->product->unit->name) }}
                                </h1>
                              </div>
                              <div class="text-right text-muted">
                                <small>
                                    Rp. {{ number_format( $c->qty * $c->product->harga_jual ) }}
                                </small>
                              </div>
                            </div>
                            <p class="text-sm mb-0">
                                {{ $c->qty}} &#10005; Rp {{ number_format($c->product->harga_jual) }}
                            </p>
                          </div>
                      </div>
                    </a>
                    @endforeach
                </div>
                <div class="pl-4 pr-4 pt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="text-primary">
                                <strong>
                                    Subtotal
                                </strong>
                            </h2>
                        </div>
                        <div class="text-right">
                            <h2 class="text-muted">
                                <strong>
                                    Rp. {{ number_format( $subtotal ) }}
                                </strong>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="px-3 py-3">
                    <a href="{{ route('orders.create') }}" class="text-white text-lg font-weight-bold">
                        <div class="bg-primary text-center p-2">
                            Bayar
                        </div>
                    </a>
                </div>

            </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{asset('assets/img/man-1.png')}}">
              </span>
              <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">
                      {{ Auth::user()->name }}
                  </span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0 text-red">Welcome!</h6>
            </div>
            <a href="javascript:;" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
        </li>
    </ul>
  </div>
</nav>
