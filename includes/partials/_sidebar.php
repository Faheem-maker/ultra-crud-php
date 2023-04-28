<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="assets/images/faces/face1.jpg" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2">David Grey. H</span>
          <span class="text-secondary text-small">Project Manager</span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <span class="menu-title">Home</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    <?php
    $tables = mysqli_query($conn, 'SELECT * FROM dynamic_tables');
    while ($table = mysqli_fetch_assoc($tables)): ?>
        <li class="nav-item">
      <a class="nav-link" href="crud.php?table=<?= $table['table_name']; ?>">
        <span class="menu-title"><?= $table['display_name']; ?></span>
        <i class="mdi mdi-<?= $table['icon'] ?? 'home'; ?> menu-icon"></i>
      </a>
    </li>
    <?php endwhile; ?>
  </ul>
</nav>