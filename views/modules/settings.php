	<h2 style="margin-top:0;">Settings</h2>
	<div ng-controller="SettingsController">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" ng-model="Settings.TITLE" />
				</div>
				<div class="form-group">
					<label>Subtitle</label>
					<input type="text" class="form-control" ng-model="Settings.SUBTITLE" />
				</div>
				<div class="form-group">
					<label>Logo</label>
					<input type="text" class="form-control" ng-model="Settings.LOGO" />
				</div>
				<div class="form-group">
					<label>Description</label>
					<textarea class="form-control" row="3" ng-model="Settings.DESCRIPTION"></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Clinic Days</label>
					<br />
					<div class="btn-group btn-group-sm">
						<button class="btn btn-default" ng-class="{'btn-default':!Settings.CLINIC_DAYS[day],'btn-primary':Settings.CLINIC_DAYS[day]}" ng-repeat="day in Days" ng-click="toggleDay(day)">{{day}}</button>
					</div>
				</div>
				<div class="form-group">
					<label>Maximum Daily Booking</label>
					<input type="number" class="form-control" ng-model="Settings.MAX_DAILY_BOOKING" />
				</div>
				<div class="form-group">
					<label>Ref No Counter</label>
					<input type="number" class="form-control" ng-model="Settings.REF_NO_COUNTER" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<button class="btn btn-default" ng-disabled="Loading"  ng-click="cancelSettings()">CANCEL</button>
			</div>
			<div class="col-md-6">
				<button class="btn btn-primary pull-right" ng-disabled="Loading" ng-click="saveSettings()">CONFIRM</button>
			</div>
		</div>
	</div>   
    <?php echo Assest::js('settings');?>