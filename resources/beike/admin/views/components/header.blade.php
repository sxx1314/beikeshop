<div class="header-content d-none d-lg-block">
  <div class="header-wrap">
    <div class="header-left">
      <div class="logo">
        <a href=""><img src="{{ asset('image/logo.png') }}" class="img-fluid"></a>
        {{-- <div class="text-center"><h5 class="mb-0">beike admin</h5></div> --}}
      </div>
    </div>
    <div class="header-right">
      <ul class="navbar navbar-left">
        @foreach ($links as $link)
          <li class="nav-item {{ $link['active'] ? 'active' : '' }}"><a href="{{ $link['url'] }}" class="nav-link">{{ $link['title'] }}</a></li>
        @endforeach
      </ul>
      <ul class="navbar navbar-right">
        <li class="nav-item">
          <a href="{{ admin_route('marketing.index') }}" class="nav-link"><i class="bi bi-gem"></i>&nbsp;@lang('admin/common.marketing')</a>
        </li>
        <li class="nav-item">
          <a target="_blank" href="{{ shop_route('home.index') }}" class="nav-link"><i class="bi bi-send me-1"></i> @lang('admin/common.access_frontend')</a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown">{{ $admin_language['name'] }}</a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              @foreach ($admin_languages as $language)
              <li><a href="{{ admin_route('edit.locale', ['locale' => $language['code']]) }}" class="dropdown-item">{{ $language['name'] }}</a></li>
              @endforeach
            </ul>
          </div>
        </li>
        <li class="nav-item me-3">
          <div class="dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              {{-- <img src="http://dummyimage.com/100x100" class="avatar img-fluid rounded-circle me-1"> --}}
              <span class="text-dark ml-2">{{ current_user()->name }}</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
              <li><a href="{{ admin_route('logout.index') }}" class="dropdown-item"><i class="bi bi-box-arrow-left"></i> {{ __('common.sign_out') }}</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="header-mobile d-lg-none">
  <div class="header-mobile-wrap">

    <div class="header-mobile-left">
      <div class="mobile-open-menu"><i class="bi bi-list"></i></div>

    </div>

    <div class="logo">
      <a href=""><img src="{{ asset('image/logo.png') }}" class="img-fluid"></a>
    </div>

    <div class="header-mobile-right">
      <div class="mobile-to-front">
        <a target="_blank" href="{{ shop_route('home.index') }}" class="nav-divnk"><i class="bi bi-send"></i></a>
      </div>
    </div>

  </div>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas-mobile-menu">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-bold" id="offcanvasWithBothOptionsLabel">{{ __('common.menu') }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body mobile-menu-wrap">
    @if (is_mobile())
      <ul class="mobile-navbar">
        @foreach ($links as $link)
          <li class="nav-item {{ $link['active'] ? 'active' : '' }}">
            <a href="{{ $link['url'] }}" class="nav-link">{{ $link['title'] }}</a>
            @if ($link['active'])
            <x-admin-sidebar />
            @endif
          </li>
        @endforeach
      </ul>
    @endif
  </div>

  <div class="offcanvas-footer">
    <div class="offcanvas-btns">
      <div class="lang">
        <div class="dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="javascript:void(0)" data-bs-toggle="dropdown">{{ $admin_language['name'] }}</a>

          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            @foreach ($admin_languages as $language)
            <li><a href="{{ admin_route('edit.locale', ['locale' => $language['code']]) }}" class="dropdown-item">{{ $language['name'] }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="user">
        <a href="{{ admin_route('logout.index') }}" class="nav-link text-dark"><i class="bi bi-box-arrow-left"></i> {{ __('common.sign_out') }}</a>
      </div>
    </div>
  </div>
</div>
