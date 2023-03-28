<ul class="header-navbar align-items-center floating-nav navbar-light nav nav-tabs" role="tablist" style="margin-top: -50px; z-index:1;">
    <li class="nav-item">
      <a
        class="nav-link {{Route::currentRouteName() == 'user-list' ? 'active' :''}}"
        id="home-tab"
        href="{{url('admin/user')}}"
        aria-controls="home"
        role="tab"
        aria-selected="true"
        >Overview</a
      >
    </li>
    <li class="nav-item">
      <a
        class="nav-link {{Route::currentRouteName() == 'hospital-list' ? 'active' :''}}"
        id="profile-tab"
        href="{{url('admin/hospital')}}"
        aria-controls="profile"
        role="tab"
        aria-selected="false"
        >List</a
      >
    </li>
    <li class="nav-item">
        <a
          class="nav-link {{Route::currentRouteName() == 'hospital-add' ? 'active' :''}}"
          id="profile-tab"
          href="{{url('admin/hospital/add')}}"
          aria-controls="profile"
          role="tab"
          aria-selected="false"
          >Register New Hospital</a
        >
      </li>
    <li class="nav-item">
        <a
          class="nav-link {{Route::currentRouteName() == 'register-user' ? 'active' :''}}"
          id="profile-tab"
          href="{{url('admin/user/add')}}"
          aria-controls="profile"
          role="tab"
          aria-selected="false"
          >Preview</a
        >
      </li>
    @if (Route::currentRouteName() == 'edit')
        <li class="nav-item">
        <a
          class="nav-link {{Route::currentRouteName() == 'edit' ? 'active' :''}}"
          id="about-tab"
          href="{{url('admin/user/edit')}}"
          aria-controls="about"
          role="tab"
          aria-selected="false"
          >Edit</a
        >
      </li>
    @endif

  </ul>
  <hr>
