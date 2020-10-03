<header class="container-fluid pt-3">
  <div class="row justify-content-center py-2">
    <div class="col-lg-10 px-lg-0 px-5 mt-lg-0 mt-4">
      <div class="row justify-content-between px-lg-0 px-3">
        <a href="<?=SERVER_DIR?>" class="d-inline-block text-left">
          <img src="<?=FILES_DIR?>logo.svg" alt="logo" class="col-lg-5 col-10" data-aos="zoom-out" data-aos-duration="1000">
        </a>
        <nav class="d-inline-block text-right">
          <?php include 'menu.php'; ?>
        </nav>
      </div>
    </div>
  </div>

  <?php
    $pagename = $_GET['page'];
    if($pagename == 'home'){ include 'banners.php'; }
  ?>

  <loop><sql>table=config;where= title = 'empty';</sql>
    {content}
  </loop>

</header>
