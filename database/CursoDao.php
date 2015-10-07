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
        //criar join com pessoa
        $sql = "select nome, polo, descricao from " . self::$tabela . 
                " join $tipoCurso on id_tipo_curso = tipo";

        $result = pg_query($dbCon, $sql);

        $cursos = Array();
        while ($linha = pg_fetch_assoc($result)) {
            $nome = $linha['nome'];
            $tipo = $linha['descricao'];
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

        $dbCon = $conexao->getConexao();
        //criar join com pessoa
        $sql = "select * from " . self::$tabela . " where id_polo = $1";

        $result = pg_query_params($dbCon, $sql, Array($id));
        $linha = pg_fetch_assoc($result);
        
        $polo = new Polo();

        $cidade = $linha['cidade'];
        $nome = $linha['nome'];
        $estado = $linha['estado'];

        $polo->setCidade($cidade);
        $polo->setId($id);
        $polo->setEstado($estado);
        $polo->setNome($nome);

        $conexao->closeConexao();

        return $polo;
    }

    function create($polo) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();
        //pessoas -> tutor
        $sql = "insert into polo (nome, cidade, uf) values($1, $2, $3)";
        $params = array($polo->getNome(), $polo->getCidade(), $polo->getEstado());
        pg_query_params($dbCon, $sql, $params);

        $conexao->closeConexao();
    }

    function delete($id) {
        //delete on cascade?
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "delete from " . self::$tabela . " where polo_id=$1";

        pg_query_params($dbCon, $sql, Array($id));
        $conexao->closeConexao();
    }

    function update($polo) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "update " . self::$tabela . " set nome=$1, cidade=$2, uf=$3 where id_polo=$4";
        
        $params = Array($polo->getNome(), $polo->getCidade(), $polo->getEstado(), $polo->getId(),);
        pg_query_params($dbCon, $sql, $params);

        $conexao->closeConexao();
    }
}
