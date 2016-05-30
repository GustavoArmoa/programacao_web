<div class="row" ng-controller="FilmesController">
    <div class="col s12">
        <div loading-bootstrap></div>
    </div>

    <div class="col s12">
        <table class="responsive-table">
            <thead>
            <tr>
                <th class="center" data-field="id">ID</th>
                <th class="center" data-field="name">Título</th>
                <th class="center" data-field="lang">Idioma</th>
                <th class="center" data-field="price">Preço Locação</th>
                <th class="center" data-field="detail">-</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="filme in listaFilmes">
                <td class="center">{{filme.filme_id}}</td>
                <td>{{filme.titulo}}</td>
                <td class="center">{{filme.idioma}}</td>
                <td class="center">R$ {{filme.preco_da_locacao}}</td>
                <td class="center">
                    <a class="waves-effect waves-teal btn orange"
                       ng-click="abrirFormulario(filme)"><i class="material-icons">mode_edit</i></a>
                    <a class="waves-effect waves-teal btn red"
                       ng-click="excluirFilme(filme)"><i class="material-icons">delete</i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div pagination-bootstrap></div>

    <div class="fixed-action-btn" ng-if="listaFilmes" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large orange" ng-click="abrirFormulario()">
            <i class="large material-icons">add</i>
        </a>
    </div>

</div>