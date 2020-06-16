<?php
try{

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 15/06/2020
    * Time: 17:09
   **/

   /* Instânciamento da classe UserFile  */
   $UserFile = $Main->LoadClass('UserFile');

   /* Campos */
   $quantity = $UserFile->Count();

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
   $div  = '<a href="#" class="card text-white text-center shadow-sm border-0 text-decoration-none" onclick="request(\'TABLE=USER_FILE&ACTION=DATAGRID\')" style="background-image:linear-gradient(to right top,#3ac484,#51c28d,#64c094,#74be9c,#84bca2);">';
   $div .= '    <div class="card-body">';
   $div .= '        <h6 class="card-title">';
   $div .= '            Clique para atualizar';
   $div .= '        </h6>';
   $div .= '        <h5 class="card-title">';
   $div .= '            UserFile Cadastrados';
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
   $div .= '     <a href="#" class="list-group-item list-group-item-action" style="border-left: solid 4px #51c28d;" onclick="request(\'TABLE=USER_FILE&ACTION=FORM\')">';
   $div .= '         <div class="d-flex w-100 justify-content-between">';
   $div .= '             <h6 class="mb-1">Cadastrar Nova UserFile</h6>';
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
   $div .= '                   user_file_id';
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
   $UserFile->All();
   while($rowUserFile = $UserFile->FetchObject()){

       $div .= '              <tr id="row-'.$rowUserFile->user_file_id.'">';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowUserFile->user_file_id);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowUserFile->user_id);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowUserFile->situation_id);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowUserFile->name);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowUserFile->description);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowUserFile->base64);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowUserFile->file_type);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowUserFile->path);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowUserFile->date_register);
       $div .= '                </td>';
       $div .= '                <td class="text-break">';
       $div .=                     utf8_encode($rowUserFile->date_update);
       $div .= '                </td>';
       $div .= '                <td class="text-center">';
       $div .= '                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
       $div .= '                        <i class="fas fa-cog"></i>';
       $div .= '                    </button>';
       $div .= '                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
       $div .= '                       <a class="dropdown-item" onclick="request(\'TABLE=USER_FILE&ACTION=FORM&USER_FILE_ID='.$rowUserFile->user_file_id.'\')" href="#"><span class="badge badge-primary"><i class="fa fa-fw fa-pencil-alt"></i></span> Editar</a>';
       $div .= '                        <div class="dropdown-divider"></div>';
       $div .= '                       <a class="dropdown-item" href="#" onclick="deleteItemQuestion(\'TABLE=USER_FILE&ACTION=DELETE&USER_FILE_ID='.$rowUserFile->user_file_id.'\', \'Deseja realmente excluir o conteúdo: <b>'.utf8_encode($rowUserFile->user_file_id).'?</b> Esta ação não poderá ser desfeita.\', \'#row-'.$rowUserFile->user_file_id.'\')"><span class="badge badge-danger"><i class="fa fa-fw fa-trash"></i></span>  Apagar</a>';
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
