
<div class="container-fluid">

  <div class="row justify-content-center py-lg-3">
    <div class="col-lg-10 col-12 mt-5">

      <h1 class="text-center mt-5 mb-4">Planos</h1>

      <div class="row justify-content-center py-lg-3 mb-5">

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
                <a href="plans/item/{id}/{function->slug->title}" id="link_to_plan">
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
                <a href="plans/item/{id}/{function->slug->title}" id="link_to_plan_{id}" title="{function->slug->title}">
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
                <a href="plans/item/{id}/{function->slug->title}" id="link_to_plan_{id}" title="{function->slug->title}">
                  <button type="button" class="btn text-center transition">Criar Conta</button>
                </a>
              </div>
            </div>
        </loop>

      </div>

    </div>
  </div>

  <div class="row justify-content-center py-5 mt-0 bg-gradient">
    <div class="col-10 py-5">
      <div class="row justify-content-center py-5">
        <div class="col-lg-6 col-12 my-auto text-center" data-aos="zoom-out-right">
          <img src="<?=IMG_DIR?>icon_home_negative.webp" alt="icon_home" class="mb-lg-0 mb-5">
        </div>
        <div class="col-lg-6 col-12 px-lg-5 px-3 my-auto line-height text-white"data-aos="zoom-out-up"  data-aos-delay="300">
          <p>
            Deep Links permitem que você envie os usuários diretamente para os aplicativos do iOS e Android, na página ou publicação que você quiser.
          </p>
          <p>
            Diga adeus aos links que abrem o Facebook e Instagram no navegador do celular e diga olá aos aplicativos nativos.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center py-5 my-2">

    <div class="col-10 py-5">
      <div class="row justify-content-center py-5">
        <div class="col-lg-6 col-12 my-auto text-center">
          <img src="<?=IMG_DIR?>charts.webp" alt="icon_home" class="mb-lg-0 mb-5 col-lg-11 col-12" data-aos="flip-up" data-aos-delay="400" data-aos-duration="8000">
        </div>
        <div class="col-lg-6 col-12 px-lg-5 px-3 my-auto line-height text-left">
          <p>
            <h1 class="text-left color-watermelon">Aumente a conversão de suas campanhas!</h1>
          </p>
          <p>
            O uso de Deep Links potencializa a sua campanha, pois direciona o usuário para o aplicativo na página ou publicação que você quer, criando assim uma experiência muito mais integrada, aumentado significativamente a probabilidade de conversão.
          </p>
        </div>
      </div>
    </div>

    <div class="col-11 py-2">
      <h1 class="text-center mt-5 mb-4" data-aos="flip-up">Quando usar Deep Links?</h1><br>
      <div class="row justify-content-center text-center">

        <div class="col-lg-3 p-3">
          <img src="<?=IMG_DIR?>social.webp" alt="social media" class="col-12" data-aos="fade-up" data-aos-delay="200"><br>
          <p class="text-center">
            Campanhas para<br>Mídias Sociais
          </p>
        </div>

        <div class="col-lg-3 p-3">
          <img src="<?=IMG_DIR?>email.webp" alt="email marketing" class="col-12" data-aos="fade-up" data-aos-delay="400"><br>
          <p class="text-center">
            E-mail<br>Marketing
          </p>
        </div>

        <div class="col-lg-3 p-3">
          <img src="<?=IMG_DIR?>sms.webp" alt="social media" class="col-12" data-aos="fade-up" data-aos-delay="600"><br>
          <p class="text-center">
            SMS
          </p>
        </div>

        <div class="col-lg-3 p-3">
          <img src="<?=IMG_DIR?>whatsapp.webp" alt="social media" class="col-12" data-aos="fade-up" data-aos-delay="800"><br>
          <p class="text-center">
            Campanhas para<br>Whatsapp
          </p>
        </div>

      </div>
    </div>

  </div>


</div>

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
      $('#link_to_plan_'+str).attr("href", "plans/item/"+selectval+"/"+ahref);
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
