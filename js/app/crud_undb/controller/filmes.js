app.controller('FilmesController', function($scope, FilmesService, ModalService) {
    $scope.search = '';
    FilmesService.getListaFilmes($scope);

    $scope.pagination.changePageCallback(function(pagination){
        $scope.page = pagination.currentPage;
        FilmesService.getListaFilmes($scope);
    });

    $scope.abrirFormulario = function(formulario) {
        // Just provide a template url, a controller and call 'showModal'.
        ModalService.showModal({
            templateUrl: "?action=formulario",
            controller: "FormularioModalController",
            inputs: {
                formulario: formulario
            }
        }).then(function(modal) {
            modal.element.openModal({
                dismissible: false, // Modal can be dismissed by clicking outside of the modal
                opacity: .5, // Opacity of modal background
                in_duration: 300, // Transition in duration
                out_duration: 200
            });
            modal.close.then(function(result) {
                FilmesService.getListaFilmes($scope);
            });
        });

    };

    $scope.excluirFilme = function(filme){
        if(confirm("Deseja realmente excluir o filme " + filme.titulo+ " ?")){
            $scope.formulario = angular.copy(filme);
            FilmesService.deleteApagarFilme($scope);
        }
    };

});

app.controller('FormularioModalController', function($scope, FilmesService, close, formulario) {

    $scope.dismissModal = function(result) {
        close(result, 200); // close, but give 200ms for bootstrap to animate
    };

    if(angular.isUndefined(formulario))
        $scope.formulario = {};
    else
        $scope.formulario = formulario;

    $scope.save = function(){
        if(angular.isUndefined($scope.formulario.filme_id))
            FilmesService.postCadastrarFilme($scope);
        else
            FilmesService.putAtualizarFilme($scope);
    };

});