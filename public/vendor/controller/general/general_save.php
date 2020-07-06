<?php
try {

   /**
    * Created by MyCode
    * user: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

    /* Instânciamento da classe general  */
    $General = $Main->LoadClass('General');

    /* Parâmetros de entrada */
    $general_id = isset($_POST['general_id']) ? (int)$Main->anti_injection($_POST['general_id']) : 0;
    $user_id = isset($_POST['user_id']) ? (int)$Main->anti_injection($_POST['user_id']) : 0;
    $title = isset($_POST['title']) ? (string)$Main->anti_injection($_POST['title']) : '';
    $description = isset($_POST['description']) ? (string)$Main->anti_injection($_POST['description']) : '';
    $keywords = isset($_POST['keywords']) ? (string)$Main->anti_injection($_POST['keywords']) : '';
    $copyright = isset($_POST['copyright']) ? (string)$Main->anti_injection($_POST['copyright']) : '';
    $author = isset($_POST['author']) ? (string)$Main->anti_injection($_POST['author']) : '';
    $url = isset($_POST['url']) ? (string)$Main->anti_injection($_POST['url']) : '';
    $email = isset($_POST['email']) ? (string)$Main->anti_injection($_POST['email']) : '';
    $smtp = isset($_POST['smtp']) ? (string)$Main->anti_injection($_POST['smtp']) : '';
    $port = isset($_POST['port']) ? (string)$Main->anti_injection($_POST['port']) : '';
    $password = isset($_POST['password']) ? (string)$Main->anti_injection($_POST['password']) : '';
    $domain = isset($_POST['domain']) ? (string)$Main->anti_injection($_POST['domain']) : '';
    $charsert = isset($_POST['charsert']) ? (string)$Main->anti_injection($_POST['charsert']) : '';
    $username = isset($_POST['username']) ? (string)$Main->anti_injection($_POST['username']) : '';
    $session = isset($_POST['session']) ? (string)$Main->anti_injection($_POST['session']) : '';
    $number_register = isset($_POST['number_register']) ? (int)$Main->anti_injection($_POST['number_register']) : 0;
    $cnpj = isset($_POST['cnpj']) ? (string)$Main->anti_injection($_POST['cnpj']) : '';
    $endereco = isset($_POST['endereco']) ? (string)$Main->anti_injection($_POST['endereco']) : '';
    $telefone = isset($_POST['telefone']) ? (string)$Main->anti_injection($_POST['telefone']) : '';
    $celular = isset($_POST['celular']) ? (string)$Main->anti_injection($_POST['celular']) : '';
    $facebook = isset($_POST['facebook']) ? (string)$Main->anti_injection($_POST['facebook']) : '';
    $instagram = isset($_POST['instagram']) ? (string)$Main->anti_injection($_POST['instagram']) : '';
    $pinterest = isset($_POST['pinterest']) ? (string)$Main->anti_injection($_POST['pinterest']) : '';
    $twitter = isset($_POST['twitter']) ? (string)$Main->anti_injection($_POST['twitter']) : '';
    $date_register = isset($_POST['date_register']) ? (string)$Main->anti_injection($_POST['date_register']) : date("y-m-d h:m:s");
    $date_update = isset($_POST['date_update']) ? (string)$Main->anti_injection($_POST['date_update']) : date("y-m-d h:m:s");
    $error   = '';
    $message = '';

    /* Validação de campos obrigatórios */
    /* Verifico se o campo general_id foi preenchido */
    if (empty($general_id)) {
        $error++;
        $message .= $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>general_id</strong>.<br/>';
    }
    /* Verifico se o campo user_id foi preenchido */
    if (empty($user_id)) {
        $error++;
        $message .= $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>user_id</strong>.<br/>';
    }
    /* Verifico se o campo date_register foi preenchido */
    if (empty($date_register)) {
        $error++;
        $message .= $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>date_register</strong>.<br/>';
    }
    /* Verifico se o campo date_update foi preenchido */
    if (empty($date_update)) {
        $error++;
        $message .= $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>date_update</strong>.<br/>';
    }

    if ($error > 0) {

       /** Preparo o formulario para retorno **/
        $result = array("cod"   => 0,
                       "msg"   => $message." <br/> Total de erros encontrados: ".$error,
                       "title" => "Atenção");

        /**pause*/
        sleep(1);

        /**Envio*/
        echo json_encode($result);

        /**Para o procedimento*/
        exit;
    } else {
        $General->Save($general_id, $user_id, $title, $description, $keywords, $copyright, $author, $url, $email, $smtp, $port, $password, $domain, $charsert, $username, $session, $number_register, $cnpj, $endereco, $telefone, $celular, $facebook, $instagram, $pinterest, $twitter, $date_register, $date_update);

        /** Result **/
        $result = array("cod"   => 1,
                       "msg"   => "Informações atualizadas com sucesso!",
                       "title" => "Atenção",
                       "qs"    => "TABLE=GENERAL&ACTION=DATAGRID");

        /** Pause **/
        sleep(1);

        /** Envio **/
        echo json_encode($result);

        /** Paro o procedimento **/
        exit;
    }
} catch (Exception $e) {

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
