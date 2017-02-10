angular.module( 'mainApp', [ 'ngMaterial', 'ngMessages', 'ngStorage', 'dndLists'] )
.controller("MainController", function($scope, $localStorage){
	$scope.tarea={
		'tarea':'',
		'categoria':'',
		'fecha':''
	};

	$scope.add = function(){
		$scope.importantes_urgentes.push($scope.tarea);
	};

	$scope.models = {
        selected: null,
        lists: {"A": [], "B": []}
    };

    // Generate initial model
    for (var i = 1; i <= 3; ++i) {
        $scope.models.lists.A.push({label: "Item A" + i});
        $scope.models.lists.B.push({label: "Item B" + i});
    }

    // Model to JSON for demo purpose
    $scope.$watch('models', function(model) {
        $scope.modelAsJson = angular.toJson(model, true);
    }, true);

	$scope.$watch('importantes_urgentes', function() {
	    $localStorage.importantes_urgentes = $scope.importantes_urgentes;
	});

	$scope.importantes_urgentes = $localStorage.importantes_urgentes || [];
	$scope.importantes_nourgentes = $localStorage.importantes_nourgentes || [];
	$scope.noimportantes_urgentes = $localStorage.noimportantes_urgentes || [];
	$scope.noimportantes_nourgentes = $localStorage.noimportantes_nourgentes || [];


} );