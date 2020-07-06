<?php

/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 **/

/** Defino o local onde a classe esta localizada **/
namespace vendor\model;

class ContentCategory
{

    /** Variaveis que irei utilizar na classe **/
    private $connection = null;
    private $content_category_id = 0;
    private $user_id = 0;
    private $situation_id = 0;
    private $name = null;
    private $description = null;
    private $date_register = null;
    private $date_update = null;

    /** Construtor da classe **/
    public function __construct()
    {

        /** Cria o objeto de conexão com o banco de dados **/
        $this->connection = new MySql();

        /** Inicio uma conexão com o banco de dados **/
        $this->connection->connect();
    }

    /** Listo a quantidade total de registros **/
    public function editForm($content_category_id)
    {

        /** Parâmetro de entrada **/
        $this->content_category_id = (int)$content_category_id;

        /** Consulta SQL **/
        $sql = "select * from content_category where content_category_id = :content_category_id";

        /** Preparo o Sql **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Preencho os parâmetros do SQl **/
        $stmt->bindValue(':content_category_id', $this->content_category_id);

        /** Executo o SQl **/
        $stmt->execute();

        /** Retorno um objeto **/
        return $stmt->fetchObject();
    }

    /** Listo a quantidade total de registros **/
    public function get($content_category_id)
    {

        /** Parâmetro de entrada **/
        $this->content_category_id = (int)$content_category_id;

        /** Consulta SQL **/
        $sql = "select * from content_category where content_category_id = :content_category_id";

        /** Preparo o Sql **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Preencho os parâmetros do SQl **/
        $stmt->bindValue(':content_category_id', $this->content_category_id);

        /** Executo o SQl **/
        $stmt->execute();

        /** Retorno um objeto **/
        return $stmt->fetchObject();
    }

    /** Lista todos os registros **/
    public function all()
    {

        /** Consulta SQL **/
        $sql = "select * from content_category";

        /** Preparo o Sql **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Executo o SQl **/
        $stmt->execute();

        /** Retorno um objeto **/
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Insere/autualiza um registro no banco de dados **/
    public function save($content_category_id, $user_id, $situation_id, $name, $description, $date_register, $date_update)
    {

        /** Parâmetros de entrada **/
        $this->content_category_id = (int)$content_category_id;
        $this->user_id             = (int)$user_id;
        $this->situation_id        = (int)$situation_id;
        $this->name                = (string)$name;
        $this->description         = (string)$description;
        $this->date_register       = (string)$date_register;
        $this->date_update         = (string)$date_update;

        /** Verifico se é inserção ou atualização **/
        if ($this->content_category_id == 0) {

            /** Consulta SQL **/
            $sql = "INSERT INTO content_category(content_category_id, user_id, situation_id, name, description, date_register, date_update)VALUES(:content_category_id, :user_id, :situation_id, :name, :description, :date_register, :date_update)";
        } else {

            /** Consulta SQL **/
            $sql = "UPDATE content_category set content_category_id = :content_category_id, user_id = :user_id, situation_id = :situation_id, name = :name, description = :description, date_register = :date_register, date_update = :date_update WHERE content_category_id = :content_category_id";
        }

        /** Preparo o SQL **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Preencho os parâmetros do sql **/
        $stmt->bindValue(':content_category_id', $this->content_category_id);
        $stmt->bindValue(':user_id', $this->user_id);
        $stmt->bindValue(':situation_id', $this->situation_id);
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':description', $this->description);
        $stmt->bindValue(':date_register', $this->date_register);
        $stmt->bindValue(':date_update', $this->date_update);

        /** Executo o Sql **/
        $stmt->execute();
    }

    /** Excluo um registro específico **/
    public function delete($content_category_id)
    {

        /** Parâmetro de entrada **/
        $this->content_category_id = (int)$content_category_id;

        /** Consulta SQL **/
        $sql = "DELETE FROM content_category WHERE content_category_id = :content_category_id";

        /** Preparo o Sql **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Preencho os parâmetros do SQl **/
        $stmt->bindValue(':content_category_id', $this->content_category_id);

        /** Retorno um objeto **/
        return $stmt->execute();
    }
}
