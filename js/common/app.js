var app = angular.module('invantage', []);
app.controller('report', function($scope,inputfilters) {
	$scope.commondata = '';
	
	var urllist = {
		department:'api/department_list/format/json',
		category:'api/category_list/format/json',
		vendor:'api/vendorname_list/format/json'	
	}

	function renderdata(element,popluatedata){
		switch(element){
			case 'departments':
				$scope.departments = popluatedata;
				break;
			case 'categoies':
				$scope.categoies = popluatedata;
				break;
			case 'vendors':
				$scope.vendors = popluatedata;
				break;
		}
	}

	function departmentcall(){
		inputfilters.department(urllist.department)
		.then(
			function(responsedata){
				renderdata('departments',responsedata)
			}
		)
	}

	function categorycall(){
		inputfilters.category(urllist.category)
		.then(
			function(responsedata){
				renderdata('categoies',responsedata)
			}
		)
	}

	function vendorcall(){
		inputfilters.vendor(urllist.vendor)
		.then(
			function(responsedata){
				renderdata('vendors',responsedata)
			}
		)
	}

	loadAll();
	function loadAll(){
		departmentcall();
		categorycall();
		vendorcall();
		
	}

});

app.service('inputfilters',function($http,$q){
	return({
		department:department,
		category:category,
		vendor:vendor
	})

	function department(url)
	{
		var request = $http({
			method:'get',
			url:url,
			headers : {'Accept' : 'application/json'}
		});
		return (request.then(responseSuccess,responseFail))
	}
	
	function category(url)
	{
		var request = $http({
			method:'get',
			url:url,
			headers : {'Accept' : 'application/json'}
		});
		return (request.then(responseSuccess,responseFail))
	}

	function vendor(url)
	{
		var request = $http({
			method:'get',
			url:url,
			headers : {'Accept' : 'application/json'}
		});
		return (request.then(responseSuccess,responseFail))
	}

	function responseSuccess(response){
		return (response.data);
	}

	function responseFail(response){
		if (! angular.isObject( response.data ) || ! response.data.message) {
            return( $q.reject( "An unknown error occurred." ) );
        }
        // Otherwise, use expected error message.
        return( $q.reject( response.data.message ) );
	}
})