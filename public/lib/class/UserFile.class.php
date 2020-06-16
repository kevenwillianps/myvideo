<?php

   /**
    * Created by MyCode
    * User: KEVEN
    * Date: 15/06/2020
    * Time: 17:09
   **/

   /** Configuração de acesso ao banco de dados **/
   require_once("lib/class/Host.php");

   /** Classe de conexão ao banco de dados Mysql **/
   require_once("lib/class/Mysql.Class.php");

   class UserFile
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
           $sql = "select count(*) as qtde from user_file ";

           /** Executo o comando SQL */
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return (int)$this->obj->query_fetch_object()->qtde;

       }

       /** Listo a quantidade total de registros **/
       public function Get($user_file_id)
       {

           /** Parâmetro de entrada **/
           $this->user_file_id = (int)$user_file_id;

           /** Consulta SQL **/
           $sql = "select * from user_file where user_file_id = {$this->user_file_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Lista um registro específico **/
       public function GetLast()
       {

           /** Consulta SQL **/
           $sql = "select * from user_file order by user_file_id desc limit 1";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Lista todos os registros **/
       public function All()
       {

           /** Consulta SQL **/
           $sql = "select * from user_file";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Insere/autualiza um registro no banco de dados **/
       public function Save($user_file_id, $user_id, $situation_id, $name, $description, $base64, $file_type, $path, $date_register, $date_update)
       {

           /** Parâmetros de entrada **/
           $this->user_file_id = (int)$user_file_id;
           $this->user_id = (int)$user_id;
           $this->situation_id = (int)$situation_id;
           $this->name = (string)$name;
           $this->description = (string)$description;
           $this->base64 = (string)$base64;
           $this->file_type = (string)$file_type;
           $this->path = (string)$path;
           $this->date_register = (string)$date_register;
           $this->date_update = (string)$date_update;

           /** Verifico se é inserção ou atualização **/
           if($this->user_file_id == 0)
           {

               /** Consulta SQL **/
               $sql = "INSERT INTO user_file(user_file_id, user_id, situation_id, name, description, base64, file_type, path, date_register, date_update)VALUES('{$this->user_file_id}', '{$this->user_id}', '{$this->situation_id}', '{$this->name}', '{$this->description}', '{$this->base64}', '{$this->file_type}', '{$this->path}', '{$this->date_register}', '{$this->date_update}')";

           }else
           {

               /** Consulta SQL **/
               $sql = "UPDATE user_file set user_file_id = '{$this->user_file_id}', user_id = '{$this->user_id}', situation_id = '{$this->situation_id}', name = '{$this->name}', description = '{$this->description}', base64 = '{$this->base64}', file_type = '{$this->file_type}', path = '{$this->path}', date_register = '{$this->date_register}', date_update = '{$this->date_update}' WHERE user_file_id = {$this->user_file_id}";

           }

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Excluo um registro específico **/
       public function Delete($user_file_id)
       {

           /** Parâmetro de entrada **/
           $this->user_file_id = (int)$user_file_id;

           /** Consulta SQL **/
           $sql = "DELETE FROM user_file WHERE user_file_id = {$this->user_file_id}";

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
