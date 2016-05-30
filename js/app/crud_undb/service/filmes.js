app.service("FilmesService", function($request, requestLink, $rootScope){

    this.getListaFilmes = function(scope){
        $request.get(requestLink)
            .addData({
                page   : scope.page,
                action : 'read'
            })
            .load(scope.loading.getRequestLoad())
            .send(function(data){
                scope.listaFilmes = data.filmes.lista;
                scope.pagination.changePages(Math.ceil(data.filmes.quantidade / 25));
                scope.pagination.changeCurrentPage(data.filmes.pagina);
                $rootScope.listaIdiomas = data.idiomas.lista;
                $rootScope.listaClassificacoes = data.filmes.classificacoes;
                $rootScope.listaRecursosEspeciais = data.filmes.recursos_especiais;
            }, function(meta){
                Materialize.toast(meta.error_message, 4000);
            });
    };

    this.postCadastrarFilme = function(scope){
        $request.post(requestLink)
            .addParams({
                action : 'create'
            })
            .addData(scope.formulario)
            .load(scope.loading.getRequestLoad())
            .send(function(data){
                Materialize.toast(data.message, 4000);
                scope.formulario.filme_id = data.filme_id;
            }, function(meta){
                Materialize.toast(meta.error_message, 4000);
            });
    };

    this.putAtualizarFilme = function(scope){
        $request.put(requestLink)
            .addParams({
                action : 'update'
            })
            .addData(scope.formulario)
            .load(scope.loading.getRequestLoad())
            .send(function(data){
                Materialize.toast(data.message, 4000);
            }, function(meta){
                Materialize.toast(meta.error_message, 4000);
            });
    };

    this.deleteApagarFilme = function(scope){
        var filmeService = this;
        $request.delete(requestLink)
            .addParams({
                action : 'delete'
            })
            .addData(scope.formulario)
            .load(scope.loading.getRequestLoad())
            .send(function(data){
                Materialize.toast(data.message, 4000);
                filmeService.getListaFilmes(scope);
            }, function(meta){
                Materialize.toast(meta.error_message, 4000);
            });
    };
});