<ul class="header-navbar align-items-center floating-nav navbar-light nav nav-tabs" role="tablist" style="margin-top: -50px; z-index:1;">
    <li class="nav-item">
      <a
        class="nav-link {{Route::currentRouteName() == 'commission-list' ? 'active' :''}}"
        id="home-tab"
        href="{{url('admin/commission')}}"
        aria-controls="home"
        role="tab"
        aria-selected="true"
        >List</a
      >
    </li>
    <li class="nav-item">
      <a
        class="nav-link {{Route::currentRouteName() == 'commission-add' ? 'active' :''}}"
        id="profile-tab"
        href="{{url('admin/commission/add')}}"
        aria-controls="profile"
        role="tab"
        aria-selected="false"
        >Add</a
      >
    </li>
    @if (Route::currentRouteName() == 'commission-edit')
        <li class="nav-item">
        <a
          class="nav-link {{Route::currentRouteName() == 'commission-edit' ? 'active' :''}}"
          id="about-tab"
          href="{{url('admin/commission/edit')}}"
          aria-controls="about"
          role="tab"
          aria-selected="false"
          >Edit</a
        >
      </li>
    @endif

  </ul>
  <hr>
