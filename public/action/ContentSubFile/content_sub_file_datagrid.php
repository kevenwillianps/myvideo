<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /* Instânciamento da classe ContentSubFile  */
   $ContentSubFile = $Main->LoadClass('ContentSubFile');

   /* Campos */
   $quantity = $ContentSubFile->Count();

   /* Verifico se existe registros no banco de dados */
   if($quantity <= 0){

       $div = '<div class="alert alert-info">';
       $div.= '    <ul>';
       $div.= '        <li>';
       $div.= '            <strong>Atenção!</strong> Nenhum registro cadastrado';
       $div.= '        </li>';
       $div.= '    </ul>';
       $div.= '</div>';

   }

   /* Link para atualizar a listagem */
   $div  = '<a href="#" class="card text-white text-center shadow-sm border-0 text-decoration-none" onclick="request(\'TABLE=CONTENT_SUB_FILE&ACTION=DATAGRID\')" style="background-image:linear-gradient(to right top,#3ac484,#51c28d,#64c094,#74be9c,#84bca2);">';
   $div .= '    <div class="card-body">';
   $div .= '        <h6 class="card-title">';
   $div .= '            Clique para atualizar';
   $div .= '        </h6>';
   $div .= '        <h5 class="card-title">';
   $div .= '            ContentSubFile Cadastrados';
   $div .= '        </h5>';
   $div .= '        <h3 class="card-text">';
   $div .= '            <strong>';
   $div .=                 $quantity;
   $div .= '            </strong>';
   $div .= '        </h3>';
   $div .= '    </div>';
   $div .= '</a>';

   /* Link para abrir o formulário */
   $div .= ' <div class="list-group mt-3">';
   $div .= '     <a href="#" class="list-group-item list-group-item-action" style="border-left: solid 4px #51c28d;" onclick="request(\'TABLE=CONTENT_SUB_FILE&ACTION=FORM\')">';
   $div .= '         <div class="d-flex w-100 justify-content-between">';
   $div .= '             <h6 class="mb-1">Cadastrar Nova ContentSubFile</h6>';
   $div .= '         </div>';
   $div .= '         <small class="text-muted">';
   $div .= '             Clique para abrir o formulário';
   $div .= '         </small>';
   $div .= '     </a>';
   $div .= ' </div>';

   /* Cabeçalho da minha tabela */
   $div .= '<div class="bg-primary mt-3 shadow-sm">';
   $div .= '    <table class="table table-bordered table-hover">';
   $div .= '        <thead>';
   $div .= '            <tr>';
   $div .= '                <th>';
   $div .= '                   content_sub_file_id';
   $div .= '                </th>';
   $div .= '                <th>';
   $div .= '                   content_sub_id';
   $div .= '                </th>';
   $div .= '                <th>';
   $div .= '                   user_id';
   $div .= '                </th>';
   $div .= '                <th>';
   $div .= '                   situation_id';
   $div .= '                </th>';
   $div .= '                <th>';
   $div .= '                   name';
   $div .= '                </th>';
   $div .= '                <th>';
   $div .= '                   description';
   $div .= '                </th>';
   $div .= '                <th>';
   $div .= '                   base64';
   $div .= '                </th>';
   $div .= '                <th>';
   $div .= '                   file_type';
   $div .= '                </th>';
   $div .= '                <th>';
   $div .= '                   path';
   $div .= '                </th>';
   $div .= '                <th>';
   $div .= '                   date_register';
   $div .= '                </th>';
   $div .= '                <th>';
   $div .= '                   date_update';
   $div .= '                </th>';
   $div .= '                <th class="text-center">';
   $div .= '                   Operações';
   $div .= '                </th>';
   $div .= '            </tr>';
   $div .= '        </thead>';
   $div .= '    <tbody>';
   /* Chamo o método que traz todos os registros */
   $ContentSubFile->All();
   while($rowContentSubFile = $ContentSubFile->FetchObject()){

       $div .= '              <tr id="row-'.$rowContentSubFile->content_sub_file_id.'">';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->content_sub_file_id);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->content_sub_id);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->user_id);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->situation_id);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->name);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->description);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->base64);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->file_type);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->path);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->date_register);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowContentSubFile->date_update);
       $div .= '                </td>';
       $div .= '                <td class="text-center">';
       $div .= '                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
       $div .= '                        <i class="fas fa-cog"></i>';
       $div .= '                    </button>';
       $div .= '                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
       $div .= '                       <a class="dropdown-item" onclick="request(\'TABLE=CONTENT_SUB_FILE&ACTION=FORM&CONTENT_SUB_FILE_ID='.$rowContentSubFile->content_sub_file_id.'\')" href="#"><span class="badge badge-primary"><i class="fa fa-fw fa-pencil-alt"></i></span> Editar</a>';
       $div .= '                        <div class="dropdown-divider"></div>';
       $div .= '                       <a class="dropdown-item" href="#" onclick="deleteItemQuestion(\'TABLE=CONTENT_SUB_FILE&ACTION=DELETE&CONTENT_SUB_FILE_ID='.$rowContentSubFile->content_sub_file_id.'\', \'Deseja realmente excluir o conteúdo: <b>'.utf8_encode($rowContentSubFile->content_sub_file_id).'?</b> Esta ação não poderá ser desfeita.\', \'#row-'.$rowContentSubFile->content_sub_file_id.'\')"><span class="badge badge-danger"><i class="fa fa-fw fa-trash"></i></span>  Apagar</a>';
       $div .= '                    </div>';
       $div .= '                </td>';
       $div .= '              </tr>';

   }
   $div .= '    </tbody>';
   $div .= '    </table>';
   $div .= '</div>';

   /** Result **/
   $result = array("cod"   => 1,
                   "msg"   => "Datagrid montada com sucesso!",
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
