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

   class General
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
           $sql = "select count(*) as qtde from general ";

           /** Executo o comando SQL */
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return (int)$this->obj->query_fetch_object()->qtde;

       }

       /** Listo a quantidade total de registros **/
       public function Get($general_id)
       {

           /** Parâmetro de entrada **/
           $this->general_id = (int)$general_id;

           /** Consulta SQL **/
           $sql = "select * from general where general_id = {$this->general_id}";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

           /** Retorno em forma de objeto uma consulta SQL **/
           return $this->obj->query_fetch_object();

       }

       /** Lista todos os registros **/
       public function All()
       {

           /** Consulta SQL **/
           $sql = "select * from general";

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Insere/autualiza um registro no banco de dados **/
       public function Save($general_id, $user_id, $title, $description, $keywords, $copyright, $author, $url, $email, $smtp, $port, $password, $domain, $charsert, $username, $session, $number_register, $cnpj, $endereco, $telefone, $celular, $facebook, $instagram, $pinterest, $twitter, $date_register, $date_update)
       {

           /** Parâmetros de entrada **/
           $this->general_id = (int)$general_id;
           $this->user_id = (int)$user_id;
           $this->title = (string)$title;
           $this->description = (string)$description;
           $this->keywords = (string)$keywords;
           $this->copyright = (string)$copyright;
           $this->author = (string)$author;
           $this->url = (string)$url;
           $this->email = (string)$email;
           $this->smtp = (string)$smtp;
           $this->port = (string)$port;
           $this->password = (string)$password;
           $this->domain = (string)$domain;
           $this->charsert = (string)$charsert;
           $this->username = (string)$username;
           $this->session = (string)$session;
           $this->number_register = (int)$number_register;
           $this->cnpj = (string)$cnpj;
           $this->endereco = (string)$endereco;
           $this->telefone = (string)$telefone;
           $this->celular = (string)$celular;
           $this->facebook = (string)$facebook;
           $this->instagram = (string)$instagram;
           $this->pinterest = (string)$pinterest;
           $this->twitter = (string)$twitter;
           $this->date_register = (string)$date_register;
           $this->date_update = (string)$date_update;

           /** Verifico se é inserção ou atualização **/
           if($this->general_id == 0)
           {

               /** Consulta SQL **/
               $sql = "INSERT INTO general(general_id, user_id, title, description, keywords, copyright, author, url, email, smtp, port, password, domain, charsert, username, session, number_register, cnpj, endereco, telefone, celular, facebook, instagram, pinterest, twitter, date_register, date_update)VALUES('{$this->general_id}', '{$this->user_id}', '{$this->title}', '{$this->description}', '{$this->keywords}', '{$this->copyright}', '{$this->author}', '{$this->url}', '{$this->email}', '{$this->smtp}', '{$this->port}', '{$this->password}', '{$this->domain}', '{$this->charsert}', '{$this->username}', '{$this->session}', '{$this->number_register}', '{$this->cnpj}', '{$this->endereco}', '{$this->telefone}', '{$this->celular}', '{$this->facebook}', '{$this->instagram}', '{$this->pinterest}', '{$this->twitter}', '{$this->date_register}', '{$this->date_update}')";

           }else
           {

               /** Consulta SQL **/
               $sql = "UPDATE general set general_id = '{$this->general_id}', user_id = '{$this->user_id}', title = '{$this->title}', description = '{$this->description}', keywords = '{$this->keywords}', copyright = '{$this->copyright}', author = '{$this->author}', url = '{$this->url}', email = '{$this->email}', smtp = '{$this->smtp}', port = '{$this->port}', password = '{$this->password}', domain = '{$this->domain}', charsert = '{$this->charsert}', username = '{$this->username}', session = '{$this->session}', number_register = '{$this->number_register}', cnpj = '{$this->cnpj}', endereco = '{$this->endereco}', telefone = '{$this->telefone}', celular = '{$this->celular}', facebook = '{$this->facebook}', instagram = '{$this->instagram}', pinterest = '{$this->pinterest}', twitter = '{$this->twitter}', date_register = '{$this->date_register}', date_update = '{$this->date_update}' WHERE general_id = {$this->general_id}";

           }

           /** Executo o comando SQL **/
           $this->obj->ExecuteQuery($sql);

       }

       /** Excluo um registro específico **/
       public function Delete($general_id)
       {

           /** Parâmetro de entrada **/
           $this->general_id = (int)$general_id;

           /** Consulta SQL **/
           $sql = "DELETE FROM general WHERE general_id = {$this->general_id}";

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
