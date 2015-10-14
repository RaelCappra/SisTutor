<?php

include_once('../lib/Conexao.php');
include_once('../model/Curso.php');
include_once('../database/PoloDao.php');



class CursoDao {
    private static $tabela = "sistutor.curso";
    
    function read() {
        $conexao = new Conexao();
        
        $tipoCurso = "sistutor.tipo_curso";
        
        $dbCon = $conexao->getConexao();
        
        $sql = "select id_curso,nome, polo, nome, $tipoCurso.id_tipo_curso, descricao from " . self::$tabela . 
                " join $tipoCurso on id_tipo_curso = tipo order by polo desc";

        $result = pg_query($dbCon, $sql);

        $cursos = Array();
        while ($linha = pg_fetch_assoc($result)) {
            $nome = $linha['nome'];
            $tipo = $tipo = Array("descricao"=>$linha['descricao'], "id"=>$linha["id_tipo_curso"]);
            $idPolo = $linha['polo'];
            $id = $linha['id_curso'];
            
            $polo = (new PoloDao())->getById($idPolo);
            
            $curso = new Curso();
            $curso->setId($id);
            $curso->setNome($nome);
            $curso->setPolo($polo);
            $curso->setTipo($tipo);
            

            array_push($cursos, $curso);
        }

        $conexao->closeConexao();

        return $cursos;
    }
    
    

    function getById($id) {
        $conexao = new Conexao();
        $tipoCurso = "sistutor.tipo_curso";
        
        $dbCon = $conexao->getConexao();
        $tabela = self::$tabela;
        $sql = "select id_curso,nome, polo, id_tipo_curso, descricao from " . self::$tabela . 
                " join $tipoCurso on id_tipo_curso = tipo" .
                " where id_curso=$1";

        $result = pg_query_params($dbCon, $sql, Array($id));
        $curso = 0;
        
        $linha = pg_fetch_assoc($result);
        if ($linha) {
            $curso = new Curso();
            
            $nome = $linha['nome'];
            $tipo = Array("descricao"=>$linha['descricao'], "id"=>$linha["id_tipo_curso"]);
            $idPolo = $linha['polo'];
            $id = $linha['id_curso'];
            
            $polo = (new PoloDao())->getById($idPolo);
            
            $curso->setId($id);
            $curso->setNome($nome);
            $curso->setPolo($polo);
            $curso->setTipo($tipo);
            
        }

        $conexao->closeConexao();

        return $curso;
    }

    function create($curso) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();
        $sql = "insert into sistutor.curso (nome, tipo, polo) values($1, $2, $3)";
        $params = array($curso->getNome(), $curso->getTipo()['id'], $curso->getPolo()->getId());
        pg_query_params($dbCon, $sql, $params);

        $conexao->closeConexao();
    }

    function delete($id) {
        //delete on cascade?
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "delete from " . self::$tabela . " where id_curso=$1";

        pg_query_params($dbCon, $sql, Array($id));
        $conexao->closeConexao();
    }

    function update($curso) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "update " . self::$tabela . " set nome=$1, tipo=$2, polo=$3 where id_curso=$4";
        
        $params = Array($curso->getNome(), $curso->getTipo()['id'], $curso->getPolo()->getId(), $curso->getId());
        pg_query_params($dbCon, $sql, $params);

        $conexao->closeConexao();
    }
    
    function getTipos(){
        $conexao = new Conexao();
		
        $dbCon = $conexao->getConexao();
        $sql = "select * from sistutor.tipo_curso";

        $result = pg_query($dbCon, $sql);

        $tarefas = Array();		
        while ($linha = pg_fetch_assoc($result)) {
                array_push($tarefas, $linha);
        }

        $conexao->closeConexao();

        return $tarefas;
    }
}
