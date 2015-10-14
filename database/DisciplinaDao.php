<?php

include('../lib/Conexao.php');
include('../model/Disciplina.php');
include('../database/CursoDao.php');

class DisciplinaDao {

    private static $tabela = "sistutor.disciplina";

    function read() {
        $conexao = new Conexao();
        $tabela = self::$tabela;
        $disciplina = "sistutor.curso";

        $dbCon = $conexao->getConexao();
        //criar join com curso
        $sql = "select $tabela.id_disciplina $tabela.nome, $tabela.curso from $tabela " .
                "join $disciplina on id_curso = curso";

        $result = pg_query($dbCon, $sql);

        $disciplinas = Array();
        while ($linha = pg_fetch_assoc($result)) {
            $nome = $linha['nome'];
            $idCurso = $linha['curso'];
            $id = $linha['id_disciplina'];

            $curso = (new CursoDao())->getById($idCurso);

            $disciplina = new Disciplina();
            $disciplina->setId($id);
            $disciplina->setNome($nome);
            $disciplina->setCurso($curso);


            array_push($disciplinas, $disciplina);
        }

        $conexao->closeConexao();

        return $disciplinas;
    }

    function getById($id) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();
        //criar join com pessoa
        $sql = "select * from " . self::$tabela . " where id_disciplina = $1";

        $result = pg_query_params($dbCon, $sql, Array($id));
        
        $disciplina = 0;
        
        $linha = pg_fetch_assoc($result);
        if($linha){
            $nome = $linha['nome'];
            $idCurso = $linha['curso'];

            $curso = (new CursoDao())->getById($idCurso);

            $disciplina->setId($id);
            $disciplina->setNome($nome);
            $disciplina->setCurso($curso);
        }
        
        $conexao->closeConexao();

        return $disciplina;
    }

    function create($disciplina) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();
        
        $sql = "insert into disciplina (nome, curso) values($1, $2)";
        $params = array($disciplina->getNome(), $disciplina->getCurso()->getId());
        pg_query_params($dbCon, $sql, $params);

        $conexao->closeConexao();
    }

    function delete($id) {
        //delete on cascade?
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "delete from " . self::$tabela . " where disciplina_id=$1";

        pg_query_params($dbCon, $sql, Array($id));
        $conexao->closeConexao();
    }

    function update($disciplina) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "update " . self::$tabela . " set nome=$1, curso=$2 where id_disciplina=$3";

        $params = Array($disciplina->getNome(), $disciplina->getCurso, $disciplina->getId());
        pg_query_params($dbCon, $sql, $params);

        $conexao->closeConexao();
    }

}
