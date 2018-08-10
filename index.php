<html>
	<head>


		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
		<script src="wcapi.js"></script>
		<?php
		//require_once('dbcon.php');
		?>
	</head>
	<body ng-app='starter.services' ng-controller='myCtrl'>
		<pre id="result" class="prettyprint">Loading ...</pre>

		<script>
			var Woocommerce = null;
			var app = angular.module('starter.services',[]);
			app.service('WC', function(){
			    return {
			        WC: function(){
			            var WoocommerceObj = new WoocommerceAPI({
			                url: 'http://pc.hcilab.ml/metagig',
			                consumerKey: 'ck_abd529a9cf00444fbd5ac760ec2a9232fc9fa6b6',
			                consumerSecret: 'cs_5095dd4b02e68e821fc9a03b29e6fdd850fb4788',
					        wpAPI: true,
			  		        version: 'wc/v2'
			            })
			            return WoocommerceObj;
			        }
			}});
			app.controller('myCtrl', function($scope, WC){
			  Woocommerce = WC.WC();
			  get_categories(data => {
			  	console.log(data);
			  });
			  get_customers(data => {
			  	console.log(data);
			  });
			  get_orders(data => {
			  	console.log(data);
			  });
			  get_reports(data => {
			  	console.log(data);
			  });
			  get_sales(data => {
			  	console.log(data);
			  });

			  get_products(data => {
			  	console.log(data);
			  	document.getElementById('result').innerHTML = 'Loaded'
			  	//JSON.stringify(data, null, 2);
			  });

			});

			function get_categories(callback) {
				Woocommerce.get('products/categories', function(err, data, res){
					if(err)
						console.log(err);
					
					callback(JSON.parse(res));
					/*
					var objeto = JSON.parse(res);
					var resultado = {};
					resulatdo.name = objeto.name;
					callback(resultado);
					*/
				});
			}

			function get_products(callback) {
				Woocommerce.get('products', function(err, data, res){
				    if(err)
						console.log(err);
						var objeto = JSON.parse(res);
						var resultado = {};
						resultado.id = objeto.id;
						resultado.name = objeto.name;
						resultado.slug = objeto.slug;
						resultado.catalog_visible=objeto.catalog_visible;
						resultado.description = objeto.description;
						resultado.short_description = objeto.short_description;
						resultado.regular_price = objeto.regular_price;
						resultado.sale_price = objeto.sale_price;
						resultado.categories = objeto.categories;
						callback(resultado);
				    //callback(JSON.parse(res));
				});
			}

			function get_orders(callback) {
				Woocommerce.get('orders', function(err, data, res) {
				    if(err)
						console.log(err);
						var objeto = JSON.parse(res);
						var resultado = {};
						resultado.id = objeto.id;
						resultado.status = objeto.status;
						resultado.total = objeto.status;
						resultado.billing = objeto.billing;
						callback(resultado);
				    //callback(JSON.parse(res));
				});
			}

			function get_customers(callback) {
				Woocommerce.get('customers', function(err, data, res) {
				    if(err)
						console.log(err);
						var objeto = JSON.parse(res);
						var resultado = {};
						resultado.id = objeto.id;
						resultado.first_name = objeto.first_name;
						resultado.last_name = objeto.last_name;
						resultado.username = objeto.username;
						resultado.email = objeto.name;
						resultado.address_1 = objeto.address_1;
						resultado.city = objeto.city;
						resultado.state = objeto.state;
						resultado.postcode = objeto.postcode;
						resultado.country = objeto.country;
				    callback(resultado);
				});
			}

			function get_reports(callback) {
				Woocommerce.get('reports', function(err, data, res) {
				    if(err)
						console.log(err);
				    callback(JSON.parse(res));
				});
			}
			function get_sales(callback) {
				Woocommerce.get('reports/sales', function(err, data, res) {
				    if(err)
						console.log(err);
				    callback(JSON.parse(res));
				});
			}	
		</script>


	<?php

	require __DIR__ .'/vendor/autoload.php';
	use Automattic\WooCommerce\Client;
	$woocommerce = new Client(
   		'http://pc.hcilab.ml/metagig', 
    	'ck_abd529a9cf00444fbd5ac760ec2a9232fc9fa6b6f', 
    	'cs_5095dd4b02e68e821fc9a03b29e6fdd850fb47882',
   	 	[
        	'wp_api' => true,
        	'version' => 'wc/v2',
    	]
	);

	function add_product(){
		global $woocommerce;
		$data = [
		    'name' => 'Premium Quality',
		    'sale_price' => '21.99',
		    'short_description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
		    'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
		    		    'images' => [
		        [
		            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_front.jpg',
		            'position' => 0
		        ],
		        [
		            'src' => 'http://demo.woothemes.com/woocommerce/wp-content/uploads/sites/56/2013/06/T_2_back.jpg',
		            'position' => 1
		        ]
		    ],
		    'categories' => [
		        [
		            'id' => 9
		        ],
		        [
		            'id' => 14
		        ]
		    ]

		];

		print_r($woocommerce->post('products', $data));
		
		//echo "<script>console.log(".json_encode($data).")</script>";
	}

?>
		 <?php
			  
			  //create_product();
			 //store_front();
			  //add_vendor();
			  ?>

	</body>
</html>
