<?php
try{

    /**
     * Created by MyCode
     * User: KEVEN
     * Date: 01/06/2020
     * Time: 13:20
     **/

    /** Instânciamento da classe User  **/
    $Content         = $Main->LoadClass('Content');
    $ArrayUtf8Encode = $Main->LoadClass('ArrayUtf8Encode');

    /** Chamo o método que traz todos os registros **/
    $Content->All();

    /** Declaro minha array de retorno **/
    $result = array();

    /** Retorno em forma de array associativa SQL */
    while ($rowContent = $Content->FetchAssoc()){

        $result[] = $rowContent;

    }

    /** Result **/
    $result = array("result" => $ArrayUtf8Encode->utf8_converter($result));

    /** Pause **/
    sleep(1);

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}catch(Exception $e){

    /** Preparo o formulario para retorno **/
    $result = array("cod"   => 0,
        "msg"   => $e->getMessage(),
        "title" => "Atenção");

    /** Pause **/
    sleep(1);

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
