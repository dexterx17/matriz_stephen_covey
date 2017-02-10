<!DOCTYPE html>
<html>
<head>
	<title>Construye tu Matriz del Tiempo (de Stephen Covey)</title>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="./bower_components/angular-material/angular-material.css">
</head>
<body ng-app="mainApp">
	<md-content ng-controller="MainController">
	    <md-toolbar class="md-hue-2">
	      <div class="md-toolbar-tools">
	        <md-button class="md-icon-button" aria-label="Settings" ng-disabled="true">
	          <md-icon md-svg-icon="img/icons/menu.svg"></md-icon>
	        </md-button>

	        <h2 flex md-truncate>Construye tu Matriz del tiempo (Stephen Covey)</h2>

	      </div>
	    </md-toolbar>

		<md-content>
			<div layout="row" layout-fill>
	            <form flex="65" name="taskForm" ng-submit="add()" layout="column">
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
	                            <md-option value="i_u">Importante / Urgente</md-option>
	                            <md-option value="i_nu">Importante / No Urgente</md-option>
	                            <md-option value="ni_u">No Importante / Urgente</md-option>
	                            <md-option value="ni_nu">No Importante / No Urgente</md-option>
	                        </md-select>
	                    </md-input-container>-->
	                    <md-input-container>
				            <label>Fecha límite</label>
				            <md-datepicker ng-model="tarea.fecha"></md-datepicker>
				        </md-input-container>
	                    <md-button type="submit" class="md-raised md-primary">Agregar</md-button>
	                </div>
	            </form>
	            <div flex="30">
	            	 <div class="md-item-text md-whiteframe-z1" flex>
	    	          <h3 class="adds">ADDs</h3>
	    	        </div>
	            </div>
	        </div>
			<div ng-cloak layout-gt-sm="row" layout="column">
				<div flex-gt-sm="50" flex>
				    <md-toolbar layout="row" class="md-hue-3">
				      <div class="md-toolbar-tools">
				        <span>Importante / Urgente</span>
				      </div>
				    </md-toolbar>
					<md-content>
					    <md-list flex>
					        <md-subheader class="md-no-sticky">Salud, proyectos presionantes</md-subheader>
					        <md-list-item class="md-3-line" ng-repeat="item in importantes_urgentes" ng-click="null">
					          <div class="md-list-item-text" layout="column">
					            <h3> {{ item.tarea }} </h3>
					            <p> {{ item.fecha }} </p>
					          </div>
					        </md-list-item>
					        <md-divider ></md-divider>
					    </md-list>
					    <!-- The dnd-list directive allows to drop elements into it.
						     The dropped data will be added to the referenced list -->
						<ul dnd-list="list">
						    <!-- The dnd-draggable directive makes an element draggable and will
						         transfer the object that was assigned to it. If an element was
						         dragged away, you have to remove it from the original list
						         yourself using the dnd-moved attribute -->
						    <li ng-repeat="item in list"
						        dnd-draggable="item"
						        dnd-moved="list.splice($index, 1)"
						        dnd-effect-allowed="move"
						        dnd-selected="models.selected = item"
						        ng-class="{'selected': models.selected === item}"
						        >
						        {{item.label}}
						    </li>
						</ul>
					</md-content>

					<md-toolbar layout="row" class="md-hue-3">
				      <div class="md-toolbar-tools">
				        <span>No Importante / Urgente</span>
				      </div>
				    </md-toolbar>
					<md-content>
					    <md-list flex>
					        <md-subheader class="md-no-sticky">Mensajes, llamadas, peticiones imprevistas, reuniones inncesarias</md-subheader>
					        <md-list-item class="md-3-line" ng-repeat="item in importantes" ng-click="null">
					          <img ng-src="{{item.face}}?{{$index}}" class="md-avatar" alt="Quien" />
					          <div class="md-list-item-text" layout="column">
					            <h3> Quien </h3>
					            <h4> Que </h4>
					            <p> Notas </p>
					          </div>
					        </md-list-item>
					        <md-divider ></md-divider>
					    </md-list>
					</md-content>
				</div>

				<div flex-gt-sm="50" flex>
				    <md-toolbar layout="row" class="md-hue-3">
				      <div class="md-toolbar-tools">
				        <span>Importante / No Urgente</span>
				      </div>
				    </md-toolbar>
					<md-content>
					    <md-list flex>
					        <md-subheader class="md-no-sticky">Crecimiento personal, Actividades preventivas</md-subheader>
					        <md-list-item class="md-3-line" ng-repeat="item in importantes" ng-click="null">
					          <img ng-src="{{item.face}}?{{$index}}" class="md-avatar" alt="Quien" />
					          <div class="md-list-item-text" layout="column">
					            <h3> Quien </h3>
					            <h4> Que </h4>
					            <p> Notas </p>
					          </div>
					        </md-list-item>
					        <md-divider ></md-divider>
					    </md-list>
					</md-content>

					<md-toolbar layout="row" class="md-hue-3">
				      <div class="md-toolbar-tools">
				        <span>No Importante / No Urgente</span>
				      </div>
				    </md-toolbar>
					<md-content>
					    <md-list flex>
					        <md-subheader class="md-no-sticky">Redes sociales sin objetivo, vicios, chismes</md-subheader>
					        <md-list-item class="md-3-line" ng-repeat="item in importantes" ng-click="null">
					          <img ng-src="{{item.face}}?{{$index}}" class="md-avatar" alt="Quien" />
					          <div class="md-list-item-text" layout="column">
					            <h3> Quien </h3>
					            <h4> Que </h4>
					            <p> Notas </p>
					          </div>
					        </md-list-item>
					        <md-divider ></md-divider>
					    </md-list>
					</md-content>
				</div>
			</div>
		</md-content>
    </md-content>
	<script src="./bower_components/angular/angular.js"></script>
	<script src="./bower_components/angular-aria/angular-aria.js"></script>
	<script src="./bower_components/angular-animate/angular-animate.js"></script>
	<script src="./bower_components/angular-material/angular-material.js"></script>
	<script src="./bower_components/angular-messages/angular-messages.js"></script>
	<script src="./bower_components/angular-drag-and-drop-lists/angular-drag-and-drop-lists.js"></script>
	<script src="./bower_components/ngstorage/ngStorage.js"></script>

	<script>
        angular.module( 'mainApp', [ 'ngMaterial' ] )
    </script>
    <script src="./js/controladores.js" type="text/javascript"></script>
</body>
</html>