<!DOCTYPE html>
<html>
<head>
	<title>Matriz del Tiempo (de Stephen Covey)</title>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="./bower_components/angular-material/angular-material.css">
    <style type="text/css" media="screen">
    	.text-center{
    		text-align: center;
    		width: 100%;
    	}
    	.default-item{
    		text-align: center;
    	}
    	.move-icon{
    		cursor: move;
    	}
    </style>
</head>
<body ng-app="mainApp">
	<md-content ng-controller="MainController">
	    <md-toolbar class="md-hue-2">
	      <div class="md-toolbar-tools">
	        <md-button class="md-icon-button" aria-label="Settings" ng-disabled="true">
	          <md-icon md-svg-icon="img/icons/menu.svg"></md-icon>
	        </md-button>

	        <h2 flex md-truncate>Matriz del tiempo (Stephen Covey)</h2>

	      </div>
	    </md-toolbar>

		<md-content >
			<md-tabs md-dynamic-height md-border-bottom md-center-tabs md-stretch-tabs="always">
      			<md-tab label="Construye">
        			<md-content class="md-padding">
						<div layout="row" layout-fill>
				            <form flex="60" name="taskForm" ng-submit="add()" layout="column">
				                <div layout-gt-xs="row">
				                    <md-input-container class="md-block" flex-gt-xs> 
				    			        <label>Actividad o aspecto</label>
				                    	<input required name="tarea" ng-model="tarea.tarea" placeholder="Ingresa una actividad o aspecto">
				                    	  <div ng-messages="taskForm.tarea.$error">
				    			            <div ng-message="required">Ingresa una actividad o aspecto</div>
				    			          </div>
				    			    </md-input-container>
				    			    <!--<md-input-container class="md-block" flex-gt-xs>
				    			        <label>Categoria</label>
				                        <md-select  ng-model="tarea.categoria">
				                            <md-option value="i_u"></md-option>
				                            <md-option value="i_nu">Importante / No Urgente</md-option>
				                            <md-option value="ni_u">No Importante / Urgente</md-option>
				                            <md-option value="ni_nu">No Importante / No Urgente</md-option>
				                        </md-select>
				                    </md-input-container>-->
				                    <md-input-container>
							            <label>Fecha límite</label>
							            <md-datepicker ng-model="tarea.fecha" md-placeholder="Fecha límite" ng-required="false"></md-datepicker>
							        </md-input-container>
				                    <md-button type="submit" class="md-raised md-primary" aria-label="Agregar tarea">Agregar</md-button>
				                </div>
				            </form>
				            <div flex="30">
				            	 <div class="md-item-text md-whiteframe-z1" flex>
				    	          <h3 class="adds">ADDs</h3>
				    	        </div>
				            </div>
				            <div flex="5">
				            	<md-button type="submit" class="md-raised md-primary" aria-label="Renovar tareas" ng-click="renovar($event)">
				            		 <md-icon md-svg-src="img/icons/renew.svg"></md-icon>
				            	</md-button>
				            </div>
				        </div>
						<div layout-gt-sm="row" layout="column">
							<div flex-gt-sm="50" flex>
							    <md-toolbar layout="row" class="md-primary">
							      <div class="md-toolbar-tools">
							        <span>Importante / Urgente</span>
							      </div>
							    </md-toolbar>
								<md-content>
								    <md-list flex ng-drop="true" class="bg-iu"
								    	ng-drop-success="onDropIU($data,$event)">
								        <md-subheader class="md-primary">Salud, proyectos presionantes</md-subheader>
								        <md-list-item class="md-3-line" 
								        	ng-repeat="item in importantes_urgentes" 
								        	ng-drag="true" ng-drag-data="item" 
								        	ng-drag-success="onDragTask($data,$event)">
								          <md-icon md-svg-icon="img/icons/move.svg" aria-label="Mover tarea" class="md-avatar-icon move-icon" ></md-icon>
								          <div class="md-list-item-text" layout="column">
								            <h3> {{ item.tarea }} </h3>
								            <p> {{ item.fecha }} </p>
								          </div>
								          <md-icon md-svg-icon="img/icons/edit.svg"  ng-click="editTask(item)" aria-label="Editar tarea" class="md-secondary md-hue-3" ></md-icon>
								          <md-icon md-svg-icon="img/icons/delete.svg"  ng-click="deleteTask(item,$event)" aria-label="Eliminar tarea" class="md-secondary md-hue-3" ></md-icon>
								        </md-list-item>
								        <md-divider ></md-divider>
								        <md-list-item class="md-3-line default-item animate-show-hide" ng-hide="importantes_urgentes.length">
								          <div class="md-list-item-text" layout="column">
								            <h3> Agrega y Arrastra aquí tus tareas  </h3>
								            <p> Importantes / Urgentes </p>
								          </div>
								        </md-list-item>
								    </md-list>
								</md-content>

								<md-toolbar layout="row" class="md-hue-1 md-primary">
							      <div class="md-toolbar-tools">
							        <span>No Importante / Urgente</span>
							      </div>
							    </md-toolbar>
								<md-content>
								    <md-list flex ng-drop="true"
								    	ng-drop-success="onDropNIU($data,$event)">
								        <md-subheader class="md-hue-1 md-primary">Mensajes, llamadas, peticiones imprevistas, reuniones inncesarias</md-subheader>
								        <md-list-item class="md-3-line" 
								        	ng-repeat="item in noimportantes_urgentes"
								          	ng-drag="true" ng-drag-data="item" 
								        	ng-drag-success="onDragTask($data,$event)">
								        	<md-icon md-svg-icon="img/icons/move.svg" aria-label="Mover tarea" class="md-avatar-icon move-icon" ></md-icon>
								          <div class="md-list-item-text" layout="column">
								            <h3> {{ item.tarea }} </h3>
								            <p> {{ item.fecha }} </p>
								          </div>
								          <md-icon md-svg-icon="img/icons/edit.svg"  ng-click="editTask(item)" aria-label="Editar tarea" class="md-secondary md-hue-3" ></md-icon>
								          <md-icon md-svg-icon="img/icons/delete.svg"  ng-click="deleteTask(item,$event)" aria-label="Eliminar tarea" class="md-secondary md-hue-3" ></md-icon>
								        </md-list-item>
								        <md-divider ></md-divider>
										<md-list-item class="md-3-line default-item animate-show-hide" ng-hide="noimportantes_urgentes.length">
								          <div class="md-list-item-text" layout="column">
								            <h3> Agrega y Arrastra aquí tus tareas</h3>
								            <p> No Importantes / Urgentes </p>
								          </div>
								        </md-list-item>
								    </md-list>
								</md-content>
							</div>

							<div flex-gt-sm="50" flex>
							    <md-toolbar layout="row" class="md-hue-2 md-primary">
							      <div class="md-toolbar-tools">
							        <span>Importante / No Urgente</span>
							      </div>
							    </md-toolbar>
								<md-content>
								    <md-list flex ng-drop="true"
								    	ng-drop-success="onDropINU($data,$event)">
								        <md-subheader class="md-hue-2 md-primary">Crecimiento personal, Actividades preventivas</md-subheader>
								        <md-list-item class="md-3-line" 
								        	ng-repeat="item in importantes_nourgentes"
								          	ng-drag="true" ng-drag-data="item" 
								        	ng-drag-success="onDragTask($data,$event)">
								        	<md-icon md-svg-icon="img/icons/move.svg" aria-label="Mover tarea" class="md-avatar-icon move-icon" ></md-icon>
								          <div class="md-list-item-text" layout="column">
								            <h3> {{ item.tarea }} </h3>
								            <p> {{ item.fecha }} </p>
								          </div>
								          <md-icon md-svg-icon="img/icons/edit.svg"  ng-click="editTask(item)" aria-label="Editar tarea" class="md-secondary md-hue-3" ></md-icon>
								          <md-icon md-svg-icon="img/icons/delete.svg"  ng-click="deleteTask(item,$event)" aria-label="Eliminar tarea" class="md-secondary md-hue-3" ></md-icon>
								        </md-list-item>
								        <md-divider ></md-divider>
								        <md-list-item class="md-3-line default-item animate-show-hide" ng-hide="importantes_nourgentes.length">
								          <div class="md-list-item-text" layout="column">
								            <h3> Agrega y Arrastra aquí tus tareas  </h3>
								            <p> Importantes / No Urgentes </p>
								          </div>
								        </md-list-item>
								    </md-list>
								</md-content>

								<md-toolbar layout="row" class="md-hue-3 md-primary">
							      <div class="md-toolbar-tools">
							        <span>No Importante / No Urgente</span>
							      </div>
							    </md-toolbar>
								<md-content>
								    <md-list flex ng-drop="true"
								    	ng-drop-success="onDropNINU($data,$event)">
								        <md-subheader class="md-hue-3 md-primary">Redes sociales sin objetivo, vicios, chismes</md-subheader>
								        <md-list-item class="md-3-line" 
								        	ng-repeat="item in noimportantes_nourgentes"
								        	ng-drag="true" ng-drag-data="item" 
								        	ng-drag-success="onDragTask($data,$event)">
								        	<md-icon md-svg-icon="img/icons/move.svg" aria-label="Mover tarea" class="md-button md-hue-3 md-primary" ></md-icon>
								          <div class="md-list-item-text" layout="column">
								            <h3> {{ item.tarea }} </h3>
								            <p> {{ item.fecha }} </p>
								          </div>
								          <md-icon md-svg-icon="img/icons/edit.svg"  ng-click="editTask(item)" aria-label="Editar tarea" class="md-secondary md-hue-3" ></md-icon>
								          <md-icon md-svg-icon="img/icons/delete.svg"  ng-click="deleteTask(item,$event)" aria-label="Eliminar tarea" class="md-secondary md-hue-3" ></md-icon>
								        </md-list-item>
								        <md-divider ></md-divider>
								        <md-list-item class="md-3-line default-item animate-show-hide" ng-hide="noimportantes_nourgentes.length">
								          <div class="md-list-item-text" layout="column">
								            <h3> Agrega y Arrastra aquí tus tareas  </h3>
								            <p> No Importantes / No Urgentes </p>
								          </div>
								        </md-list-item>
								    </md-list>
								</md-content>
							</div>
						</div>
						<hr>
						<div layout="row">
							<md-toolbar layout="row" class="md-hue-3 md-accent">
						      <div class="md-toolbar-tools " ng-drop="true"
						    	ng-drop-success="onDropDelete($data,$event)">
						        <span class="text-center">Arrastra las tareas <strong>Aquí</strong> para eliminarlas </span>
						      </div>
						    </md-toolbar>
						</div>
					</md-content>
					<md-tab label="Diseña">
        				<md-content class="md-padding" md-theme="{{ dynamicTheme }}" md-theme-watch>
							<div layout-gt-sm="row" layout="column">
							<div flex-gt-sm="50" flex>
							    <md-toolbar layout="row" class="md-primary">
							      <div class="md-toolbar-tools">
							        <span>Importante / Urgente</span>
							      </div>
							    </md-toolbar>
								<md-content>
								    <md-list flex  class="bg-iu">
								        <md-list-item class="md-3-line" 
								        	ng-repeat="item in importantes_urgentes" >
								          <div class="md-list-item-text" layout="column">
								            <h3> {{ item.tarea }} </h3>
								            <p> {{ item.fecha }} </p>
								          </div>
								        </md-list-item>
								        <md-divider ></md-divider>
								    </md-list>
								</md-content>

								<md-toolbar layout="row" class="md-hue-1 md-primary">
							      <div class="md-toolbar-tools">
							        <span>No Importante / Urgente</span>
							      </div>
							    </md-toolbar>
								<md-content>
								    <md-list flex>
								        <md-list-item class="md-3-line" 
								        	ng-repeat="item in noimportantes_urgentes">
								          <div class="md-list-item-text" layout="column">
								            <h3> {{ item.tarea }} </h3>
								            <p> {{ item.fecha }} </p>
								          </div>
								        </md-list-item>
								        <md-divider ></md-divider>
								    </md-list>
								</md-content>
							</div>

							<div flex-gt-sm="50" flex>
							    <md-toolbar layout="row" class="md-hue-2 md-primary">
							      <div class="md-toolbar-tools">
							        <span>Importante / No Urgente</span>
							      </div>
							    </md-toolbar>
								<md-content>
								    <md-list flex >
								        <md-list-item class="md-3-line" 
								        	ng-repeat="item in importantes_nourgentes">
								          <div class="md-list-item-text" layout="column">
								            <h3> {{ item.tarea }} </h3>
								            <p> {{ item.fecha }} </p>
								          </div>
								        </md-list-item>
								        <md-divider ></md-divider>
								    </md-list>
								</md-content>

								<md-toolbar layout="row" class="md-hue-3 md-primary">
							      <div class="md-toolbar-tools">
							        <span>No Importante / No Urgente</span>
							      </div>
							    </md-toolbar>
								<md-content>
								    <md-list flex>
								        <md-list-item class="md-3-line" 
								        	ng-repeat="item in noimportantes_nourgentes">
								          <div class="md-list-item-text" layout="column">
								            <h3> {{ item.tarea }} </h3>
								            <p> {{ item.fecha }} </p>
								          </div>
								        </md-list-item>
								        <md-divider ></md-divider>
								    </md-list>
								</md-content>
							</div>
						</div>
						<div layout="row">
							<md-button ng-click="dynamicTheme = 'default'">Default</md-button>
  							<md-button ng-click="dynamicTheme = 'green-theme'">Green {{ dynamicTheme }}</md-button>
						</div>
						</md-content>
					</md-tab>
					<md-tab label="Exporta">
        				<md-content class="md-padding">
							<div layout="row" layout-fill>
							</div>
						</md-content>
					</md-tab>
					<md-tab label="Comparte">
        				<md-content class="md-padding">
							<div layout="row" layout-fill>
							</div>
						</md-content>
					</md-tab>
				</md-tab>
			</md-tabs>
		</md-content>
    </md-content>
	<script src="./bower_components/angular/angular.js"></script>
	<script src="./bower_components/angular-aria/angular-aria.js"></script>
	<script src="./bower_components/angular-animate/angular-animate.js"></script>
	<script src="./bower_components/angular-material/angular-material.js"></script>
	<script src="./bower_components/angular-messages/angular-messages.js"></script>
	<script src="./bower_components/ngstorage/ngStorage.js"></script>
	<script src="./bower_components/ngDraggable/ngDraggable.js"></script>

	<script>
        angular.module( 'mainApp', [ 'ngMaterial' ] , ['$mdThemingProvider',function($mdThemingProvider) {
		    alert('joder');
		  $mdThemingProvider.theme('default')
		    .primaryPalette('pink')
		    .accentPalette('orange');
		  $mdThemingProvider.theme('green-theme')
		    .primaryPalette('purple')
		    .accentPalette('green');
		   $mdThemingProvider
      		.enableBrowserColor();
		}]);
    </script>
    <script src="./js/controladores.js" type="text/javascript"></script>
</body>
</html>