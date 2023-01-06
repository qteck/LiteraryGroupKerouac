	@extends('layout') 

	@section('content')
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Vyplňte detaily k objednávce</h4>
      </div>
      <div class="modal-body">

<form method="POST">
  <div class="form-group">
    <label for="jmeno">Jméno</label>
    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
    <input type="hidden" name="_idPolozka" value=""> 
    <input type="text" class="form-control" id="jmeno" placeholder="Jan">
  </div>
  <div class="form-group">
    <label for="prijmeni">Přijmení</label>
    <input type="text" class="form-control" id="prijmeni" placeholder="Novák">
  </div>
  <div class="form-group">
    <label for="telefon">Telefon</label>
    <input type="text" class="form-control" id="telefon" placeholder="6031138..">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" placeholder="jannovak@gmail.cz">
  </div>
  <div class="form-group">
    <label for="adresa">Adresa</label>
    <textarea class="form-control" id="adresa" placeholder="Číslo domu, ulice, město, stát"></textarea>
  </div>
<hr class="divider">
<p class="bg-success">Prosím zkontrolujte si osobní údaje a detaily objednávky.</p>
<hr class="divider">

	<table class="table">
		<caption>
			Detaily objednávky
		</caption>
		<thead>
			<tr>
				<th>#</th>
				<th>Položka</th>
				<th>Kusů</th>
				<th>Cena</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">1</th>
				<td id="polozka"></td>
				<td style="width: 30%">
					<input type="text" id="kvantity" style="width: 42px;display: inline" class="form-control input-sm" value="1"> (max. 3)
				</td>
				<td><span id="cena"></span> Kč / kniha</td>
			</tr>
			<tr>
				<th colspan="4" class="text-right">
				<span id="postovne">55</span> Kč (poštovné) + 
				<span id="objednavka">260</span> Kč (cena knihy) = 
				<span id="soucet">359</span> Kč (součet)</th>
			</tr>
		</tbody>
	</table>
	</form>

	<p>Objednávky hmotnějších zásilek přijmáme na <a href="mailto: info@kerouac.cz">info@kerouac.cz</a>.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zavrit</button>

        <div id="paypal-button-container"></div>

    <script>
      var ident =  Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        paypal.Button.render({

            env: 'production', // sandbox | production
            
                    style: {
            size: 'small',
            color: 'gold',
            shape: 'rect',
            label: 'pay'
        },

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'AeMHg8on03IgKz27jDLOpsZrYicUz_0R8lHkYRLk6rVYNaO8WDz6iC7QfOtDkvFo6E2D3qfoG9z6Gfhd',
                production: 'ARKpv7M1R-GkbtPCnkOqMuqXPv3rqnVBESxrB_AUymKo5H_Wf2tneAI6wbpd80npMLeP3fm_nPS5yFr3'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {
              var token = $("input[name='_token']").val();
              var forename = $("#jmeno").val();
              var surname = $("#prijmeni").val();
              var email = $("#email").val();
              var phone = $("#telefon").val();
              var orderedItem_id = $("input[name='_idPolozka']").val();
              var price = $("#cena").text();
              var totalPrice = $("#soucet").text();
              var quantity = $("#kvantity").val();
              var currency = 'czk'
              var address = $("#adresa").val();

              var polozkaText = $('#polozka').text();
              var shipping = 55;
             
              
                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                      intent: 'sale',
                      payer: { payment_method: 'paypal',
                               payer_info: {
                                email: email,
                                first_name: forename,
                                last_name: surname,
                                shipping_address: {
                                  line1: address,
                                  phone: phone,
                                  recipient_name: forename+' '+surname,
                                },
                               }},
                        transactions: [
                            {
                                amount: { total: totalPrice, 
                                          currency: 'CZK',      
                                          details: { 
                                                     subtotal: price*quantity,
                                                     shipping: shipping,
                                                   } 
                                        },
                                description: 'Email: '+ email + 'Phone' + phone,
                                invoice_number: ident,
                                item_list:{
                                            items: [{
                                            name: polozkaText,
                                            quantity: quantity,
                                            price: price,
                                            sku: orderedItem_id,
                                            currency: 'CZK'
                                          }]
                                  },
                            }
                        ],
                        note_to_payer: 'Děkuji moc za nákup.',
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                	//save the shipping info in here. 
              var token = $("input[name='_token']").val();
              var forename = $("#jmeno").val();
              var surname = $("#prijmeni").val();
              var email = $("#email").val();
              var phone = $("#telefon").val();
              var orderedItem_id = $("input[name='_idPolozka']").val();
              var price = $("#cena").text();
              var totalPrice = $("#soucet").text();
              var quantity = $("#kvantity").val();
              var currency = 'czk'
              var address = $("#adresa").val();
              
               $.ajax({
                        url: "{{ url('/knihy/platba/') }}",
                        method: "POST",
                        dataType: 'json',
                        data: { 'forename': forename,
                                'surname': surname,
                                'phone': phone,
                                'email': email,
                                'orderedItem_id': orderedItem_id,
                                'price': price,
                                'totalPrice': totalPrice,
                                'transaction_id': ident,
                                'quantity': quantity,
                                'currency': currency,
                                'address': address,
                                'status': "Success",
                                '_token': token },

                        success: function (s)
                        {
                          //console.log(s+"success"+token);
                        },
                        error: function (e) {
                          console.log(JSON.stringify(e));
                        }
                 })

                  $.ajax({
                        url: "{{ url('/knihy/platba/email') }}",
                        method: "POST",
                        dataType: 'json',
                        data: { 'forename': forename,
                                'email': email,
                                '_token': token },

                        success: function(){
                             alert('email sent');
                        }
                  });

            var success = '<div class=\"alert alert-success\" role=\"alert\">Platba proběhla úspěšně. Potvrzení objednávky bylo odesláno na uvedený email.</div>';

            $('#myModalLabel').html('Informace');
            $('.modal-body').html(success);
            $('#paypal-button-container').remove();

            setTimeout(function(){
              location.reload();
            },6000);

                });

                if (error === 'INSTRUMENT_DECLINED') {
                		actions.restart();
            	}
            },

            onCancel: function(data, actions) {

              var token = $("input[name='_token']").val();
              var forename = $("#jmeno").val();
              var surname = $("#prijmeni").val();
              var email = $("#email").val();
              var phone = $("#telefon").val();
              var orderedItem_id = $("input[name='_idPolozka']").val();
              var price = $("#cena").text();
              var totalPrice = $("#soucet").text();
              var quantity = $("#kvantity").val();
              var currency = 'czk'
              var address = $("#adresa").val();
              
            	 $.ajax({
                        url: "{{ url('/knihy/platba/') }}",
  						          method: "POST",
  						          dataType: 'json',
  						          data: { 'forename': forename,
                                'surname': surname,
                                'phone': phone,
                                'email': email,
                                'orderedItem_id': orderedItem_id,
                                'price': price,
                                'totalPrice': totalPrice,
                                'quantity': quantity,
                                'currency': currency,
                                'address': address,
                                'status': "Cancelled",
                                '_token': token },

  						          success: function(s){
                          //console.log("success"+token);
                        },
  						          error: function (e) {
                          //console.log(JSON.stringify(e));
                        }
					       })

            var cancellation = '<div class=\"alert alert-danger\" role=\"alert\">Platba byla zrušena.</div>';

            $('#myModalLabel').html('Informace');
            $('.modal-body').html(cancellation);
            $('#paypal-button-container').remove();

            setTimeout(function(){
              location.reload();
            },6000);
        	}

        }, '#paypal-button-container');

    </script>

		
      </div>
    </div>
  </div>
</div>
<!-- EndModal -->

	<div class="row">
		<div class="col-md-4">
			<blockquote class="blockquote">
				<p class="m-b-0">Creativity is contagious, pass it on.</p>
				<footer class="blockquote-footer">
					<cite title="Source Title">Albert Einstein</cite>
				</footer>
				<p></p>
			</blockquote>
		</div>
		<div class="col-md-8">
			<h2>Knihy</h2>
		</div>
	</div>

	<div style="margin-bottom: 30px;" class="row row-margin">

	@foreach($books as $book)
		<div class="col-md-6" style="margin-bottom: 60px">
		<div class="row">
			<div class="col-md-6">
				<img alt="" style="width: 260px; height: 360px;" src="{{ url('storage') }}/{{ $book->picture }}" class="img-responsive">
			</div>
			<div class="col-md-6">
				<table class="table table-condensed">
				<tr>
					<td style="border-top: none; padding-top: 0;">
						<p>{{ $book->description }}</p>
					</td>
				</tr>
					<tr>
						<td class="titlePolozka">{{ $book->title }}</td>
					</tr>
					<tr>
						<td>{{ $book->author }}</td>
					</tr>
					<tr>
						<td>Slavná literarní skupina kerouac</td>
					</tr>
					<tr>
						<td class="priceTag">{{ $book->price }} Kč (+ 55 Kč poštovné)</td>
            <td style="display: none" class='idItem'>{{ $book->id }}</td>
					</tr>
					<tr>
						<td class="text-right">
							<button type="button" class="modal-button" class="btn btn-sm" data-toggle="modal" data-target="#myModal">
  								Kup to
							</button>
						</td>
					</tr>
				</table>
			</div>	
			</div>
			</div>
		@endforeach
	</div>

       <script>
            $('.modal-button').on('click',function (){

              var priceTag = parseInt($(this).closest('.table').find('.priceTag').text());
              var titlePolozka = $(this).closest('.table').find('.titlePolozka').text();
              var idPolozka = $(this).closest('.table').find('.idItem').text();
              
              $('#cena').text(priceTag);
              $( "#kvantity" ).val(1);
              $("#objednavka").text(priceTag);
              $("#soucet").text(parseInt(priceTag)+parseInt($( "#postovne" ).text()));
              $("input[name='_idPolozka']").val(idPolozka)
             
              $('#polozka').text(titlePolozka);
            });  

        </script>

        <script>
           
            $('#kvantity').on('keyup',function () {
            
            var cena = $("#cena").text();
          
              kvantity = $( "#kvantity" ).val();
              if(kvantity >= 1) 
                  {
                    if (kvantity > 3) {kvantity = 3; $( "#kvantity" ).val(3);}

                    postovne = $( "#postovne" ).text();

                    $("#objednavka").text(cena * kvantity);
                    $("#soucet").text(+(cena * kvantity)+ +postovne);
                }
        });
        </script>
<!--
		<div class="row" style="clear:both;padding-top: 30px">
			<div class="container">
					<p>Zakoupeni jedne (nebo vice) z nasich knih je uprimne vitano, a chapano jako vyjadreni podpory, coz signifikatne stimuluje nasi tvorbu.</p>
			</div>
		</div>
		-->

@endsection