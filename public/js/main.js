angular.module( 'mainApp', [ 'ngMaterial', 'ngMessages', 'ngStorage', 'ngDraggable' ])
.config(function($mdThemingProvider) {
	$mdThemingProvider.theme('blue')
    	.primaryPalette('blue');
    $mdThemingProvider.theme('light-blue')
    	.primaryPalette('light-blue');
	$mdThemingProvider.theme('green')
    	.primaryPalette('green');
    $mdThemingProvider.theme('pink')
    	.primaryPalette('pink');
    $mdThemingProvider.theme('light-green')
    	.primaryPalette('light-green');
    $mdThemingProvider.theme('orange')
    	.primaryPalette('orange');
    $mdThemingProvider.theme('amber')
    	.primaryPalette('amber');
    $mdThemingProvider.theme('lime')
    	.primaryPalette('lime');
    $mdThemingProvider.theme('brown')
    	.primaryPalette('brown');
    $mdThemingProvider.theme('teal')
    	.primaryPalette('teal');
    $mdThemingProvider.theme('cyan')
    	.primaryPalette('cyan');
    $mdThemingProvider.theme('blue-grey')
    	.primaryPalette('blue-grey');
	$mdThemingProvider.theme('grey')
    	.primaryPalette('grey',{
    	'default': '900'})
    	.accentPalette('grey',{
    	'default': '700'})
	$mdThemingProvider.alwaysWatchTheme(true);
})
.controller("MainController", function($scope, $localStorage, $mdToast, $mdDialog){

	$scope.tarea={
		'tarea':'',
		'categoria':'i_u',
		'fecha':''
	};

	$scope.cuadrantes = {
		'i_u':'Importante / Urgente',
		'i_nu':'Importante / No Urgente',
		'ni_u':'No Importante / Urgente',
		'ni_nu':'No Importante / No Urgente'
	};

	$scope.theme = 'default';
	$scope.selectedTab = 0;
	$scope.pdf_url = '';
	$scope.img_url = '';
	$scope.svg_url = '';

	$scope.exportar_pdf = function(){
		// Convert the DOM element to a drawing using kendo.drawing.drawDOM
        kendo.drawing.drawDOM($(".content-wrapper"))
        .then(function(group) {
        	$scope.selectedTab = 2;
            // Render the result as a PDF file
            return kendo.drawing.exportPDF(group, {
                paperSize: "auto",
                margin: { left: "1cm", top: "1cm", right: "1cm", bottom: "1cm" }
            });
        })
        .done(function(data) {
        	$scope.selectedTab = 2;
        	$scope.pdf_url = data;
        });
	}
	$scope.exportar_img = function(){
		 // Convert the DOM element to a drawing using kendo.drawing.drawDOM
        kendo.drawing.drawDOM($(".content-wrapper"))
        .then(function(group) {
        	$scope.selectedTab = 2;
            // Render the result as a PNG image
            return kendo.drawing.exportImage(group);
        })
        .done(function(data) {
        	$scope.selectedTab = 2;
            $scope.img_url = data;
        });
	}
	$scope.exportar_svg = function(){
		 // Convert the DOM element to a drawing using kendo.drawing.drawDOM
        kendo.drawing.drawDOM($(".content-wrapper"))
        .then(function(group) {
        	$scope.selectedTab = 2;
            // Render the result as a SVG document
            return kendo.drawing.exportSVG(group);
        })
        .done(function(data) {
        	$scope.selectedTab = 2;
            $scope.svg_url = data;
        });
	}

	$scope.download_pdf = function(){
		if($scope.pdf_url!=''){
			// Save the PDF file
	        kendo.saveAs({
	            dataURI: $scope.pdf_url,
	            fileName: "matriz.pdf"
	        });
		}
	}

	$scope.download_img = function(){
		if($scope.img_url!=''){
			// Save the PNG file
	        kendo.saveAs({
	            dataURI: $scope.img_url,
	            fileName: "matriz.png"
	        });
		}
	}

	$scope.download_svg = function(){
		if($scope.svg_url!=''){
			// Save the SVG file
	        kendo.saveAs({
	            dataURI: $scope.svg_url,
	            fileName: "matriz.svg"
	        });
		}
	}

	$scope.importantes_urgentes = $localStorage.importantes_urgentes || [];
	$scope.importantes_nourgentes = $localStorage.importantes_nourgentes || [];
	$scope.noimportantes_urgentes = $localStorage.noimportantes_urgentes || [];
	$scope.noimportantes_nourgentes = $localStorage.noimportantes_nourgentes || [];

	$scope.$watch('importantes_urgentes', function() {
	    $localStorage.importantes_urgentes = $scope.importantes_urgentes;
	});
	$scope.$watch('importantes_nourgentes', function() {
	    $localStorage.importantes_nourgentes = $scope.importantes_nourgentes;
	});
	$scope.$watch('noimportantes_urgentes', function() {
	    $localStorage.noimportantes_urgentes = $scope.noimportantes_urgentes;
	});
	$scope.$watch('noimportantes_nourgentes', function() {
	    $localStorage.noimportantes_nourgentes = $scope.noimportantes_nourgentes;
	});

	$scope.add = function(){
		$scope.importantes_urgentes.push({
			'tarea':$scope.tarea.tarea,
			'categoria':'i_u',
			'fecha':$scope.tarea.fecha
		});
		$mdToast.show(
      		$mdToast.simple()
      		.position('top right')
	        .textContent('Tarea agregada correctamente!')
	        .hideDelay(3000)
	    );
	    $scope.tarea.tarea='';
	    $scope.tarea.fecha='';
	};
	$scope.deleteTask = function(data,$event){
		 var confirm = $mdDialog.confirm()
          .title('Eliminar tarea!')
          .textContent('Estas seguro que deseas eliminar esta tarea?')
          .ariaLabel('Eliminar tarea!')
          .targetEvent($event)
          .ok('Eliminar')
          .cancel('Cancelar');

	    $mdDialog.show(confirm).then(function() {
			switch(data.categoria){
				case 'i_u':
					var index = $scope.importantes_urgentes.indexOf(data);
			        if (index > -1) {
			            $scope.importantes_urgentes.splice(index, 1);
			        }
				break;
				case 'ni_u':
					var index = $scope.noimportantes_urgentes.indexOf(data);
			        if (index > -1) {
			            $scope.noimportantes_urgentes.splice(index, 1);
			        }
				break;
				case 'i_nu':
					var index = $scope.importantes_nourgentes.indexOf(data);
			        if (index > -1) {
			            $scope.importantes_nourgentes.splice(index, 1);
			        }
				break;
				case 'ni_nu':
					var index = $scope.noimportantes_nourgentes.indexOf(data);
			        if (index > -1) {
			            $scope.noimportantes_nourgentes.splice(index, 1);
			        }
				break;
			}
			$mdToast.show(
	      		$mdToast.simple()
	      		.position('top right')
		        .textContent('Tarea eliminada correctamente!')
		        .hideDelay(3000)
		    );
	    }, function() {
	      //cancela
	    });
	};
	$scope.renovar = function($event){
		var confirm = $mdDialog.confirm()
          .title('Eliminar datos!')
          .textContent('Estas seguro que deseas eliminar todas las tareas?')
          .ariaLabel('Eliminar tareas!')
          .targetEvent($event)
          .ok('Eliminar')
          .cancel('Cancelar');

	    $mdDialog.show(confirm).then(function() {
			$scope.importantes_urgentes = [];
			$scope.importantes_nourgentes = [];
			$scope.noimportantes_urgentes = [];
			$scope.noimportantes_nourgentes = [];
		}, function() {
	      //cancela
	    });
	};

    $scope.onDragTask=function(data,evt){
		switch(data.categoria){
			case 'i_u':
		        var index = $scope.importantes_urgentes.indexOf(data);
		        if (index > -1) {
		            $scope.importantes_urgentes.splice(index, 1);
		        }
			break;
			case 'ni_u':
		        var index = $scope.noimportantes_urgentes.indexOf(data);
		        if (index > -1) {
		            $scope.noimportantes_urgentes.splice(index, 1);
		        }
			break;
			case 'i_nu':
		        var index = $scope.importantes_nourgentes.indexOf(data);
		        if (index > -1) {
		            $scope.importantes_nourgentes.splice(index, 1);
		        }
			break;
			case 'ni_nu':
		        var index = $scope.noimportantes_nourgentes.indexOf(data);
		        if (index > -1) {
		            $scope.noimportantes_nourgentes.splice(index, 1);
		        }
			break;
		}
    }

	$scope.onDropIU=function(data,evt){
		data.categoria='i_u';
        var index = $scope.importantes_urgentes.indexOf(data);
        if (index == -1)
        	$scope.importantes_urgentes.push(data);
    }
    $scope.onDropNIU=function(data,evt){
		data.categoria='ni_u';
        var index = $scope.noimportantes_urgentes.indexOf(data);
        if (index == -1)
        	$scope.noimportantes_urgentes.push(data);
    }
    $scope.onDropINU=function(data,evt){
		data.categoria='i_nu';
        var index = $scope.importantes_nourgentes.indexOf(data);
        if (index == -1)
        	$scope.importantes_nourgentes.push(data);
    }
    $scope.onDropNINU=function(data,evt){
		data.categoria='ni_nu';
        var index = $scope.noimportantes_nourgentes.indexOf(data);
        if (index == -1)
        	$scope.noimportantes_nourgentes.push(data);
    }

    $scope.onDropDelete=function(data,evt){
    	 var confirm = $mdDialog.confirm()
          .title('Eliminar tarea!')
          .textContent('Estas seguro que deseas eliminar esta tarea?')
          .ariaLabel('Eliminar tarea!')
          .targetEvent(evt)
          .ok('Eliminar')
          .cancel('Cancelar');

	    $mdDialog.show(confirm).then(function() {
			switch(data.categoria){
				case 'i_u':
					var index = $scope.importantes_urgentes.indexOf(data);
			        if (index > -1) {
			            $scope.importantes_urgentes.splice(index, 1);
			        }
				break;
				case 'ni_u':
					var index = $scope.noimportantes_urgentes.indexOf(data);
			        if (index > -1) {
			            $scope.noimportantes_urgentes.splice(index, 1);
			        }
				break;
				case 'i_nu':
					var index = $scope.importantes_nourgentes.indexOf(data);
			        if (index > -1) {
			            $scope.importantes_nourgentes.splice(index, 1);
			        }
				break;
				case 'ni_nu':
					var index = $scope.noimportantes_nourgentes.indexOf(data);
			        if (index > -1) {
			            $scope.noimportantes_nourgentes.splice(index, 1);
			        }
				break;
			}
			$mdToast.show(
	      		$mdToast.simple()
	      		.position('top right')
		        .textContent('Tarea eliminada correctamente!')
		        .hideDelay(3000)
		    );
		}, function() {
	      switch(data.categoria){
				case 'i_u':
			        $scope.importantes_urgentes.push(data);
				break;
				case 'ni_u':
					$scope.noimportantes_urgentes.push(data);
				break;
				case 'i_nu':
					$scope.importantes_nourgentes.push(data);
				break;
				case 'ni_nu':
					$scope.noimportantes_nourgentes.push(data);
				break;
			}
	    });
    }



} );