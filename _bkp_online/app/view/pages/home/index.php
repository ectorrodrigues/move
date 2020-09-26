
<div class="container-fluid">
  <div class="row justify-content-center py-lg-3">
    <div class="col-10">

      <h1 class="text-center mt-2 mb-5">Planos</h1>

      <div class="row justify-content-center py-lg-3 mb-5">
        <loop><sql>table=plans;</sql>
          <div class="col-lg-3 col-10 text-center transition box-home py-4">

              <div>
                <h2>{title}</h2>
              </div>

              <div class="text-left mt-4">
                {description}
              </div>

              <div class="text-center mb-4 price">
                R$ {function->price_format->price}
              </div>


              <div>
                <a href="plans/item/{id}/{function->slug->title}" class="p-5">
                  <button type="button" class="btn text-center">Criar Conta</button>
                </a>
              </div>

            </div>
        </loop>
      </div>

    </div>
  </div>
</div>
