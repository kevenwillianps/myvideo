<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Instânciamento da classe User  **/
   $User   = $Main->LoadClass('User');

   /** Capturo meus campos envios por json **/
   $inputs = json_decode(file_get_contents('php://input'), true);

   /** Parâmetros de entrada **/
   $user_id          = isset($inputs['inputs']['user_id'])          ? (int)$Main->anti_injection($inputs['inputs']['user_id'])          : 0;
   $user_function_id = isset($inputs['inputs']['user_function_id']) ? (int)$Main->anti_injection($inputs['inputs']['user_function_id']) : 1;
   $situation_id     = isset($inputs['inputs']['situation_id'])     ? (int)$Main->anti_injection($inputs['inputs']['situation_id'])     : 1;
   $name             = isset($inputs['inputs']['name'])             ? (string)$Main->anti_injection($inputs['inputs']['name'])          : '';
   $email            = isset($inputs['inputs']['email'])            ? (string)$Main->anti_injection($inputs['inputs']['email'])         : '';
   $date_birth       = isset($inputs['inputs']['date_birth'])       ? (string)$Main->anti_injection($inputs['inputs']['date_birth'])    : '';
   $access_first     = isset($inputs['inputs']['access_first'])     ? (string)$Main->anti_injection($inputs['inputs']['access_first'])  : date("y-m-d h:m:s");
   $access_last      = isset($inputs['inputs']['access_last'])      ? (string)$Main->anti_injection($inputs['inputs']['access_last'])   : date("y-m-d h:m:s");
   $access_log       = isset($inputs['inputs']['access_log'])       ? (string)$Main->anti_injection($inputs['inputs']['access_log'])    : '';
   $password         = isset($inputs['inputs']['password'])         ? (string)$Main->anti_injection($inputs['inputs']['password'])      : '';
   $date_register    = isset($inputs['inputs']['date_register'])    ? (string)$Main->anti_injection($inputs['inputs']['date_register']) : date("y-m-d h:m:s");
   $date_update      = isset($inputs['inputs']['date_update'])      ? (string)$Main->anti_injection($inputs['inputs']['date_update'])   : date("y-m-d h:m:s");

   /** Controle de Erros **/
   $error   = 0;
   $message = array();

   /** Validação de campos obrigatórios **/
   /** Verifico se o campo user_id foi preenchido **/
   if($user_id < 0){

       $error++;
       $message[0] = $error. '- UserID - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo user_function_id foi preenchido **/
   if($user_function_id < 0){

       $error++;
       $message[1] = $error. '- UserFunctionID - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo situation_id foi preenchido **/
   if($situation_id < 0){

       $error++;
       $message[2] = $error. '- SituationID - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo name foi preenchido **/
   if(empty($name)){

       $error++;
       $message[3] = $error. '- Name - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo email foi preenchido **/
   if(empty($email)){

       $error++;
       $message[4] = $error. '- Email - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo date_birth foi preenchido **/
   if(empty($date_birth)){

       $error++;
       $message[5] = $error. '- DateBirth - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo date_register foi preenchido **/
   if(empty($date_register)){

       $error++;
       $message[6] = $error. '- DateRegister - O seguinte campo deve ser preenchido/selecionado';

   }
   /** Verifico se o campo date_update foi preenchido **/
   if(empty($date_update)){

       $error++;
       $message[7] = $error. '- DateUpdate - O seguinte campo deve ser preenchido/selecionado';

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

       $User->Save($user_id, $user_function_id, $situation_id, $name, $email, $date_birth, $access_first, $access_last, $access_log, md5($password), $date_register, $date_update);

       /** Result **/
       $result = array("cod" => 1, "message" => "Informações atualizadas com sucesso!",);

       /** Pause **/
       sleep(1);

       /** Envio **/
       echo json_encode($result);

       /** Paro o procedimento **/
       exit;

   }

}catch(Exception $e){

   /** Preparo o formulario para retorno **/
   $result = array("cod" => 0, "msg" => $e->getMessage(), "title" => "Atenção");

   /** Pause **/
   sleep(1);

   /** Envio **/
   echo json_encode($result);

   /** Paro o procedimento **/
   exit;

}
