<!-- Fixed Sidebar -->
<div class="sidebar black-sidebar">
  <div class="logo">
    <div class="logo-content">
      <img src="assets/img/logo2.png" width="60px" alt="Logo">
      <span class="title">VICTOR</span>
    </div>
    <i class="fa-solid fa-circle-chevron-left"></i>
  </div>

  <ul class="nav flex-column">
    <!-- <li class="nav-heading">Core</li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
        <i class="fas fa-tachometer-alt me-2"></i>
        <span data-translate="dashboard">Dashboard</span>
      </a>
    </li> -->

    <li class="nav-heading" data-translate="home">HOME</li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
        <i class="fas fa-tachometer-alt me-2"></i>
        <span data-translate="dashboard">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'province.php' ? 'active' : ''; ?>" href="province.php">
        <i class="fas fa-map me-2"></i>
        <span data-translate="provinces">Provinces</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'districts.php' ? 'active' : ''; ?>" href="districts.php">
        <i class="fas fa-map-marker-alt me-2"></i>
        <span data-translate="districts">Districts</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'class.php' ? 'active' : ''; ?>" href="class.php">
        <i class="fa-solid fa-school-flag me-2"></i>
        <span data-translate="classes">Classes</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'subjects.php' ? 'active' : ''; ?>" href="subjects.php">
        <i class="fa-solid fa-book me-2"></i>
        <span data-translate="subjects">Subjects</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'genders.php' ? 'active' : ''; ?>" href="genders.php">
        <i class="fas fa-venus-mars me-2"></i>
        <span data-translate="genders">Genders</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'qualifications.php' ? 'active' : ''; ?>" href="qualifications.php">
        <i class="fas fa-graduation-cap me-2"></i>
        <span data-translate="qualifications">qualifications</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'teachers.php' ? 'active' : ''; ?>" href="teachers.php">
        <i class="fas fa-chalkboard-teacher me-2"></i>
        <span data-translate="teachers">Teachers</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'students.php' ? 'active' : ''; ?>" href="students.php">
        <i class="fas fa-user-graduate me-2"></i>
        <span data-translate="students">Students</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'fees.php' ? 'active' : ''; ?>" href="fees.php">
        <i class="fa-brands fa-cash-app me-2"></i>
        <span data-translate="fess">Fees</span>
      </a>
    </li>
    <li class="nav-heading" data-translate="account">ACCOUNT</li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
        <i class="fa-regular fa-circle-user"></i>
        &nbsp; <span data-translate="account">Account</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
        <i class="fa-solid fa-user-cog"></i>
        &nbsp; <span data-translate="settings">Settings</span>
      </a>
    </li>
    <li class="nav-heading"> Backups</li>
    <li class="nav-item">
      <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'backup.php' ? 'active' : ''; ?>" href="backup.php">
        <i class="fa-solid fa-database"></i>
        &nbsp; <span data-translate="store-backup">Backups</span>
      </a>
    </li>
  </ul>

</div>

<style>
  .logo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 5px;
    margin-bottom: 5px;
  }

  .logo-content {
    display: flex;
    align-items: center;
    /* gap: 12px; */
  }

  .logo i {
    font-size: 30px;
    cursor: pointer;
  }

  .logo i:hover {
    font-size: 30px;
    color: #7D53F3;
  }

  .logo-content img {
    width: 70px;
    /* slightly bigger logo */
  }

  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 260px;
    height: 100vh;
    background-color: #fff;
    color: #000;
    padding: 15px 10px;
    overflow-y: auto;
    scrollbar-width: none;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
    margin-right: 260px;
    z-index: 1030;
  }

  .sidebar .nav-link {
    color: #11222e;
    margin: 1px 0px;
    border-radius: 50px;

    display: flex;
    align-items: center;
    transition: none;
    /* remove motion on hover/click */
  }

  .sidebar .nav-link.active,
  .sidebar .nav-link:hover {
    background-color: #7D53F3;
    color: #fff;
  }

  .sidebar .nav-link i {
    font-size: 16px;
    /* slightly bigger icons */
  }

  .sidebar .nav-heading {
    color: #adb5bd;
    font-size: 0.85rem;
    text-transform: uppercase;
    margin-top: 15px;
    margin-bottom: 5px;
  }

  .main-content {
    margin-left: 260px;
    padding: 20px;
  }

  .title {
    font-family: "Fira Sans", sans-serif;
    font-weight: bolder;
    font-size: 24px;
    font-style: italic;
    color: #7D53F3;
  }

  @media (max-width: 768px) {
    .sidebar {
      width: 100%;
      height: auto;
      position: relative;
    }

    .main-content {
      margin-left: 0;
    }
  }
</style>