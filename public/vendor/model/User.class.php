<?php
/**
 * Created by MyCode
 * user: KEVEN
 * Date: 01/06/2020
 * Time: 13:20
 *
 */

/** Defino o local onde a classe esta localizada **/
namespace vendor\model;

class User
{

    /** Declaro as variaveis que irei utilizar na classe **/
    private $connection = null;
    private $sql = null;
    private $stmt = null;
    private $search = null;
    private $user_id = 0;
    private $user_function_id = 0;
    private $situation_id = 0;
    private $name = null;
    private $email = null;
    private $date_birth = null;
    private $access_first = null;
    private $access_last = null;
    private $access_log = null;
    private $password = null;
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

    /** Listo a quantidade total de registros **/
    public function access($email, $password)
    {

        /** Parâmetro de entrada **/
        $this->email = (string)$email;
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
                where us.email = :email AND us.password = :password limit 1";

        /** Preparo o SQl **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Adiciono valores aos parâmetros **/
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        /** Executo o Sql **/
        $stmt->execute();

        /** Relizo a listagem do resutlado **/
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    /** Listo todos os registros **/
    public function search($search)
    {

        /** Parâmetros de entrada **/
        $this->search = (string)$search;

        /** Consulta SQL **/
        $this->sql = "select
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
                  join user_function usf on us.user_function_id = usf.user_function_id
                where lower(us.name) like :search or lower(us.email) like :search";

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

    /** Listo todos os registros **/
    public function all()
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

        /** Preparo o SQl **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Executo o Sql **/
        $stmt->execute();

        /** Relizo a listagem do resutlado **/
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Insere/autualiza um registro no banco de dados **/
    public function save($user_id, $user_function_id, $situation_id, $name, $email, $date_birth, $access_first, $access_last, $access_log, $password, $date_register, $date_update)
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
        if ($this->user_id == 0) {

            /** Consulta SQL **/
            $sql = "INSERT INTO user(user_id, user_function_id, situation_id, name, email, date_birth, access_first, access_last, access_log, password, date_register, date_update)VALUES(:user_id, :user_function_id, :situation_id, :name, :email, :date_birth, :access_first, :access_last, :access_log, :password, :date_register, :date_update);";
        } else {

            /** Consulta SQL **/
            $sql = "UPDATE user set user_id = :user_id, user_function_id = :user_function_id, situation_id = :situation_id, name = :name, email = :email, date_birth = :date_birth, access_first = :access_first, access_last = :access_last, access_log = :access_log, password = :password, date_register = :date_register, date_update = :date_update WHERE user_id = :user_id";
        }

        /** Preparo o Sql **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Preencho os parâmetros do SQL **/
        $stmt->bindValue(':user_id', $this->user_id);
        $stmt->bindValue(':user_function_id', $this->user_function_id);
        $stmt->bindValue(':situation_id', $this->situation_id);
        $stmt->bindValue(':name', $this->name);
        $stmt->bindValue(':email', $this->email);
        $stmt->bindValue(':date_birth', $this->date_birth);
        $stmt->bindValue(':access_first', $this->access_first);
        $stmt->bindValue(':access_last', $this->access_last);
        $stmt->bindValue(':access_log', $this->access_log);
        $stmt->bindValue(':password', $this->password);
        $stmt->bindValue(':date_register', $this->date_register);
        $stmt->bindValue(':date_update', $this->date_update);

        /** Executo o Sql **/
        return $stmt->execute();
    }

    /** Listo a quantidade total de registros **/
    public function editForm($user_id)
    {

        /** Parâmetro de entrada **/
        $this->user_id = (int)$user_id;

        /** Consulta SQL **/
        $sql = "select * from user where user_id = :user_id";

        /** Preparo Sql **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Preencho os valores dos parâmetros **/
        $stmt->bindParam(':user_id', $this->user_id);

        /** Executo o Sql **/
        $stmt->execute();

        /** Executo o Sql **/
        return $stmt->fetchObject();
    }

    /** Listo a quantidade total de registros **/
    public function getLast()
    {

        /** Consulta SQL **/
        $sql = "select 
                      * 
                from user 
                order by user_id desc limit 1";

        /** Preparo Sql **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Executo o Sql **/
        $stmt->execute();

        /** Executo o Sql **/
        return $stmt->fetchObject();
    }

    /** Lista todos os registros **/
    public function getTopProfiles()
    {

        /** Consulta SQL **/
        $this->sql = "select
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
                   (select uf.file_type from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_type,
                   (select count(c.content_id) as quantity_content from content c where c.user_id = us.user_id) as quantity_content,
                   (select count(cs.content_sub_id) as quantity_content_sub from content_sub cs where cs.user_id = us.user_id) as quantity_content_sub
                 from user us
                   join user_function usf on us.user_function_id = usf.user_function_id
                 where (select count(c.content_id) as quantity_content from content c where c.user_id = us.user_id) > 0 or (select count(cs.content_sub_id) as quantity_content_sub from content_sub cs where cs.user_id = us.user_id) > 0
                 order by rand() limit 3";

        /** Preparo o SQl **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Executo o Sql **/
        $this->stmt->execute();

        /** Relizo a listagem do resutlado **/
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /** Listo a quantidade total de registros **/
    public function get($user_id)
    {

        /** Parâmetro de entrada **/
        $this->user_id = (int)$user_id;

        /** Consulta SQL **/
        $this->sql = "select * from user us where user_id = :user_id";

        /** Preparo o SQl **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQL **/
        $this->stmt->bindValue(':user_id', $this->user_id);

        /** Executo o Sql **/
        $this->stmt->execute();

        /** Relizo a listagem do resutlado **/
        return $this->stmt->fetchObject();
    }

    /** Listo a quantidade total de registros **/
    public function getUserDetails($user_id)
    {

        /** Parâmetro de entrada **/
        $this->user_id = (int)$user_id;

        /** Consulta SQL **/
        $this->sql = "select
                   us.user_id,
                   us.name as user_name,
                   us.email as user_email,
                   uf.name as user_function,
                   (select count(c.content_id) as quantity_content from content c where c.user_id = {$this->user_id}) as quantity_content,
                   (select count(cs.content_sub_id) as quantity_content_sub from content_sub cs where cs.user_id = {$this->user_id}) as quantity_content_sub,
                   (select uf.name from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_name,
                   (select uf.path from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_path,
                   (select uf.file_type from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as file_type
                 from user us
                   join user_function uf on us.user_function_id = uf.user_function_id
                 where user_id = :user_id";

        /** Preparo o SQl **/
        $this->stmt = $this->connection->connect()->prepare($this->sql);

        /** Preencho os parâmetros do SQL **/
        $this->stmt->bindValue(':user_id', $this->user_id);

        /** Executo o Sql **/
        $this->stmt->execute();

        /** Relizo a listagem do resutlado **/
        return $this->stmt->fetchObject();
    }

    /** Excluo um registro específico **/
    public function delete($user_id)
    {

        /** Parâmetro de entrada **/
        $this->user_id = (int)$user_id;

        /** Consulta SQL **/
        $sql = "DELETE FROM user WHERE user_id = :user_id";

        /** Preparo o Sql **/
        $stmt = $this->connection->connect()->prepare($sql);

        /** Adiciono valores aos parâmetros **/
        $stmt->bindParam(':user_id', $this->user_id);

        /** Executo o Sql **/
        return $stmt->execute();
    }

    /** Construtor da classe **/
    public function __destruct()
    {

        /** Finalizo a conexão com o banco de dados **/
        $this->connection = null;
    }
}
