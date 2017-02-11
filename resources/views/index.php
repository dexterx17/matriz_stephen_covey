<!DOCTYPE html>
<html>
<head>
	<title>Matriz del Tiempo (de Stephen Covey)</title>
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="./bower_components/angular-material/angular-material.css">
    <link rel="stylesheet" href="./bower_components/kendo/styles/web/kendo.common-material.css">
    <link rel="stylesheet" href="./bower_components/kendo/styles/web/kendo.default.css">
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
    	.img-download{
    		width: 100%;
    		height: 400px;
    	}
    </style>

    <meta property="og:url"           content="http://www.your-domain.com/your-page.html" />
  	<meta property="og:type"          content="website" />
  	<meta property="og:title"         content="Matriz de Tiempo (Stephen Covey)" />
  	<meta property="og:description"   content="Prioriza tu tiempo y tus actividades, planifica para alcanzar tus metas con la ayuda de esta herramienta" />
  	<meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />
</head>
<body ng-app="mainApp">
	<md-content ng-controller="MainController" md-theme="{{theme}}" md-theme-watch="true">
	    <md-toolbar class="md-hue-2">
	      <div class="md-toolbar-tools">
	        <md-button class="md-icon-button" aria-label="Settings" ng-disabled="true">
	          <md-icon md-svg-icon="img/icons/menu.svg"></md-icon>
	        </md-button>

	        <h2 flex md-truncate>Matriz del tiempo (Stephen Covey)</h2>
	        
				<!-- Your like button code -->
				  <div class="fb-like" 
				    data-href="http://www.your-domain.com/your-page.html" 
				    data-layout="standard" 
				    data-action="like" 
				    data-show-faces="true">
				  </div>
	        
	      </div>
	    </md-toolbar>

		<md-content >
			<md-tabs md-dynamic-height md-border-bottom md-center-tabs 
				md-stretch-tabs="always" md-selected="selectedTab">
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
				            	<md-button type="button" class="md-fab md-raised md-primary" aria-label="Renovar tareas" ng-click="renovar($event)">
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
					<md-tab label="Diseña & Exporta">
        				<md-content class="md-padding" >
        					<div layout="row" layout-align="space-around center">
								<md-button class="md-primary md-raised" ng-click="theme = 'default'">Default</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'blue'">Blue</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'light-blue'">Light-Blue</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'green'">Green</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'light-green'">Light Green</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'pink'">Pink</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'lime'">Lime</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'grey'">Grey</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'blue-grey'">Blue Grey</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'orange'">Orange</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'amber'">Amber</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'teal'">Teal</md-button>
	  							<md-button class="md-primary md-raised" ng-click="theme = 'cyan'">Cyan</md-button>
							</div>
							<div layout-gt-sm="row" layout="column" class="content-wrapper">
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
							<hr>
							<div layout="row" layout-align="space-around center">
								<md-button aria-label="Generar PDF" class="md-primary md-raised" ng-click="exportar_pdf()">Generar PDF</md-button>
	  							<md-button aria-label="Generar IMG" class="md-primary md-raised" ng-click="exportar_img()">Generar Imagen</md-button>
	  							<md-button aria-label="Generar SVG" class="md-primary md-raised" ng-click="exportar_svg()">Generar SVG</md-button>
							</div>
						</md-content>
					</md-tab>
					<md-tab label="Descarga & Comparte">
        				<md-content class="md-padding">
        					<div class="row">
        						<img ng-show="img_url" ng-src="{{ img_url }}" width="400" height="300" class="img-download">
        						<img ng-show="svg_url" ng-src="{{ svg_url }}" width="400" height="300" class="img-download">
        					</div>
        					<hr>
							<div layout="row" layout-align="space-around center">
								<md-button ng-hide="pdf_url" class="md-primary md-raised" ng-click="selectedTab=1" aria-label="Generar PDF">Generar PDF</md-button>
								<md-button ng-show="pdf_url" class="md-primary md-raised" ng-click="download_pdf()" aria-label="Descargar PDF">Descargar PDF</md-button>
	  							<md-button ng-hide="img_url" class="md-primary md-raised" ng-click="selectedTab=1" aria-label="Generar Imagen">Generar Imagen</md-button>
	  							<md-button ng-show="img_url" class="md-primary md-raised" ng-click="download_img()" aria-label="Descargar Imagen">Descargar Imagen</md-button>
	  							<md-button ng-hide="svg_url" class="md-primary md-raised" ng-click="selectedTab=1" aria-label="Generar SVG">Generar SVG</md-button>
	  							<md-button ng-show="svg_url" class="md-primary md-raised" ng-click="download_svg()" aria-label="Descargar SVG">Descargar SVG</md-button>
							</div>
        					<hr>
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
	<!-- Load Pako ZLIB library to enable PDF compression -->
	<script src="./bower_components/jquery/dist/jquery.min.js"></script>
	<script src="./bower_components/kendo/js/kendo.all.min.js"></script>
	<script src="./bower_components/pako/dist/pako_deflate.min.js"></script>
    <script src="./js/main.js" type="text/javascript"></script>

    <script>

		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-91816822-1', 'auto');
		ga('send', 'pageview');

    	window.fbAsyncInit = function() {
		    FB.init({
		    	appId      : '881661108603493',
		    	xfbml      : true,
		    	version    : 'v2.8'
		    });
		    FB.AppEvents.logPageView();
		};

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) return;
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/es_LA/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));


	</script> 
</body>
</html>