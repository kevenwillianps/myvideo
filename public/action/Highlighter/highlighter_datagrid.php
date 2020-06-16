<?php
try{

    /**
     * Created by MyCode
     * User: KEVEN
     * Date: 01/06/2020
     * Time: 13:20
     **/

    /** Instânciamento da classe User  **/
    $Highlighter     = $Main->LoadClass('Highlighter');
    $ArrayUtf8Encode = $Main->LoadClass('ArrayUtf8Encode');

    /** Chamo o método que traz todos os registros **/
    $Highlighter->All();

    /** Declaro minha array de retorno **/
    $result = array();

    /** Retorno em forma de array associativa SQL */
    while ($rowHighlighter = $Highlighter->FetchAssoc()){

        $result[] = $rowHighlighter;

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
    $result = array("cod" => 0, "message" => $e->getMessage(), "title" => "Atenção");

    /** Pause **/
    sleep(1);

    /** Envio **/
    echo json_encode($result);

    /** Paro o procedimento **/
    exit;

}
