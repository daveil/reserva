	<h2 style="margin-top:0;">Settings</h2>
	<div ng-controller="SettingsController">
		<h5>Clinic</h5>
		<hr />
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" ng-model="Settings.TITLE" />
				</div>
				<div class="form-group">
					<label>Subtitle</label>
					<input type="text" class="form-control" ng-model="Settings.SUBTITLE" />
				</div>
				<div class="form-group">
					<label>Background</label>
					<div class="input-group">
						<input type="text" class="form-control" ng-model="Settings.BACKGROUND" />
						<span class="input-group-btn"><button class="btn btn-default" ng-click="openUploader('background')">UPLOAD</button></span>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="form-group">
					<label>Clinic Days</label>
					<br />
					<div class="btn-group btn-group-sm">
						<button class="btn btn-default" ng-class="{'btn-default':!Settings.CLINIC_DAYS[day],'btn-primary':Settings.CLINIC_DAYS[day]}" ng-repeat="day in Days" ng-click="toggleDay(day)">{{day}}</button>
					</div>
				</div>
				<div class="form-group">
					<label>Clinic Hours</label>
					<br />
					<div class="row">
						<div class="col-md-6">
							<select class="form-control"  ng-model="Settings.HOUR_START" >
								<option value="">Start</option>
								<option ng-selected="Settings.HOUR_START===hour.id" ng-repeat="hour in Hours track by hour.id" ng-value="hour.id">{{hour.name}}</option>
							</select>
						</div>
						<div class="col-md-6">
							<select class="form-control" ng-model="Settings.HOUR_END" >
								<option value="">End</option>
								<option ng-selected="Settings.HOUR_END===hour.id" ng-repeat="hour in Hours track by hour.id" ng-value="hour.id">{{hour.name}}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Maximum Daily Booking</label>
					<input type="number" class="form-control" ng-model="Settings.MAX_DAILY_BOOKING" />
				</div>
			</div>
		</div>
		<h5>Chikka</h5>
		<hr />
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<div class="form-group">
					<label>Mobile No</label>
					<input type="tel" placeholder="63XXXXXXXXXX" class="form-control" ng-model="Settings.CHIKKA_MOBILE" />
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="form-group">
					<label>Short Code</label>
					<input type="tel" placeholder="29290XXXXXX" class="form-control" ng-model="Settings.CHIKKA_SHORT_CODE" />
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="form-group">
					<label>Client Id</label>
					<input type="text" placeholder="Client ID" class="form-control" ng-model="Settings.CHIKKA_CLIENT_ID" />
				</div>
			</div>
			<div class="col-md-6 col-xs-6">
				<div class="form-group">
					<label>Short Code</label>
					<input type="password" placeholder="Secret Key" class="form-control" ng-model="Settings.CHIKKA_SECRET_KEY" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-6">
				<button class="btn btn-default" ng-disabled="Loading"  ng-click="cancelSettings()">CANCEL</button>
			</div>
			<div class="col-md-6 col-xs-6">
				<button class="btn btn-primary pull-right" ng-disabled="Loading" ng-click="saveSettings()">CONFIRM</button>
			</div>
		</div>
	</div>   
    <?php echo Assest::js('settings');?>