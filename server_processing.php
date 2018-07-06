<?php
error_reporting(~E_ALL);
$table = 'my_data';
$primaryKey = 'info_id';
$columns = array(
    array( 'db' => 'f_name', 'dt' => 0 ),
    array( 'db' => 'l_name',  'dt' => 1 ),
    array( 'db' => 'email_id',   'dt' => 2 ),
    array( 'db' => 'profile',     'dt' => 3 ),
    array(
        'db'        => 'ts_create',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            return date( 'jS M y', strtotime($d));
        }
    ),
    array(
        'db'        => 'ts_update',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            return date( 'jS M y', strtotime($d));
        }
    )
);
 
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'demo_trial',
    'host' => 'localhost'
);
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);