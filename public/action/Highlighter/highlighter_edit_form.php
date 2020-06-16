<?php
try{

    /**
     * Created by MyCode
     * User: KEVEN
     * Date: 04/06/2020
     * Time: 10:49
     **/

    /** Capturo meus campos envios por json **/
    $inputs          = json_decode(file_get_contents('php://input'), true);

    /** Parâmetros de entrada  **/
    $highlighter_id  = isset($inputs['inputs']['highlighter_id']) ? (int)$Main->anti_injection($inputs['inputs']['highlighter_id']) : 0;

    /** Instânciamento da classe Classes  **/
    $Highlighter     = $Main->LoadClass('Highlighter');
    $ArrayUtf8Encode = $Main->LoadClass('ArrayUtf8Encode');

    /** Carrego o meu registro  **/
    $row             = $Highlighter->EditForm($highlighter_id);
    $row             = $ArrayUtf8Encode->utf8_converter($row);

    /** Result **/
    $result = array("cod" => 1, "result" => $row);

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
