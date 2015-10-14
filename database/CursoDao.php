<?php

include('../lib/Conexao.php');
include('../model/Curso.php');
include('../database/PoloDao.php');



class CursoDao {
    private static $tabela = "sistutor.curso";
    
    function read() {
        $conexao = new Conexao();
        
        $tipoCurso = "sistutor.tipo_curso";
        
        $dbCon = $conexao->getConexao();
        
        $sql = "select nome, polo, nome, $tipoCurso.id_tipo_curso, descricao from " . self::$tabela . 
                " join $tipoCurso on id_tipo_curso = tipo";

        $result = pg_query($dbCon, $sql);

        $cursos = Array();
        while ($linha = pg_fetch_assoc($result)) {
            $nome = $linha['nome'];
            $tipo = $tipo = Array("descricao"=>$linha['descricao'], "id"=>$linha["id_tipo_curso"]);
            $idPolo = $linha['polo'];
            $id = $linha['id'];
            
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
        $sql = "select nome, polo, id_tipo_curso, descricao from " . self::$tabela . 
                " join $tipoCurso on id_tipo_curso = tipo" .
                " where id_curso=$1";

        $result = pg_query($dbCon, $sql);
        $curso = 0;
        
        $linha = pg_fetch_assoc($result);
        if ($linha) {
            $curso = new Curso();
            
            $nome = $linha['nome'];
            $tipo = Array("descricao"=>$linha['descricao'], "id"=>$linha["id_tipo_curso"]);
            $idPolo = $linha['polo'];
            $id = $linha['id'];
            
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
        $sql = "insert into (nome, cidade, uf) values($1, $2, $3)";
        $params = array($polo->getNome(), $polo->getCidade(), $polo->getEstado());
        pg_query_params($dbCon, $sql, $params);

        $conexao->closeConexao();
    }

    function delete($id) {
        //delete on cascade?
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "delete from " . self::$tabela . " where curso_id=$1";

        pg_query_params($dbCon, $sql, Array($id));
        $conexao->closeConexao();
    }

    function update($curso) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "update " . self::$tabela . " set nome=$1, tipo=$2, uf=$3 where id_polo=$4";
        
        $params = Array($polo->getNome(), $polo->getCidade(), $polo->getEstado(), $polo->getId(),);
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
