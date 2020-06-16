<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /* Instânciamento da classe Situation  */
   $Situation = $Main->LoadClass('Situation');

   /* Parâmetros de entrada */
   $situation_id = isset($_POST['SITUATION_ID']) ? (int)$Main->anti_injection($_POST['SITUATION_ID']) : 0;
   $error   = '';
   $message = '';

   /* Validação de campos obrigatórios */
   /* Verifico se o campo situation_id foi preenchido */
   if(empty($situation_id)){

       $error++;
       $message .= $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>situation_id</strong>.<br/>';

   }

   if($error > 0){

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

   }else{

       /** Busco o registro solicitado **/
       $row = $Situation->Get($situation_id);

       /** Verifico se existe o registro **/
       if(isset($row)){

           /** Verfico se o registro é válido **/
           if($row->situation_id > 0){

               /** Executo o método de exclusão **/
               if($Situation->Delete($row->situation_id)){

                   /** Se o registro possuir arquivo, sua pasta com os arquivos **/
                   if (is_dir("images/Situation/" . $situation_id . "/")){

                       function delTree($dir) {

                           $files = array_diff(scandir($dir), array('.','..'));

                               foreach ($files as $file) {

                                   (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");

                               }

                               return rmdir($dir);

                           }

                       delTree("images/Situation/" . $situation_id . "/");

                       /** Result **/
                       $result = array("cod"   => 1,
                                       "msg"   => "Registro Excluído com Sucesso!",
                                       "title" => "Atenção",
                                       "qs"    => "TABLE=SITUATION&ACTION=DATAGRID");

                       /** Pause **/
                       sleep(1);

                       /** Envio **/
                       echo json_encode($result);

                       /** Paro o procedimento **/
                       exit;

                   }

                   /** Result **/
                   $result = array("cod"   => 1,
                                   "msg"   => "Registro Excluído com Sucesso!",
                                   "title" => "Atenção",
                                   "qs"    => "TABLE=SITUATION&ACTION=DATAGRID");

                   /** Pause **/
                   sleep(1);

                   /** Envio **/
                   echo json_encode($result);

                   /** Paro o procedimento **/
                   exit;

               }
               else
               {

                   /** Result **/
                   $result = array("cod"   => 0,
                                   "msg"   => "Erro ao executar método",
                                   "title" => "Atenção");

                   /** Pause **/
                   sleep(1);

                   /** Envio **/
                   echo json_encode($result);

                   /** Paro o procedimento **/
                   exit;

               }

           }
           else
           {

               /** Result **/
               $result = array("cod"   => 0,
                               "msg"   => "Registro inválido",
                               "title" => "Atenção");

                /** Pause **/
                sleep(1);

                /** Envio **/
                echo json_encode($result);

                /** Paro o procedimento **/
                exit;

           }

       }
       else
       {

           /** Result **/
           $result = array("cod"   => 0,
                           "msg"   => "Não foi possível localizar o registro",
                           "title" => "Atenção",
                           "qs"    => "TABLE=SITUATION&ACTION=DATAGRID");

           /** Pause **/
           sleep(1);

           /** Envio **/
           echo json_encode($result);

           /** Paro o procedimento **/
           exit;

       }

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
