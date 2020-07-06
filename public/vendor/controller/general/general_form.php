<?php
try {

   /**
    * Created by MyCode
    * user: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

    /** Parâmetros de entrada  **/
    $general_id = isset($_POST['general_id']) ? (int)$Main->anti_injection($_POST['general_id']) : 0;

    /** Instânciamento da classe general  **/
    $General = $Main->LoadClass('General');

    /** Carrego o meu registro  **/
    $row = $General->Get($general_id);

    /** Cabeçalho da página  **/
    $div  = '<div class="card text-white text-center shadow-sm border-0" style="background-image: linear-gradient(to right top,#3ac484,#51c28d,#64c094,#74be9c,#84bca2);">';
    $div .= '    <div class="card-body">';
    $div .= '        <h6 class="card-title">';
    $div .= '           Gerenciamneto de:';
    $div .= '        </h6>';
    $div .= '        <h3 class="card-text">';
    $div .= '           general';
    $div .= '        </h3>';
    $div .= '    </div>';
    $div .= '</div>';

    /** Link para voltar a listagem **/
    $div .= ' <div class="list-group mt-3">';
    $div .= '     <a href="#" class="list-group-item list-group-item-controller" style="border-left: solid 4px #51c28d;" onclick="request(\'TABLE=GENERAL&ACTION=DATAGRID\')">';
    $div .= '         <div class="d-flex w-100 justify-content-between">';
    $div .= '             <h6 class="mb-1">listagem de general</h6>';
    $div .= '         </div>';
    $div .= '         <small class="text-muted">';
    $div .= '             Clique para abrir a listagem';
    $div .= '         </small>';
    $div .= '     </a>';
    $div .= ' </div>';

    /** Formulário de cadastro/atualização  **/
    $div .= '<div class="card mt-3">';
    $div .= '   <div class="card-body">';
    $div .= '       <form role="form" id="frmGeneral">';
    $div .= '           <div class="row">';

    /** Monto meu campo 'general_id' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="general_id">';
    $div .= '			                general_id';
    $div .= '			            </label>';
    $div .= '			            <input id="general_id" name="general_id" class="form-control" type="text" value="'.@utf8_encode($row->general_id).'" >';
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

    /** Monto meu campo 'title' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="title">';
    $div .= '			                title';
    $div .= '			            </label>';
    $div .= '			            <input id="title" name="title" class="form-control" type="text" value="'.@utf8_encode($row->title).'" >';
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

    /** Monto meu campo 'keywords' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="keywords">';
    $div .= '			                keywords';
    $div .= '			            </label>';
    $div .= '			            <input id="keywords" name="keywords" class="form-control" type="text" value="'.@utf8_encode($row->keywords).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'copyright' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="copyright">';
    $div .= '			                copyright';
    $div .= '			            </label>';
    $div .= '			            <input id="copyright" name="copyright" class="form-control" type="text" value="'.@utf8_encode($row->copyright).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'author' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="author">';
    $div .= '			                author';
    $div .= '			            </label>';
    $div .= '			            <input id="author" name="author" class="form-control" type="text" value="'.@utf8_encode($row->author).'" >';
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

    /** Monto meu campo 'email' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="email">';
    $div .= '			                email';
    $div .= '			            </label>';
    $div .= '			            <input id="email" name="email" class="form-control" type="text" value="'.@utf8_encode($row->email).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'smtp' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="smtp">';
    $div .= '			                smtp';
    $div .= '			            </label>';
    $div .= '			            <input id="smtp" name="smtp" class="form-control" type="text" value="'.@utf8_encode($row->smtp).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'port' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="port">';
    $div .= '			                port';
    $div .= '			            </label>';
    $div .= '			            <input id="port" name="port" class="form-control" type="text" value="'.@utf8_encode($row->port).'" >';
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

    /** Monto meu campo 'domain' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="domain">';
    $div .= '			                domain';
    $div .= '			            </label>';
    $div .= '			            <input id="domain" name="domain" class="form-control" type="text" value="'.@utf8_encode($row->domain).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'charsert' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="charsert">';
    $div .= '			                charsert';
    $div .= '			            </label>';
    $div .= '			            <input id="charsert" name="charsert" class="form-control" type="text" value="'.@utf8_encode($row->charsert).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'username' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="username">';
    $div .= '			                username';
    $div .= '			            </label>';
    $div .= '			            <input id="username" name="username" class="form-control" type="text" value="'.@utf8_encode($row->username).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'session' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="session">';
    $div .= '			                session';
    $div .= '			            </label>';
    $div .= '			            <input id="session" name="session" class="form-control" type="text" value="'.@utf8_encode($row->session).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'number_register' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="number_register">';
    $div .= '			                number_register';
    $div .= '			            </label>';
    $div .= '			            <input id="number_register" name="number_register" class="form-control" type="text" value="'.@utf8_encode($row->number_register).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'cnpj' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="cnpj">';
    $div .= '			                cnpj';
    $div .= '			            </label>';
    $div .= '			            <input id="cnpj" name="cnpj" class="form-control" type="text" value="'.@utf8_encode($row->cnpj).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'endereco' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="endereco">';
    $div .= '			                endereco';
    $div .= '			            </label>';
    $div .= '			            <input id="endereco" name="endereco" class="form-control" type="text" value="'.@utf8_encode($row->endereco).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'telefone' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="telefone">';
    $div .= '			                telefone';
    $div .= '			            </label>';
    $div .= '			            <input id="telefone" name="telefone" class="form-control" type="text" value="'.@utf8_encode($row->telefone).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'celular' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="celular">';
    $div .= '			                celular';
    $div .= '			            </label>';
    $div .= '			            <input id="celular" name="celular" class="form-control" type="text" value="'.@utf8_encode($row->celular).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'facebook' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="facebook">';
    $div .= '			                facebook';
    $div .= '			            </label>';
    $div .= '			            <input id="facebook" name="facebook" class="form-control" type="text" value="'.@utf8_encode($row->facebook).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'instagram' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="instagram">';
    $div .= '			                instagram';
    $div .= '			            </label>';
    $div .= '			            <input id="instagram" name="instagram" class="form-control" type="text" value="'.@utf8_encode($row->instagram).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'pinterest' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="pinterest">';
    $div .= '			                pinterest';
    $div .= '			            </label>';
    $div .= '			            <input id="pinterest" name="pinterest" class="form-control" type="text" value="'.@utf8_encode($row->pinterest).'" >';
    $div .= '	                </div>';
    $div .= '	            </div>';

    /** Monto meu campo 'twitter' **/
    $div .= '               <div class="col-md-12">';
    $div .= '                   <div class="form-group">';
    $div .= '	                    <label for="twitter">';
    $div .= '			                twitter';
    $div .= '			            </label>';
    $div .= '			            <input id="twitter" name="twitter" class="form-control" type="text" value="'.@utf8_encode($row->twitter).'" >';
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
    $div .= '				        <button class="btn btn-outline-primary" type="button" onclick="sendForm(\'#frmGeneral\', \'N\')">Salvar <i class="fas fa-paper-plane"></i></button>';
    $div .= '	                </div>';
    $div .= '	            </div>';
    $div .= '           </div>';

    /** Monto meus campos hidden **/
    $div .= '		    <input type="hidden" name="TABLE" value="GENERAL"/>';
    $div .= '		    <input type="hidden" name="ACTION" value="SAVE"/>';
    $div .= '			<input type="hidden" name="GENERAL_ID" value="'.@$row->general_id.'"/>';

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
