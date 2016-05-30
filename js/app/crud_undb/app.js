var app = angular.module('crud', ['Barbara-Js', 'angularModalService', 'ui.materialize']);

app.config(function ($httpProvider) {
    $httpProvider.defaults.useXDomain = true;
    delete $httpProvider.defaults.headers.common['X-Requested-With'];
});

app.value("requestLink", "index.php");

app.run( function ($rootScope, bootstrap) {
    $rootScope.alert      = bootstrap.alert();
    $rootScope.loading    = bootstrap.loading();
    $rootScope.pagination = bootstrap.pagination();
});