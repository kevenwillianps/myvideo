<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Instânciamento da classe Highlighter  **/
   $Highlighter = $Main->LoadClass('Highlighter');

   /** Capturo meus campos envios por json **/
   $inputs = json_decode(file_get_contents('php://input'), true);

   /** Parâmetros de entrada **/
   $highlighter_id = isset($inputs['inputs']['highlighter_id']) ? (int)$Main->anti_injection($inputs['inputs']['highlighter_id'])   : 0;
   $name           = isset($inputs['inputs']['name'])           ? (string)$Main->anti_injection($inputs['inputs']['name'])          : '';
   $description    = isset($inputs['inputs']['description'])    ? (string)$Main->anti_injection($inputs['inputs']['description'])   : '';
   $date_register  = isset($inputs['inputs']['date_register'])  ? (string)$Main->anti_injection($inputs['inputs']['date_register']) : date("y-m-d h:m:s");
   $date_update    = isset($inputs['inputs']['date_update'])    ? (string)$Main->anti_injection($inputs['inputs']['date_update'])   : date("y-m-d h:m:s");

   /** Controle de Erros **/
   $error   = 0;
   $message = array();

   /** Validação de campos obrigatórios **/
   /** Verifico se o campo highlighter_id foi preenchido **/
   if($highlighter_id < 0){

       $error++;
       $message[0] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>highlighter_id</strong>.<br/>';

   }
   /** Verifico se o campo name foi preenchido **/
   if(empty($name)){

       $error++;
       $message[1] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>name</strong>.<br/>';

   }
   /** Verifico se o campo description foi preenchido **/
   if(empty($description)){

       $error++;
       $message[2] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>description</strong>.<br/>';

   }
   /** Verifico se o campo date_register foi preenchido **/
   if(empty($date_register)){

       $error++;
       $message[3] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>date_register</strong>.<br/>';

   }
   /** Verifico se o campo date_update foi preenchido **/
   if(empty($date_update)){

       $error++;
       $message[4] = $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>date_update</strong>.<br/>';

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

       $Highlighter->Save($highlighter_id, $name, $description, $date_register, $date_update);

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
