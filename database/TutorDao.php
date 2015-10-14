<?php

include_once('../lib/Conexao.php');
include_once('../model/Tutor.php');
include_once('../model/Pessoa.php');

class TutorDao {

    private static $tabela = "sistutor.tutor";

    private static function makeTutor($linha) {
        $nome = $linha['nome'];
        $pessoaId = $linha['id_pessoa'];
        $sobrenome = $linha['sobrenome'];
        $cpf = $linha['cpf'];
        $email = $linha['email'];

        $formacaoId = $linha['id_formacao'];
        $formacaoDescricao = $linha['d_formacao'];

        $formacao = Array("descricao" => $formacaoDescricao, "id" => $formacaoId);


        $titulacaoId = $linha['id_titulacao'];
        $titulacaoDescricao = $linha['d_titulacao'];
        $titulacao = Array("descricao" => $titulacaoDescricao, "id" => $titulacaoId);

        $tutorId = $linha['id_tutor'];

        $tutor = new Tutor();

        $tutor->setCpf($cpf);
        $tutor->setEmail($email);
        $tutor->setFormacao($formacao);
        $tutor->setId($pessoaId);
        $tutor->setSobrenome($sobrenome);
        $tutor->setNome($nome);
        $tutor->setTitulacao($titulacao);
        $tutor->setTutorId($tutorId);

        return $tutor;
    }

    function read() {
        $tabela = self::$tabela;
        $pessoa = "sistutor.pessoa";
        $formacao = "sistutor.formacao";
        $titulacao = "sistutor.titulacao";
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "select id_tutor, $pessoa.id_pessoa, $pessoa.nome, $pessoa.sobrenome, $pessoa.cpf, $pessoa.email," .
                " $formacao.id_formacao, $formacao.descricao as d_formacao, $titulacao.id_titulacao, $titulacao.descricao as d_titulacao" .
                " from $tabela join $pessoa on $pessoa.id_pessoa = $tabela.pessoa" .
                " join $formacao on $formacao.id_formacao = $tabela.formacao" .
                " join $titulacao on $titulacao.id_titulacao = $tabela.titulacao";

        /* echo $sql;
          die();
         */
        $result = pg_query($dbCon, $sql);

        $tutores = Array();
        while ($linha = pg_fetch_assoc($result)) {
            $tutor = self::makeTutor($linha);
            array_push($tutores, $tutor);
        }

        $conexao->closeConexao();

        return $tutores;
    }

    function getById($id) {
        $tabela = self::$tabela;
        $pessoa = "sistutor.pessoa";
        $formacao = "sistutor.formacao";
        $titulacao = "sistutor.titulacao";
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "select id_tutor, $pessoa.id_pessoa, $pessoa.nome, $pessoa.sobrenome, $pessoa.cpf, $pessoa.email," .
                " $formacao.id_formacao, $formacao.descricao as d_formacao, $titulacao.id_titulacao, $titulacao.descricao as d_titulacao" .
                " from $tabela join $pessoa on $pessoa.id_pessoa = $tabela.pessoa" .
                " join $formacao on $formacao.id_formacao = $tabela.formacao" .
                " join $titulacao on $titulacao.id_titulacao = $tabela.titulacao" .
                " where id_tutor = $id";


        $result = pg_query($dbCon, $sql);

        $tutor;
        if ($linha = pg_fetch_assoc($result)) {
            $tutor = self::makeTutor($linha);
        }

        $conexao->closeConexao();

        return $tutor;
    }

    function create($tutor) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();
        $sqlPessoa = "insert into sistutor.pessoa(cpf, nome, sobrenome, email) values($1,$2,$3,$4) returning id_pessoa;";
        $paramsPessoa = array($tutor->getCpf(), $tutor->getNome(), $tutor->getSobrenome(), $tutor->getEmail());
        $result = pg_query_params($dbCon, $sqlPessoa, $paramsPessoa);
        $id = 0;

        if ($linha = pg_fetch_assoc($result)) {
            $id = $linha['id_pessoa'];
        }

        $sqlTutor = "insert into sistutor.tutor (pessoa, formacao, titulacao) values($1,$2,$3)";
        $paramsTutor = array($id, $tutor->getFormacao()['id'], $tutor->getTitulacao()['id']);
        pg_query_params($dbCon, $sqlTutor, $paramsTutor);

        $conexao->closeConexao();
    }

    function delete($id) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "delete from " . self::$tabela . " where id_tutor=" . $id;

        $result = pg_query($dbCon, $sql);

        $tarefas = Array();
        while ($linha = pg_fetch_assoc($result)) {
            array_push($tarefas, $linha);
        }

        $conexao->closeConexao();

        return $tarefas;
    }

    function updateTutor($tutor) {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "update " . self::$tabela . " set pessoa=$1, formacao=$2, titulacao=$3 where id_tutor=$4";

        $params = Array($tutor->getId(), $tutor->getFormacoes()['id'],
            $tutor->getTitulacoes()['id'], $tutor->getTutorId());

        pg_query_params($dbCon, $sql, $params);

        $conexao->closeConexao();
    }

    function updatePessoa($pessoa) {
        $tabela = "sistutor.pessoa";
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();

        $sql = "update $tabela set nome=$1, sobrenome=$2, cpf=$3, email=$4 where id_pessoa=$5";

        $params = Array($pessoa->getNome(), $pessoa->getSobrenome(), $pessoa->getCpf->getId(),
            $pessoa->getEmail(), $pessoa->getId());
        pg_query_params($dbCon, $sql, $params);

        $conexao->closeConexao();
    }

    function getTitulacoes() {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();
        $sql = "select *, id_titulacao as id from sistutor.titulacao";

        $result = pg_query($dbCon, $sql);

        $tarefas = Array();
        while ($linha = pg_fetch_assoc($result)) {
            array_push($tarefas, $linha);
        }

        $conexao->closeConexao();

        return $tarefas;
    }

    function getFormacoes() {
        $conexao = new Conexao();

        $dbCon = $conexao->getConexao();
        $sql = "select *, id_formacao as id from sistutor.formacao";

        $result = pg_query($dbCon, $sql);

        $formacoes = Array();
        while ($linha = pg_fetch_assoc($result)) {
            array_push($formacoes, $linha);
        }

        $conexao->closeConexao();

        return $formacoes;
    }

}
