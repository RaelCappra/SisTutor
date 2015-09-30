<?php
include('../lib/Conexao.php');


class TarefaDao {
	private static $tabelaCurso = "tarefa";
	
	function listaTarefas() {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		
		$sql = "select * from ".self::$tabelaCurso. " where lixeira=false";
		
		$result = pg_query($dbCon, $sql);
		
		$tarefas = Array();		
		while ($linha = pg_fetch_assoc($result)) {
			array_push($tarefas, $linha);
		}
		
		$conexao->closeConexao();
		
		return $tarefas;
	}

        function listaLixeira() {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		
		$sql = "select * from ".self::$tabelaCurso. " where lixeira=true";
		
		$result = pg_query($dbCon, $sql);
		
		$tarefas = Array();		
		while ($linha = pg_fetch_assoc($result)) {
			array_push($tarefas, $linha);
		}
		
		$conexao->closeConexao();
		
		return $tarefas;
	}
        
        function listaTarefasEmOrdem() {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		
		$sql = "select * from ".self::$tabelaCurso." where lixeira=false order by data_hora asc";
               
		
		$result = pg_query($dbCon, $sql);
		
		$tarefas = Array();		
		while ($linha = pg_fetch_assoc($result)) {
			array_push($tarefas, $linha);
		}
		
		$conexao->closeConexao();
		
		return $tarefas;
	}
        
        function listaTarefasEmCriacao() {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		
		$sql = "select * from ".self::$tabelaCurso." where lixeira=false order by data_criacao asc";
               
		
		$result = pg_query($dbCon, $sql);
		
		$tarefas = Array();		
		while ($linha = pg_fetch_assoc($result)) {
			array_push($tarefas, $linha);
		}
		
		$conexao->closeConexao();
		
		return $tarefas;
	}
        
        function listaTarefaPorId($id) {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		
		$sql = "select * from ".self::$tabelaCurso." where id = ".$id;
		
		$result = pg_query($dbCon, $sql);
		
		$tarefas = Array();		
		while ($linha = pg_fetch_assoc($result)) {
			array_push($tarefas, $linha);
		}
		
		$conexao->closeConexao();
		
		return $tarefas;
	}
        
        function deleta() {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		
		$sql = "delete from ".self::$tabelaCurso." where lixeira = true";
		
		pg_query($dbCon, $sql);

		$conexao->closeConexao();
		
		
	}
        
        function moveLixeira($id) {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		
		 $sql = "UPDATE tarefa
                               SET lixeira=true WHERE id = ".$id;
		pg_query($dbCon, $sql);

		$conexao->closeConexao();
		
		
	}
        
        function restaurar($id) {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		
		 $sql = "UPDATE tarefa
                               SET lixeira=false WHERE id = ".$id;
		pg_query($dbCon, $sql);

		$conexao->closeConexao();
		
		
	}
        
        function edita($tarefa) {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		if($tarefa->getDataHora() != ""){
                    $sql = "UPDATE tarefa
                               SET nome='".$tarefa->getNome()."', descricao='".$tarefa->getDescricao()."', data_hora='".$tarefa->getDataHora()."',
                               cor='".$tarefa->getCor()."' WHERE id = ".$tarefa->getId();
                }else{
                    $sql = "UPDATE tarefa
                               SET nome='".$tarefa->getNome()."', descricao='".$tarefa->getDescricao()."', data_hora=null,
                            cor='".$tarefa->getCor()."' WHERE id = ".$tarefa->getId();
                }
                
           
		pg_query($dbCon, $sql);
		$conexao->closeConexao();
	}
        
        function insere($tarefa) {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		if($tarefa->getDataHora() != ""){
                    $sql = "insert into tarefa(nome,descricao,data_hora, cor, imagem) values('".$tarefa->getNome()."','".$tarefa->getDescricao()."','".$tarefa->getDataHora()."','".$tarefa->getCor()."','".$tarefa->getImagem()."') ";
                }else{
                    $sql = "insert into tarefa(nome,descricao, cor, imagem) values('".$tarefa->getNome()."','".$tarefa->getDescricao()."','".$tarefa->getCor()."','".$tarefa->getImagem()."') ";
                    
                    
                }
                
                
		
                
		pg_query($dbCon, $sql);
	
		$conexao->closeConexao();

	}

	
}