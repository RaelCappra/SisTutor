<?php

include_once('../lib/Conexao.php');
include_once('../model/Disciplina.php');
include_once('../database/CursoDao.php');

class DisciplinaDao {

    private static $tabela = "sistutor.disciplina";

    function read() {
        $conexao = new Conexao();
        $tabela = self::$tabela;
        $disciplina = "sistutor.curso";

        $dbCon = $conexao->getConexao();
        //criar join com curso
        $sql = "select $tabela.id_disciplina, $tabela.nome, $tabela.curso from $tabela " .
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
        if ($linha) {
            $nome = $linha['nome'];
            $idCurso = $linha['curso'];

            $curso = (new CursoDao())->getById($idCurso);
            $disciplina = new Disciplina();
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

        $sql = "insert into sistutor.disciplina (nome, curso) values($1, $2) returning id_disciplina as id";
        $params = array($disciplina->getNome(), $disciplina->getCurso()->getId());
        $result = pg_query_params($dbCon, $sql, $params);
        if($linha = pg_fetch_assoc($result)){
            return $linha['id'];
        }
        return 0;
        $conexao->closeConexao();
    }

    function delete($id) {
        //delete on cascade?
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "delete from " . self::$tabela . " where id_disciplina=$1";

        pg_query_params($dbCon, $sql, Array($id));
        $conexao->closeConexao();
    }

    function update($disciplina) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "update " . self::$tabela . " set nome=$1, curso=$2 where id_disciplina=$3";

        $params = Array($disciplina->getNome(), $disciplina->getCurso()->getId(), $disciplina->getId());
        pg_query_params($dbCon, $sql, $params);

        $conexao->closeConexao();
    }

    function listByTutor($tutor) {
        $conexao = new Conexao();

        $tutor_disciplina = "sistutor.tutor_disciplina";
        $dbCon = $conexao->getConexao();
        //criar join com curso
        $sql = "select id_disciplina as disciplina from $tutor_disciplina where id_tutor=$1";

        $result = pg_query_params($dbCon, $sql, Array($tutor->getTutorId()));

        $disciplinas = Array();
        while ($linha = pg_fetch_assoc($result)) {
            $id = $linha['disciplina'];
            $disciplina = $this->getById($id);
            array_push($disciplinas, $disciplina);
        }

        $conexao->closeConexao();

        return $disciplinas;
    }

    function listDisciplinasTutoresByCurso($curso) {
        $tDisciplina = self::$tabela;
        $tTutor = "sistutor.tutor";
        $tPessoa = "sistutor.pessoa";
        $tutorDisisciplina = "sistutor.tutor_disciplina";
        
        $sql = "select $tDisciplina.nome as d_nome, $tPessoa.nome as p_nome, $tPessoa.sobrenome from $tutorDisisciplina" . 
                " join $tTutor on $tutorDisisciplina.id_tutor = $tTutor.id_tutor" .
                " join $tPessoa on $tPessoa.id_pessoa = $tTutor.pessoa" .
                " join $tDisciplina on $tDisciplina.id_disciplina = $tutorDisisciplina.id_disciplina" .
                " where $tDisciplina.curso = $1" .
                " order by disciplina";
        
        $conexao = new Conexao();
        $dbCon = $conexao->getConexao();
        $result = pg_query_params($dbCon, $sql, array($curso->getId()));
        
        return pg_fetch_all($result);
    }
}
