<?php

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Instância da classe Main **/
   include_once ('lib/class/Main.class.php');

   /** Construtor **/
   $Main = new Main();

   /** Requisições **/
   $TABLE  = isset($_REQUEST['TABLE'])  ? htmlspecialchars($_REQUEST['TABLE'])  : '';
   $ACTION = isset($_REQUEST['ACTION']) ? htmlspecialchars($_REQUEST['ACTION']) : '';

   /** Verifico a tabela **/
   switch ($TABLE)
   {

       /** Vejo minhas rotas disponíveis para a tabela 'CONTENT' **/
       case 'ADVENTURE':

           /** Rota para carregar o formulário **/
           if($ACTION == 'GET_TOP_PROFILES')
           {

               include('action/Adventure/adventure_get_top_profiles.php');

           }
           /** Rota para carregar o formulário **/
           elseif($ACTION == 'GET_CONTENTS')
           {

               include('action/Adventure/adventure_get_contents.php');

           }
           /** Rota para carregar o formulário **/
           elseif($ACTION == 'GET_CONTENT_SUBS')
           {

               include('action/Adventure/adventure_get_content_subs.php');

           }
           break;
       /** Vejo minhas rotas disponíveis para a tabela 'CONTENT' **/
       case 'CONTENT':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/Content/content_form.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'EDIT_FORM')
           {

               include('action/Content/content_edit_form.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'GET_USER_CONTENT')
           {

               include('action/Content/content_user_content.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/Content/content_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/Content/content_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/Content/content_datagrid.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'CONTENT_CATEGORY' **/
       case 'CONTENT_CATEGORY':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/ContentCategory/content_category_form.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'EDIT_FORM')
           {

               include('action/ContentCategory/content_category_edit_form.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/ContentCategory/content_category_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/ContentCategory/content_category_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/ContentCategory/content_category_datagrid.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'CONTENT_FILE' **/
       case 'CONTENT_FILE':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/ContentFile/content_file_form.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/ContentFile/content_file_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/ContentFile/content_file_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/ContentFile/content_file_datagrid.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'CONTENT_SUB' **/
       case 'CONTENT_SUB':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/ContentSub/content_sub_form.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'GET_CONTENT')
           {

               include('action/ContentSub/content_sub_get_content.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'EDIT_FORM')
           {

               include('action/ContentSub/content_edit_form.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/ContentSub/content_sub_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/ContentSub/content_sub_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/ContentSub/content_sub_datagrid.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'CONTENT_SUB' **/
       case 'CONTENT_SUB_AUXILIARY':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/ContentSubAuxiliary/content_sub_auxiliary_form.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'EDIT_FORM')
           {

               include('action/ContentSubAuxiliary/content_sub_auxiliary_edit_form.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/ContentSubAuxiliary/content_sub_auxiliary_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/ContentSubAuxiliary/content_sub_auxiliary_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/ContentSubAuxiliary/content_sub_auxiliary_datagrid.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'CONTENT_SUB_FILE' **/
       case 'CONTENT_SUB_FILE':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/ContentSubFile/content_sub_file_form.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/ContentSubFile/content_sub_file_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/ContentSubFile/content_sub_file_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/ContentSubFile/content_sub_file_datagrid.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'GENERAL' **/
       case 'GENERAL':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/General/general_form.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/General/general_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/General/general_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/General/general_datagrid.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'HIGHLIGHTER' **/
       case 'HIGHLIGHTER':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/Highlighter/highlighter_form.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'EDIT_FORM')
           {

               include('action/Highlighter/highlighter_edit_form.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/Highlighter/highlighter_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/Highlighter/highlighter_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/Highlighter/highlighter_datagrid.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'SITUATION' **/
       case 'SITUATION':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/Situation/situation_form.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'EDIT_FORM')
           {

               include('action/Situation/situation_edit_form.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/Situation/situation_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/Situation/situation_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/Situation/situation_datagrid.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'USER' **/
       case 'USER':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/User/user_form.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'EDIT_FORM')
           {

               include('action/User/user_edit_form.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'GET_USER_PROFILE')
           {

               include('action/User/user_profile.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/User/user_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/User/user_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/User/user_datagrid.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'ACCESS')
           {

               include('action/User/user_access.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'GETSESSION')
           {

               include('action/User/user_session.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DESTROYSESSION')
           {

               include('action/User/user_destroy_session.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'USER_FILE' **/
       case 'USER_FILE':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/UserFile/user_file_form.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/UserFile/user_file_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/UserFile/user_file_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/UserFile/user_file_datagrid.php');

           }
           break;

       /** Vejo minhas rotas disponíveis para a tabela 'USER_FUNCTION' **/
       case 'USER_FUNCTION':

           /** Rota para carregar o formulário **/
           if($ACTION == 'FORM')
           {

               include('action/UserFunction/user_function_form.php');

           }
           /** Rota para carregar o formulário **/
           if($ACTION == 'EDIT_FORM')
           {

               include('action/UserFunction/user_function_edit_form.php');

           }
           /** Rota para inserir/atualizar um registro **/
           elseif($ACTION == 'SAVE')
           {

               include('action/UserFunction/user_function_save.php');

           }
           /** Rota para excluir um registro **/
           elseif($ACTION == 'DELETE')
           {

               include('action/UserFunction/user_function_delete.php');

           }
           /** Rota para listar registros **/
           elseif($ACTION == 'DATAGRID')
           {

               include('action/UserFunction/user_function_datagrid.php');

           }
           break;

   }
