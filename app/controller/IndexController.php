<?php

namespace CRUD\controller;

use CRUD\model\DaoFilme;
use CRUD\model\DaoIdioma;
use CRUD\model\PojoFilme;
use CRUD\model\PojoIdioma;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->view;
    }

    public function formularioAction()
    {
        $this->view->setTemplate('modal');
        return $this->view;
    }

    public function createAction()
    {
        try{
            $filme = new PojoFilme();
            $filme->setTitulo($this->getContent('titulo'));
            $filme->setDescricao($this->getContent('descricao'));
            $filme->setAnoDeLancamento($this->getContent('ano_de_lancamento'));
            $filme->setIdioma(new PojoIdioma());
            $filme->getIdioma()->setIdiomaId($this->getContent('idioma_id'));
            $filme->setIdiomaOriginal(new PojoIdioma());
            $filme->getIdiomaOriginal()->setIdiomaId($this->getContent('idioma_original_id'));
            $filme->setDuracaoDaLocacao($this->getContent('duracao_da_locacao'));
            $filme->setPrecoDaLocacao($this->getContent('preco_da_locacao'));
            $filme->setDuracaoDoFilme($this->getContent('duracao_do_filme'));
            $filme->setCustoDeSubstituicao($this->getContent('custo_de_substituicao'));
            $filme->setClassificacao($this->getContent('classificacao'));

            if(!is_array($this->getContent('recursos_especiais'))) {
                $filme->setRecursosEspeciais($this->getContent('recursos_especiais'));
            } else {
                foreach($this->getContent('recursos_especiais') as $recursoEspecial)
                    $filme->setRecursosEspeciais($recursoEspecial);
            }

            return [
                'message'  => 'Filme cadastrado com sucesso!',
                'filme_id' => (new DaoFilme())->create($filme),
            ];

        } catch (\Exception $e){
            return ['error' => $e->getMessage()];
        }
    }

    public function readAction()
    {
        try{
            $filme   = new PojoFilme();
            $filmes  = new DaoFilme();
            $idiomas = new DaoIdioma();
            $page    = $this->getGetParams('page');
            $page    = is_null($page)     ? 1 : $page;
            $page    = !is_numeric($page) ? 1 : $page;
            $page    = $page > 0 ? $page : 1;

            return [
                'filmes' => [
                    'lista'              => $filmes->readAll($page),
                    'quantidade'         => (int) $filmes->quantidadeFilmes(),
                    'pagina'             => (int) $page,
                    'classificacoes'     => $filme->getListaClassificacoes(),
                    'recursos_especiais' => $filme->getListaRecursosEspeciais()
                ],
                'idiomas' => [
                    'lista'      => $idiomas->readAll(),
                    'quantidade' => (int) $idiomas->quantidadeIdiomas()
                ]
            ];
        } catch (\Exception $e){
            return ['error' => $e->getMessage()];
        }
    }

    public function updateAction()
    {
        try{
            $filme = new PojoFilme();
            $filme->setFilmeId($this->getContent('filme_id'));
            $filme->setTitulo($this->getContent('titulo'));
            $filme->setDescricao($this->getContent('descricao'));
            $filme->setAnoDeLancamento($this->getContent('ano_de_lancamento'));
            $filme->setIdioma(new PojoIdioma());
            $filme->getIdioma()->setIdiomaId($this->getContent('idioma_id'));
            $filme->setIdiomaOriginal(new PojoIdioma());
            $filme->getIdiomaOriginal()->setIdiomaId($this->getContent('idioma_original_id'));
            $filme->setDuracaoDaLocacao($this->getContent('duracao_da_locacao'));
            $filme->setPrecoDaLocacao($this->getContent('preco_da_locacao'));
            $filme->setDuracaoDoFilme($this->getContent('duracao_do_filme'));
            $filme->setCustoDeSubstituicao($this->getContent('custo_de_substituicao'));
            $filme->setClassificacao($this->getContent('classificacao'));

            if(!is_array($this->getContent('recursos_especiais'))) {
                $filme->setRecursosEspeciais($this->getContent('recursos_especiais'));
            } else {
                foreach($this->getContent('recursos_especiais') as $recursoEspecial)
                    $filme->setRecursosEspeciais($recursoEspecial);
            }

            return [
                'message' => 'Filme atualizado com sucesso!',
                'status'  => (new DaoFilme())->update($filme)
            ];

        } catch (\Exception $e){
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteAction()
    {
        try{
            $filme = new PojoFilme();
            $filme->setFilmeId($this->getContent('filme_id'));

            return [
                'message' => 'Filme apagado com sucesso!',
                'status'  => (new DaoFilme())->delete($filme)
            ];

        } catch (\Exception $e){
            return ['error' => $e->getMessage()];
        }
    }
}