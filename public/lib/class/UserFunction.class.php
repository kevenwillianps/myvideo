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

   class UserFunction
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
           $sql = "select count(*) as qtde from user_function ";

           /** Executo o comando SQL */
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return (int)$this->obj->query_fetch_object()->qtde;

       }

       /** Listo a quantidade total de registros **/
       public function Get($user_function_id)
       {

           /** Parâmetro de entrada **/
           $this->user_function_id = (int)$user_function_id;

           /** Consulta SQL **/
           $sql = "select * from user_function where user_function_id = {$this->user_function_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Listo a quantidade total de registros **/
       public function EditForm($user_function_id)
       {

           /** Parâmetro de entrada **/
           $this->user_function_id = (int)$user_function_id;

           /** Consulta SQL **/
           $sql = "select * from user_function where user_function_id = {$this->user_function_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Lista todos os registros **/
       public function All()
       {

           /** Consulta SQL **/
           $sql = "select * from user_function";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Insere/autualiza um registro no banco de dados **/
       public function Save($user_function_id, $situation_id, $name, $description, $c_execute, $r_execute, $u_execute, $d_execute, $date_register, $date_update)
       {

           /** Parâmetros de entrada **/
           $this->user_function_id = (int)$user_function_id;
           $this->situation_id = (int)$situation_id;
           $this->name = (string)$name;
           $this->description = (string)$description;
           $this->c_execute = (int)$c_execute;
           $this->r_execute = (int)$r_execute;
           $this->u_execute = (int)$u_execute;
           $this->d_execute = (int)$d_execute;
           $this->date_register = (string)$date_register;
           $this->date_update = (string)$date_update;

           /** Verifico se é inserção ou atualização **/
           if($this->user_function_id == 0)
           {

               /** Consulta SQL **/
               $sql = "INSERT INTO user_function(user_function_id, situation_id, name, description, c_execute, r_execute, u_execute, d_execute, date_register, date_update)VALUES('{$this->user_function_id}', '{$this->situation_id}', '{$this->name}', '{$this->description}', '{$this->c_execute}', '{$this->r_execute}', '{$this->u_execute}', '{$this->d_execute}', '{$this->date_register}', '{$this->date_update}')";

           }else
           {

               /** Consulta SQL **/
               $sql = "UPDATE user_function set user_function_id = '{$this->user_function_id}', situation_id = '{$this->situation_id}', name = '{$this->name}', description = '{$this->description}', c_execute = '{$this->c_execute}', r_execute = '{$this->r_execute}', u_execute = '{$this->u_execute}', d_execute = '{$this->d_execute}', date_register = '{$this->date_register}', date_update = '{$this->date_update}' WHERE user_function_id = {$this->user_function_id}";

           }

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Excluo um registro específico **/
       public function Delete($user_function_id)
       {

           /** Parâmetro de entrada **/
           $this->user_function_id = (int)$user_function_id;

           /** Consulta SQL **/
           $sql = "DELETE FROM user_function WHERE user_function_id = {$this->user_function_id}";

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
