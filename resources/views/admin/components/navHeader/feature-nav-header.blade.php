<ul class="tablehead">
    <li class="nav-item marlin">
        <a
          class="nav-link {{Route::currentRouteName() == 'feature-list' ? 'active' :''}}"
          id="home-tab"
          href="{{url('admin/feature')}}"
          aria-controls="home"
          role="tab"
          aria-selected="true"
          ><i class="headfotn" data-feather="list" data-ticon="list"></i>List</a
        >
      </li>
    <li class="nav-item marlin">
      <a
        class="nav-link {{Route::currentRouteName() == 'feature-add' ? 'active' :''}}"
        id="profile-tab"
        href="{{url('admin/feature/add')}}"
        aria-controls="profile"
        role="tab"
        aria-selected="false"
        ><i class="headfotn" data-feather="plus" data-ticon="plus"></i>Add</a
      >
    </li>
    @if (Route::currentRouteName() == 'feature-edit')
        <li class="nav-item marlin">
        <a
          class="nav-link {{Route::currentRouteName() == 'feature-edit' ? 'active' :''}}"
          id="about-tab"
          href="{{url('admin/feature/edit')}}"
          aria-controls="about"
          role="tab"
          aria-selected="false"
          > <i class="headfotn" data-feather="edit" data-ticon="edit"></i>Edit</a
        >
      </li>
    @endif

  </ul>
  <hr>
