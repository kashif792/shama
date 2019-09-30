  var app = angular.module('invantage', []);
  app.controller('promote_ctrl', function($scope, $window, $http, $document, $timeout, $interval, $compile) {
  	$scope.str = []


  	function setsessiondate() {
  		$('#sessiondate').daterangepicker({
  			"autoApply": true,
  			"showDropdowns": true,
  			"startDate": $scope.startdate,
  			"endDate": $scope.enddate,
  			"minDate": $scope.startdate
  		});
  	}

  	/**
  	 * ---------------------------------------------------------
  	 *   load table
  	 * ---------------------------------------------------------
  	 */
  	function loaddatatable() {
  		$('#table-body-phase-tow').DataTable({
  			responsive: true,
  			"order": [
  				[0, "asc"]
  			],
  		});
  	}

  	var urllist = {
  		getclasslist: 'getclasslist',
  		getsemesterdata: 'getsemesterdata',
  		getschedular: 'getschedular',
  		saveschedular: 'saveschedular'
  	}

  	angular.element(function() {
  		getclasslist()

  	});

  	function getclasslist() {
  		httprequest(urllist.getclasslist, ({})).then(function(response) {
  			if (response != null && response.length > 0) {
  				$scope.classlist = response
  				$scope.select_class = response[0]
  				getSemesterData();
  			}
  		});
  	}

  	function getSemesterData() {
  		try {
  			httprequest(urllist.getsemesterdata, ({})).then(function(response) {
  				if (response.length > 0 && response != null) {
  					$scope.semesterlist = response;
  					$scope.inputSemester = response[0];
  					getschedular()
  				} else {
  					$scope.semesterlist = [];
  				}
  			})
  		} catch (ex) {}
  	}

  	$scope.changeclass = function() {
  		getschedular()
  	}

  	$scope.changesemester = function() {
  		getschedular()
  	}

  	$scope.schedular = []

  	function getschedular() {
  		try {
  			var data = ({
  				classid: $scope.select_class.id,
  				semesterid: $scope.inputSemester.id
  			})
        message('','hide')
  			httprequest(urllist.getschedular, data).then(function(response) {
  				$scope.str = [];
  				var appstr = '';
  				if (response.length > 0 && response != null) {
  					$scope.schedular = response

  					for (var i = 0; i < response.length; i++) {
  						var subjectarray = [];
  						for (var k = 0; k < response[i].lesson.length; k++) {
  							var lessondetail = [];

  							for (var l = 0; l <= response[i].lesson[k].lessondetail.length - 1; l++) {
  								var icon = '<i class="fa fa-picture-o" aria-hidden="true"></i>';
  								if (response[i].lesson[k].lessondetail[l].type == 'Video') {
  									var icon = '<i class="fa fa-video-camera" aria-hidden="true"></i>';
  								}
  								if (response[i].lesson[k].lessondetail[l].type == 'Text') {
  									var icon = '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
  								}
  								if (response[i].lesson[k].lessondetail[l].type == 'Document') {
  									var icon = '<i class="fa fa-file-word-o" aria-hidden="true"></i>';
  								}
  								if (response[i].lesson[k].lessondetail[l].type == 'Application') {
  									var icon = '<i class="fa fa-tablet" aria-hidden="true"></i>';
  								}

  								var templesson = {
  									"text": response[i].lesson[k].lessondetail[l].name,
  									"lessonid": response[i].lesson[k].lessondetail[l].id,
  									"subjectid": response[i].lesson[k].subid,
  									"lessonposition": parseInt(i) + 1,
  								}
  								$scope.str.push(templesson)
  								appstr += '<li id="menuItem_' + i + '" data-position-id="'+response[i].lesson[k].position+'" data-lesson-id="' + response[i].lesson[k].lessondetail[l].id + '" data-subject-id="' + response[i].lesson[k].subid + '"><div>' + icon + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + response[i].lesson[k].lessondetail[l].name + ' &nbsp;&nbsp;(' + response[i].lesson[k].subject + ')' + '</div></li>';
  							}
  						}
  					}

  					// editor.setData(JSON.stringify(str));
  					$(".sortable").html('')
  					$(".sortable").html(appstr)
            document.getElementById("btnReload").disabled = false;
  					createlist()
  				} else {
            document.getElementById("btnReload").disabled = true;
            $(".sortable").html('')
            	$(".sortable").html(appstr)
              message('No lesson found','show')
  					//  editor.setData(JSON.stringify(str));
  				}
  			})

  		} catch (ex) {}
  	}


  	function createlist() {

  		$('.sortable').nestedSortable({
  			handle: 'div',
  			items: 'li',
  			toleranceElement: '> div',

  			placeholder: 'placeholder',
  			revert: 250,
  			tolerance: 'pointer',

  			tolerance: 'pointer',
  			toleranceElement: '> div',



  			// Set this to true to lock the parentship of items.
  			// They can only be re-ordered within theire current parent container.
  			disableParentChange: true,

  			// Set this to true if you don't want empty lists to be removed.
  			doNotClear: true,

  			// How long (in ms) to wait before expanding a collapsed node
  			// useful only if isTree: true
  			expandOnHover: 700,

  			// You can specify a custom function to verify if a drop location is allowed.
  			isAllowed: function() {
  				return true;
  			},

  			// Set this to true if you want to use the new tree functionality.
  			isTree: false,

  			// The list type used (ordered or unordered).
  			listType: "ol",

  			// The maximum depth of nested items the list can accept.
  			maxLevels: 0,

  			// Whether to protect the root level
  			protectRoot: true,

  			// The id given to the root element
  			rootID: null,

  			// Set this to true if you have a right-to-left page.
  			rtl: false,

  			// Set this to true if you want the plugin to collapse the tree on page load
  			startCollapsed: false,

  			// How far right or left (in pixels) the item has to travel in order to be nested or to be sent outside its current list.
  			tabSize: 20,
  			// custom classes
  			branchClass: "mjs-nestedSortable-branch",
  			collapsedClass: "mjs-nestedSortable-collapsed",
  			disableNestingClass: "mjs-nestedSortable-no-nesting",
  			errorClass: "mjs-nestedSortable-error",
  			expandedClass: "mjs-nestedSortable-expanded",
  			hoveringClass: "mjs-nestedSortable-hovering",
  			leafClass: "mjs-nestedSortable-leaf",
  			disabledClass: "mjs-nestedSortable-disabled"
  		});
  	}

  	function updatelist(subjectid, lessonid, position) {
  		for (var i = 0; i < $scope.schedular.length; i++) {
  			var subjectarray = [];
  			for (var k = 0; k < $scope.schedular[i].lesson.length; k++) {
  				var lessondetail = [];
  				for (var l = 0; l < $scope.schedular[i].lesson[k].lessondetail.length; l++) {
  					if ($scope.schedular[i].lesson[k].subid == subjectid && ((parseInt(i) + 1) > (parseInt(position))) && ((parseInt(i) + 1) != (parseInt(position)))) {
  						var icon = '<i class="fa fa-picture-o" aria-hidden="true"></i>';
  						if ($scope.schedular[i].lesson[k].lessondetail[l].type == 'Video') {
  							var icon = '<i class="fa fa-video-camera" aria-hidden="true"></i>';
  						}
  						if ($scope.schedular[i].lesson[k].lessondetail[l].type == 'Text') {
  							var icon = '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
  						}
  						if ($scope.schedular[i].lesson[k].lessondetail[l].type == 'Document') {
  							var icon = '<i class="fa fa-file-word-o" aria-hidden="true"></i>';
  						}
  						if ($scope.schedular[i].lesson[k].lessondetail[l].type == 'Application') {
  							var icon = '<i class="fa fa-tablet" aria-hidden="true"></i>';
  						}

  						var templesson = {
  							"text": icon + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + $scope.schedular[i].lesson[k].lessondetail[l].name + ' &nbsp;&nbsp;(' + $scope.schedular[i].lesson[k].subject + ')',
  							"lessonid": $scope.schedular[i].lesson[k].lessondetail[l].id,
  							"subjectid": $scope.schedular[i].lesson[k].subid,
  						}

  						var li = $("li[data-subject-id='" + $scope.schedular[i].lesson[k].subid + "'][data-lesson-posistion='" + (parseInt(i) + 1) + "']");
  						li.find('div span.txt').html(icon + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + $scope.schedular[i].lesson[k].lessondetail[l].name + ' &nbsp;&nbsp;(' + $scope.schedular[i].lesson[k].subject + ')')
  					}
  				}
  			}
  		}
  	}

  	function findlesson(lessonname, iindex, kindex) {
  		for (var i = iindex; i < $scope.schedular.length; i++) {
  			for (var k = kindex; k < $scope.schedular[i].lesson.length; k++) {
  				for (var l = 0; l < $scope.schedular[i].lesson[k].lessondetail.length; l++) {
  					if (lessonname == $scope.schedular[i].lesson[k].lessondetail[l].name) {
  						return $scope.schedular[i].lesson[k].lessondetail[l].name
  					}
  				}
  			}
  		}
  	}

  	function findsubject(subjectname, inx) {
  		for (var i = inx; i < $scope.schedular.length; i++) {
  			for (var k = 0; k < $scope.schedular[i].lesson.length; k++) {
  				if (subjectname == $scope.schedular[i].lesson[k].subject) {
  					return $scope.schedular[i].lesson[k].subid
  				}
  			}
  		}
  	}

  	$scope.saveschedular = function() {
  		var $this = $("#btnReload");
  		$this.button('loading');
  		var finallist = []
      var position = 1;
  		$("ol.sortable li").each(function() {
  			var schedularlist = []
  			var temp = {
  				lessonid: $(this).attr('data-lesson-id'),
  				subjectid: $(this).attr('data-subject-id'),
  				position: position,
  			}
  			finallist.push(temp)
        position++;
  		})
  		var data = ({
  			classid: $scope.select_class.id,
  			semesterid: $scope.inputSemester.id,
  			schedulardata: finallist
  		})
  		message("", 'hide');
  		httppostrequest(urllist.saveschedular, data).then(function(response) {
  			if (response.message == true && response != null && response != undefined) {
  				message("Schedular saved", 'show');
  				$this.button('reset');
  			} else {
  				message("Schedular not saved", 'show');
  				$this.button('reset');
  			}
  		});

  	}

  	function httprequest(url, data) {
  		var request = $http({
  			method: 'get',
  			url: url,
  			params: data,
  			headers: {
  				'Accept': 'application/json'
  			}
  		});
  		return (request.then(responseSuccess, responseFail))
  	}

  	function httppostrequest(url, data) {
  		var request = $http({
  			method: 'POST',
  			url: url,
  			data: data,
  			headers: {
  				'Accept': 'application/json'
  			}
  		});
  		return (request.then(responseSuccess, responseFail))
  	}

  	function responseSuccess(response) {
  		return (response.data);
  	}

  	function responseFail(response) {
  		return (response.data);
  	}
  });
