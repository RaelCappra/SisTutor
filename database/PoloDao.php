<?php

include('../lib/Conexao.php');
include('../model/Polo.php');

class PoloDao {

    private static $tabela = "sistutor.polo";

    function read() {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();
        //criar join com pessoa
        $sql = "select * from " . self::$tabela;

        $result = pg_query($dbCon, $sql);

        $polos = Array();
        while ($linha = pg_fetch_assoc($result)) {
            $polo = new Polo();

            $cidade = $linha['cidade'];
            $nome = $linha['nome'];
            $estado = $linha['estado'];
            $id = $linha['id'];

            $polo->setCidade($cidade);
            $polo->setId($id);
            $polo->setEstado($estado);
            $polo->setNome($nome);

            array_push($polos, $polo);
        }

        $conexao->closeConexao();

        return $polos;
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

    function create($tutor) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();
        //pessoas -> tutor
        $sql = "insert into pessoas values()";
        $params = array($tutor->getCpf(), $tutor->getNome(),);
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

        $sql = "select * from " . self::$tabela . " where lixeira=false";

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

        $sql = "select * from " . self::$tabela . " where lixeira=false";

        $result = pg_query($dbCon, $sql);

        $tarefas = Array();
        while ($linha = pg_fetch_assoc($result)) {
            array_push($tarefas, $linha);
        }

        $conexao->closeConexao();

        return $tarefas;
    }

}
