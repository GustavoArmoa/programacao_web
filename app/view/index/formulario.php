<form ng-submit="save()">
    <div class="modal-content">
        <h4>{{formulario.filme_id ? 'Atualizar' : 'Novo'}} Filme</h4>
        <div class="row">

            <div class="input-field col s6">
                <input id="titulo_input"
                       type="text"
                       ng-model="formulario.titulo"
                       ng-required="true"
                       class="validate">
                <label for="titulo_input"
                       ng-class="{active : formulario.titulo}">Título (*)</label>
            </div>

            <div class="input-field col s6">
                <input id="ano_lancamento_input"
                       type="number"
                       step="any"
                       ng-model="formulario.ano_de_lancamento"
                       class="validate">
                <label for="ano_lancamento_input"
                       ng-class="{active : formulario.ano_de_lancamento}">Ano de Lançamento</label>
            </div>

            <div class="input-field col s12">
                <textarea id="descricao_input"
                       type="text"
                       ng-model="formulario.descricao"
                       class="materialize-textarea"></textarea>
                <label for="descricao_input"
                       ng-class="{active : formulario.descricao}">Descrição</label>
            </div>

            <div class="input-field col s6" input-field>
                <select material-select
                        watch="idioma_input"
                        ng-required="true"
                        id="idioma_input"
                        ng-model="formulario.idioma_id">
                    <option ng-repeat="idioma in listaIdiomas" value="{{idioma.idioma_id}}">
                        {{idioma.nome}}
                    </option>
                </select>

                <label for="idioma_input">Idioma (*)</label>
            </div>

            <div class="input-field col s6" input-field>
                <select material-select
                        watch="idioma_original_input"
                        id="idioma_original_input"
                        ng-model="formulario.idioma_original_id">
                    <option ng-repeat="idioma in listaIdiomas" value="{{idioma.idioma_id}}">
                        {{idioma.nome}}
                    </option>
                </select>
                <label for="idioma_original_input">Idioma Original</label>
            </div>

            <div class="input-field col s6">
                <input id="duracao_da_locacao_input"
                       type="number"
                       step="any"
                       ng-model="formulario.duracao_da_locacao"
                       ng-required="true"
                       class="validate">
                <label for="duracao_da_locacao_input"
                       ng-class="{active : formulario.duracao_da_locacao}">Duração da Locação (*)</label>
            </div>

            <div class="input-field col s6">
                <input id="preco_da_locacao_input"
                       type="number"
                       step="any"
                       ng-model="formulario.preco_da_locacao"
                       ng-required="true"
                       class="validate">
                <label for="preco_da_locacao_input"
                       ng-class="{active : formulario.preco_da_locacao}">Preço da Locação (*)</label>
            </div>

            <div class="input-field col s6">
                <input id="duracao_do_filme_input"
                       type="number"
                       step="any"
                       ng-model="formulario.duracao_do_filme"
                       class="validate">
                <label for="duracao_do_filme_input"
                       ng-class="{active : formulario.duracao_do_filme}">Duração do Filme</label>
            </div>

            <div class="input-field col s6">
                <input id="custo_de_substituicao_input"
                       type="number"
                       step="any"
                       ng-model="formulario.custo_de_substituicao"
                       ng-required="true"
                       class="validate">
                <label for="custo_de_substituicao_input"
                       ng-class="{active : formulario.custo_de_substituicao}">Custo de Substituição (*)</label>
            </div>

            <div class="input-field col s6" input-field>
                <select material-select
                        watch="classificacao_input"
                        id="classificacao_input"
                        ng-model="formulario.classificacao">
                    <option ng-repeat="classificacao in listaClassificacoes" value="{{classificacao}}">
                        {{classificacao}}
                    </option>
                </select>

                <label for="classificacao_input">Classificacao</label>
            </div>

            <div class="input-field col s6" input-field>
                <select material-select
                        multiple
                        watch="recursos_especiais_input"
                        id="recursos_especiais_input"
                        ng-model="formulario.recursos_especiais">
                    <option ng-repeat="recursoEspecial in listaRecursosEspeciais" value="{{recursoEspecial}}">
                        {{recursoEspecial}}
                    </option>
                </select>
                <label for="idioma_original_input">Recursos Especiais</label>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <button type="submit"
                class="modal-action waves-effect waves-green btn orange">Salvar</button>
        <a class="modal-action modal-close waves-effect waves-green btn-flat"
           ng-click="dismissModal()">Fechar</a>
    </div>
</form>