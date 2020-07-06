<?php

/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 **/

/** Informo o local onde esta minha classe **/
namespace vendor\model;

class UserFile
{

    /** Declaro as variveis que irei utilizar na classe **/
    private $connection = null;
    private $sql = null;
    private $stmt = null;
    private $user_file_id = 0;
    private $user_id = 0;
    private $situation_id = 0;
    private $name = null;
    private $description = null;
    private $base64 = null;
    private $file_type = null;
    private $path = null;
    private $date_register = null;
    private $date_update = null;

    /** Construtor da classe **/
    public function __construct()
    {

        /** Cria o objeto de conexão com o banco de dados **/
        $this->connection = new MySql();

        /** Inicio a conexão com o banco de dados **/
        $this->connection->connect();
    }

    /** Listo a quantidade total de registros **/
    public function get($user_file_id)
    {

        /** Parâmetro de entrada **/
        $this->user_file_id = (int)$user_file_id;

        /** Consulta SQL **/
        $this->sql = "select * from user_file where user_file_id = :user_file_id";

        /** Preparo o Sql **/
        $stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQl **/
        $stmt->bindValue(':user_file_id', $this->user_file_id);

        /** Executo o SQl **/
        $stmt->execute();

        /** Retorno um objeto **/
        return $stmt->fetchObject();
    }

    /** Lista um registro específico **/
    public function getLast()
    {

        /** Consulta SQL **/
        $this->sql = "select * from user_file order by user_file_id desc limit 1";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQl **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchObject();
    }

    /** Lista todos os registros **/
    public function all()
    {

        /** Consulta SQL **/
        $this->sql = "select * from user_file_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o SQl **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Insere/autualiza um registro no banco de dados **/
    public function save($user_file_id, $user_id, $situation_id, $name, $description, $base64, $file_type, $path, $date_register, $date_update)
    {

        /** Parâmetros de entrada **/
        $this->user_file_id  = (int)$user_file_id;
        $this->user_id       = (int)$user_id;
        $this->situation_id  = (int)$situation_id;
        $this->name          = (string)$name;
        $this->description   = (string)$description;
        $this->base64        = (string)$base64;
        $this->file_type     = (string)$file_type;
        $this->path          = (string)$path;
        $this->date_register = (string)$date_register;
        $this->date_update   = (string)$date_update;

        /** Verifico se é inserção ou atualização **/
        if ($this->user_file_id == 0) {

            /** Consulta SQL **/
            $this->sql = "INSERT INTO user_file(user_file_id, user_id, situation_id, name, description, base64, file_type, path, date_register, date_update)VALUES(:user_file_id, :user_id, :situation_id, :name, :description, :base64, :file_type, :path, :date_register, :date_update)";
        } else {

            /** Consulta SQL **/
            $this->sql = "UPDATE user_file set user_file_id = :user_file_id, user_id = :user_id, situation_id = :situation_id, name = :name, description = :description, base64 = :base64, file_type = :file_type, path = :path, date_register = :date_register, date_update = :date_update WHERE content_file_id = :content_file_id";
        }

        /** Preparo o sql para execução **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do Sql **/
        $this->stmt->bindParam(':user_file_id', $this->user_file_id);
        $this->stmt->bindParam(':user_id', $this->user_id);
        $this->stmt->bindParam(':situation_id', $this->situation_id);
        $this->stmt->bindParam(':name', $this->name);
        $this->stmt->bindParam(':description', $this->description);
        $this->stmt->bindParam(':base64', $this->base64);
        $this->stmt->bindParam(':file_type', $this->file_type);
        $this->stmt->bindParam(':path', $this->path);
        $this->stmt->bindParam(':date_register', $this->date_register);
        $this->stmt->bindParam(':date_update', $this->date_update);

        /** retorno e executo o sql **/
        return $this->stmt->execute();
    }

    /** Excluo um registro específico **/
    public function delete($user_file_id)
    {

        /** Parâmetro de entrada **/
        $this->user_file_id = (int)$user_file_id;

        /** Consulta SQL **/
        $this->sql = "DELETE FROM user_file WHERE user_file_id = :user_file_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQl **/
        $this->stmt->bindValue(':user_file_id', $this->user_file_id);

        /** Retorno um objeto **/
        return $this->stmt->execute();
    }
}
