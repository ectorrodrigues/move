<div class="row justify-content-center py-lg-3 mb-5">

  <?php $reference = $_GET['id']; ?>

  <loop><sql>table=plans;where=id = '1';</sql>
    <div class="col-lg-3 col-10 text-center transition box-home py-4 px-lg-0 px-5 mx-3 my-lg-0 my-5" data-aos="fade-up">
        <div>
          <h2 class="color-watermelon">{title}</h2>
        </div>
        <div class="text-left mt-4 pl-lg-0 pl-4 description-list">
          {description}
            <li class="cliques_{id}">5.000 cliques</li>
          </ul>
        </div>
        <div class="text-center my-4 price">
          <div class="totalprice">Equivalente a:</div><br>
          R$ {function->price_format->price} <span class="month">/único</span>
        </div>

        <div class="mb-4">
          <select name="plan" id="selected_plan" onchange="update_link()">
            <option value="1">6 meses</option>
          </select>
        </div>

        <div class="p-0 m-0">
          <a href="../../../new_account.php?action=update&plan=1&reference=<?=$reference?>" id="link_to_plan">
            <button type="button" class="btn text-center">Criar Conta</button>
          </a>
        </div>
      </div>
  </loop>


  <loop><sql>table=plans;where=id = '2';</sql>
    <div class="col-lg-3 col-10 text-center transition box-home py-4 px-lg-0 px-5 mx-3 my-lg-0 my-5" data-aos="fade-up" data-aos-delay="300">
        <div>
          <h2 class="color-watermelon">{title}</h2>
        </div>
        <div class="text-left mt-4 pl-lg-0 pl-4 description-list">
          {description}
            <li class="cliques_{id}">1.000 cliques</li>
          </ul>
        </div>
        <div class="text-center my-4 price">
          <div class="totalprice">Equivalente a:</div><br>
          <span class="price_value_{id}">R$ {function->price_format->price}<span class="month">/mês</span></span>
        </div>

        <div class="mb-4">
          <select name="plan" id="selected_plan_{id}" onchange="update_link({id})">
            {function->plans_months->id}
          </select>
        </div>

        <div class="p-0 m-0">
          <a href="../../../new_account.php?action=update&plan=2&reference=<?=$reference?>" id="link_to_plan_{id}" title="{function->slug->title}">
            <button type="button" class="btn text-center">Criar Conta</button>
          </a>
        </div>
      </div>
  </loop>

  <loop><sql>table=plans;where=id = '6';</sql>
    <div class="col-lg-3 col-10 text-center transition box-home py-4 px-lg-0 px-5 mx-3 my-lg-0 my-5" data-aos="fade-up" data-aos-delay="600">
        <div>
          <h2 class="color-watermelon">{title}</h2>
        </div>
        <div class="text-left mt-4 pl-lg-0 pl-4 description-list">
          {description}
            <li class="cliques_{id}">3.000 cliques</li>
          </ul>
        </div>
        <div class="text-center my-4 price">
          <div class="totalprice">Equivalente a:</div><br>
          <span class="price_value_{id}">R$ {function->price_format->price}<span class="month">/mês</span></span>
        </div>

        <div class="mb-4">
          <select name="plan" id="selected_plan_{id}" onchange="update_link({id})">
            {function->plans_months->id}
          </select>
        </div>

        <div class="p-0 m-0">
          <a href="../../../new_account.php?action=update&plan=6&reference=<?=$reference?>" id="link_to_plan_{id}" title="{function->slug->title}">
            <button type="button" class="btn text-center transition">Criar Conta</button>
          </a>
        </div>
      </div>
  </loop>

</div>

<script type="text/javascript">
  $(".access").html("voltar ao painel");
</script>

<script type="text/javascript">

function update_link(str){
  var selectval = $('#selected_plan_'+str).val();
  var priceclass = 'price_value_'+str;
  var ahref = $('#link_to_plan_'+str).attr("title");

  $.ajax({
    type: "GET",
    url: '<?=ABSOLUTE_PATH?>app/model/validation.php?v=a',
    data: 'id_price='+selectval,
    success: function(data)
    {
      $('.'+priceclass).html(data);
      $('#link_to_plan_'+str).attr("href", "../../../new_account.php?action=update&plan="+selectval+"&reference=<?=$reference?>");
    }
  });

  $.ajax({
    type: "GET",
    url: '<?=ABSOLUTE_PATH?>app/model/validation.php?v=a',
    data: 'cliques='+selectval,
    success: function(data)
    {
      $('.cliques_'+str).html(data);
    }
  });

}

</script>
