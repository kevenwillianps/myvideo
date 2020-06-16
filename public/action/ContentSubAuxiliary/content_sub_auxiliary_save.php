<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Instânciamento da classe ContentSub  **/
   $ContentSub = $Main->LoadClass('ContentSub');

   /** Capturo meus campos envios por json **/
   $inputs = json_decode(file_get_contents('php://input'), true);

   /** Parâmetros de entrada **/
   $content_sub_id           = isset($inputs['inputs']['content_sub_id'])           ? (int)$Main->anti_injection($inputs['inputs']['content_sub_id'])              : 0;
   $content_id               = isset($inputs['inputs']['content_id'])               ? (int)$Main->anti_injection($inputs['inputs']['content_id'])                  : 0;
   $content_sub_auxiliary_id = isset($inputs['inputs']['content_sub_auxiliary_id']) ? (int)$Main->anti_injection($inputs['inputs']['content_sub_auxiliary_id'])    : 0;
   $user_id                  = isset($inputs['inputs']['user_id'])                  ? (int)$Main->anti_injection($inputs['inputs']['user_id'])                     : $_SESSION['MYSUPPORT-USER-ID'];
   $situation_id             = isset($inputs['inputs']['situation_id'])             ? (int)$Main->anti_injection($inputs['inputs']['situation_id'])                : 1;
   $menu_position            = isset($inputs['inputs']['menu_position'])            ? (int)$Main->anti_injection($inputs['inputs']['menu_position'])               : 1;
   $highlighter_id           = isset($inputs['inputs']['highlighter_id'])           ? (int)$Main->anti_injection($inputs['inputs']['highlighter_id'])              : 1;
   $url                      = isset($inputs['inputs']['url'])                      ? (string)$Main->anti_injection($inputs['inputs']['url'])                      : '';
   $title                    = isset($inputs['inputs']['title'])                    ? (string)$Main->anti_injection($inputs['inputs']['title'])                    : '';
   $title_menu               = isset($inputs['inputs']['title_menu'])               ? (string)$Main->anti_injection($inputs['inputs']['title_menu'])               : '';
   $description              = isset($inputs['inputs']['description'])              ? (string)$Main->anti_injection($inputs['inputs']['description'])              : '';
   $content_resume           = isset($inputs['inputs']['content_resume'])           ? (string)$Main->anti_injection($inputs['inputs']['content_resume'])           : '';
   $content_complete         = isset($inputs['inputs']['content_complete'])         ? (string)$Main->anti_injection($inputs['inputs']['content_complete'])         : '';
   $date_register            = isset($inputs['inputs']['date_register'])            ? (string)$Main->anti_injection($inputs['inputs']['date_register'])            : date("y-m-d h:m:s");
   $date_update              = isset($inputs['inputs']['date_update'])              ? (string)$Main->anti_injection($inputs['inputs']['date_update'])              : date("y-m-d h:m:s");

   /** Controle de erros **/
   $error   = 0;
   $message = array();

   /** Validação de campos obrigatórios **/
   /** Verifico se o campo content_sub_id foi preenchido **/
   if($content_sub_id < 0){

       $error++;
       $message[0] = $error. '- ContentSubId - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo user_id foi preenchido **/
   if($user_id <= 0){

       $error++;
       $message[1] = $error. '- UserID - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo situation_id foi preenchido **/
   if($situation_id <= 0){

       $error++;
       $message[2] = $error. '- SituationID - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo menu_position foi preenchido **/
   if($menu_position <= 0){

       $error++;
       $message[3] = $error. '- MenuPosition - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo highlighter_id foi preenchido **/
   if($highlighter_id <= 0){

       $error++;
       $message[4] = $error. '- HighlighterID - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo date_register foi preenchido **/
   if(empty($date_register)){

       $error++;
       $message[5] = $error. '- DateRegister - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo date_update foi preenchido **/
   if(empty($date_update)){

       $error++;
       $message[6] = $error. '- DateUpdate - O seguinte campo deve ser preenchido/selecionado';

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

       $ContentSub->SaveAuxiliary($content_sub_id, $content_id, $content_sub_auxiliary_id, $user_id, $situation_id, $menu_position, $highlighter_id, $url, $title, $title_menu, $description, $content_resume, $content_complete, $date_register, $date_update);

       /** Result **/
       $result = array("cod" => 1, "content_sub_id" => ($content_sub_id > 0 ? $content_sub_id : $ContentSub->GetLast()->content_sub_id), "message" => "Informações atualizadas com sucesso!");

       /** Pause **/
       sleep(1);

       /** Envio **/
       echo json_encode($result);

       /** Paro o procedimento **/
       exit;

   }

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
