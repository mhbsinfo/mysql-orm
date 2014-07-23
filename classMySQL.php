<?php

$SERVIDOR				="";
$BANCO					="";
$USUARIO				="";
$SENHA					="";
$erro = "1 - No foi possvel conectar ao Banco de Dados:";
$erro2 = "2 - No foi possvel selecionar o Banco de Dados:";
$link 	=	@mysql_connect($SERVIDOR, $USUARIO, $SENHA) or die ($erro . mysql_error());
$con	=	@mysql_select_db ($BANCO) or die ($erro2 . mysql_error());
mysql_query("SET NAMES 'utf8'"); 
mysql_query('SET character_set_connection=utf8'); 
mysql_query('SET character_set_client=utf8'); 
mysql_query('SET character_set_results=utf8');  

class MySQL {
			function __construct(){
				$this->like=(object) array();
				$this->InsertVars=array();
				$this->Insert_Update=array();
				$this->fetch_array=array();
				$this->rell='';
				$this->DISTINCT='';
			}
			public function select()  {
			$this->selectquery='SELECT ';
			if(!empty($this->DISTINCT))	{$this->selectquery .= $this->DISTINCT;}
			if(!empty($this->colum))	{$this->selectquery .= $this->colum;}else{$this->selectquery .=' * ';} 	$this->selectquery .= ' FROM ';
			if(!empty($this->table))	{$this->selectquery .= $this->table;}
			if(!empty($this->rell) && !empty($this->rell)){ $this->selectquery .= $this->rell.'  ';}
			if(!empty($this->where) &&  (empty($this->like->coluna) || empty($this->like->palavra)))	{$this->selectquery .= ' WHERE ('.$this->where.')';}
			if(!empty($this->like->coluna) && !empty($this->like->palavra) )		{$this->selectquery .= ' WHERE ('.$this->like->coluna.' LIKE "%'.$this->like->palavra.'%")';}
			if(!empty($this->group))	{$this->selectquery .= ' GROUP BY '.$this->group.' ';}
			if(!empty($this->order))	{$this->selectquery .= ' ORDER BY '.$this->order.' ';}
			if(!empty($this->limit))	{$this->selectquery .= ' LIMIT '.$this->limit.' ';}
			$consulta = mysql_query($this->selectquery)or die (_erro(mysql_error()));
			$this->_num_rows= mysql_num_rows($consulta);
			if($this->_num_rows>0){while($row = mysql_fetch_array($consulta)) {$this->fetch_array[]= $row;}}else{$this->fetch_array=array();}
			$this->output = $this->selectquery;}	
			public function insert(){
			$this->InsertQuery='INSERT INTO ';
			if(!empty($this->table))	{$this->InsertQuery .= $this->table;}else{exit;}
			if(count($this->InsertVars)>0){$this->InsertQuery .= ' ( '.implode(',',array_keys($this->InsertVars)).' ) ';}else{exit;};
			$this->InsertQuery .= ' VALUES ';
			if(count($this->InsertVars)>0){$this->InsertQuery .= ' ( "'.implode('","',array_values($this->InsertVars)).'" ) ';}else{exit;};
			if(!empty($this->where))	{$this->InsertQuery .= ' WHERE ('.$this->where.')';}
			if(mysql_query($this->InsertQuery)or die(_erro(mysql_error()))){return true;};}
			public function salvar() {$this->UpdateQuery='UPDATE ';
			if(!empty($this->table))	{$this->UpdateQuery .= $this->table;}else{exit;}
			$this->UpdateQuery .= ' SET ';
			if(count($this->Insert_Update)>0){$this->UpdateQuery .= implode(',',$this->Insert_Update);}else{exit;};
			if(!empty($this->where))	{$this->UpdateQuery .= ' WHERE ('.$this->where.')';}
			if(mysql_query($this->UpdateQuery)){return true;}}
			
			public function exclui(){$this->DeleteQuery='DELETE FROM ';
			if(!empty($this->table))	{$this->DeleteQuery .= $this->table;}else{exit;}
			if(!empty($this->where))	{$this->DeleteQuery .= ' WHERE ('.$this->where.')';}else{exit;}
			if(mysql_query($this->DeleteQuery) or die(_erro(mysql_error()))){return true;};
			$this->content = mysql_affected_rows();}
			public function set_insert($colum,$var){$this->InsertVars[$colum]=$var;}
			public function set_update($colum,$var){array_push ($this->Insert_Update , $colum.'="'.$var.'"' );}
			public function inner_join($tabela,$where){ $this->rell .='  INNER JOIN '.$tabela.'   ON '.$where.' ';}
			public function distinct() {$this->DISTINCT=' DISTINCT ';}}
/*
//--------------------------------------------------select
$s 					= new MySQL();
$s->colum			='id, nome, token';
$s->table			='usuarios';
$s->where			='id="israel"';
$s->like->coluna	='nome';
$s->like->palavra	='isra';
$s->order			='id ASC';
$s->limit			='5';
$s->select();
print_r($s->fetch_array);
//--------------------------------------------------INSERT
$I 					= new MySQL();
$I->table			='usuarios';
$I->set_insert('nome','TESTE DE CLASSE');
$I->insert();
//--------------------------------------------------UPDATE
$U					= new MySQL();
$U->where			='id="50"';
$U->table			='usuarios';
$U->set_update('nome','Altair dias');
$U->salvar();
//--------------------------------------------------INNER JOIN 
$user					= new MySQL();
$user->table			='usuarios';
$user->colum			='usuarios.id, usuarios.avatar, usuarios.nome';
$user->rel->table		='grupos_link';
$user->rel->on			='grupos_link.id_user=usuarios.id';
$user->select();
//--------------------------------------------------DELETE
$D					= new MySQL();
$D->where			='id="50"';
$D->table			='usuarios';
$D->exclui();
*/


?>
