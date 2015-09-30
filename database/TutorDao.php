<?php

include('../lib/Conexao.php');


class TutorDao {
    private static $tabela = "sistutor.tutor";
    
    function read() {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		//criar join com pessoa
		$sql = "select * from ".self::$tabelaCurso;
		
		$result = pg_query($dbCon, $sql);
		
		$tarefas = Array();		
		while ($linha = pg_fetch_assoc($result)) {
			array_push($tarefas, $linha);
		}
		
		$conexao->closeConexao();
		
		return $tarefas;
    }
    
    function create($tutor) {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		//pessoas -> tutor
		$sql = "insert into pessoas values()";
		$params = array($tutor->getCpf(), $tutor->getNome(), );
		$result = pg_query_params($dbCon, $sql, $params);
		
		$tarefas = Array();		
		while ($linha = pg_fetch_assoc($result)) {
			array_push($tarefas, $linha);
		}
		
		$conexao->closeConexao();
		
		return $tarefas;
               
    }
    
    function delete($codigo) {
                //delete on cascade?
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
        
    function update($tutor) {
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
}
