<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Instânciamento da classe Content  **/
   $Content = $Main->LoadClass('Content');

   /** Capturo meus campos envios por json **/
   $inputs = json_decode(file_get_contents('php://input'), true);

   /** Parâmetros de entrada **/
   $content_id          = isset($inputs['inputs']['content_id'])          ? (int)$Main->anti_injection($inputs['inputs']['content_id'])          : 0;
   $content_category_id = isset($inputs['inputs']['content_category_id']) ? (int)$Main->anti_injection($inputs['inputs']['content_category_id']) : 1;
   $user_id             = isset($inputs['inputs']['user_id'])             ? (int)$Main->anti_injection($inputs['inputs']['user_id'])             : $_SESSION['MYSUPPORT-USER-ID'];
   $situation_id        = isset($inputs['inputs']['situation_id'])        ? (int)$Main->anti_injection($inputs['inputs']['situation_id'])        : 1;
   $highlighter_id      = isset($inputs['inputs']['highlighter_id'])      ? (int)$Main->anti_injection($inputs['inputs']['highlighter_id'])      : 1;
   $menu_position       = isset($inputs['inputs']['menu_position'])       ? (int)$Main->anti_injection($inputs['inputs']['menu_position'])       : 1;
   $url                 = isset($inputs['inputs']['url'])                 ? (string)$Main->anti_injection($inputs['inputs']['url'])              : 'Não Informado';
   $title               = isset($inputs['inputs']['title'])               ? (string)$Main->anti_injection($inputs['inputs']['title'])            : '';
   $title_menu          = isset($inputs['inputs']['title_menu'])          ? (string)$Main->anti_injection($inputs['inputs']['title_menu'])       : 'Não Informado';
   $description         = isset($inputs['inputs']['description'])         ? (string)$Main->anti_injection($inputs['inputs']['description'])      : 'Não Informado';
   $content_resume      = isset($inputs['inputs']['content_resume'])      ? (string)$Main->anti_injection($inputs['inputs']['content_resume'])   : 'Não Informado';
   $content_complete    = isset($inputs['inputs']['content_complete'])    ? (string)$Main->anti_injection($inputs['inputs']['content_complete']) : '';
   $date_register       = isset($inputs['inputs']['date_register'])       ? (string)$Main->anti_injection($inputs['inputs']['date_register'])    : date("y-m-d h:m:s");
   $date_update         = isset($inputs['inputs']['date_update'])         ? (string)$Main->anti_injection($inputs['inputs']['date_update'])      : date("y-m-d h:m:s");

   /** Controle de Erros **/
   $error   = 0;
   $message = array();

   /** Validação de campos obrigatórios **/
   /** Verifico se o campo content_id foi preenchido **/
   if($content_id < 0){

       $error++;
       $message[0] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>content_id</strong>.<br/>';

   }
   /** Verifico se o campo content_category_id foi preenchido **/
   if($content_category_id <= 0){

       $error++;
       $message[1] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>content_category_id</strong>.<br/>';

   }
   /** Verifico se o campo user_id foi preenchido **/
   if($user_id <= 0){

       $error++;
       $message[2] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>user_id</strong>.<br/>';

   }
   /** Verifico se o campo situation_id foi preenchido **/
   if($situation_id <= 0){

       $error++;
       $message[3] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>situation_id</strong>.<br/>';

   }
   /** Verifico se o campo highlighter_id foi preenchido **/
   if($highlighter_id <= 0){

       $error++;
       $message[4] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>highlighter_id</strong>.<br/>';

   }
   /** Verifico se o campo menu_position foi preenchido **/
   if(empty($menu_position)){

       $error++;
       $message[5] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>menu_position</strong>.<br/>';

   }
   /** Verifico se o campo date_register foi preenchido **/
   if(empty($date_register)){

       $error++;
       $message[6] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>date_register</strong>.<br/>';

   }
   /** Verifico se o campo date_update foi preenchido **/
   if(empty($date_update)){

       $error++;
       $message[7] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>date_update</strong>.<br/>';

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

       $Content->Save($content_id, $content_category_id, $user_id, $situation_id, $highlighter_id, $menu_position, $url, $title, $title_menu, $description, $content_resume, $content_complete, $date_register, $date_update);

       /** Result **/
       $result = array("cod" => 1, "content_id" => ($content_id > 0 ? $content_id : $Content->GetLast()->content_id), "message" => "Informações atualizadas com sucesso!");

       /** Pause **/
       sleep(1);

       /** Envio **/
       echo json_encode($result);

       /** Paro o procedimento **/
       exit;

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
