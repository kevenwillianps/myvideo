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

   class ContentSub
   {

       /** Construtor da classe **/
       function __construct()
       {

           /** Cria o objeto de conexão com o banco de dados **/
           $this->obj = new Connect;

       }

       /** Lista um registro específico **/
       public function Count()
       {

           /** Consulta SQL **/
           $sql = "select count(*) as qtde from content_sub ";

           /** Executo o comando SQL */
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return (int)$this->obj->query_fetch_object()->qtde;

       }

       /** Listo a quantidade total de registros **/
       public function EditForm($content_sub_id)
       {

           /** Parâmetro de entrada **/
           $this->content_sub_id = (int)$content_sub_id;

           /** Consulta SQL **/
           $sql = "select * from content_sub where content_sub_id = {$this->content_sub_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Listo a quantidade total de registros **/
       public function Get($content_sub_id)
       {

           /** Parâmetro de entrada **/
           $this->content_sub_id = (int)$content_sub_id;

           /** Consulta SQL **/
           $sql = "select * from content_sub where content_sub_id = {$this->content_sub_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Listo a quantidade total de registros **/
       public function GetContent($content_sub_id)
       {

           /** Parâmetro de entrada **/
           $this->content_sub_id = (int)$content_sub_id;

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
                   where cs.content_sub_id = {$this->content_sub_id}
                   and cs.content_sub_auxiliary_id is null
                   order by cs.content_sub_id desc";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Listo a quantidade total de registros **/
       public function GetLast()
       {

           /** Consulta SQL **/
           $sql = "select * from content_sub order by content_sub_id desc limit 1";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Lista todos os registros **/
       public function All($content_id)
       {

           /** Parâmetros de Entrada **/
           $this->content_id = (int)$content_id;

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
                   where cs.content_id = {$this->content_id}
                   and cs.content_sub_auxiliary_id is null
                   order by cs.content_sub_id desc";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Lista todos os registros **/
       public function AllAuxiliary($content_sub_id)
       {

           /** Parâmetros de Entrada **/
           $this->content_sub_id = (int)$content_sub_id;

           /** Consulta SQL **/
           $sql = "select
                   cs.content_id,
                   cs.content_sub_id,
                   cs.title,
                   cs.content_resume,
                   cs.content_complete,
                   cs.description,
                   us.user_id as user_id,
                   us.name as user_name,
                   cs.date_register,
                   uf.name as user_function,
                   (select cf.name from content_sub_file cf where cf.content_sub_id = cs.content_sub_id order by content_sub_file_id desc limit 1) as file_name,
                   (select cf.path from content_sub_file cf where cf.content_sub_id = cs.content_sub_id order by content_sub_file_id desc limit 1) as file_path,
                   (select cf.file_type from content_sub_file cf where cf.content_sub_id = cs.content_sub_id order by content_sub_file_id desc limit 1) as file_type
                   from content_sub cs
                   join user us on us.user_id = cs.user_id
                   join user_function uf on us.user_function_id = uf.user_function_id
                   where cs.content_sub_auxiliary_id = {$this->content_sub_id}
                   order by cs.content_sub_id asc";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Insere/autualiza um registro no banco de dados **/
       public function Save($content_sub_id, $content_id, $content_sub_auxiliary_id, $user_id, $situation_id, $menu_position, $highlighter_id, $url, $title, $title_menu, $description, $content_resume, $content_complete, $date_register, $date_update)
       {

           /** Parâmetros de entrada **/
           $this->content_sub_id           = (int)$content_sub_id;
           $this->content_id               = (string)$content_id;
           $this->content_sub_auxiliary_id = (string)$content_sub_auxiliary_id;
           $this->user_id                  = (int)$user_id;
           $this->situation_id             = (int)$situation_id;
           $this->menu_position            = (int)$menu_position;
           $this->highlighter_id           = (int)$highlighter_id;
           $this->url                      = (string)$url;
           $this->title                    = (string)$title;
           $this->title_menu               = (string)$title_menu;
           $this->description              = (string)$description;
           $this->content_resume           = (string)$content_resume;
           $this->content_complete         = (string)$content_complete;
           $this->date_register            = (string)$date_register;
           $this->date_update              = (string)$date_update;

           /** Verifico se é inserção ou atualização **/
           if($this->content_sub_id == 0)
           {

               /** Consulta SQL **/
               $sql = "INSERT INTO content_sub(content_sub_id, content_id, content_sub_auxiliary_id, user_id, situation_id, menu_position, highlighter_id, url, title, title_menu, description, content_resume, content_complete, date_register, date_update)VALUES('{$this->content_sub_id}', '{$this->content_id}', '{$this->content_sub_auxiliary_id}', '{$this->user_id}', '{$this->situation_id}', '{$this->menu_position}', '{$this->highlighter_id}', '{$this->url}', '{$this->title}', '{$this->title_menu}', '{$this->description}', '{$this->content_resume}', '{$this->content_complete}', '{$this->date_register}', '{$this->date_update}')";

           }else
           {

               /** Consulta SQL **/
               $sql = "UPDATE content_sub set content_sub_id = '{$this->content_sub_id}', content_id = '{$this->content_id}', content_sub_auxiliary_id = '{$this->content_sub_auxiliary_id}', user_id = '{$this->user_id}', situation_id = '{$this->situation_id}', menu_position = '{$this->menu_position}', highlighter_id = '{$this->highlighter_id}', url = '{$this->url}', title = '{$this->title}', title_menu = '{$this->title_menu}', description = '{$this->description}', content_resume = '{$this->content_resume}', content_complete = '{$this->content_complete}', date_register = '{$this->date_register}', date_update = '{$this->date_update}' WHERE content_sub_id = {$this->content_sub_id}";

           }

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Insere/autualiza um registro no banco de dados **/
       public function SaveAuxiliary($content_sub_id, $content_id, $content_sub_auxiliary_id, $user_id, $situation_id, $menu_position, $highlighter_id, $url, $title, $title_menu, $description, $content_resume, $content_complete, $date_register, $date_update)
       {

           /** Parâmetros de entrada **/
           $this->content_sub_id           = (int)$content_sub_id;
           $this->content_id               = (int)$content_id;
           $this->content_sub_auxiliary_id = (int)$content_sub_auxiliary_id;
           $this->user_id                  = (int)$user_id;
           $this->situation_id             = (int)$situation_id;
           $this->menu_position            = (int)$menu_position;
           $this->highlighter_id           = (int)$highlighter_id;
           $this->url                      = (string)$url;
           $this->title                    = (string)$title;
           $this->title_menu               = (string)$title_menu;
           $this->description              = (string)$description;
           $this->content_resume           = (string)$content_resume;
           $this->content_complete         = (string)$content_complete;
           $this->date_register            = (string)$date_register;
           $this->date_update              = (string)$date_update;

           /** Verifico se é inserção ou atualização **/
           if($this->content_sub_id == 0 && $this->content_sub_auxiliary_id > 0)
           {

               /** Consulta SQL **/
               $sql = "INSERT INTO content_sub(content_id, content_sub_auxiliary_id, user_id, situation_id, menu_position, highlighter_id, url, title, title_menu, description, content_resume, content_complete, date_register, date_update)VALUES('{$this->content_id}', '{$this->content_sub_auxiliary_id}', '{$this->user_id}', '{$this->situation_id}', '{$this->menu_position}', '{$this->highlighter_id}', '{$this->url}', '{$this->title}', '{$this->title_menu}', '{$this->description}', '{$this->content_resume}', '{$this->content_complete}', '{$this->date_register}', '{$this->date_update}')";

           }
           else if ($this->content_sub_id > 0 && $this->content_sub_auxiliary_id > 0)
           {

               /** Consulta SQL **/
               $sql = "UPDATE content_sub set content_sub_id = '{$this->content_sub_id}', content_id = '{$this->content_id}', content_sub_auxiliary_id = '{$this->content_sub_auxiliary_id}', user_id = '{$this->user_id}', situation_id = '{$this->situation_id}', menu_position = '{$this->menu_position}', highlighter_id = '{$this->highlighter_id}', url = '{$this->url}', title = '{$this->title}', title_menu = '{$this->title_menu}', description = '{$this->description}', content_resume = '{$this->content_resume}', content_complete = '{$this->content_complete}', date_register = '{$this->date_register}', date_update = '{$this->date_update}' WHERE content_sub_id = {$this->content_sub_id}";

           }

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Excluo um registro específico **/
       public function Delete($content_sub_id)
       {

           /** Parâmetro de entrada **/
           $this->content_sub_id = (int)$content_sub_id;

           /** Consulta SQL **/
           $sql = "DELETE FROM content_sub WHERE content_sub_id = {$this->content_sub_id}";

           /** Executo o comando SQL **/
           if($this->obj->ExecuteQuery($sql))
           {

               return true;

           }else
           {

               return false;

           }

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
