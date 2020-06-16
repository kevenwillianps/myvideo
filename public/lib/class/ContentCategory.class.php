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

   class ContentCategory
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
           $sql = "select count(*) as qtde from content_category ";

           /** Executo o comando SQL */
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return (int)$this->obj->query_fetch_object()->qtde;

       }

       /** Listo a quantidade total de registros **/
       public function Get($content_category_id)
       {

           /** Parâmetro de entrada **/
           $this->content_category_id = (int)$content_category_id;

           /** Consulta SQL **/
           $sql = "select * from content_category where content_category_id = {$this->content_category_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Listo a quantidade total de registros **/
       public function EditForm($content_category_id)
       {

           /** Parâmetro de entrada **/
           $this->content_category_id = (int)$content_category_id;

           /** Consulta SQL **/
           $sql = "select * from content_category where content_category_id = {$this->content_category_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Lista todos os registros **/
       public function All()
       {

           /** Consulta SQL **/
           $sql = "select * from content_category";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Insere/autualiza um registro no banco de dados **/
       public function Save($content_category_id, $user_id, $situation_id, $name, $description, $date_register, $date_update)
       {

           /** Parâmetros de entrada **/
           $this->content_category_id = (int)$content_category_id;
           $this->user_id = (int)$user_id;
           $this->situation_id = (int)$situation_id;
           $this->name = (string)$name;
           $this->description = (string)$description;
           $this->date_register = (string)$date_register;
           $this->date_update = (string)$date_update;

           /** Verifico se é inserção ou atualização **/
           if($this->content_category_id == 0)
           {

               /** Consulta SQL **/
               $sql = "INSERT INTO content_category(content_category_id, user_id, situation_id, name, description, date_register, date_update)VALUES('{$this->content_category_id}', '{$this->user_id}', '{$this->situation_id}', '{$this->name}', '{$this->description}', '{$this->date_register}', '{$this->date_update}')";

           }else
           {

               /** Consulta SQL **/
               $sql = "UPDATE content_category set content_category_id = '{$this->content_category_id}', user_id = '{$this->user_id}', situation_id = '{$this->situation_id}', name = '{$this->name}', description = '{$this->description}', date_register = '{$this->date_register}', date_update = '{$this->date_update}' WHERE content_category_id = {$this->content_category_id}";

           }

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Excluo um registro específico **/
       public function Delete($content_category_id)
       {

           /** Parâmetro de entrada **/
           $this->content_category_id = (int)$content_category_id;

           /** Consulta SQL **/
           $sql = "DELETE FROM content_category WHERE content_category_id = {$this->content_category_id}";

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
