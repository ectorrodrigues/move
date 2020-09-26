
<div class="container-fluid">
  <div class="row justify-content-center py-lg-3">
    <div class="col-10">

      <h1 class="text-center mt-2 mb-5">Planos</h1>

      <div class="row justify-content-center py-lg-3 mb-5">

        <loop><sql>table=plans;where=id = '1';</sql>
          <div class="col-lg-3 col-10 text-center transition box-home py-4">
              <div>
                <h2>{title}</h2>
              </div>
              <div class="text-left mt-4">
                {description}
              </div>
              <div class="text-center mb-2 price">
                R$ {function->price_format->price} <span class="month">/mês</span>
              </div>

              <div class="mb-5">
                <select name="plan" id="selected_plan" onchange="update_link()">
                  <option value="2">1 mês</option>
                  <option value="3">6 meses</option>
                  <option value="4">12 meses</option>
                </select>
              </div>

              <div class="p-0 m-0">
                <a href="plans/item/{id}/{function->slug->title}" class="p-5" id="link_to_plan">
                  <button type="button" class="btn text-center">Criar Conta</button>
                </a>
              </div>
            </div>
        </loop>

      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
/*
$( "#selected_plan" ).change(function() {
  alert( "Handler for .change() called." );
});
*/

</script>
