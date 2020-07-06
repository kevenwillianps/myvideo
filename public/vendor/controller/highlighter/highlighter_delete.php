<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Realizo a importação de classes **/
use \vendor\model\Main;
use \vendor\model\Highlighter;

/** Instânciamento das classes importadas **/
$main = new Main();
$highlighter = new Highlighter();

try {

    /** Capturo meus campos envios por json **/
    $inputs = json_decode(file_get_contents('php://input'), true);

    /** Parâmetros de entrada **/
    $highlighter_id = isset($inputs['inputs']['highlighter_id']) ? (int)$main->antiInjection($inputs['inputs']['highlighter_id']) : 0;

    /** Controle de erros **/
    $message = array();

    /** Validação de campos obrigatórios **/
    /** Verifico se o campo class_id foi preenchido **/
    if ($highlighter_id <= 0) {
        array_push($message, '$situation_id - O seguinte campo deve ser preenchido/selecionado');
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
        $row = $highlighter->get($highlighter_id);

        /** Verifico se existe o registro **/
        if (isset($row)) {

            /** Verfico se o registro é válido **/
            if ($row->highlighter_id > 0) {

                /** Executo o método de exclusão **/
                if ($highlighter->delete($row->highlighter_id)) {
                    array_push($message, "Registro Excluído com Sucesso!");

                    /** Result **/
                    $result = array(

                        "cod" => 1,
                        "message" => $message

                    );
                } else {
                    array_push($message, "Erro ao executar método");

                    /** Result **/
                    $result = array(

                        "cod" => 0,
                        "message" => $message

                    );
                }
            } else {
                array_push($message, "Registro inválido");

                /** Result **/
                $result = array(

                    "cod" => 0,
                    "message" => $message

                );
            }
        } else {
            array_push($message, "Não foi possível localizar o registro");

            /** Result **/
            $result = array(

                "cod" => 0,
                "message" => $message

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
