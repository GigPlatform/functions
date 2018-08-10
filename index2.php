<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
		<script src="wcapi.js"></script>
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
			                url: 'http://dev.metagig.ml',
			                consumerKey: 'ck_de36cdd05b4708bac395edcf3c6a371c5cb97c4f',
			                consumerSecret: 'cs_b08f9cbe4f9630d232c9056b022bbc795dee8e92',
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
				});
			}

			function get_products(callback) {
				Woocommerce.get('products', function(err, data, res){
				    if(err)
						console.log(err);
				    callback(JSON.parse(res));
				});
			}

			function get_orders(callback) {
				Woocommerce.get('orders', function(err, data, res) {
				    if(err)
						console.log(err);
				    callback(JSON.parse(res));
				});
			}

			function get_customers(callback) {
				Woocommerce.get('customers', function(err, data, res) {
				    if(err)
						console.log(err);
				    callback(JSON.parse(res));
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
	</body>
</html>
