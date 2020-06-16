<?php
try{

    /**
     * Created by MyCode
     * User: KEVEN
     * Date: 07/05/2020
     * Time: 20:35
     **/

    /** Capturo meus campos envios por json **/
    $inputs = json_decode(file_get_contents('php://input'), true);

    /** Instânciamento da classe Files  **/
    $ContentFile = $Main->LoadClass('ContentFile');

    /** Parâmetros de entrada - Controle de Arquivo **/
    $pointer   = isset($inputs['inputs']['pointer'])   ? (int)$Main->anti_injection($inputs['inputs']['pointer'])      : 0;
    $part      = isset($inputs['inputs']['part'])      ? (string)$Main->anti_injection($inputs['inputs']['part'])      : '';
    $length    = isset($inputs['inputs']['length'])    ? (int)$Main->anti_injection($inputs['inputs']['length'])       : 0;
    $extension = isset($inputs['inputs']['extension']) ? (string)$Main->anti_injection($inputs['inputs']['extension']) : '';

    /** Parâmetros de entrada **/
    $content_file_id = isset($inputs['inputs']['content_file_id']) ? (int)$Main->anti_injection($inputs['inputs']['content_file_id']) : 0;
    $content_id      = isset($inputs['inputs']['content_id'])      ? (int)$Main->anti_injection($inputs['inputs']['content_id'])      : 0;
    $user_id         = isset($inputs['inputs']['user_id'])         ? (int)$Main->anti_injection($inputs['inputs']['user_id'])         : $_SESSION['MYSUPPORT-USER-ID'];
    $situation_id    = isset($inputs['inputs']['situation_id'])    ? (int)$Main->anti_injection($inputs['inputs']['situation_id'])    : 1;
    $name            = isset($inputs['inputs']['name'])            ? (string)$Main->anti_injection($inputs['inputs']['name'])         : 'file_'.rand(5, 15);
    $description     = isset($inputs['inputs']['description'])     ? (string)$Main->anti_injection($inputs['inputs']['description'])  : 'description_'.rand(5, 15);
    $base64          = isset($inputs['inputs']['base64'])          ? (string)$Main->anti_injection($inputs['inputs']['base64'])       : 'base64_'.rand(5, 15);
    $file_type       = isset($inputs['inputs']['file_type'])       ? (string)$Main->anti_injection($inputs['inputs']['file_type'])    : $extension;
    $date_register   = isset($inputs['inputs']['date_register'])   ? (string)$Main->anti_injection($inputs['inputs']['date_register']): date("y-m-d h:m:s");
    $date_update     = isset($inputs['inputs']['date_update'])     ? (string)$Main->anti_injection($inputs['inputs']['date_update'])  : date("y-m-d h:m:s");

    /** Pego o ano atual **/
    $year  = date('Y');
    /** Pego o mês atual **/
    $month = date('m');
    /** Pego o dia atual **/
    $day   = date('d');
    /** Caminho raiz dos documentos **/
    $path  = "document/{$year}/{$month}/{$day}/{$extension}";

    /** Controle de erros **/
    $error   = 0;
    $message = array();

    /** Validação de campos obrigatórios **/
    /** Verifico se o campo file_id foi preenchido **/
    if($content_file_id < 0){

        $error++;
        $message[0] = $error. 'file_id - O seguinte campo deve ser preenchido/selecionado';

    }
    /** Verifico se o campo name foi preenchido **/
    if(empty($name)){

        $error++;
        $message[1] = $error. 'name - O seguinte campo deve ser preenchido/selecionadop';

    }
    /** Verifico se o campo path foi preenchido **/
    if($pointer < 0){

        $error++;
        $message[2] = $error. 'pointer - O seguinte campo deve ser preenchido/selecionado';

    }
    /** Verifico se o campo path foi preenchido **/
    if(empty($part)){

        $error++;
        $message[3] = $error. 'part - O seguinte campo deve ser preenchido/selecionado';

    }
    /** Verifico se o campo path foi preenchido **/
    if($length < 0){

        $error++;
        $message[4] = $error. 'length - O seguinte campo deve ser preenchido/selecionado';

    }
    /** Verifico se o campo path foi preenchido **/
    if(empty($extension)){

        $error++;
        $message[5] = $error. 'extension - O seguinte campo deve ser preenchido/selecionado';

    }

    if($error > 0){

        /** Preparo o formulario para retorno **/
        $result = array("cod" => 0, "message" => $message);

        /**pause*/
        sleep(1);

        /**Envio*/
        echo json_encode($result);

        /**Para o procedimento*/
        exit;

    }else{

        /** Verifico se existe o caminho **/
        if (is_dir($path)){

            if ($pointer == ($length - 1)){

                /** Crio meu arquivo e escrevo dentro dele **/
                $document = fopen($path.'/'.$name, "a+");

                /** Escrevo dentro do arquivo **/
                fwrite($document, base64_decode($part));

                /** Encerro a escrita do arquivo **/
                fclose($document);

                if (is_file($path.'/'.$name)){

                    /** Método para salvar o registro **/
                    $ContentFile->Save($content_file_id, $content_id, $user_id, $situation_id, $name, $description, $base64, $file_type, $path, $date_register, $date_update);

                    /** Result **/
                    $result = array("cod" => 99, "message" => "Arquivo salvo com sucesso!", "content_file_id" => $ContentFile->GetLast()->content_file_id);

                    /** Envio **/
                    echo json_encode($result);

                    /** Paro o procedimento **/
                    exit;

                }else{

                    /** Result **/
                    $result = array("cod" => 0, "message" => "Não foi localizado o arquivo");

                    /** Envio **/
                    echo json_encode($result);

                    /** Paro o procedimento **/
                    exit;

                }

            }else{

                /** Crio meu arquivo e escrevo dentro dele **/
                $document = fopen($path.'/'.$name, "a+");

                /** Escrevo dentro do arquivo **/
                fwrite($document, base64_decode($part));

                /** Encerro a escrita do arquivo **/
                fclose($document);

                if (is_file($path.'/'.$name)){

                    /** Result **/
                    $result = array("cod" => 1, "message" => "Arquivo criado com sucesso");

                    /** Envio **/
                    echo json_encode($result);

                    /** Paro o procedimento **/
                    exit;

                }else{

                    /** Result **/
                    $result = array("cod" => 0, "message" => "Não foi possível criar o arquivo");

                    /** Envio **/
                    echo json_encode($result);

                    /** Paro o procedimento **/
                    exit;

                }

            }

        }else{

            /** Crio o caminho **/
            mkdir($path, 0777, true);

            /** Verifico se existe o caminho **/
            if (is_dir($path)){

                if ($pointer == ($length - 1)){

                    /** Crio meu arquivo e escrevo dentro dele **/
                    $document = fopen($path.'/'.$name, "a+");

                    /** Escrevo dentro do arquivo **/
                    fwrite($document, base64_decode($part));

                    /** Encerro a escrita do arquivo **/
                    fclose($document);

                    if (is_file($path.'/'.$name)){

                        /** Método para salvar o registro **/
                        $ContentFile->Save($content_file_id, $content_id, $user_id, $situation_id, $name, $description, $base64, $file_type, $path, $date_register, $date_update);

                        /** Result **/
                        $result = array("cod" => 99, "message" => "Arquivo salvo com sucesso!", "content_file_id" => $ContentFile->GetLast()->content_file_id);

                        /** Envio **/
                        echo json_encode($result);

                        /** Paro o procedimento **/
                        exit;

                    }else{

                        /** Result **/
                        $result = array("cod" => 0, "message" => "Não foi localizado o arquivo");

                        /** Envio **/
                        echo json_encode($result);

                        /** Paro o procedimento **/
                        exit;

                    }

                }else{

                    /** Crio meu arquivo e escrevo dentro dele **/
                    $document = fopen($path.'/'.$name, "a+");

                    /** Escrevo dentro do arquivo **/
                    fwrite($document, base64_decode($part));

                    /** Encerro a escrita do arquivo **/
                    fclose($document);

                    if (is_file($path.'/'.$name)){

                        /** Result **/
                        $result = array("cod" => 1, "message" => "Arquivo criado com sucesso");

                        /** Envio **/
                        echo json_encode($result);

                        /** Paro o procedimento **/
                        exit;

                    }else{

                        /** Result **/
                        $result = array("cod" => 0, "message" => "Não foi possível criar o arquivo");

                        /** Envio **/
                        echo json_encode($result);

                        /** Paro o procedimento **/
                        exit;

                    }

                }

            }

        }

    }

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