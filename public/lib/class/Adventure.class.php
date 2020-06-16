<?php

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Configuração de acesso ao banco de dados **/
   require_once("lib/class/Host.php");

   /** Classe de conexão ao banco de dados Mysql **/
   require_once("lib/class/Mysql.class.php");

   class Adventure
   {

       /** Construtor da classe **/
       function __construct()
       {

           /** Cria o objeto de conexão com o banco de dados **/
           $this->obj = new Connect;

       }

       /** Lista todos os registros **/
       public function GetTopProfiles()
       {

           /** Consulta SQL **/
           $sql = "select
                   us.user_id,
                   us.name as user_name,
                   us.email,
                   us.access_first,
                   us.access_last,
                   us.date_register,
                   us.date_update,
                   us.date_birth,
                   usf.user_function_id,
                   usf.name as user_function,
                   usf.name as function_name,
                   usf.c_execute,
                   usf.r_execute,
                   usf.u_execute,
                   usf.d_execute,
                   (select uf.name from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_name,
                   (select uf.path from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_path,
                   (select uf.file_type from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_type,
                   (select count(c.content_id) as quantity_content from content c where c.user_id = us.user_id) as quantity_content,
                   (select count(cs.content_sub_id) as quantity_content_sub from content_sub cs where cs.user_id = us.user_id) as quantity_content_sub
                 from user us
                   join user_function usf on us.user_function_id = usf.user_function_id
                 where (select count(c.content_id) as quantity_content from content c where c.user_id = us.user_id) > 0 and (select count(cs.content_sub_id) as quantity_content_sub from content_sub cs where cs.user_id = us.user_id) > 0
                 order by rand()";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Lista todos os registros **/
       public function GetContents()
       {

           /** Consulta SQL **/
           $sql = "select
                   c.content_id,
                   c.title,
                   c.content_resume,
                   c.content_complete,
                   c.description,
                   c.date_register,
                   us.user_id as user_id,
                   us.name as user_name,
                   uf.name as user_function,
                   (select cf.name from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_name,
                   (select cf.path from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_path,
                   (select cf.file_type from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_type
                 from content c
                   join user us on us.user_id = c.user_id
                   join user_function uf on uf.user_function_id = us.user_function_id
                 order by rand() limit 3";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Lista todos os registros **/
       public function GetContentSubs()
       {

           /** Consulta SQL **/
           $sql = "select
                   cs.content_id,
                   cs.content_sub_id,
                   cs.title,
                   cs.content_resume,
                   cs.content_complete,
                   cs.description,
                   cs.date_register,
                   us.user_id as user_id,
                   us.name as user_name,
                   uf.name as user_function,
                   (select cf.name from content_sub_file cf where cf.content_sub_id = cs.content_sub_id order by content_sub_file_id desc limit 1) as file_name,
                   (select cf.path from content_sub_file cf where cf.content_sub_id = cs.content_sub_id order by content_sub_file_id desc limit 1) as file_path,
                   (select cf.file_type from content_sub_file cf where cf.content_sub_id = cs.content_sub_id order by content_sub_file_id desc limit 1) as file_type
                 from content_sub cs
                   join user us on us.user_id = cs.user_id
                   join user_function uf on us.user_function_id = uf.user_function_id
                 where cs.content_sub_auxiliary_id is null
                 order by cs.content_sub_id desc";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Retorno o número de linhas de uma consulta SQL **/
       function NumRow()
       {

           return $this->obj->query_num_row();

       }

       /** Libera a memória associada ao resultado **/
       function FreeResult()
       {

           $this->obj->free_result();

       }

       /** Retorna a linha atual do conjunto de resultados como um objeto **/
       function FetchObject()
       {

           return $this->obj->query_fetch_object();

       }

       /** Retorna a linha atual do conjunto de resultados como uma array assiciativa */
       function FetchAssoc()
       {

           return $this->obj->query_fetch_assoc();

       }

       /** Fecha uma conexão aberta anteriormente com o banco de dados **/
       function __destruct()
       {

           $this->obj->close();

       }

   }
