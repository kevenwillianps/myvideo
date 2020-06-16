<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Parâmetros de entrada  **/
   $content_sub_id = isset($_POST['content_sub_id']) ? (int)$Main->anti_injection($_POST['content_sub_id']) : 0;

   /** Instânciamento da classe ContentSub  **/
   $ContentSub = $Main->LoadClass('ContentSub');

   /** Carrego o meu registro  **/
   $row = $ContentSub->Get($content_sub_id);

   /** Cabeçalho da página  **/
   $div  = '<div class="card text-white text-center shadow-sm border-0" style="background-image: linear-gradient(to right top,#3ac484,#51c28d,#64c094,#74be9c,#84bca2);">';
   $div .= '    <div class="card-body">';
   $div .= '        <h6 class="card-title">';
   $div .= '           Gerenciamneto de:';
   $div .= '        </h6>';
   $div .= '        <h3 class="card-text">';
   $div .= '           ContentSub';
   $div .= '        </h3>';
   $div .= '    </div>';
   $div .= '</div>';

   /** Link para voltar a listagem **/
   $div .= ' <div class="list-group mt-3">';
   $div .= '     <a href="#" class="list-group-item list-group-item-action" style="border-left: solid 4px #51c28d;" onclick="request(\'TABLE=CONTENT_SUB&ACTION=DATAGRID\')">';
   $div .= '         <div class="d-flex w-100 justify-content-between">';
   $div .= '             <h6 class="mb-1">listagem de ContentSub</h6>';
   $div .= '         </div>';
   $div .= '         <small class="text-muted">';
   $div .= '             Clique para abrir a listagem';
   $div .= '         </small>';
   $div .= '     </a>';
   $div .= ' </div>';

   /** Formulário de cadastro/atualização  **/
   $div .= '<div class="card mt-3">';
   $div .= '   <div class="card-body">';
   $div .= '       <form role="form" id="frmContentSub">';
   $div .= '           <div class="row">';

   /** Monto meu campo 'content_sub_id' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="content_sub_id">';
   $div .= '			                content_sub_id';
   $div .= '			            </label>';
   $div .= '			            <input id="content_sub_id" name="content_sub_id" class="form-control" type="text" value="'.@utf8_encode($row->content_sub_id).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'content_sub_auxiliary_id' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="content_sub_auxiliary_id">';
   $div .= '			                content_sub_auxiliary_id';
   $div .= '			            </label>';
   $div .= '			            <input id="content_sub_auxiliary_id" name="content_sub_auxiliary_id" class="form-control" type="text" value="'.@utf8_encode($row->content_sub_auxiliary_id).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'user_id' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="user_id">';
   $div .= '			                user_id';
   $div .= '			            </label>';
   $div .= '			            <input id="user_id" name="user_id" class="form-control" type="text" value="'.@utf8_encode($row->user_id).'" >';
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

   /** Monto meu campo 'menu_position' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="menu_position">';
   $div .= '			                menu_position';
   $div .= '			            </label>';
   $div .= '			            <input id="menu_position" name="menu_position" class="form-control" type="text" value="'.@utf8_encode($row->menu_position).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'highlighter_id' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="highlighter_id">';
   $div .= '			                highlighter_id';
   $div .= '			            </label>';
   $div .= '			            <input id="highlighter_id" name="highlighter_id" class="form-control" type="text" value="'.@utf8_encode($row->highlighter_id).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'url' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="url">';
   $div .= '			                url';
   $div .= '			            </label>';
   $div .= '			            <input id="url" name="url" class="form-control" type="text" value="'.@utf8_encode($row->url).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'title' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="title">';
   $div .= '			                title';
   $div .= '			            </label>';
   $div .= '			            <input id="title" name="title" class="form-control" type="text" value="'.@utf8_encode($row->title).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'title_menu' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="title_menu">';
   $div .= '			                title_menu';
   $div .= '			            </label>';
   $div .= '			            <input id="title_menu" name="title_menu" class="form-control" type="text" value="'.@utf8_encode($row->title_menu).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'description' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="description">';
   $div .= '			                description';
   $div .= '			            </label>';
   $div .= '			            <input id="description" name="description" class="form-control" type="text" value="'.@utf8_encode($row->description).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'content_resume' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="content_resume">';
   $div .= '			                content_resume';
   $div .= '			            </label>';
   $div .= '			            <input id="content_resume" name="content_resume" class="form-control" type="text" value="'.@utf8_encode($row->content_resume).'" >';
   $div .= '	                </div>';
   $div .= '	            </div>';

   /** Monto meu campo 'content_complete' **/
   $div .= '               <div class="col-md-12">';
   $div .= '                   <div class="form-group">';
   $div .= '	                    <label for="content_complete">';
   $div .= '			                content_complete';
   $div .= '			            </label>';
   $div .= '			            <input id="content_complete" name="content_complete" class="form-control" type="text" value="'.@utf8_encode($row->content_complete).'" >';
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
   $div .= '				        <button class="btn btn-outline-primary" type="button" onclick="sendForm(\'#frmContentSub\', \'N\')">Salvar <i class="fas fa-paper-plane"></i></button>'; 
   $div .= '	                </div>';
   $div .= '	            </div>';
   $div .= '           </div>';

   /** Monto meus campos hidden **/
   $div .= '		    <input type="hidden" name="TABLE" value="CONTENT_SUB"/>';
   $div .= '		    <input type="hidden" name="ACTION" value="SAVE"/>';
   $div .= '			<input type="hidden" name="CONTENT_SUB_ID" value="'.@$row->content_sub_id.'"/>';

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
