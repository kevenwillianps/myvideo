<?php

   /**
    * Created by MyCode
    * user: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Defino o local que a classe esta localizada **/
   namespace vendor\model;

   class UserFunction
   {

       /** Parâmetros que irei utilizar na classe **/
       private $connection  = null;
       private $user_function_id = 0;
       private $situation_id = 0;
       private $name = null;
       private $description = null;
       private $c_execute = 0;
       private $r_execute = 0;
       private $u_execute = 0;
       private $d_execute = 0;
       private $date_register = 0;
       private $date_update = 0;

       /** Construtor da classe **/
       public function __construct()
       {

           /** Cria o objeto de conexão com o banco de dados **/
           $this->connection = new MySql();

           /** Inicio a conexão com o banco de dados **/
           $this->connection->connect();
       }

       /** Listo a quantidade total de registros **/
       public function editForm($user_function_id)
       {

           /** Parâmetro de entrada **/
           $this->user_function_id = (int)$user_function_id;

           /** Consulta SQL **/
           $sql = "select * from user_function where user_function_id = :user_function_id";

           /** Preparo o Sql **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Preencho os parâmetros do sql **/
           $stmt->bindValue(':user_function_id', $this->user_function_id);

           /** Executo o Sql **/
           $stmt->execute();

           /** Executo o Sql **/
           return $stmt->fetchObject();
       }

       /** Lista todos os registros **/
       public function all()
       {

           /** Consulta SQL **/
           $sql = "select * from user_function";

           /** Preparo o Sql **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Executo o Sql **/
           $stmt->execute();

           /** Executo o Sql **/
           return $stmt->fetchAll(\PDO::FETCH_ASSOC);
       }

       /** Insere/autualiza um registro no banco de dados **/
       public function save($user_function_id, $situation_id, $name, $description, $c_execute, $r_execute, $u_execute, $d_execute, $date_register, $date_update)
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
           if ($this->user_function_id == 0) {

               /** Consulta SQL **/
               $sql = "INSERT INTO user_function(user_function_id, situation_id, name, description, c_execute, r_execute, u_execute, d_execute, date_register, date_update)VALUES(:user_function_id, :situation_id, :name, :description, :c_execute, :r_execute, :u_execute, :d_execute, :date_register, :date_update)";
           } else {

               /** Consulta SQL **/
               $sql = "UPDATE user_function set user_function_id = :user_function_id, situation_id = :situation_id, name = :name, description = :description, c_execute = :c_execute, r_execute = :r_execute, u_execute = :u_execute, d_execute = :d_execute, date_register = :date_register, date_update  = :date_update WHERE user_function_id = :user_function_id";
           }

           /** Preparo o sql para execução **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Preencho os parâmetros do Sql **/
           $stmt->bindParam(':user_function_id', $this->user_function_id);
           $stmt->bindParam(':situation_id', $this->situation_id);
           $stmt->bindParam(':name', $this->name);
           $stmt->bindParam(':description', $this->description);
           $stmt->bindParam(':c_execute', $this->c_execute);
           $stmt->bindParam(':r_execute', $this->r_execute);
           $stmt->bindParam(':u_execute', $this->u_execute);
           $stmt->bindParam(':d_execute', $this->d_execute);
           $stmt->bindParam(':date_register', $this->date_register);
           $stmt->bindParam(':date_update', $this->date_update);

           /** retorno e executo o sql **/
           return $stmt->execute();
       }

       /** Excluo um registro específico **/
       public function delete($user_function_id)
       {

           /** Parâmetro de entrada **/
           $this->user_function_id = (int)$user_function_id;

           /** Consulta SQL **/
           $sql = "DELETE FROM user_function WHERE user_function_id = :user_function_id";

           /** Preparo o Sql **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Preencho os parâmetros do sql **/
           $stmt->bindValue(':user_function_id', $this->user_function_id);

           /** Executo o Sql **/
           return $stmt->execute();
       }

       /** Lista todos os registros **/
       public function get($user_function_id)
       {

           /** Parâmetros de entrada **/
           $this->user_function_id = (int)$user_function_id;

           /** Consulta SQL **/
           $sql = "select * from user_function where user_function_id = :user_function_id";

           /** Preparo o Sql **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Preencho os parâmetros do sql **/
           $stmt->bindValue(':user_function_id', $this->user_function_id);

           /** Executo o Sql **/
           $stmt->execute();

           /** Executo o Sql **/
           return $stmt->fetchObject();
       }
   }
