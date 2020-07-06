<?php

/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 **/

/** Defino o local que a classe esta **/
namespace vendor\model;

class ContentSubAuxiliary
{

    /** Variáveis que irei utilizar na classe **/
    private $connection = null;
    private $sql = null;
    private $stmt = null;
    private $search = null;
    private $content_sub_id = 0;
    private $content_id = 0;
    private $content_sub_auxiliary_id = null;
    private $user_id = 0;
    private $situation_id = 0;
    private $menu_position = 0;
    private $highlighter_id = 0;
    private $url = null;
    private $title = null;
    private $title_menu = null;
    private $description = null;
    private $content_resume = null;
    private $content_complete = null;
    private $date_register = null;
    private $date_update = null;

    /** Construtor da classe **/
    public function __construct()
    {

        /** Instânciamento de classes **/
        $this->connection = new MySql();

        /** Inicio a conexão com o banco de dados **/
        $this->connection->connect();
    }

    /** Lista todos os registros **/
    public function all($content_sub_auxiliary_id)
    {

        /** Parâmetros de Entrada **/
        $this->content_sub_auxiliary_id = (int)$content_sub_auxiliary_id;

        /** Consulta SQL **/
        $this->sql = "select
                      cs.content_sub_id,
                      cs.content_id,
                      cs.content_sub_auxiliary_id,
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
                      (select cf.file_type from content_sub_file cf where cf.content_sub_id = cs.content_sub_id order by content_sub_file_id desc limit 1) as file_type,
                      (select uf.name from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as user_file_name,
                      (select uf.path from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as user_file_path
                    from content_sub cs
                      join user us on us.user_id = cs.user_id
                      join user_function uf on us.user_function_id = uf.user_function_id
                    where cs.content_sub_auxiliary_id = :content_sub_auxiliary_id
                    order by cs.content_sub_id asc";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Defino os valores dos parâmetros **/
        $this->stmt->bindParam(':content_sub_auxiliary_id', $this->content_sub_auxiliary_id);

        /** Executo o Sql **/
        $this->stmt->execute();

        /** Retorno um objeto **/
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Insere/autualiza um registro no banco de dados **/
    public function save($content_sub_id, $content_id, $content_sub_auxiliary_id, $user_id, $situation_id, $highlighter_id, $menu_position, $url, $title, $title_menu, $description, $content_resume, $content_complete, $date_register, $date_update)
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
        if ($this->content_sub_id == 0) {

            /** Consulta SQL **/
            $this->sql = "INSERT INTO content_sub(content_sub_id, content_id, content_sub_auxiliary_id, user_id, situation_id, menu_position, highlighter_id, url, title, title_menu, description, content_resume, content_complete, date_register, date_update)VALUES(:content_sub_id, :content_id, :content_sub_auxiliary_id, :user_id, :situation_id, :menu_position, :highlighter_id, :url, :title, :title_menu, :description, :content_resume, :content_complete, :date_register, :date_update);";
        } else {

            /** Consulta SQL **/
            $this->sql = "UPDATE content_sub set content_sub_id = :content_sub_id, content_id = :content_id, content_sub_auxiliary_id = :content_sub_auxiliary_id, user_id = :user_id, situation_id = :situation_id, menu_position = :menu_position, highlighter_id = :highlighter_id, url = :url, title = :title, title_menu = :title_menu, description = :description, content_resume = :content_resume, content_complete = :content_complete, date_register = :date_register, date_update = :date_update WHERE content_sub_id = :content_sub_id;";
        }

        /** Preparo o sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Coloco os valores do SQl **/
        $this->stmt->bindParam(':content_sub_id', $this->content_sub_id);
        $this->stmt->bindParam(':content_id', $this->content_id);
        $this->stmt->bindParam(':content_sub_auxiliary_id', $this->content_sub_auxiliary_id);
        $this->stmt->bindParam(':user_id', $this->user_id);
        $this->stmt->bindParam(':situation_id', $this->situation_id);
        $this->stmt->bindParam(':menu_position', $this->menu_position);
        $this->stmt->bindParam(':highlighter_id', $this->highlighter_id);
        $this->stmt->bindParam(':url', $this->url);
        $this->stmt->bindParam(':title', $this->title);
        $this->stmt->bindParam(':title_menu', $this->title_menu);
        $this->stmt->bindParam(':description', $this->description);
        $this->stmt->bindParam(':content_resume', $this->content_resume);
        $this->stmt->bindParam(':content_complete', $this->content_complete);
        $this->stmt->bindParam(':date_register', $this->date_register);
        $this->stmt->bindParam(':date_update', $this->date_update);

        /** Executo o sql **/
        return $this->stmt->execute();
    }

    /** Excluo um registro específico **/
    public function delete($content_sub_id)
    {

        /** Parâmetro de entrada **/
        $this->content_sub_id = (int)$content_sub_id;

        /** Consulta SQL **/
        $this->sql = "DELETE FROM content_sub WHERE content_sub_id = :content_sub_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do sql **/
        $this->stmt->bindParam(':content_sub_id', $this->content_sub_id);

        /** Executo o comando SQL **/
        return $this->stmt->execute();
    }

    /** Listo a quantidade total de registros **/
    public function get($content_sub_id)
    {

        /** Parâmetro de entrada **/
        $this->content_sub_id = (int)$content_sub_id;

        /** Consulta SQL **/
        $this->sql = "select * from content_sub where content_sub_id = :content_sub_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do sql **/
        $this->stmt->bindParam(':content_sub_id', $this->content_sub_id);

        /** Executo o Sql **/
        $this->stmt->execute();

        /** Executo o comando SQL **/
        return $this->stmt->fetchObject();
    }

    /** Listo a quantidade total de registros **/
    public function getContent($content_sub_id)
    {

        /** Parâmetro de entrada **/
        $this->content_sub_id = (int)$content_sub_id;

        /** Consulta SQL **/
        $this->sql = "select
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
                   (select cf.file_type from content_sub_file cf where cf.content_sub_id = cs.content_sub_id order by content_sub_file_id desc limit 1) as file_type,
                   (select uf.name from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as user_file_name,
                   (select uf.path from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as user_file_path
                 from content_sub cs
                   join user us on us.user_id = cs.user_id
                   join user_function uf on us.user_function_id = uf.user_function_id
                 where cs.content_sub_id = :content_sub_id
                      and cs.content_sub_auxiliary_id is null
                 order by cs.content_sub_id desc";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do sql **/
        $this->stmt->bindParam(':content_sub_id', $this->content_sub_id);

        /** Executo o Sql **/
        $this->stmt->execute();

        /** Executo o comando SQL **/
        return $this->stmt->fetchObject();
    }

    /** Listo a quantidade total de registros **/
    public function editForm($content_sub_id)
    {

        /** Parâmetro de entrada **/
        $this->content_sub_id = (int)$content_sub_id;

        /** Consulta SQL **/
        $this->sql = "select * from content_sub where content_sub_id = :content_sub_id";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do sql **/
        $this->stmt->bindParam(':content_sub_id', $this->content_sub_id);

        /** Executo o Sql **/
        $this->stmt->execute();

        /** Executo o comando SQL **/
        return $this->stmt->fetchObject();
    }

    /** Lista todos os registros **/
    public function search($search)
    {

        /** Parâmetros de Entrada **/
        $this->search = (string)$search;

        /** Consulta SQL **/
        $this->sql = "select
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
                    where lower(cs.title) like :search
                          and cs.content_sub_auxiliary_id is null
                    order by cs.content_sub_id desc";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Informo para buscar qualquer coisa antes ou depois **/
        $this->search = '%' . $this->search . '%';

        /** Preencho os parâmetros do sql **/
        $this->stmt->bindParam(':search', $this->search);

        /** Executo o Sql **/
        $this->stmt->execute();

        /** Executo o comando SQL **/
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Listo a quantidade total de registros **/
    public function getLast()
    {

        /** Consulta SQL **/
        $this->sql = "select * from content_sub order by content_sub_id desc limit 1";

        /** Preparo o Sql **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o Sql **/
        $this->stmt->execute();

        /** Executo o comando SQL **/
        return $this->stmt->fetchObject();
    }

    public function __destruct()
    {

        /** Encerro a conexão com o banco de dados **/
        $this->connection = null;
    }
}
