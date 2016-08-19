<h3 style="margin-top:0;">Content</h3>
<div ng-controller="ContentController"> 
	
	<div class="row">
		<div class="col-md-6"> 
			<form  class="form-vertical">
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="">Title</label>
							<input type="text" class="form-control" ng-model="Title" />
						</div>
						<div class="col-md-6">
							<label for="">Link</label>
							<input type="text" class="form-control" ng-model="Link" />
						</div>
					</div>
					
				</div>
				<div class="form-group">
					<div summernote ng-model="ContentText" config="ComposerOptions"></div>
				</div>
				<div class="from-group"> 
					<div class="row">
					<div class="col-md-4"> 
							<button class="btn btn-default">Cancel</button>
						</div>
						<div class="col-md-8"> 
							<div class="pull-right">
								<button class="btn btn-warning " ng-click="save('D')">Save as Draft</button>
								<button class="btn btn-success" ng-click="save('P')">PUBLISH</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Content</div>
			<table class="table"> 
				  <thead>
					<tr>
					  <th class="col-md-1"><input type="checkbox" /></th>
					  <th class="col-md-11">Title</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
						<td><input type="checkbox" /></td>
						<td>
							<a>Smaple title</a>	
						</td>
					</tr>
				  </tbody>
			</table>
			<div class="row" style="padding:1rem;">
				  <div class="col-md-4">
					  <button class="btn btn-success btn-block"  ng-click="publish()">PUBLISH</button>
				  </div>
				  <div class="col-md-4">
					<button class="btn btn-warning btn-block" ng-click="draft()">DRAFT</button>
				  </div>
				  <div class="col-md-4">
					<button class="btn btn-danger btn-block"   ng-click="delete()">DELETE</button>
				  </div>
			  </div>
		</div>
			
</div>
<?php echo Assest::js('contents');?>