/**
 * Created by ferazo on 15/12/2016.
 */
angular.module("PhpAngularMysql")
.controller("Ctrl", function($scope,$http){
    $scope.img=[];
    $http.get("https://github.com/ferazo66/imagenes/tree/develop")
        .then(function(datos){
            $scope.img=datos.data;
        },function(error){
            console.log("error");
        });

})