<header class="header">
  <div class="logo">
    <img src="assets/punch-clock-light.svg" alt="PunchClock">
  </div>

  <div onclick="toggleSidebar()" class="toggle-menu mx-3">
    <i class="icofont-navigation-menu"></i>
  </div>

  <div class="spacer"></div>

  <div class="dropdown me-3">
    <div class="dropdown-button">
      <img class="avatar me-3" src="{{'https://i.pravatar.cc/40?u=' . $user->email}}" alt="{{ $user->bame }}">
      <span>{{ $user->name }}</span>
      <i class="icofont-simple-down ms-2"></i>
    </div>
    <div class="dropdown-content">
      <ul class="nav-list">
        <li class="nav-item">
          <a href="/logout">
            <i class="icofont-logout p-2"></i>
            Sair
          </a>
        </li>
      </ul>
    </div>
  </div>
</header>
