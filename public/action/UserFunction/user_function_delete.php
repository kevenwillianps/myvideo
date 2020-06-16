<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /* Instânciamento da classe UserFunction  */
   $UserFunction = $Main->LoadClass('UserFunction');

   /* Parâmetros de entrada */
   $user_function_id = isset($_POST['USER_FUNCTION_ID']) ? (int)$Main->anti_injection($_POST['USER_FUNCTION_ID']) : 0;
   $error   = '';
   $message = '';

   /* Validação de campos obrigatórios */
   /* Verifico se o campo user_function_id foi preenchido */
   if(empty($user_function_id)){

       $error++;
       $message .= $error. ' - O seguinte campo deve ser preenchido/selecionado <strong>user_function_id</strong>.<br/>';

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
       $row = $UserFunction->Get($user_function_id);

       /** Verifico se existe o registro **/
       if(isset($row)){

           /** Verfico se o registro é válido **/
           if($row->user_function_id > 0){

               /** Executo o método de exclusão **/
               if($UserFunction->Delete($row->user_function_id)){

                   /** Se o registro possuir arquivo, sua pasta com os arquivos **/
                   if (is_dir("images/UserFunction/" . $user_function_id . "/")){

                       function delTree($dir) {

                           $files = array_diff(scandir($dir), array('.','..'));

                               foreach ($files as $file) {

                                   (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");

                               }

                               return rmdir($dir);

                           }

                       delTree("images/UserFunction/" . $user_function_id . "/");

                       /** Result **/
                       $result = array("cod"   => 1,
                                       "msg"   => "Registro Excluído com Sucesso!",
                                       "title" => "Atenção",
                                       "qs"    => "TABLE=USER_FUNCTION&ACTION=DATAGRID");

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
                                   "qs"    => "TABLE=USER_FUNCTION&ACTION=DATAGRID");

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
                           "qs"    => "TABLE=USER_FUNCTION&ACTION=DATAGRID");

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
