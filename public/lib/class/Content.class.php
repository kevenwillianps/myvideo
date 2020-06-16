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

   class Content
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
           $sql = "select count(*) as qtde from content ";

           /** Executo o comando SQL */
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return (int)$this->obj->query_fetch_object()->qtde;

       }

       /** Listo a quantidade total de registros **/
       public function Get($content_id)
       {

           /** Parâmetro de entrada **/
           $this->content_id = (int)$content_id;

           /** Consulta SQL **/
           $sql = "select 
                   c.content_id,
                   c.title,
                   c.content_resume,
                   c.content_complete,
                   c.description,
                   c.date_register,
                   us.name as user_name,
                   uf.name as user_function,
                   (select cf.name from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_name,
                   (select cf.path from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_path,
                   (select cf.file_type from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_type
                   from content c
                   join user us on us.user_id = c.user_id
                   join user_function uf on uf.user_function_id = us.user_function_id
                   where c.content_id = {$this->content_id}
                   order by c.content_id desc";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Listo a quantidade total de registros **/
       public function GetUserContent($user_id)
       {

           /** Parâmetro de entrada **/
           $this->user_id = (int)$user_id;

           /** Consulta SQL **/
           $sql = "select 
                   c.user_id,
                   c.content_id,
                   c.title,
                   c.content_resume,
                   c.content_complete,
                   c.description,
                   c.date_register,
                   us.name as user_name,
                   uf.name as user_function,
                   (select cf.name from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_name,
                   (select cf.path from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_path,
                   (select cf.file_type from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_type
                 from content c
                   join user us on us.user_id = c.user_id
                   join user_function uf on uf.user_function_id = us.user_function_id
                 where c.user_id = {$this->user_id}
                 order by c.content_id desc";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Listo a quantidade total de registros **/
       public function EditForm($content_id)
       {

           /** Parâmetro de entrada **/
           $this->content_id = (int)$content_id;

           /** Consulta SQL **/
           $sql = "select * from content c where c.content_id = {$this->content_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Listo a quantidade total de registros **/
       public function GetLast()
       {

           /** Consulta SQL **/
           $sql = "select * from content order by content_id desc limit 1";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Lista todos os registros **/
       public function All()
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
                   order by c.content_id desc";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Insere/autualiza um registro no banco de dados **/
       public function Save($content_id, $content_category_id, $user_id, $situation_id, $highlighter_id, $menu_position, $url, $title, $title_menu, $description, $content_resume, $content_complete, $date_register, $date_update)
       {

           /** Parâmetros de entrada **/
           $this->content_id = (int)$content_id;
           $this->content_category_id = (int)$content_category_id;
           $this->user_id = (int)$user_id;
           $this->situation_id = (int)$situation_id;
           $this->highlighter_id = (int)$highlighter_id;
           $this->menu_position = (int)$menu_position;
           $this->url = (string)$url;
           $this->title = (string)$title;
           $this->title_menu = (string)$title_menu;
           $this->description = (string)$description;
           $this->content_resume = (string)$content_resume;
           $this->content_complete = (string)$content_complete;
           $this->date_register = (string)$date_register;
           $this->date_update = (string)$date_update;

           /** Verifico se é inserção ou atualização **/
           if($this->content_id == 0)
           {

               /** Consulta SQL **/
               $sql = "INSERT INTO content(content_id, content_category_id, user_id, situation_id, highlighter_id, menu_position, url, title, title_menu, description, content_resume, content_complete, date_register, date_update)VALUES('{$this->content_id}', '{$this->content_category_id}', '{$this->user_id}', '{$this->situation_id}', '{$this->highlighter_id}', '{$this->menu_position}', '{$this->url}', '{$this->title}', '{$this->title_menu}', '{$this->description}', '{$this->content_resume}', '{$this->content_complete}', '{$this->date_register}', '{$this->date_update}')";

           }else
           {

               /** Consulta SQL **/
               $sql = "UPDATE content set content_id = '{$this->content_id}', content_category_id = '{$this->content_category_id}', user_id = '{$this->user_id}', situation_id = '{$this->situation_id}', highlighter_id = '{$this->highlighter_id}', menu_position = '{$this->menu_position}', url = '{$this->url}', title = '{$this->title}', title_menu = '{$this->title_menu}', description = '{$this->description}', content_resume = '{$this->content_resume}', content_complete = '{$this->content_complete}', date_register = '{$this->date_register}', date_update = '{$this->date_update}' WHERE content_id = {$this->content_id}";

           }

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Excluo um registro específico **/
       public function Delete($content_id)
       {

           /** Parâmetro de entrada **/
           $this->content_id = (int)$content_id;

           /** Consulta SQL **/
           $sql = "DELETE FROM content WHERE content_id = {$this->content_id}";

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
