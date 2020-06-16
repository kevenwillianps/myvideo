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

   class User
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
           $sql = "select count(*) as qtde from user ";

           /** Executo o comando SQL */
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return (int)$this->obj->query_fetch_object()->qtde;

       }

       /** Listo a quantidade total de registros **/
       public function Access($email, $password)
       {

           /** Parâmetro de entrada **/
           $this->email    = (string)$email;
           $this->password = (string)$password;

           /** Consulta SQL **/
           $sql = "select
                   us.user_id,
                   us.name as user_name,
                   us.email,
                   us.access_first,
                   us.access_last,
                   us.date_register,
                   us.date_update,
                   usf.user_function_id,
                   usf.name as function_name,
                   usf.c_execute,
                   usf.r_execute,
                   usf.u_execute,
                   usf.d_execute
                   from user us 
                   join user_function usf on us.user_function_id = usf.user_function_id
                   where us.email = '{$this->email}' AND us.password = '{$this->password}' limit 1";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Listo a quantidade total de registros **/
       public function Get($user_id)
       {

           /** Parâmetro de entrada **/
           $this->user_id = (int)$user_id;

           /** Consulta SQL **/
           $sql = "select * from user where user_id = {$this->user_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Listo a quantidade total de registros **/
       public function GetUserProfile($user_id)
       {

           /** Parâmetro de entrada **/
           $this->user_id = (int)$user_id;

           /** Consulta SQL **/
           $sql = "select
                   us.user_id,
                   us.name as user_name,
                   uf.name as user_function,
                   (select count(c.content_id) as quantity_content from content c where c.user_id = {$this->user_id}) as quantity_content,
                   (select count(cs.content_sub_id) as quantity_content_sub from content_sub cs where cs.user_id = {$this->user_id}) as quantity_content_sub,
                   (select uf.name from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_name,
                   (select uf.path from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_path,
                   (select uf.file_type from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_type
                 from user us
                   join user_function uf on us.user_function_id = uf.user_function_id
                 where user_id = {$this->user_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Listo a quantidade total de registros **/
       public function EditForm($user_id)
       {

           /** Parâmetro de entrada **/
           $this->user_id = (int)$user_id;

           /** Consulta SQL **/
           $sql = "select
                   us.user_id,
                   us.user_function_id,
                   us.situation_id,
                   us.name,
                   us.email,
                   us.date_birth,
                   us.access_first,
                   us.access_last,
                   us.access_log,
                   us.date_register,
                   us.date_update
                   from user us 
                   where user_id = {$this->user_id}";

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
                   (select uf.file_type from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_type
                 from user us
                   join user_function usf on us.user_function_id = usf.user_function_id";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Insere/autualiza um registro no banco de dados **/
       public function Save($user_id, $user_function_id, $situation_id, $name, $email, $date_birth, $access_first, $access_last, $access_log, $password, $date_register, $date_update)
       {

           /** Parâmetros de entrada **/
           $this->user_id          = (int)$user_id;
           $this->user_function_id = (int)$user_function_id;
           $this->situation_id     = (int)$situation_id;
           $this->name             = (string)$name;
           $this->email            = (string)$email;
           $this->date_birth       = (string)$date_birth;
           $this->access_first     = (string)$access_first;
           $this->access_last      = (string)$access_last;
           $this->access_log       = (string)$access_log;
           $this->password         = (string)$password;
           $this->date_register    = (string)$date_register;
           $this->date_update      = (string)$date_update;

           /** Verifico se é inserção ou atualização **/
           if($this->user_id == 0)
           {

               /** Consulta SQL **/
               $sql = "INSERT INTO user(user_id, user_function_id, situation_id, name, email, date_birth, access_first, access_last, access_log, password, date_register, date_update)VALUES('{$this->user_id}', '{$this->user_function_id}', '{$this->situation_id}', '{$this->name}', '{$this->email}', '{$this->date_birth}', '{$this->access_first}', '{$this->access_last}', '{$this->access_log}', '{$this->password}', '{$this->date_register}', '{$this->date_update}')";

           }else
           {

               /** Consulta SQL **/
               $sql = "UPDATE user set user_id = '{$this->user_id}', user_function_id = '{$this->user_function_id}', situation_id = '{$this->situation_id}', name = '{$this->name}', email = '{$this->email}', date_birth = '{$this->date_birth}', access_first = '{$this->access_first}', access_last = '{$this->access_last}', access_log = '{$this->access_log}', password = '{$this->password}', date_register = '{$this->date_register}', date_update = '{$this->date_update}' WHERE user_id = {$this->user_id}";

           }

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Excluo um registro específico **/
       public function Delete($user_id)
       {

           /** Parâmetro de entrada **/
           $this->user_id = (int)$user_id;

           /** Consulta SQL **/
           $sql = "DELETE FROM user WHERE user_id = {$this->user_id}";

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
