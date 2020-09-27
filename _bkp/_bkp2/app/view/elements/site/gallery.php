<div>
  <link rel="stylesheet" type="text/css" href="CSS_DIRcarousel.css" />
  <style>.w-100{background-position: center; background-size: contain; background-repeat: no-repeat;}</style>

  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      <loop>
        <sql>where= id = '<?= $_GET['id']?>' ;</sql>
        <div class="carousel-item active">
          <div class="d-block img-fluid w-100" style="background-image:url('IMG_DIR<?=$_GET['page']?>/{img}');">
          </div>
        </div>
      </loop>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

  </div>
</div>
