<h3 style="margin-top:0;">Content</h3>
<div ng-controller="ContentController"> 
	
	<div class="row">
		<div class="col-md-6 col-xs-6"> 
			<form  class="form-vertical">
				<div class="form-group">
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<label for="">Title</label>
							<input type="text" class="form-control" ng-model="Title" />
						</div>
					</div>
					
				</div>
				<div class="form-group">
					<div summernote ng-model="ContentText" config="ComposerOptions"></div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6 col-xs-6">
							<label for="">Link</label>
							<input type="text" class="form-control" ng-model="Link" />
						</div>
						<div class="col-md-6 col-xs-6">
							<label for="">Type</label>
							<select class="form-control" ng-model="Type">
								<option value="page">Page</option>
								<option value="service">Service</option>
								<option value="home">Append to Homepage</option>
							</select>
						</div>
					</div>
				</div>
				<div class="from-group"> 
					<div class="row">
					<div class="col-md-4 col-xs-4"> 
							<button class="btn btn-default" ng-click="cancel()">Cancel</button>
						</div>
						<div class="col-md-8 col-xs-8"> 
							<div class="pull-right">
								<button class="btn btn-warning " ng-click="save('D')">Save as Draft</button>
								<button class="btn btn-success" ng-click="save('P')">PUBLISH</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-6 col-xs-6">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				<b>Content</b>
			</div>
			<table class="table"> 
				  <thead>
					<tr>
					  <th class="col-md-1 col-xs-1"><input type="checkbox" ng-click="toggleCheckbox()"/></th>
					  <th class="col-md-11 col-xs-11">Title</th>
					</tr>
				  </thead>
				  <tbody>
					<tr ng-repeat="Content in Contents" ng-if="Contents.length" >
					  <td><input type="checkbox" ng-model="Content.checked" /></td>
					  <td>
						  <a href="#/edit={{Content.slug}}" ng-click="edit(Content)">
							{{Content.title}}
						  </a>
					  </td>
				
					</tr>
					<tr ng-if="!Contents.length">
						
							<td colspan="2" class="text-center">{{Loading?'Loading...':'No contents found'}}</td>
					
					</tr>
				  </tbody>
			</table>
			<div class="row" style="padding:1rem;">
				  <div class="col-md-4 col-xs-4">
					  <button class="btn btn-success btn-block"  ng-disabled="!Contents.length"  ng-click="publish()">PUBLISH</button>
				  </div>
				  <div class="col-md-4 col-xs-4">
					<button class="btn btn-warning btn-block" ng-disabled="!Contents.length"  ng-click="draft()">DRAFT</button>
				  </div>
				  <div class="col-md-4 col-xs-4">
					<button class="btn btn-danger btn-block" ng-disabled="!Contents.length"   ng-click="delete()">DELETE</button>
				  </div>
			  </div>
		</div>
		<div class="modal-blind" ng-class="{show:openModal}"></div>
		<div class="modal" ng-class="{show:openModal}">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <h4 class="modal-title">
				  {{openModal==='Publish'  || openModal==='Draft' || openModal==='Delete'? 'Warning':openModal}}
				  </h4>
				</div>
				<div class="modal-body">
					<div class="row" >
						<div class="col-md-12 col-xs-12">
							
							<div ng-if="openModal==='Success' || openModal==='Warning'" >
								{{modalMessage}}
							</div>
							<div ng-if="openModal==='Publish'  || openModal==='Draft' || openModal==='Delete' " >
								Are you sure you want <b><i>{{openModal}} </i></b>the selected item(s)?
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<div ng-show="openModal==='Success' || openModal==='Warning'" >
				   <button type="button" class="btn  pull-right" ng-class="{'btn-success':openModal==='Success','btn-danger':openModal!=='Success'}" ng-click="openModal=null">Close</button>
					</div>
					<div ng-show="openModal==='Publish'  || openModal==='Draft' || openModal==='Delete' " >
						<button type="button" class="btn  btn-default pull-left" ng-click="openModal=null" >Cancel</button>
						<button type="button" class="btn  btn-primary pull-right" ng-click="confirm(openModal)">Confirm</button>
					</div>
				  <div class="clearfix"></div>
				</div>
			  </div>
			</div>
		</div>

</div>
<?php echo Assest::js('contents');?>