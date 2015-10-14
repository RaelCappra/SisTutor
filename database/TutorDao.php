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
		$sqlPessoa = "insert into sistutor.pessoa(cpf, nome, sobrenome, email) values($1,$2,$3,$4) returning id_pessoa;";
		$paramsPessoa = array($tutor->getCpf(), $tutor->getNome(), $tutor->getSobrenome(), $tutor->getEmail());
		$result = pg_query_params($dbCon, $sqlPessoa, $paramsPessoa);
                $id;
		foreach ($result as $r){
                    $id = $r['id_pessoa'];
                }
                
		$sqlTutor = "insert into sistutor.tutor (pessoa, formacao, titulacao) values($1,$2,$3)";
                $paramsTutor = array($id, $tutor->getFormacao(), $tutor->getTitulacao());
                pg_query_params($dbCon, $sqlTutor, $paramsTutor);
                
		$conexao->closeConexao();

    }
    
    function delete($id) {
		$conexao = new Conexao();
		
		$dbCon = $conexao->getConexao();
		
		$sql = "select * from ".self::$tabelaCurso. " where id_tutor=".$id;
		
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
