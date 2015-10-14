<?php

include_once('../lib/Conexao.php');

class GestorDao {

    private static $tabela = "sistutor.gestor";

    public function autentica($login, $senha) {
        $conexao = new Conexao();
        $tabelaLogin = "sistutor.login";

        $dbCon = $conexao->getConexao();

        $sql = "select * from " . self::$tabela .
                " join $tabelaLogin on $tabelaLogin.id_login = "
                . "gestor.login "
                . "where $tabelaLogin.login = $1 and "
                . "$tabelaLogin.senha = $2";

        $result = pg_query_params($dbCon, $sql, Array($login, $senha));

        if (pg_fetch_assoc($result)) {
            $conexao->closeConexao();
            return true;
        } else {
            $conexao->closeConexao();
            return false;
        }
    }

}
