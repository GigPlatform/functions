<?php

function connect(){
    $cons_usuario="root";
	$cons_contra="";
	$cons_base_datos="wordpress";
	$cons_equipo="localhost";
	$obj_conexion = mysqli_connect($cons_equipo,$cons_usuario,$cons_contra,$cons_base_datos);
	
	/*if(!$obj_conexion)
	{
	    echo "<h3>No se ha podido conectar PHP - MySQL, verifique sus datos.</h3><hr><br>";
	}
	else
	{
	    echo "<h3>Conexion Exitosa PHP - MySQL</h3><hr><br>";
	}*/
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
function create_users($user_login, $user_pass, $user_email,$user_registered, $display_name, $first_name, $last_name, $description, $bio,  $city, $code, $state, $country, $phone, $paypalMail, $logo, $color, $store, $messageToBuyers ){
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
$log= name_generator($user_login);
$logm=name_generator(strtolower($user_login));
$storem=strtolower($store);

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
//create_users("Prueba", "edupassword","prueba@test.com",get_date(),"displayName", "Prueba", "apellidos", "Descripcion de tienda","biografia de usuario", "im a city","imacode","im a state","MX","4491161815","paypal@paypal.com", "//127.0.0.1/practices/metaGIG/META-GIG/wordpress/wp-content/uploads/2018/07/logo.png", "blue", "tiendaDePrueba" );
//create_users("test", "edupassword", "nicetest", "mail@test.com", get_date(), "im a test", "Alberto", "Campos Hernandez");
//get_users();
//print_r($var_resultado);
/*$var_consulta ="SELECT * FROM wp_users WHERE name = '$check'";
$var_resultado = $obj_conexion->query($var_consulta);
$result = mysqli_fetch_array($var_resultado);*/
echo checkTermID();
?>