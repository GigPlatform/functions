<?php

function connect(){
    $cons_usuario="root";
	$cons_contra="";
	$cons_base_datos="wordpress";
	$cons_equipo="localhost";
	$obj_conexion = mysqli_connect($cons_equipo,$cons_usuario,$cons_contra,$cons_base_datos);
	return $obj_conexion;
}

function get_date(){
	return date("Y/m/d")." ".date("h:i:sa");
}

function name_generator($name){
$id= checkID();
return $name."-".$id;
}

/*
gets all users from wordpress
*/
function get_users(){
$var_consulta ="SELECT * FROM wp_users";
$var_resultado = connect()->query($var_consulta);
 while($row = mysqli_fetch_array($var_resultado))
  {
    print_r($row);
  }	
}
function create_users($user_login, $user_pass, $user_email,$user_registered, $display_name, $first_name, $last_name, $description, $bio,  $city, $code, $state, $country, $phone, $paypalMail, $logo, $color, $store, $messageToBuyers, $twitter ){
	$user_nicename =strtolower($user_login); 
	$var_consulta ="INSERT INTO wp_users(user_login, user_pass, user_nicename, user_email,user_registered, display_name)
                VALUES ('$user_login', '$user_pass', '$user_nicename', '$user_email','$user_registered', '$display_name')";
$var_resultado = connect()->query($var_consulta);
if($var_resultado){
echo "Registro creado en wp_users";
echo "<br>";
}

//this is for store name and slug. it needs 2 records: one with an - and the id 
//example: name-1 slug-1 and name slug
$log= name_generator($store);
$logm=name_generator(strtolower($store));
$storem=strtolower($store);
echo $store;
echo $storem;
$var_consulta="INSERT INTO wp_terms(name, slug)
                VALUES ('$log', '$logm'),
                	   ('$store', '$storem');";
$var_resultado = connect()->query($var_consulta);
if($var_resultado){
	echo "<br>";
	echo "Registro creado en wp_terms";
}

$termID= checkTermID();
$id=checkID();

$role = <<<EOF
"dc_vendor"
EOF;

/*
$var_consulta="INSERT INTO wp_usermeta(user_id, meta_key, meta_value)
                VALUES ('$id', 'nickname', '$user_login'),
                	   ('$id', 'first_name', '$first_name'),
                	   ('$id', 'last_name', '$last_name'),
	              	   ('$id', 'wp_capabilities', 'a:1:{s:9:$role;b:1;}'),
                	   ('$id', '_vendor_description', '$description'),
                	   ('$id', 'description', '$bio'),
                	   ('$id', '_vendor_city', '$city'),
                	   ('$id', '_vendor_postcode', '$code'),
					   ('$id', '_vendor_state', '$state'),
					   ('$id', '_vendor_country', '$country'),
					   ('$id', '_vendor_phone', '$phone'),
					   ('$id', '_vendor_paypal_email', '$paypalMail'),
					   ('$id', '_vendor_message_to_buyers', '$messageToBuyers'),
					   ('$id', '_vendor_image', '$logo'),
					   ('$id', 'admin_color', '$color'),
					   ('$id', 'shipping_class_id', '$termID'),
					   ('$id', '_vendor_term_id', '$termID'+1),
                	   ('$id', 'wp_user_level', 0);";

$var_consulta="INSERT INTO wp_usermeta(user_id, meta_key, meta_value)
                VALUES ('$id', 'nickname', '$user_login'),
                	   ('$id', 'first_name', '$first_name'),
                	   ('$id', 'last_name', '$last_name'),
	              	   ('$id', 'wp_capabilities', 'a:1:{s:9:$role;b:1;}'),
                	   ('$id', '_vendor_description', '$description'),
                	   ('$id', 'description', '$bio'),
                	   ('$id', 'billing_city', '$city'),
                	   ('$id', 'billing_postcode', '$code'),
					   ('$id', 'billing_state', '$state'),
					   ('$id', 'billing_country', '$country'),
					   ('$id', 'billing_phone', '$phone'),
					   ('$id', '_vendor_paypal_email', '$paypalMail'),
					   ('$id', '_vendor_message_to_buyers', '$messageToBuyers'),
					   ('$id', '_vendor_image', '$logo'),
					   ('$id', 'admin_color', '$color'),
					   ('$id', 'shipping_class_id', '$termID'),
					   ('$id', '_vendor_term_id', '$termID'+1),
                	   ('$id', 'wp_user_level', 0);";
*/
$var_consulta="INSERT INTO wp_usermeta(user_id, meta_key, meta_value)
                VALUES ('$id', 'nickname', '$user_login'),
                	   ('$id', 'first_name', '$first_name'),
                	   ('$id', 'last_name', '$last_name'),
	              	   ('$id', 'wp_capabilities', 'a:1:{s:9:$role;b:1;}'),
                	   ('$id', '_vendor_description', '$description'),
                	   ('$id', 'description', '$bio'),
                	   ('$id', 'billing_city', '$city'),
                	   ('$id', 'billing_postcode', '$code'),
					   ('$id', 'billing_state', '$state'),
					   ('$id', 'billing_country', '$country'),
					   ('$id', 'billing_phone', '$phone'),
					   ('$id', '_vendor_city', '$city'),
                	   ('$id', '_vendor_postcode', '$code'),
					   ('$id', '_vendor_state', '$state'),
					   ('$id', '_vendor_country', '$country'),
					   ('$id', '_vendor_phone', '$phone'),
					   ('$id', '_vendor_paypal_email', '$paypalMail'),
					   ('$id', '_vendor_message_to_buyers', '$messageToBuyers'),
					   ('$id', '_vendor_image', '$logo'),
					   ('$id', 'admin_color', '$color'),
					   ('$id', '_vendor_twitter_profile', '$twitter'),
					   ('$id', '_vendor_term_id', '$termID'),
                	   ('$id', 'wp_user_level', 0);";

$var_resultado = connect()->query($var_consulta);
//print_r($var_consulta);
if($var_resultado){
	echo "<br>";
	echo "Registro creado en wp_usermeta";
}
//extra info needed for the term table
$termID = checkTermID()-1;
$var_consulta="INSERT INTO wp_termmeta(term_id, meta_key, meta_value)
                VALUES ('$termID', 'vendor_id', '$id'),
                       ('$termID', 'vendor_shipping_origin', 'GB'),
                	   ('$termID'+1, '_vendor_user_id', '$id');";
$var_resultado = connect()->query($var_consulta);        
if($var_resultado){
	echo "<br>";
	echo "Registro creado en wp_termmeta";
}

//term_taxonomy table, it stores a description 
//product_shipping_class
//dc_vendor_shop
$var_consulta="INSERT INTO wp_term_taxonomy(term_id, taxonomy)
                VALUES ('$termID', 'product_shipping_class'),
                	   ('$termID'+1, 'dc_vendor_shop');";
$var_resultado = connect()->query($var_consulta);   
if($var_resultado){
	echo "<br>";
	echo "Registro creado en wp_term_taxonomy";
}    
/*
 while($row = mysqli_fetch_array($var_resultado))
  {
    print_r($row);
  }	
 */
}
function checkID(){
$var_consulta ="SELECT ID 
FROM wp_users
ORDER BY id DESC
LIMIT 1";
$var_resultado = connect()->query($var_consulta);
 while($row = mysqli_fetch_array($var_resultado))
  {
    return($row['ID']);
  }	
}
function checkTermID(){
$var_consulta ="SELECT term_id 
FROM wp_terms
ORDER BY term_id DESC
LIMIT 1";
$var_resultado = connect()->query($var_consulta);
 while($row = mysqli_fetch_array($var_resultado))
  {
    return($row['term_id']);
  }	
}

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
	/*

		$var_consulta ="SELECT first_name, last_name, _vendor_image,
		_vendor_description AS about, description AS info, billing_city AS city,
		billing_state AS state, billing_postcode AS postcode, billing_country AS country, 
		billing_phone AS phone, _vendor_twitter_profile AS twitter
		FROM wp_usermeta";
*/



	function get_vendor_ID(){
$role = <<<EOF
"dc_vendor"
EOF;
		$var_consulta ="SELECT user_id
		FROM wp_usermeta
		WHERE meta_value ='a:1:{s:9:$role;b:1;}'
		GROUP BY user_id";
		$var_resultado = connect()->query($var_consulta);
		while($row = $var_resultado->fetch_assoc()) {
			print_r($row);
		}
		//$num = $var_resultado->num_rows;
		return $row;
	}
	function get_vendor_ID_rows(){
$role = <<<EOF
"dc_vendor"
EOF;
		$var_consulta ="SELECT user_id
		FROM wp_usermeta
		WHERE meta_value ='a:1:{s:9:$role;b:1;}'
		GROUP BY user_id";
		$var_resultado = connect()->query($var_consulta);
		$num = $var_resultado->num_rows;
		return $num;
	}

	function get_vendor_data(){

		$var_consulta ="SELECT meta_key, meta_value
		FROM wp_usermeta";
		$var_resultado = connect()->query($var_consulta);
		$objeto=array();
		$j=0;
		while($row = $var_resultado->fetch_assoc()) {
			//echo $row['meta_key'].":";
			//echo $row['meta_value']."<br>";
			//$objeto = $row;
			//print_r($row);

					if($row['meta_key']=="first_name"){
    				$objeto[$j]['first_name'] = $row['meta_value'];
	    			}
	    			//echo "su nombre es: ".$objeto['first_name']."<br>";

	    			if($row['meta_key']=="last_name"){
	    				$objeto[$j]['last_name'] = $row['meta_value'];
	    			}
	    			//echo "su nombre es: ".$objeto['last_name']."<br>";


	    			if($row['meta_key']=="_vendor_image"){
	    				$objeto[$j]['profilePic'] = $row['meta_value'];
	    			}	
	    			//echo "su nombre es: ".$objeto['profilePic']."<br>";

	    			if($row['meta_key']=="_vendor_description"){
	    				$objeto[$j]['about'] = $row['meta_value'];
	    			}
	    			
	    			//echo "su nombre es: ".$objeto['about']."<br>";
	  

	    			if($row['meta_key']=="description"){
	    				$objeto[$j]['info'] = $row['meta_value'];
	    			}
	    			
	    			//echo "su nombre es: ".$objeto['info']."<br>";

	    			if($row['meta_key']=="billing_city"){
	    				$objeto[$j]['city'] = $row['meta_value'];
	    			}
	    			
	    			//echo "su nombre es: ".$objeto['city']."<br>";

	    			if($row['meta_key']=="billing_state"){
	    				$objeto[$j]['state'] = $row['meta_value'];
	    			}
	    			
	    			//echo "su nombre es: ".$objeto['state']."<br>";

	    			if($row['meta_key']=="billing_postcode"){
	    				$objeto[$j]['postcode'] = $row['meta_value'];
	    			}
	    			
	    			//echo "su nombre es: ".$objeto['postcode']."<br>";

	    			if($row['meta_key']=="billing_country"){
	    				$objeto[$j]['country'] = $row['meta_value'];
	    			}
	    			
	    			//echo "su nombre es: ".$objeto['country']."<br>";

	    			if($row['meta_key']=="billing_phone"){
	    				$objeto[$j]['phone'] = $row['meta_value'];
	    			}
	    			
	    			//echo "su nombre es: ".$objeto['phone']."<br>";

	    			if($row['meta_key']=="_vendor_twitter_profile"){
	    				$objeto[$j]['twitter'] = $row['meta_value'];
	    				$j++;
	    			}

		}
		print_r($objeto);
		//$json = json_encode($objeto, JSON_FORCE_OBJECT);
		//echo $json;
    // output data of each row

}



$username = $_POST['user_login'];
$password = $_POST['user_pass'];
$user_email = $_POST['user_email'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$description = $_POST['description'];
$bio = $_POST['bio'];
$city = $_POST['city'];
$state = $_POST['state'];
$country = $_POST['country'];
$phone = $_POST['phone'];
$code = $_POST['code'];
$store = $_POST['store'];
$messageToBuyers = $_POST['code'];
$twitter = $_POST['twitter'];

$display_name = $first_name." ".$last_name;

create_users($username, $password, $user_email, get_date(), $display_name, $first_name, $last_name, $description, $bio, $city, $code , $state, $country, $phone, $user_email, "//127.0.0.1/practices/metaGIG/META-GIG/wordpress/wp-content/uploads/2018/07/logo.png", "blue", $store, $messageToBuyers, $twitter );

//get_users();
//print_r($var_resultado);
/*$var_consulta ="SELECT * FROM wp_users WHERE name = '$check'";
$var_resultado = $obj_conexion->query($var_consulta);
$result = mysqli_fetch_array($var_resultado);*/
//echo checkTermID();
//get_vendor_data();
?>