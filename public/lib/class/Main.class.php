<?php
/**
* Classe Lista.class.php
* @filesource
* @autor		Kenio de Souza
* @copyright	Copyright 2016 Serenity Informatica
* @package		class
* @subpackage	class.class
* @version		1.0
* Total de campos para essa classe [8]*/

/** Configuração de acesso ao banco de dados */
require_once("lib/class/Host.php");

/** Classe de conexão ao banco de dados Mysql */
require_once("lib/class/Mysql.class.php");

class Main
{

	/** Cria o objeto de conexão com o banco de dados */
	private $obj;

	/** Construtor da classe */
	function __construct(){
		@ob_start();
		@session_start();	
	}

	/** Construtor da classe */
	function GuaranteedAccess()	
	{		
		  
		  /**Verifico se o usuario esta logado*/
		  if(((!isset($_SESSION['MYCMS-USERID'])) || ((int)$_SESSION['MYCMS-USERID'] == 0)) && ((!isset($_SESSION['MYCMS-ORGID'])) || ((int)$_SESSION['MYCMS-ORGID'] == 0))){
			  header("Location: access");
			  exit;
		  }		
	}
	
	/**Carrega XML*/
	function LoadXML($file)
	{
		  if($file)
		  {
			  //Recebo o xml para listagem dos dados
			  $dom = new domDocument();
			  @$dom->loadXML($file);
			  @$newxml = simplexml_import_dom($dom);	
			  
			  return $newxml;
		  }
		  
	}
	
	//COLOCA A MASCARA NO CNPF OU CNPJ
	function formatarCPF_CNPJ($campo){
	
			$tam = strlen($campo);
			
			if($tam == 11)//Verifico se é um CPF
			{
				$part1 = substr($campo, 0, 3);
				$part2 = substr($campo, 3, 3);
				$part3 = substr($campo, 6, 3);
				$part4 = substr($campo, 9, 2);
				
				$return = $part1.'.'.$part2.'.'.$part3.'-'.$part4;//Monto o cpf formatado
				
			}
			
			elseif($tam == 14)//Verifico se é um CNPJ
			{
				$part1 = substr($campo, 0, 2);
				$part2 = substr($campo, 2, 3);
				$part3 = substr($campo, 5, 3);
				$part4 = substr($campo, 8, 4);
				$part5 = substr($campo, 12, 2);
				
				$return = $part1.'.'.$part2.'.'.$part3.'/'.$part4.'-'.$part5;//Monto o cpf formatado			
			}
			
			else
			{
				$return = $campo;
			}	
			
			return $return;		
	 
	}	

	/**Carrega Classe*/
	function LoadClass($class)
	{
		/***Instância da classe*/
		include_once($class.".class.php");
		$return = new $class();		
		
		return $return;
	}
	
	/**Trata valor para gravar no banco*/
	function MoeadDB($value)
	{
		$v = str_replace(".", "", $value);
		$v = str_replace(",", ".", $v);
		
		return $v;
		
	}
	
	/**Trata data no banco*/
	function DataDB($value)
	{
		$d = explode("/", $value);
		$date = $d[2].'-'.$d[1].'-'.$d[0];
		
		return $date;
		
	}	
		
	//ANTIINJECTION
	function anti_injection($str, $long='')
	{
			//Check
			if((!is_array($str)) && $long != 'S'){	
				
				$badchar[1]  = " drop ";
				$badchar[2]  = " select ";
				$badchar[3]  = " delete ";
				$badchar[4]  = " update ";
				$badchar[5]  = " insert ";
				$badchar[6]  = " alter ";
				$badchar[7]  = " destroy ";
				$badchar[8]  = ' * ';
				$badchar[9]  = " database ";
				$badchar[10] = " drop "; 
				$badchar[11] = " union "; 
				$badchar[12] = " TABLE_NAME "; 
				$badchar[13] = " 1=1 "; 
				$badchar[14] = ' or 1 '; 
				$badchar[15] = ' exec '; 
				$badchar[16] = ' INFORMATION_SCHEMA '; 
				$badchar[17] = ' TABLE_NAME '; 
				$badchar[18] = ' like '; 
				$badchar[19] = ' COLUMNS '; 
				$badchar[20] = ' into '; 
				$badchar[21] = ' VALUES ';
				$badchar[22] = ' from '; 
				$badchar[23] = ' From ';
				$badchar[24] = ' undefined ';
				
				$y = 1; 
				$x = sizeof($badchar); 
				while ($y <= $x) 
				{ 
					 $pos = strpos(strtolower($str), strtolower($badchar[$y])); 
					 if ($pos !== false) 
					 { 
						$str = str_replace(strtolower($badchar[$y]), "", strtolower($str)); 
					 } 
					
					$y++; 
				 } 
				
				$str = trim($str);//limpa espaços vazio	
				$str = strip_tags($str);//tira tags html e php
				$str = addslashes($str);//Adiciona barras invertidas a uma string
				$str = htmlspecialchars($str);//Evita ataques XSS
				
				return utf8_decode($str);
										
			
			}elseif((!is_array($str)) && $long == 'S'){	
				return utf8_decode(addslashes($str));			
			}else{
				return $str;	
			}
	}		
	
		
	//Zeros a esquerda
	function SetZeros($valor, $qtde)
	{
	  $result = $valor;
	  $tamanho = strlen($valor);
	  $valor = "";
	  for ($i=0; $i < $qtde-$tamanho;$i++)
	  {
		$valor = "0" . $valor;
	  }
	  $result = $valor . $result;
	  return $result;
	}		

	/** Fecha uma conexão aberta anteriormente com o banco de dados */
	function __destruct()
	{
		
    }
}
?>