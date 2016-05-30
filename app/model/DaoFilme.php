<?php

namespace CRUD\model;
use PDO;

class DaoFilme {

    public function readAll($page){
        try{
            $itemsPage = 25;

            $sql   = "SELECT
                      f.*,
                      i1.nome as idioma,
                      i2.nome as idioma_original
                      FROM filme as f
                      INNER JOIN idioma as i1 ON f.idioma_id = i1.idioma_id
                      LEFT JOIN  idioma as i2 ON f.idioma_original_id = i2.idioma_id
                      ORDER BY f.titulo
                      LIMIT :page, :items_page";
            $p_sql = Model::getPDO()->prepare($sql);
            $p_sql->bindValue(":page", ($page - 1) * $itemsPage, PDO::PARAM_INT);
            $p_sql->bindValue(":items_page", $itemsPage, PDO::PARAM_INT);
            $p_sql->execute();
            $dados = $p_sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($dados as &$dado){
                $dado['recursos_especiais']    = explode(',', $dado['recursos_especiais']);
                $dado['ano_de_lancamento']     = (int) $dado['ano_de_lancamento'] ;
                $dado['duracao_da_locacao']    = (int) $dado['duracao_da_locacao'] ;
                $dado['preco_da_locacao']      = (double) $dado['preco_da_locacao'] ;
                $dado['duracao_do_filme']      = (int) $dado['duracao_do_filme'] ;
                $dado['custo_de_substituicao'] = (double) $dado['custo_de_substituicao'] ;
            }

            return $dados;

        } catch (\Exception $e){
            throw new \Exception("Ocorreu um erro ao buscar a lista de filmes!");
        }
    }

    public function quantidadeFilmes(){
        try{
            $sql   = "SELECT COUNT(*) as quant FROM filme";
            $p_sql = Model::getPDO()->prepare($sql);
            $p_sql->execute();
            $dados = $p_sql->fetch(PDO::FETCH_ASSOC);

            if(!$dados)
                throw new \Exception($p_sql->errorInfo());

            return $dados['quant'];

        } catch (\Exception $e){
            throw new \Exception("Ocorreu um erro ao contar a lista de filmes!");
        }
    }

    public function create(PojoFilme $filme){
        try{
            $sql   = "INSERT INTO filme (
                            titulo,
                            descricao,
                            ano_de_lancamento,
                            idioma_id,
                            idioma_original_id,
                            duracao_da_locacao,
                            preco_da_locacao,
                            duracao_do_filme,
                            custo_de_substituicao,
                            classificacao,
                            recursos_especiais,
                            ultima_atualizacao
                        ) VALUES (
                            :titulo,
                            :descricao,
                            :ano_de_lancamento,
                            :idioma_id,
                            :idioma_original_id,
                            :duracao_da_locacao,
                            :preco_da_locacao,
                            :duracao_do_filme,
                            :custo_de_substituicao,
                            :classificacao,
                            :recursos_especiais,
                            :ultima_atualizacao
                        )";
            $p_sql = Model::getPDO()->prepare($sql);
            $p_sql->bindValue(":titulo", $filme->getTitulo());
            $p_sql->bindValue(":descricao", $filme->getDescricao());
            $p_sql->bindValue(":ano_de_lancamento", $filme->getAnoDeLancamento());
            $p_sql->bindValue(":idioma_id", $filme->getIdioma()->getIdiomaId());
            $p_sql->bindValue(":idioma_original_id", $filme->getIdiomaOriginal()->getIdiomaId());
            $p_sql->bindValue(":duracao_da_locacao", $filme->getDuracaoDaLocacao());
            $p_sql->bindValue(":preco_da_locacao", $filme->getPrecoDaLocacao());
            $p_sql->bindValue(":duracao_do_filme", $filme->getDuracaoDoFilme());
            $p_sql->bindValue(":custo_de_substituicao", $filme->getCustoDeSubstituicao());
            $p_sql->bindValue(":classificacao", $filme->getClassificacao());
            $p_sql->bindValue(":recursos_especiais", is_array($filme->getRecursosEspeciais()) ? implode(',', $filme->getRecursosEspeciais()) : null);
            $p_sql->bindValue(":ultima_atualizacao", (new \DateTime("now", new \DateTimeZone('America/Sao_Paulo')))->format('Y-m-d H:i:s'));

            $p_sql->execute();

            return Model::getPDO()->lastInsertId();

        } catch (\Exception $e){
            throw new \Exception("Ocorreu um erro ao cadastraro filme!");
        }
    }

    public function update(PojoFilme $filme){
        try{
            $sql   = "UPDATE filme SET
                          titulo = :titulo,
                          descricao = :descricao,
                          ano_de_lancamento = :ano_de_lancamento,
                          idioma_id = :idioma_id,
                          idioma_original_id = :idioma_original_id,
                          duracao_da_locacao = :duracao_da_locacao,
                          preco_da_locacao = :preco_da_locacao,
                          duracao_do_filme = :duracao_do_filme,
                          custo_de_substituicao = :custo_de_substituicao,
                          classificacao = :classificacao,
                          recursos_especiais = :recursos_especiais,
                          ultima_atualizacao = :ultima_atualizacao
                       WHERE filme_id = :filme_id";

            $p_sql = Model::getPDO()->prepare($sql);
            $p_sql->bindValue(":titulo", $filme->getTitulo());
            $p_sql->bindValue(":descricao", $filme->getDescricao());
            $p_sql->bindValue(":ano_de_lancamento", $filme->getAnoDeLancamento());
            $p_sql->bindValue(":idioma_id", $filme->getIdioma()->getIdiomaId());
            $p_sql->bindValue(":idioma_original_id", $filme->getIdiomaOriginal()->getIdiomaId());
            $p_sql->bindValue(":duracao_da_locacao", $filme->getDuracaoDaLocacao());
            $p_sql->bindValue(":preco_da_locacao", $filme->getPrecoDaLocacao());
            $p_sql->bindValue(":duracao_do_filme", $filme->getDuracaoDoFilme());
            $p_sql->bindValue(":custo_de_substituicao", $filme->getCustoDeSubstituicao());
            $p_sql->bindValue(":classificacao", $filme->getClassificacao());
            $p_sql->bindValue(":recursos_especiais", is_array($filme->getRecursosEspeciais()) ? implode(',', $filme->getRecursosEspeciais()) : null);
            $p_sql->bindValue(":ultima_atualizacao", (new \DateTime("now", new \DateTimeZone('America/Sao_Paulo')))->format('Y-m-d H:i:s'));
            $p_sql->bindValue(":filme_id", $filme->getFilmeId());
            return $p_sql->execute();

        } catch (\Exception $e){
            throw new \Exception("Ocorreu um erro ao atualizar filme!");
        }
    }

    public function delete(PojoFilme $filme){
        try{
            $sql   = "DELETE FROM filme WHERE filme_id = :filme_id";

            $p_sql = Model::getPDO()->prepare($sql);
            $p_sql->bindValue(":filme_id", $filme->getFilmeId());
            return $p_sql->execute();

        } catch (\Exception $e){
            throw new \Exception("Ocorreu um erro ao apagar o filme!");
        }
    }
}