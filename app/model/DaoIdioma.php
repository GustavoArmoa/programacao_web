<?php

namespace CRUD\model;

use PDO;

class DaoIdioma extends Model
{

    public function readAll(){
        try{

            $sql   = "SELECT * FROM idioma";
            $p_sql = Model::getPDO()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_ASSOC);

        } catch (\Exception $e){
            throw new \Exception("Ocorreu um erro ao buscar a lista de idiomas!");
        }
    }

    public function quantidadeIdiomas(){
        try{
            $sql   = "SELECT COUNT(*) as quant FROM idioma";
            $p_sql = Model::getPDO()->prepare($sql);
            $p_sql->execute();
            $dados = $p_sql->fetch(PDO::FETCH_ASSOC);

            if(!$dados)
                throw new \Exception($p_sql->errorInfo());

            return $dados['quant'];

        } catch (\Exception $e){
            throw new \Exception("Ocorreu um erro ao contar a lista de idiomas!");
        }
    }
}