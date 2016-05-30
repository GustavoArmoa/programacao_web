<?php

namespace CRUD\model;

class PojoIdioma
{
    private $idioma_id;
    private $nome;
    private $ultima_atualizacao;

    /**
     * @return mixed
     */
    public function getIdiomaId()
    {
        return $this->idioma_id;
    }

    /**
     * @param mixed $idioma_id
     */
    public function setIdiomaId($idioma_id)
    {
        if(!is_numeric($idioma_id) && !is_null($idioma_id))
            throw new \Exception("O campo idioma_id precisa ser numerico.");
        $this->idioma_id = $idioma_id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getUltimaAtualizacao()
    {
        return $this->ultima_atualizacao;
    }

    /**
     * @param mixed $ultima_atualizacao
     */
    public function setUltimaAtualizacao($ultima_atualizacao)
    {
        $this->ultima_atualizacao = $ultima_atualizacao;
    }

}