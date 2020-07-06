<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Importação das classes que iremos utilizar **/
use \vendor\model\Main;
use \vendor\model\ContentSub;
use \vendor\model\ArrayUtf8Encode;

/** Instânciamento das classes **/
$main = new Main();
$contentSub = new ContentSub();
$arrayUtf8Encode = new ArrayUtf8Encode();

try {

    /** Capturo meus campos envios por json **/
    $inputs = json_decode(file_get_contents('php://input'), true);

    /** Parâmetros de entrada **/
    $content_sub_id = isset($inputs['inputs']['content_sub_id']) ? (int)$main->antiInjection($inputs['inputs']['content_sub_id']) : 0;

    /** Controle de erros **/
    $message = array();

    /** Verifico se o campo é válido **/
    if ($content_sub_id <= 0) {
        array_push($message, 'O campo "ContentSubID", deve ser preenchido');
    }

    /** Verifico se existem erros **/
    if (count($message) > 0) {

        /** Preparo o formulario para retorno **/
        $result = array(
            "cod" => 0,
            "message" => $message
        );
    } else {

        /** Busco o registro solicitado **/
        $row = $contentSub->get($content_sub_id);

        /** Verifico se existe o registro **/
        if (isset($row)) {

            /** Verfico se o registro é válido **/
            if ($row->content_sub_id > 0) {

                /** Executo o método de exclusão **/
                if ($contentSub->delete($row->content_sub_id)) {

                    /** Result **/
                    $result = array(
                        "cod" => 1,
                        "message" => $message[0] = array(
                            "Registro Excluído com Sucesso!"
                        )
                    );
                } else {

                    /** Result **/
                    $result = array(
                        "cod" => 0,
                        "message" => $message[0] = array(
                            "Erro ao executar método"
                        )
                    );
                }
            } else {

                /** Result **/
                $result = array(
                    "cod" => 0,
                    "message" => $message[0] = array(
                        "Registro inválido"
                    )
                );
            }
        } else {

            /** Result **/
            $result = array(
                "cod" => 0,
                "message" => $message[0] = array(
                    "Não foi possível localizar o registro"
                )
            );
        }
    }

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
