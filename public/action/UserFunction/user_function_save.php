<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Instânciamento da classe UserFunction  **/
   $UserFunction = $Main->LoadClass('UserFunction');

   /** Capturo meus campos envios por json **/
   $inputs = json_decode(file_get_contents('php://input'), true);

   /** Parâmetros de entrada **/
   $user_function_id = isset($inputs['inputs']['user_function_id']) ? (int)$Main->anti_injection($inputs['inputs']['user_function_id']) : 0;
   $situation_id     = isset($inputs['inputs']['situation_id'])     ? (int)$Main->anti_injection($inputs['inputs']['situation_id'])     : 1;
   $name             = isset($inputs['inputs']['name'])             ? (string)$Main->anti_injection($inputs['inputs']['name'])          : '';
   $description      = isset($inputs['inputs']['description'])      ? (string)$Main->anti_injection($inputs['inputs']['description'])   : '';
   $c_execute        = isset($inputs['inputs']['c_execute'])        ? (boolean)$Main->anti_injection($inputs['inputs']['c_execute'])    : 0;
   $r_execute        = isset($inputs['inputs']['r_execute'])        ? (boolean)$Main->anti_injection($inputs['inputs']['r_execute'])    : 0;
   $u_execute        = isset($inputs['inputs']['u_execute'])        ? (boolean)$Main->anti_injection($inputs['inputs']['u_execute'])    : 0;
   $d_execute        = isset($inputs['inputs']['d_execute'])        ? (boolean)$Main->anti_injection($inputs['inputs']['d_execute'])    : 0;
   $date_register    = isset($inputs['inputs']['date_register'])    ? (string)$Main->anti_injection($inputs['inputs']['date_register']) : date("y-m-d h:m:s");
   $date_update      = isset($inputs['inputs']['date_update'])      ? (string)$Main->anti_injection($inputs['inputs']['date_update'])   : date("y-m-d h:m:s");

   /** Controle de Erros **/
   $error            = 0;
   $message          = array();

   /** Validação de campos obrigatórios **/
   /** Verifico se o campo user_function_id foi preenchido **/
   if($user_function_id < 0){

       $error++;
       $message[0] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>user_function_id</strong>.<br/>';

   }
   /** Verifico se o campo situation_id foi preenchido **/
   if($situation_id <= 0){

       $error++;
       $message[1] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>situation_id</strong>.<br/>';

   }
   /** Verifico se o campo name foi preenchido **/
   if(empty($name)){

       $error++;
       $message[2] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>name</strong>.<br/>';

   }
   /** Verifico se o campo description foi preenchido **/
   if(empty($description)){

       $error++;
       $message[3] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>description</strong>.<br/>';

   }
   /** Verifico se o campo date_register foi preenchido **/
   if(empty($date_register)){

       $error++;
       $message[4] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>date_register</strong>.<br/>';

   }
   /** Verifico se o campo date_update foi preenchido **/
   if(empty($date_update)){

       $error++;
       $message[5] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>date_update</strong>.<br/>';

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

       $UserFunction->Save($user_function_id, $situation_id, $name, $description, $c_execute, $r_execute, $u_execute, $d_execute, $date_register, $date_update);

       /** Result **/
       $result = array("cod" => 1, "message" => "Informações atualizadas com sucesso!");

       /** Pause **/
       sleep(1);

       /** Envio **/
       echo json_encode($result);

       /** Paro o procedimento **/
       exit;

   }

}catch(Exception $e){

   /** Preparo o formulario para retorno **/
   $result = array("cod" => 0, "message" => $e->getMessage());

   /** Pause **/
   sleep(1);

   /** Envio **/
   echo json_encode($result);

   /** Paro o procedimento **/
   exit;

}
