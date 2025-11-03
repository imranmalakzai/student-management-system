<nav class="navbar navbar-expand-lg navbar-custom ">
  <div class="container-fluid d-flex justify-content-between align-items-center">

    <!-- Search box -->
    <form class="search-box">
      <i class="fa fa-search"></i>
      <input type="search" placeholder="Search your content..." aria-label="Search">

    </form>

    <!-- Icons and profile -->
    <div class="d-flex align-items-center">
      <div class="icons">
        <button class="icon-btn"><i class="fa-regular fa-envelope"></i></button>
        <button id="language" class="icon-btn">EN</button>
        <button id="themeToggle" class="icon-btn">
          <i id="themeIcon" class="fa-regular fa-moon"></i>
        </button>

      </div>

      <div class="dropdown ms-3">
        <a href="#" class="d-flex looka align-items-center text-decoration-none dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="online position-relative">
            <img src="assets/img/user3.png" class="user">
          </div>
          <div class="profile-text">
            <strong data-translate="name1">Jason Ranti</strong><br>
          </div>
        </a>
        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
          <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user me-2"></i><span data-translate="profile">profile</span></a></li>
          <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear me-2"></i><span data-translate="settings">settings</span></a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a id="logoutBtn" class="dropdown-item" href="#">
              <i class="fa-solid fa-right-from-bracket me-2"></i><span data-translate="loggout">loggout</span>
            </a>
          </li>

        </ul>
      </div>
    </div>
  </div>
</nav>

<style>
  .navbar-custom {
    padding: 0.75rem 1.5rem;
  }

  .search-box {
    min-width: 70%;
    display: flex;
    align-items: center;
    background-color: #ffffff;
    padding: 10px 20px;
    border-radius: 50px;
    gap: 10px;
  }

  .search-box input {
    background: transparent;
    outline: none;
    border: none;

  }

  .online::after {
    content: "";
    width: 12px;
    height: 12px;
    border: 2px solid #fff;
    border-radius: 50%;
    right: 0px;
    top: 0px;
    background: #41db51;
    position: absolute;
  }

  .icon-btn {
    border: 1px solid #ccc;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    margin-right: 0.75rem;
    transition: all 0.2s ease;
  }

  .profile-text small {
    color: gray;
    font-size: 0.85rem;
  }

  .profile-text {
    margin-left: 10px;
  }

  .icons {
    border-right: 1px solid #ccc;
    display: flex;
  }

  .profile-text strong {
    color: #000;
  }

  .user {
    height: 50px;
    width: 50px;
    border-radius: 50%;
    object-fit: cover;
    padding: 5px;
    background-color: #e2d4fbff;
  }

  .icon-btn:hover {
    background: #f0f0f0;
  }

  .icon-btn.active {
    background: #6f42c1;
    color: white;
  }

  .looka {
    color: #000;
  }

  .profile-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .profile-info img {
    width: 36px;
    height: 36px;
    border-radius: 50%;
  }

  .profile-text {
    line-height: 1.2;
  }

  .profile-text small {
    color: gray;
    font-size: 0.85rem;
  }

  nav {
    margin-left: 264px;
  }
</style>

<script src="js/bg.js"></script>
<script src="Admin/logout.js"></script>