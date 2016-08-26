;(function(angular){
  var indexOf = [].indexOf || function(item) {
    for (var i = 0, l = this.length; i < l; i++) {
      if (i in this && this[i] === item) return i;
    }
    return -1;
  };

  angular.module('pickadate.utils', [])
    .factory('pickadateUtils', ['dateFilter', function(dateFilter) {
      return {
        isDate: function(obj) {
          return Object.prototype.toString.call(obj) === '[object Date]';
        },

        stringToDate: function(dateString) {
          if (this.isDate(dateString)) return new Date(dateString);
          var dateParts = dateString.split('-'),
            year  = dateParts[0],
            month = dateParts[1],
            day   = dateParts[2];

          // set hour to 3am to easily avoid DST change
          return new Date(year, month - 1, day, 3);
        },

        dateRange: function(first, last, initial, format) {
          var date, i, _i, dates = [];

          if (!format) format = 'yyyy-MM-dd';

          for (i = _i = first; first <= last ? _i < last : _i > last; i = first <= last ? ++_i : --_i) {
            date = this.stringToDate(initial);
            date.setDate(date.getDate() + i);
            dates.push(dateFilter(date, format));
          }
          return dates;
        }
      };
    }]);

  angular.module('pickadate', ['pickadate.utils'])

    .directive('pickadate', ['$locale', 'pickadateUtils', 'dateFilter', function($locale, dateUtils, dateFilter) {
      return {
        require: 'ngModel',
        scope: {
          date: '=ngModel',
          minDate: '=',
          maxDate: '=',
          disabledDates: '=',
          statusDates: '=',
          allowedDays: '=',
		  onChangeMonth:'&',
        },
        template:'<div class="calendar">'+
					'<div class="years clearfix">'+
					  '<div class="unit prev" ng-click="changeMonth(-1)" ng-class="{\'disabled\':!allowPrevMonth}"><em></em></div>'+
					  '<div class="monyear">{{currentDate | date:"MMMM yyyy"}}</div>'+
					  '<div class="unit next" ng-click="changeMonth(1)" ng-class="{\'disabled\':!allowNextMonth}"><em></em></div>'+
					'</div>'+
					'<div class="days">'+
					  '<div class="clearfix">'+
						'<div class="unit" ng-repeat="dayName in dayNames">'+
							'{{dayName}}'+
						'</div>'+
					  '</div>'+
					  '<div class="clearfix dates">'+
						'<div ng-repeat="d in dates" ng-click="setDate(d)" class="unit {{d.className}}" ng-class="{\'active\': date == d.date,\'disabled\': !d.enabled}">'+
							'<b>{{d.date | date:"d"}}</b>'+
						'</div>'+
					  '</div>'+
					'</div>'+
			  '</div>',
        link: function(scope, element, attrs, ngModel)  {
			
          var minDate       = scope.minDate && dateUtils.stringToDate(scope.minDate),
              maxDate       = scope.maxDate && dateUtils.stringToDate(scope.maxDate),
              disabledDates = scope.disabledDates || [""],
              statusDates = scope.statusDates || {full:[],book:[]},
              currentDate   = new Date();
          scope.dayNames    = $locale.DATETIME_FORMATS['SHORTDAY'];
          
			scope.$watchGroup(['allowedDays','disabledDates','statusDates','date'],function(values){
				console.log(values[2]);
				if(values[3]||values[2]||values[1]){
					if(values[1]) disabledDates = values[1];
					if(values[2]) statusDates = values[2];
					scope.render(new Date(scope.date));
				}
			});
          scope.render = function(initialDate) {
            initialDate = new Date(initialDate.getFullYear(), initialDate.getMonth(), 1, 3);

            var currentMonth    = initialDate.getMonth() + 1,
              dayCount          = new Date(initialDate.getFullYear(), initialDate.getMonth() + 1, 0, 3).getDate(),
              prevDates         = dateUtils.dateRange(-initialDate.getDay(), 0, initialDate),
              currentMonthDates = dateUtils.dateRange(0, dayCount, initialDate),
              lastDate          = dateUtils.stringToDate(currentMonthDates[currentMonthDates.length - 1]),
              nextMonthDates    = dateUtils.dateRange(1, 7 - lastDate.getDay(), lastDate),
              allDates          = prevDates.concat(currentMonthDates, nextMonthDates),
              dates             = [],
              today             = dateFilter(new Date(), 'yyyy-MM-dd');
			
			var dayNameUC = [];
			for(var i in scope.dayNames){
				dayNameUC.push(scope.dayNames[i].toUpperCase());
			}
			var allowedDays = scope.allowedDays || dayNameUC;
            
			// Add an extra row if needed to make the calendar to have 6 rows
            if (allDates.length / 7 < 6) {
              allDates = allDates.concat(dateUtils.dateRange(1, 8, allDates[allDates.length - 1]));
            }

            var nextMonthInitialDate = new Date(initialDate);
            nextMonthInitialDate.setMonth(currentMonth);

            scope.allowPrevMonth = !minDate || initialDate > minDate;
            scope.allowNextMonth = !maxDate || nextMonthInitialDate < maxDate;

            for (var i = 0; i < allDates.length; i++) {
              var className = "", date = allDates[i];
			  var enabled = true;
              if (date < scope.minDate || date > scope.maxDate || dateFilter(date, 'M') !== currentMonth.toString()) {
                className = 'pickadate-disabled older';
              } else if (indexOf.call(disabledDates, date) >= 0) {
                className = 'pickadate-disabled pickadate-unavailable';
				enabled = false;
              }else {
				 var day = scope.dayNames[new Date(date).getDay()].toUpperCase();
				 var allowed = indexOf.call(allowedDays,day)!=-1;
				 if(!allowed){
					 className = 'pickadate-disabled pickadate-unavailable';
					 enabled = false;
				 }else{
					className = 'pickadate-enabled';
				 }               
              }

              if (date === today) {
                className += ' pickadate-today';
              }
//			  console.log(statusDates.book,date,'full',statusDates.full.indexOf(date),'book',statusDates.book.indexOf(date));
			if(statusDates.full.indexOf(date)!==-1){
				 className +=' full ';
			}
			if(statusDates.book.indexOf(date)!==-1){
				 className +=' book ';
			}
              dates.push({date: date, className: className, enabled: enabled});
            }

            scope.dates = dates;
			
          };

          scope.setDate = function(dateObj) {
            if (isDateDisabled(dateObj)) return;
            ngModel.$setViewValue(dateObj.date);
          };

          ngModel.$render = function () {
            if ((date = ngModel.$modelValue) && (indexOf.call(disabledDates, date) === -1)) {
              scope.currentDate = currentDate = dateUtils.stringToDate(date);
            } else if (date) {
              // if the initial date set by the user is in the disabled dates list, unset it
              scope.setDate(undefined);
            }
            scope.render(currentDate);
          };

          scope.changeMonth = function (offset) {
            // If the current date is January 31th, setting the month to date.getMonth() + 1
            // sets the date to March the 3rd, since the date object adds 30 days to the current
            // date. Settings the date to the 2nd day of the month is a workaround to prevent this
            // behaviour
			if(scope.allowPrevMonth&&offset==-1 ||  scope.allowNextMonth&&offset==1){
				currentDate.setDate(1);
				currentDate.setMonth(currentDate.getMonth() + offset);
				scope.render(currentDate);
				scope.onChangeMonth()(currentDate);
			}
          };

          function isDateDisabled(dateObj) {
            return (/pickadate-disabled/.test(dateObj.className));
          }
        }
      };
    }]);
})(window.angular);