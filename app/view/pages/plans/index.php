
<div class="container-fluid px-0 mx-0">
  <div class="row my-5 px-0 mx-0">
			<h1 class="col-12 text-center mt-0 mb-0 border-top border-bottom py-3">impresso</h1>
      <loop><sql>table=portfolio;where= category = '1';orderby=id;order=DESC;</sql>
          <div class="col-lg-3 col-6 bg-img box-home d-inline-flex m-0 p-0 text-center align-middle transition" style="background-image:url('<?='IMG_DIR'?>portfolio/{function->webpconvert->img}')" alt="{title}" onmouseover="showtitle({id})" onmouseout="hidetitle({id})">
            <div class="row align-self-center text-center mx-auto px-3 box-title {id}">
              <a href="portfolio/item/{id}/{function->slug->title}" class="p-5">
                <span class="weight-900">{function->clientname->client}</span><br>{title}
              </a>
            </div>
          </div>
      </loop>
  </div>
	<div class="row my-5 px-0 mx-0">
			<h1 class="col-12 text-center my-0 border-top border-bottom py-3">digital</h1>
      <loop><sql>table=portfolio;where= category = '2';orderby=id;order=DESC;</sql>
          <div class="col-lg-3 col-6 bg-img box-home d-inline-flex m-0 p-0 text-center align-middle transition" style="background-image:url('<?='IMG_DIR'?>portfolio/{function->webpconvert->img}')" alt="{title}" onmouseover="showtitle({id})" onmouseout="hidetitle({id})">
            <div class="row align-self-center text-center mx-auto px-3 box-title {id}">
              <a href="portfolio/item/{id}/{function->slug->title}" class="p-5">
                <span class="weight-900">{function->clientname->client}</span><br>{title}
              </a>
            </div>
          </div>
      </loop>
  </div>
</div>

<script type="text/javascript">
  function showtitle($id){ $("."+$id).css("opacity", "1"); }
  function hidetitle($id){ $("."+$id).css("opacity", "0"); }
</script>
