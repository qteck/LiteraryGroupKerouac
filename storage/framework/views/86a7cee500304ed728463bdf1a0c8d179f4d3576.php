	 

	<?php $__env->startSection('content'); ?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Vyplnte detaily k objednavce</h4>
      </div>
      <div class="modal-body">

<form method="POST">
  <div class="form-group">
    <label for="jmeno">Jmeno</label>
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
    <input type="text" class="form-control" id="jmeno" placeholder="Jan">
  </div>
  <div class="form-group">
    <label for="prijmeni">Prijmeni</label>
    <input type="text" class="form-control" id="prijmeni" placeholder="Novak">
  </div>
  <div class="form-group">
    <label for="telefon">Telefon</label>
    <input type="text" class="form-control" id="telefon" placeholder="6031138..">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" placeholder="jannovak@gmail.com">
  </div>
  <div class="form-group">
    <label for="adresa">Adresa</label>
    <textarea class="form-control" id="adresa" placeholder="Cislo domu, ulice, mesto, stat"></textarea>
  </div>
<hr class="divider">
<p class="bg-success">Prosim zkontrolujte si osobni udaje a detaily objednavky.</p>
<hr class="divider">

	<table class="table">
		<caption>
			Detaily objednavky
		</caption>
		<thead>
			<tr>
				<th>#</th>
				<th>Polozka</th>
				<th>Kusu</th>
				<th>Cena</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">1</th>
				<td>Smej se ve tme</td>
				<td>
					<input type="text" id="kvantity" style="width: 42px;display: inline" class="form-control input-sm" value="1"> (max. 3)
				</td>
				<td id="cena">260</td>
			</tr>
			<tr>
				<th colspan="4" class="text-right">
				<span id="postovne">99</span> Kc (postovne) + 
				<span id="objednavka">260</span> Kc (cena knihy) = 
				<span id="soucet">359</span> Kc (soucet)</th>
			</tr>
		</tbody>
	</table>
	</form>

	<p>Objednavky hmotnejsich zasilek prijmame na <a href="mailto: info@kerouac.cz">info@kerouac.cz</a>.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zavrit</button>

        <script>
        	var cena = $( "#cena" ).text();	

        	  $('#kvantity').on('keyup',function () {

        	  	kvantity = $( "#kvantity" ).val();
        	  	if(kvantity >= 1) 
        	  			{
        	  				if (kvantity > 3) {kvantity = 3; $( "#kvantity" ).val(3);}

        	  				postovne = $( "#postovne" ).text();

        						$("#cena").text(cena * kvantity);
        						$("#objednavka").text(cena * kvantity);
        						$("#soucet").text(+(cena * kvantity)+ +postovne);
        				}
			  });
        </script>
        <div id="paypal-button-container"></div>

    <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production
            
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
                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {
            	var finalPrice = $( "#soucet" ).text();	 //final price

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '1', currency: 'CZK' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                	//save the shipping info in here. 
var token = $("input[name='_token']").val();
               $.ajax({
                        url: "<?php echo e(url('/knihy/platba/')); ?>",
                        method: "POST",
                        dataType: 'json',
                        data: { 'forename': "John",
                                'surname': "Dohn",
                                'phone': "07930811736",
                                'email': "p.stejskal222@gmail.com",
                                'orderedItem_id': "12",
                                'price': "1",
                                'quantity': "1",
                                'currency': "czk",
                                'address': "13a Invernallan Road, Stirlingshire, Stirling, FK9 4JE",
                                'status': "Ordered",
                                '_token': token },

                        success(s){console.log("success"+token);},
                        error: function (e) {
                          console.log(JSON.stringify(e));
                        }
                 })

  					.done(function( msg ) {
    					alert( "Data Saved: " + msg );
  					});

                    window.alert('Payment Complete!');
                });

                if (error === 'INSTRUMENT_DECLINED') {
                		actions.restart();
            	}
            },

            onCancel: function(data, actions) {

            	var token = $("input[name='_token']").val();
                
              console.log(token);

            	 $.ajax({
                        url: "<?php echo e(url('/knihy/platba/')); ?>",
  						          method: "POST",
  						          dataType: 'json',
  						          data: { 'forename': "John",
                                'surname': "Dohn",
                                'phone': "07930811736",
                                'email': "p.stejskal222@gmail.com",
                                'orderedItem_id': "12",
                                'price': "1",
                                'quantity': "1",
                                'currency': "czk",
                                'address': "13a Invernallan Road, Stirlingshire, Stirling, FK9 4JE",
                                'status': "Cancelled",
                                '_token': token },

  						          success(s){console.log("success"+token);},
  						          error: function (e) {
                          console.log(JSON.stringify(e));
                        }
					       })
            window.alert('Payment did not work out well! It has been cancelled.');
        	}

        }, '#paypal-button-container');

    </script>

		
      </div>
    </div>
  </div>
</div>
<!-- EndModal -->

<div class="container">
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

	<?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		<div class="col-md-6" style="margin-bottom: 60px">
		<div class="row">
			<div class="col-md-6">
				<img alt="" style="width: 260px; height: 360px;" src="<?php echo e(url('storage')); ?>/<?php echo e($book->picture); ?>" class="img-responsive">
			</div>
			<div class="col-md-6">
				<table class="table table-condensed">
				<tr>
					<td style="border-top: none; padding-top: 0;">
						<p><?php echo e($book->description); ?></p>
					</td>
				</tr>
					<tr>
						<td><?php echo e($book->title); ?></td>
					</tr>
					<tr>
						<td><?php echo e($book->author); ?></td>
					</tr>
					<tr>
						<td>Literarni skupina kerouac</td>
					</tr>
					<tr>
						<td><?php echo e($book->price); ?> Kc</td>
					</tr>
					<tr>
						<td class="text-right">
							<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#myModal">
  								Kup to
							</button>
						</td>
					</tr>
				</table>
			</div>	
			</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
	</div>

		

<!--
		<div class="row" style="clear:both;padding-top: 30px">
			<div class="container">
					<p>Zakoupeni jedne (nebo vice) z nasich knih je uprimne vitano, a chapano jako vyjadreni podpory, coz signifikatne stimuluje nasi tvorbu.</p>
			</div>
		</div>
		-->

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>