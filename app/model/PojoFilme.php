<?php

namespace CRUD\model;

class PojoFilme
{
    private $filme_id;
    private $titulo;
    private $descricao;
    private $ano_de_lancamento;
    private $idioma;
    private $idioma_original;
    private $duracao_da_locacao;
    private $preco_da_locacao;
    private $duracao_do_filme;
    private $custo_de_substituicao;
    private $classificacao;
    private $recursos_especiais;
    private $ultima_atualizacao;
    private $listaClassificacoes = ['G', 'PG', 'PG-13', 'R', 'NC-17'];
    private $listaRecursosEspeciais = ['Trailers', 'Commentaries', 'Deleted Scenes', 'Behind the Scenes'];

    /**
     * @return mixed
     */
    public function getFilmeId()
    {
        return $this->filme_id;
    }

    /**
     * @param mixed $filme_id
     */
    public function setFilmeId($filme_id)
    {
        if(!is_numeric($filme_id))
            throw new \Exception("O campo filme_id precisa ser numerico.");
        $this->filme_id = $filme_id;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getAnoDeLancamento()
    {
        return $this->ano_de_lancamento;
    }

    /**
     * @param mixed $ano_de_lancamento
     */
    public function setAnoDeLancamento($ano_de_lancamento)
    {
        if(!is_numeric($ano_de_lancamento) && !is_null($ano_de_lancamento))
            throw new \Exception("O campo ano_de_lancamento precisa ser numerico.");
        $this->ano_de_lancamento = $ano_de_lancamento;
    }

    /**
     * @return mixed
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * @param mixed $idioma
     */
    public function setIdioma(PojoIdioma $idioma)
    {
        $this->idioma = $idioma;
    }

    /**
     * @return mixed
     */
    public function getIdiomaOriginal()
    {
        return $this->idioma_original;
    }

    /**
     * @param mixed $idioma_original
     */
    public function setIdiomaOriginal(PojoIdioma $idioma_original)
    {
        $this->idioma_original = $idioma_original;
    }

    /**
     * @return mixed
     */
    public function getDuracaoDaLocacao()
    {
        return $this->duracao_da_locacao;
    }

    /**
     * @param mixed $duracao_da_locacao
     */
    public function setDuracaoDaLocacao($duracao_da_locacao)
    {
        if(!is_numeric($duracao_da_locacao))
            throw new \Exception("O campo duracao_da_locacao precisa ser numerico.");
        $this->duracao_da_locacao = $duracao_da_locacao;
    }

    /**
     * @return mixed
     */
    public function getPrecoDaLocacao()
    {
        return $this->preco_da_locacao;
    }

    /**
     * @param mixed $preco_da_locacao
     */
    public function setPrecoDaLocacao($preco_da_locacao)
    {
        if(!is_numeric($preco_da_locacao))
            throw new \Exception("O campo preco_da_locacao precisa ser numerico.");
        $this->preco_da_locacao = $preco_da_locacao;
    }

    /**
     * @return mixed
     */
    public function getDuracaoDoFilme()
    {
        return $this->duracao_do_filme;
    }

    /**
     * @param mixed $duracao_do_filme
     */
    public function setDuracaoDoFilme($duracao_do_filme)
    {
        if(!is_numeric($duracao_do_filme) && !is_null($duracao_do_filme))
            throw new \Exception("O campo duracao_do_filme precisa ser numerico.");
        $this->duracao_do_filme = $duracao_do_filme;
    }

    /**
     * @return mixed
     */
    public function getCustoDeSubstituicao()
    {
        return $this->custo_de_substituicao;
    }

    /**
     * @param mixed $custo_de_substituicao
     */
    public function setCustoDeSubstituicao($custo_de_substituicao)
    {
        if(!is_numeric($custo_de_substituicao))
            throw new \Exception("O campo custo_de_substituicao precisa ser numerico.");
        $this->custo_de_substituicao = $custo_de_substituicao;
    }

    /**
     * @return mixed
     */
    public function getClassificacao()
    {
        return $this->classificacao;
    }

    /**
     * @param mixed $classificacao
     */
    public function setClassificacao($classificacao)
    {
        if(!is_string($classificacao) && !is_null($classificacao))
            throw new \Exception("O campo classificacao precisa ser texto.");
        elseif(!in_array($classificacao, $this->listaClassificacoes) && !is_null($classificacao))
            throw new \Exception("O campo classificacao precisa ter um desses valores " . implode(', ', $this->listaClassificacoes));
        $this->classificacao = $classificacao;
    }

    /**
     * @return mixed
     */
    public function getRecursosEspeciais()
    {
        return $this->recursos_especiais;
    }

    /**
     * @param mixed $recursos_especiais
     */
    public function setRecursosEspeciais($recursos_especiais)
    {
        if(!is_string($recursos_especiais) && !is_null($recursos_especiais))
            throw new \Exception("O campo recursos_especiais precisa ser texto.");
        elseif(!in_array($recursos_especiais, $this->listaRecursosEspeciais) && !is_null($recursos_especiais))
            throw new \Exception("O campo recursos_especiais precisa ter um desses valores " . implode(', ', $this->listaRecursosEspeciais));
        $this->recursos_especiais[] = $recursos_especiais;
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

    /**
     * @return array
     */
    public function getListaClassificacoes()
    {
        return $this->listaClassificacoes;
    }

    /**
     * @param array $listaClassificacoes
     */
    public function setListaClassificacoes($listaClassificacoes)
    {
        $this->listaClassificacoes = $listaClassificacoes;
    }

    /**
     * @return mixed
     */
    public function getListaRecursosEspeciais()
    {
        return $this->listaRecursosEspeciais;
    }

    /**
     * @param mixed $listaRecursosEspeciais
     */
    public function setListaRecursosEspeciais($listaRecursosEspeciais)
    {
        $this->listaRecursosEspeciais = $listaRecursosEspeciais;
    }

}