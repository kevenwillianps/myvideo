<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Parâmetros de entrada  **/
   $user_id = isset($_POST['user_id']) ? (int)$Main->anti_injection($_POST['user_id']) : 0;

   /** Instânciamento da classe User  **/
   $User = $Main->LoadClass('User');

   /** Carrego o meu registro  **/
   $row = $User->Get($user_id);

   /** Cabeçalho da página  **/
   $div  = '<div class="card text-white text-center shadow-sm border-0" style="background-image: linear-gradient(to right top,#3ac484,#51c28d,#64c094,#74be9c,#84bca2);">';
   $div .= '    <div class="card-body">';
   $div .= '        <h6 class="card-title">';
   $div .= '           Gerenciamneto de:';
   $div .= '        </h6>';
   $div .= '        <h3 class="card-text">';
   $div .= '           User';
   $div .= '        </h3>';
   $div .= '    </div>';
   $div .= '</div>';

   /** Link para voltar a listagem **/
   $div .= ' <div class="list-group mt-3">';
   $div .= '     <a href="#" class="list-group-item list-group-item-action" style="border-left: solid 4px #51c28d;" onclick="request(\'TABLE=USER&ACTION=DATAGRID\')">';
   $div .= '         <div class="d-flex w-100 justify-content-between">';
   $div .= '             <h6 class="mb-1">listagem de User</h6>';
   $div .= '         </div>';
   $div .= '         <small class="text-muted">';
   $div .= '             Clique para abrir a listagem';
   $div .= '         </small>';
   $div .= '     </a>';
   $div .= ' </div>';

   /** Formulário de cadastro/atualização  **/
   $div .= '<div class="card mt-3">';
   $div .= '   <div class="card-body">';
   $div .= '       <form role="form" id="frmUser">';
   $div .= '           <div class="row">';

   /** Monto meu campo 'user_id' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="user_id">';
   $div .= '			                user_id';
   $div .= '			            </label>';
   $div .= '			            <input id="user_id" name="user_id" class="form-control" type="text" value="'.@utf8_encode($row->user_id).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'user_function_id' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="user_function_id">';
   $div .= '			                user_function_id';
   $div .= '			            </label>';
   $div .= '			            <input id="user_function_id" name="user_function_id" class="form-control" type="text" value="'.@utf8_encode($row->user_function_id).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'situation_id' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="situation_id">';
   $div .= '			                situation_id';
   $div .= '			            </label>';
   $div .= '			            <input id="situation_id" name="situation_id" class="form-control" type="text" value="'.@utf8_encode($row->situation_id).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'name' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="name">';
   $div .= '			                name';
   $div .= '			            </label>';
   $div .= '			            <input id="name" name="name" class="form-control" type="text" value="'.@utf8_encode($row->name).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'email' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="email">';
   $div .= '			                email';
   $div .= '			            </label>';
   $div .= '			            <input id="email" name="email" class="form-control" type="text" value="'.@utf8_encode($row->email).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'date_birth' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="date_birth">';
   $div .= '			                date_birth';
   $div .= '			            </label>';
   $div .= '			            <input id="date_birth" name="date_birth" class="form-control" type="text" value="'.@utf8_encode($row->date_birth).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'access_first' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="access_first">';
   $div .= '			                access_first';
   $div .= '			            </label>';
   $div .= '			            <input id="access_first" name="access_first" class="form-control" type="text" value="'.@utf8_encode($row->access_first).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'access_last' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="access_last">';
   $div .= '			                access_last';
   $div .= '			            </label>';
   $div .= '			            <input id="access_last" name="access_last" class="form-control" type="text" value="'.@utf8_encode($row->access_last).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'access_log' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="access_log">';
   $div .= '			                access_log';
   $div .= '			            </label>';
   $div .= '			            <input id="access_log" name="access_log" class="form-control" type="text" value="'.@utf8_encode($row->access_log).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'password' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="password">';
   $div .= '			                password';
   $div .= '			            </label>';
   $div .= '			            <input id="password" name="password" class="form-control" type="text" value="'.@utf8_encode($row->password).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'date_register' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="date_register">';
   $div .= '			                date_register';
   $div .= '			            </label>';
   $div .= '			            <input id="date_register" name="date_register" class="form-control" type="text" value="'.@utf8_encode($row->date_register).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'date_update' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="date_update">';
   $div .= '			                date_update';
   $div .= '			            </label>';
   $div .= '			            <input id="date_update" name="date_update" class="form-control" type="text" value="'.@utf8_encode($row->date_update).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu botão para enviar o formulário **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '				        <button class="btn btn-outline-primary" type="button" onclick="sendForm(\'#frmUser\', \'N\')">Salvar <i class="fas fa-paper-plane"></i></button>'; 
   $div .= '	                </div>';
   $div .= '	            </div>';
   $div .= '           </div>';

   /** Monto meus campos hidden **/
   $div .= '		    <input type="hidden" name="TABLE" value="USER"/>';
   $div .= '		    <input type="hidden" name="ACTION" value="SAVE"/>';
   $div .= '			<input type="hidden" name="USER_ID" value="'.@$row->user_id.'"/>';

   $div .= '       </form>';
   $div .= '   </div>';
   $div .= '</div>';

   /** Result **/
   $result = array("cod"   => 1,
                   "msg"   => "Formulário montado com sucesso!",
                   "title" => "Atenção",
                   "data"  => $div);

   /** Pause **/
   sleep(1);

   /** Envio **/
   echo json_encode($result);

   /** Paro o procedimento **/
   exit;

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
