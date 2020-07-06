<?php

   /**
    * Created by MyCode
    * user: KEVEN
    * Date: 01/06/2020
    * Time: 13:20
   **/

   /** Defino o local onde a classe esta localizada **/
   namespace vendor\model;

   class Content
   {

       /** Declaração de variaveis que irei urtilizar dentro da classe **/
       private $connection = null;
       private $sql = null;
       private $stmt = null;
       private $search = null;
       private $content_id = 0;
       private $content_category_id = 0;
       private $user_id = 0;
       private $situation_id = 0;
       private $highlighter_id = 0;
       private $menu_position = 0;
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

       /** Listo a quantidade total de registros **/
       public function search($search)
       {

           /** Parâmetro de entrada **/
           $this->search = (string)$search;

           /** Consulta SQL **/
           $this->sql = "select
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
                          (select cf.file_type from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_type,
                          (select uf.name from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as user_file_name,
                          (select uf.path from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as user_file_path
                        from content c
                          join user us on us.user_id = c.user_id
                          join user_function uf on uf.user_function_id = us.user_function_id
                        where lower(c.title) like :search
                        order by c.content_id desc";

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

       /** Lista todos os registros **/
       public function all()
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

           /** Preparo o SQl **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Executo o Sql **/
           $stmt->execute();

           /** Relizo a listagem do resutlado em forma de array associativa **/
           return $stmt->fetchAll(\PDO::FETCH_ASSOC);
       }

       /** Insere/autualiza um registro no banco de dados **/
       public function save($content_id, $content_category_id, $user_id, $situation_id, $highlighter_id, $menu_position, $url, $title, $title_menu, $description, $content_resume, $content_complete, $date_register, $date_update)
       {

           /** Parâmetros de entrada **/
           $this->content_id          = (int)$content_id;
           $this->content_category_id = (int)$content_category_id;
           $this->user_id             = (int)$user_id;
           $this->situation_id        = (int)$situation_id;
           $this->highlighter_id      = (int)$highlighter_id;
           $this->menu_position       = (int)$menu_position;
           $this->url                 = (string)$url;
           $this->title               = (string)$title;
           $this->title_menu          = (string)$title_menu;
           $this->description         = (string)$description;
           $this->content_resume      = (string)$content_resume;
           $this->content_complete    = (string)$content_complete;
           $this->date_register       = (string)$date_register;
           $this->date_update         = (string)$date_update;

           /** Verifico se é inserção ou atualização **/
           if ($this->content_id == 0) {

               /** Consulta SQL **/
               $sql = "INSERT INTO content(content_id, content_category_id, user_id, situation_id, highlighter_id, menu_position, url, title, title_menu, description,content_resume, content_complete, date_register, date_update) VALUES(:content_id, :content_category_id, :user_id, :situation_id, :highlighter_id, :menu_position, :url, :title, :title_menu, :description, :content_resume, :content_complete, :date_register, :date_update);";
           } else {

               /** Consulta SQL **/
               $sql = "UPDATE content set content_id = :content_id, content_category_id = :content_category_id, user_id = :user_id, situation_id = :situation_id, highlighter_id = :highlighter_id, menu_position = :menu_position, url = :url, title = :title, title_menu = :title_menu,description = :description, content_resume = :content_resume, content_complete = :content_complete, date_register = :date_register, date_update = :date_update WHERE content_id = :content_id";
           }

           /** Preparo o sql para execução **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Preencho os parâmetros do Sql **/
           $stmt->bindParam(':content_id', $this->content_id);
           $stmt->bindParam(':content_category_id', $this->content_category_id);
           $stmt->bindParam(':user_id', $this->user_id);
           $stmt->bindParam(':situation_id', $this->situation_id);
           $stmt->bindParam(':highlighter_id', $this->highlighter_id);
           $stmt->bindParam(':menu_position', $this->menu_position);
           $stmt->bindParam(':url', $this->url);
           $stmt->bindParam(':title', $this->title);
           $stmt->bindParam(':title_menu', $this->title_menu);
           $stmt->bindParam(':description', $this->description);
           $stmt->bindParam(':content_resume', $this->content_resume);
           $stmt->bindParam(':content_complete', $this->content_complete);
           $stmt->bindParam(':date_register', $this->date_register);
           $stmt->bindParam(':date_update', $this->date_update);

           /** retorno e executo o sql **/
           return $stmt->execute();
       }

       /** Excluo um registro específico **/
       public function delete($content_id)
       {

           /** Parâmetro de entrada **/
           $this->content_id = (int)$content_id;

           /** Consulta SQL **/
           $sql = "DELETE FROM content WHERE content_id = :content_id";

           /** Preparo o Sql **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Adiciono valores aos parâmetros **/
           $stmt->bindParam(':content_id', $this->content_id);

           /** Executo o Sql **/
           return $stmt->execute();
       }

       /** Listo a quantidade total de registros **/
       public function getLast()
       {

           /** Consulta SQL **/
           $sql = "select * from content order by content_id desc limit 1";

           /** Preparo o sql **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Executo o sql **/
           $stmt->execute();

           /** Retorno um objeto **/
           return $stmt->fetchObject();
       }

       /** Listo a quantidade total de registros **/
       public function get($content_id)
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
                      (select cf.file_type from content_file cf where cf.content_id = c.content_id order by content_file_id desc limit 1) as file_type,
                      (select uf.name from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as user_file_name,
                      (select uf.path from user_file uf where uf.user_id = us.user_id order by uf.user_file_id desc limit 1) as user_file_path
                   from content c
                     join user us on us.user_id = c.user_id
                     join user_function uf on uf.user_function_id = us.user_function_id
                   where c.content_id = :content_id
                   order by c.content_id desc";

           /** Preparo o sql **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Adiciono valores aos parâmetros **/
           $stmt->bindParam(':content_id', $this->content_id);

           /** Executo o sql **/
           $stmt->execute();

           /** Retorno em forma de objeto uma consulta SQL **/
           return $stmt->fetchObject();
       }

       /** Lista todos os registros **/
       public function getContent()
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
                 order by rand() limit 3";

           /** Preparo o sql **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Executo o sql **/
           $stmt->execute();

           /** Retorno em forma de objeto uma consulta SQL **/
           return $stmt->fetchAll(\PDO::FETCH_ASSOC);
       }

       /** Listo a quantidade total de registros **/
       public function getUserContent($user_id)
       {

           /** Parâmetro de entrada **/
           $this->user_id = (int)$user_id;

           /** Consulta SQL **/
           $this->sql = "select 
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
                 where c.user_id = :user_id
                 order by c.content_id desc";

           /** Preparo o Sql **/
           $this->stmt = $this->connection->connect()->prepare($this->sql);

           /** Preencho os parâmetros do Sql **/
           $this->stmt->bindParam(':user_id', $this->user_id);

           /** Executo o Sql **/
           $this->stmt->execute();

           /** Retorno um objeto **/
           return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
       }

       /** Listo a quantidade total de registros **/
       public function editForm($content_id)
       {

           /** Parâmetro de entrada **/
           $this->content_id = (int)$content_id;

           /** Consulta SQL **/
           $sql = "select
                      * 
                   from
                      content c 
                   where
                      c.content_id = :content_id";

           /** Preparo o sql **/
           $stmt = $this->connection->connect()->prepare($sql);

           /** Preencho os parâmetros do sql **/
           $stmt->bindParam(':content_id', $this->content_id);

           /** Executo o sql **/
           $stmt->execute();

           /** Retorno um objeto **/
           return $stmt->fetchObject();
       }

       /** Procedimentos executado ao sair da classe **/
       public function __destruct()
       {

           /** Encerro a conexão com o banco de dados **/
           $this->connection = null;
       }
   }
