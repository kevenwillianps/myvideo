<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 17:29
 *
 */

session_start();

try {
    $result = array(

        'user_id'          => @$_SESSION['MYSUPPORT-USER-ID'],
        'user_name'        => @$_SESSION['MYSUPPORT-USER-NAME'],
        'email'            => @$_SESSION['MYSUPPORT-EMAIL'],
        'access_first'     => @$_SESSION['MYSUPPORT-ACCESS-FIRST'],
        'access_last'      => @$_SESSION['MYSUPPORT-ACCESS-LAST'],
        'date_register'    => @$_SESSION['MYSUPPORT-DATE-REGISTER'],
        'date_update'      => @$_SESSION['MYSUPPORT-DATE-UPDATE'],
        'user_function_id' => @$_SESSION['MYSUPPORT-USER-FUNCTION-ID'],
        'function_name'    => @$_SESSION['MYSUPPORT-FUNCTION-NAME'],
        'c_execute'        => @$_SESSION['MYSUPPORT-C-EXECUTE'],
        'r_execute'        => @$_SESSION['MYSUPPORT-R-EXECUTE'],
        'u_execute'        => @$_SESSION['MYSUPPORT-U-EXECUTE'],
        'd_execute'        => @$_SESSION['MYSUPPORT-D-EXECUTE'],

    );

    /** Result **/
    $result = array(

        "cod" => 1,
        "result" => $result

    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
} catch (Exception $e) {

    /** Preparo o formulario para retorno **/
    $result = array(

        "cod" => 0,
        "message" => $e->getMessage(),

    );

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;
}
