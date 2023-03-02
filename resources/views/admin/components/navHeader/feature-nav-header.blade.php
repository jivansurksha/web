<ul class="header-navbar align-items-center floating-nav navbar-light nav nav-tabs" role="tablist" style="margin-top: -50px; z-index:1;">
    <li class="nav-item">
      <a
        class="nav-link {{Route::currentRouteName() == 'feature-list' ? 'active' :''}}"
        id="home-tab"
        href="{{url('admin/feature')}}"
        aria-controls="home"
        role="tab"
        aria-selected="true"
        >List</a
      >
    </li>
    <li class="nav-item">
      <a
        class="nav-link {{Route::currentRouteName() == 'feature-add' ? 'active' :''}}"
        id="profile-tab"
        href="{{url('admin/feature/add')}}"
        aria-controls="profile"
        role="tab"
        aria-selected="false"
        >Add</a
      >
    </li>
    @if (Route::currentRouteName() == 'feature-edit')
        <li class="nav-item">
        <a
          class="nav-link {{Route::currentRouteName() == 'feature-edit' ? 'active' :''}}"
          id="about-tab"
          href="{{url('admin/feature/edit')}}"
          aria-controls="about"
          role="tab"
          aria-selected="false"
          >Edit</a
        >
      </li>
    @endif

  </ul>
  <hr>
