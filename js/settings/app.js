  var app = angular.module('invantage',['daterangepicker','ngMessages']);
   app.directive('inputTitleValidation',function(){
        return {
            require: 'ngModel',
            link: function(scope, elm, attrs, ctrl) {
                elm.on('blur',function(e){
                    scope.$apply(function(){
                        if (!ctrl || !elm.val()) return;
                        if (elm.val().length > 3) {
                            ctrl.$setValidity('title_validation', true);
                            return true;
                        }
                        ctrl.$setValidity('title_validation', false);
                        return false;
                    });
                });
            }
        }
    });

    app.controller('promote_ctrl', function($scope, $window, $http, $document, $timeout,$interval,$compile,$filter){
      
        $scope.holidaytype = {};
        $scope.removeholiday = {};
      
        $scope.semesterdetail = {};
        $scope.show_event_type_error = true;

        $scope.sessionobj = {};
        function setsessiondate(){
             $('#sessiondate').daterangepicker({
                "autoApply": true,
                "showDropdowns": true,
                 "startDate": moment(),
                 "endDate": moment().add(1,'year'),
                // "minDate": $scope.startdate
            });
        }

        function defaultsessioninit()
        {
            try{
                
                $scope.sessionobj.date = {
                    startDate:moment(),
                    endDate: moment().add(1, "year"),
                };
              

                $scope.sessionobj.options = {
                    timePicker: false,
                    showDropdowns: true,
                    locale:{format:'MM/DD/YYYY'},
                    eventHandlers:{
                        'apply.daterangepicker': function(ev, picker){}
                    }
                }
                
                //Watch for date changes
                $scope.$watch('sessionobj.date', function(newDate) {
                }, false);
               
            }
            catch(ex)
            {
                console.log(ex)
            }
        }
        defaultsessioninit();

        /**
         * ---------------------------------------------------------
         *   load table
         * ---------------------------------------------------------
         */
        function loaddatatable()
        {
            $('#table-body-phase-tow').DataTable( {
                responsive: true,
                "order": [[ 0, "asc"  ]],
            });
        }

        var urlist = {
            getclasslist:'getclasslist',
            getsectionbyclass:'getsectionbyclass',
            getstudentbyclass:'getstudentbyclass',
            savepromotedstudents:'savepromotedstudents',
            getsessionlist:'getsessionlist',
            savesession:'savesession',
            removesession:'removesession',
            getsessiondetail:'getsessiondetail',
            getcitylist:'getcitylist',
            savelocation:'savelocation',
            removelocation:'removelocation',
            getschoollist:'getschoollist',
            saveschool:'saveschool',
            loadreleasettable:'loadreleasettable',
            saveassembly:'saveassembly',
            loadAssesmbly:'loadAssesmbly',
            loadBreak:'loadBreak',
            savebreak:'savebreak',
        }

        $scope.citylist = [];
        $scope.schoolarray = [];
        $scope.selectlistcity = []
        
        $scope.inputAdminEmail='';
        var d = new Date();
        var m = d.getMonth() + 1
        var y = d.getFullYear()

       
        $scope.sid = '';

     
        angular.element(function () {
            loadSession()
            loadSemester();
            loadSettings()
            getCitiesList();
            getSchoolList()
            loadScheduletable();
            loadAssesmbly();
         });

        function loadSession()
        {
            httprequest(urlist.getsessionlist,({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.sessionlist = response

                    //$scope.startdate = response[response.length - 1].from
                    //$scope.enddate = response[response.length - 1].to
                    //var nextyear = new Date($scope.enddate);
                    //var m = nextyear.getMonth() + 1
                    //var y = nextyear.getFullYear()+ 1
                    //$scope.enddate = m+"/"+nextyear.getDate() +"/"+y
                    $scope.inputsession = $scope.startdate +' - '+ $scope.enddate

                    for (var i = 0; i <= response.length -1; i++) {

                        if(response[i].status == 'a'){

                            $scope.inputSessionStatus = response[i].id
                        }
                    }
                }else{
                }
            });
        }

        function getSessionList()
        {
            httprequest(urlist.getsessiondetail,({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.rsessionlist = response
                    $scope.inputRSession = response[0]
                    $scope.psessionlist = response
                    $scope.inputPSession = response[0]
                }
            });
        }

        $scope.savesessiondates = function(sessionobj)
        {

            if(sessionobj.date.endDate != '')
            {

                var sdate = $scope.sessionobj.date.startDate.format('MM/DD/YYYY');
                var edate = $scope.sessionobj.date.endDate.format('MM/DD/YYYY');
            
                $scope.sessionobj.start_date =sdate;
                $scope.sessionobj.end_date =edate;

                $scope.usersavebtntext = "Saving";
                var data = ({
                    inputstartdate: moment($scope.sessionobj.start_date).format('l') ,
                    inputenddate:moment($scope.sessionobj.end_date).format('l'),
                    inputsessionid:sessionobj.serial
                })
                jQuery("#sessiondate").css("border", "1px solid #C9C9C9");
                httppostrequest(urlist.savesession,data).then(function(response){
                    console.log(response.exists);
                    if(response != null && response.message == true)
                    {
                        message('Session added','show')
                        loadSession()
                        $scope.sessionobj.serial = ''
                    
                    }
                    
                    else{
                        if(response.date_not_match == "DateNotMatch")
                        {
                            message('Session not create in these days','show')
                        }
                        else if(response.exists == "Exists")
                        {
                            message('Session Date already Exists','show')
                        }
                           $scope.usersavebtntext = "Save";
                            $scope.semesterdetail = {};
                            
                            defaultdate();
                        }
                    $scope.usersavebtntext = "Save";
                });
            }
            else{
                jQuery("#sessiondate").css("border", "1px solid red");
            }
        }

         function loadScheduletable()
        {
            httprequest(urlist.loadreleasettable,({})).then(function(response){
                if(response.s_status!= null ||response.t_status!=null)
                {
                     if(response.t_status == 1)
                    {
                        $scope.EnableSchedullar = '111'
                    }
                    else if(response.s_status == 1)
                    {
                     $scope.EnableSchedullar = '222'
                    }


                }
            });
        }

        $scope.editsession = function(sessionid)
        {

                $scope.sid = sessionid
                var data = ({
                    inputsessionid:$scope.sid

                })

               httprequest(urlist.getsessionlist,data).then(function(response){
                    if(response != null)
                    {
                         $scope.sessionobj.date = {
                            startDate:moment(response.from),
                            endDate: moment(response.to),
                        };
                        $scope.sessionobj.serial = response.id
                      
                    }
                });
        }

        $scope.removesession = function(sessionid)
        {
            $("#delete_dialog").modal('show');
            $scope.sid = sessionid
        }

        $(document).on('click','#save',function(){
            $("#delete_dialog").modal('hide');
            var data = ({
                inputsessionid:$scope.sid
            })

           httprequest(urlist.removesession,data).then(function(response){
                if(response != null)
                {
                   message('Session removed','show')
                   loadSession()
                   $scope.sid = ''
                }
            });
        });

        $scope.semesterid = 0;

        function loadSemester()
        {
            try{
                var data = ({inputsemesterid:$scope.semesterid})

                httprequest('getsemesterdata',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.semesterlist = response;
                        for (var i = 0; i <= response.length -1; i++) {
                            if(response[i].status == 'a'){
                                $scope.inputCurrentSemester = response[i].id
                                $scope.semesterdetail.semester = response[i].id;
                            }
                        }
                    }
                    else{
                        $scope.semesterlist = [];
                    }
                })
            }
            catch(ex){}
        }

         $scope.savesemester = function()
        {
            if($scope.inputSemester != null && $scope.inputSemester != '')
            {
                var data = ({
                    inputsemestername:$scope.inputSemester,
                    inputsemesterid:parseInt($scope.semesterid)

                })
                jQuery("#inputSemester").css("border", "1px solid #C9C9C9");
                var $this = $(".save-semester");
                $this.button('loading');

                httppostrequest('savesemester',data).then(function(response){
                    if(response != null && (response.message == true || response.greater == "Greater"))
                    {
                       if(response.greater == "Greater")
                       {
                           $this.button('reset');
                        message('You cannot add more than two semesters','show')
                       }
                       else{
                        $scope.semesterid = 0
                        $scope.inputSemester = '',
                        $scope.semesterdetail = {};
                        $this.button('reset');
                        message('Semester added','show')
                        loadSemester()
                    }
                    }
                    else{
                        message('Semester data not added','show')
                    }
                });
            }
            else{
                jQuery("#inputSemester").css("border", "1px solid red");
                message('Semester name should be three character long','show')
            }
        }

        $scope.editsemester = function(semid)
        {
            try{
                var data = ({inputsemesterid:semid})

                httprequest('getsemesterdata',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.inputSemester = response[0].name;
                        $scope.semesterid =response[0].id
                    }
                    else{
                        $scope.inputSemester = '';
                    }
                })
            }
            catch(ex){}
        }

        $scope.Release=function()
        {
            $is_Timetable=$('#EnableTimetable').is(":checked");
            $is_Schedullar=$('#EnableSchedullar').is(":checked");
            $scope.list = [];

            var data = ({
                        inputTimetable:$is_Timetable,
                        inputchedullar:$is_Schedullar
                    })

            httppostrequest('releasettable',data).then(function(response){
                if(response.s_status!= null ||response.t_status!=null)
                {
                    if(response.t_status == 1)
                    {
                        $scope.EnableSchedullar = '111'
                    }
                    else if(response.s_status == 1)
                    {
                        $scope.EnableSchedullar = '222'
                    }
                }
            });
        }

        $scope.setCurrentSemester = function(csem)
        {
             try{
                $scope.inputCurrentSemester = csem
                var data = ({
                    inputsetcurrentsemester:parseInt($scope.inputCurrentSemester)
                })

                httppostrequest('changesemester',data).then(function(response){
                    if(response != null && response.message == true)
                    {
                        message('Semester set','show')
                    }
                    else{
                        message('Semester  not set','show')
                    }
                });
            }
            catch(ex){}
        }

        $scope.sessionobj.activeid = null;

        $scope.setCurrentSession = function(sessionid)
        {
            try{
                 $("#changeSession").modal('show');
                $scope.sessionobj.activeid = parseInt(sessionid)
               
            }
            catch(ex){}
        }
        
        $scope.deactiveselectedsession = function()
        {
            try{
                loadSession();
            }
            catch(ex){}
        }

        $("#changeSession").on("hidden.bs.modal", function () {
            
             $scope.sessionobj.activeid = null;
        });


         $scope.changeSchoolSesion = function()
        {
            try{
                if($scope.sessionobj.activeid != null)
                {
                    var data = ({
                        inputsetcurrentsession:$scope.sessionobj.activeid
                    })

                    httppostrequest('changesession',data).then(function(response){
                        $("#changeSession").modal('hide');
                        if(response != null && response.message == true)
                        {
                            $scope.sessionobj.activeid = null;
                            message('Session set','show')
                        }
                        else{
                            message('Session  not set','show')
                        }
                    });
                }else{
                    message('Semester  not set','show');
                }
            }
            catch(ex){}
        }


        $scope.removesemester = function(sessionid)
        {
            $("#delete_dialog").modal('show');
            $scope.semesterid = sessionid
        }

        $(document).on('click','#save',function(){
            $("#delete_dialog").modal('hide');
            var data = ({
                inputsemesterid:$scope.semesterid
            })

           httprequest('removesemester',data).then(function(response){
                if(response != null)
                {
                   message('Semester removed','show')
                   loadSemester()
                   $scope.semesterid = 0
                }else{
                    message('Semester not remove','show')

                   $scope.semesterid = 0
                }
            });
        });

       $scope.EnableTimeTable=function()
       {

        $is_release=$('#inputTimeTable').is(":checked");

        $scope.inputRelease=$is_release;
        httppostrequest('ReleaseTimetable',$is_release);
        alert();

       }
       $scope.EnableShedullar=function()
       {

            $is_release=$('#inputShedullar').is(":checked");

            $scope.inputRelease=$is_release;
            httppostrequest('ReleaseTimetable',$is_release);
            alert();


       }


       function loadSettings()
        {
            try{
                var data = ({})

                httprequest('getoptionlist',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.inputAdminEmail = response[0].value;

                    }
                    else{
                        $scope.inputAdminEmail = ''
                    }
                })
            }
            catch(ex){}
        }

        $scope.saveadminsettings = function()
        {
            try{

                // if($scope.inputAdminEmail.length > 0){
                    var reg = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/i);
                    debugger
                    if(reg.test($scope.inputAdminEmail) == false){
                        jQuery("#inputAdminEmail").css("border", "1px solid red");
                        return false;
                    }

                    else
                    {
                        jQuery("#inputAdminEmail").css("border", "1px solid #C9C9C9");
                        
                    }

                    var $this = $(".email-btn");
                    $this.button('loading');
                    var data = ({
                        inputemail:$scope.inputAdminEmail
                    })

                    httppostrequest('addadminemail',data).then(function(response){
                        if(response != null && response.message == true)
                        {
                            $this.button('reset');
                            message('Email saved','show')
                        }
                        else{
                            $this.button('reset');
                            message('Email does not save.','show')
                        }
                    });
                //}
            }
            catch(ex)
            {
                
            }
        }

        function getCitiesList()
        {
             try{
                var data = ({})

                httprequest('getcitylist',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.citylist = response;
                        $scope.selectlistcity = response
                        $scope.inputCity = response[0]
                        $scope.inputSelectList = response[0]
                    }
                    else{
                        $scope.citylist = []
                    }
                })
            }
            catch(ex){}
        }

        $scope.locid = 0
        $scope.savelocation = function()
        {

            var reg = new RegExp(/^[A-Za-z0-9\s]{3,50}$/);


            if(reg.test(jQuery("#inputLocation").val()) == true)
            {
                jQuery("#location_error").hide();
                var $this = $(".location-btn");
                $this.button('loading');

                var data = ({
                    inputlocation:$scope.inputLocation,
                    inputlocationid:$scope.locid

                })
                jQuery("#inputLocation").css("border", "1px solid #C9C9C9");
                httppostrequest(urlist.savelocation,data).then(function(response){
                    if(response != null && response.message == true)
                    {
                        message('Location has been successfully saved','show');
                        getCitiesList()
                        $scope.inputLocation = null;
                        $scope.locid = 0;
                        $this.button('reset');
                    }else{
                       $this.button('reset');
                    }
                });
            }
            else{
                jQuery("#inputLocation").css("border", "1px solid red");
                //jQuery("#location_error").show();
                message('Please enter location name character between 3-56','show')

            }
        }

        $scope.editlocation = function(locationid)
        {

            $scope.locid = locationid
            var data = ({
                singlecity:$scope.locid
            })

           httprequest(urlist.getcitylist,data).then(function(response){
                if(response != null)
                {
                    $scope.inputLocation = response[0].name;
                }
            });
        }

        $scope.removelocation = function(locationid)
        {
            $("#delete_location").modal('show');
            $scope.locid = locationid
        }

        $(document).on('click','#remove_location',function(){
            $("#delete_location").modal('hide');
            var data = ({
                inputlocationid:$scope.locid
            })

           httprequest('removelocation',data).then(function(response){
                if(response != null)
                {
                   message('Location removed','show')
                   getCitiesList()
                   $scope.locid = 0
                }else{
                    message('Location not remove','show')

                   $scope.locid = 0
                }
            });
        });

        function getSchoolList()
        {
             try{
                var data = ({})
                httprequest('getschoollist',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.schoolarray = response;
                    }
                    else{
                        $scope.schoolarray = []
                    }
                })
            }
            catch(ex){}
        }

        $scope.schid = 0
        $scope.saveschool = function()
        {
            var reg = new RegExp(/^[A-Za-z0-9 ]{3,50}$/);
            if(reg.test($("#inputSchoolName").val()) == true)
            {
                var $this = $(".school-btn");
                $this.button('loading');

                var data = ({
                    inputschoolname:$scope.inputSchoolName,
                    inputlocationid:$scope.inputSelectList.id,
                    inputschoolid:$scope.schid

                })

                jQuery("#inputSchoolName").css("border", "1px solid #C9C9C9");
                httppostrequest(urlist.saveschool,data).then(function(response){
                    if(response != null && response.message == true)
                    {
                        message('School has been successfully added','show')
                        getSchoolList()
                        $scope.inputSchoolName = ''
                         $scope.schid = 0
                        $this.button('reset');
                    }else{
                        message('School did not add','show')
                        $this.button('reset');
                    }
                });
            }
            else{
                jQuery("#inputSchoolName").css("border", "1px solid red");
                message('Please enter school name character between 3-56','show')
            }
        }

        $scope.editschool = function(schoolid)
        {

            $scope.schid = schoolid
            var data = ({
                singleschool:$scope.schid
            })

           httprequest(urlist.getschoollist,data).then(function(response){
                if(response != null)
                {
                    var selectedcity  = cityfind(response[0].cityid)

                    $scope.inputSchoolName = response[0].sname;
                    $scope.inputSelectList = $scope.selectlistcity[selectedcity];
                }
            });
        }

        function cityfind(cityid)
        {
            for (var i = 0; i < $scope.selectlistcity.length; i++) {
                if($scope.selectlistcity[i].id == cityid)
                {
                    return i;
                }
            }
        }
        $scope.removeschool = function(schoolid)
        {
            $("#delete_school").modal('show');
            $scope.schid = schoolid
        }

        $(document).on('click','#remove_school',function(){
            $("#delete_school").modal('hide');
            var data = ({
                inputschoolid:$scope.schid
            })

           httprequest('removeschool',data).then(function(response){
                if(response != null)
                {
                   message('School has been successfully removed','show')
                   getSchoolList()
                   $scope.schid = 0
                }else{
                    message('School did not remove','show')

                   $scope.schid = 0
                }
            });
        });

        $scope.holidaytypelist = [];
        getHolidaytypes();
        function getHolidaytypes()
        {
            httprequest('getholidaytype',{}).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.holidaytypelist = response;
                }else{
                   $scope.holidaytypelist = []
                }
            });
        }

        $scope.saveholidaytype = function(type)
        {
            try{

                if(typeof type.title != 'undefined')
                {
                    if(type.title.length > 3 && type.title.length <= 256 )
                    {
                        $scope.show_event_type_error = true;
                         $scope.usersavebtntext = "Saving";
                        httppostrequest('saveholidaytype',type).then(function(response){
                            if(response != null)
                            {
                                $scope.holidaytype.serial = '';
                                $scope.holidaytype.id = '';
                                $scope.holidaytype.title = '';
                            
                                getHolidaytypes();
                                $scope.usersavebtntext = "Save";
                            }else{
                               $scope.usersavebtntext = "Save";
                            }
                        });
                    }
                    
                }else{
                   $scope.show_event_type_error = false; 
                }
            }
            catch(e){}
            
        }

        $scope.editholidaytype = function(type)
        {
            $scope.holidaytype = type;
        }

        $scope.removeholidaytype = function(type)
        {
            $("#delete_holidaytype").modal('show');
            $scope.removeholiday = type;
        }

        $scope.holidayremoveclick = function()
        {
           if($scope.removeholiday)
            {
                httprequest('removeholidaytype',$scope.removeholiday).then(function(response){
                    if(response != null && response.message == true)
                    {
                        $("#delete_holidaytype").modal('hide');
                        $scope.removeholiday = {};
                        $scope.holidaytype.serial = '';
                        getHolidaytypes();
                    }else{
                      
                    }
                });
            }
        }

        
        // Initialize default date
        function defaultdate()
        {
            try{
                
                if($scope.is_active_semester.length < 0)
                {
                    $scope.semesterdetail.date = {
                        startDate:moment().format('MM/DD/YYYY'),
                        endDate: moment().add(6, "month").format('MM/DD/YYYY'),
                    };
                }else{
                    $scope.semesterdetail.date = {
                        startDate:moment($scope.is_active_semester[0].end_date).format('MM/DD/YYYY'),
                        endDate: moment($scope.is_active_semester[0].end_date).add(+1,"day").add(6, "month").format('MM/DD/YYYY'),
                    };
                }
                

                $scope.options = {
                    timePicker: false,
                    showDropdowns: true,
                    locale:{format:'MM/DD/YYYY'},
                    // "minDate": ($scope.is_active_semester.length > 0  ? moment($scope.is_active_semester[0].end_date).format('MM/DD/YYYY')  : moment().format('MM/DD/YYYY'))  ,
                    // "maxDate": ($scope.is_active_semester.length > 0  ? moment($scope.is_active_semester[0].end_date).add(+1,"day").add(6, "month") : moment().add(6, "month").format('MM/DD/YYYY'))  ,
                    eventHandlers:{
                        'apply.daterangepicker': function(ev, picker){}
                    }
                }
                
                //Watch for date changes
                $scope.$watch('semesterdetail.date', function(newDate) {
                }, false);
               
            }
            catch(ex)
            {
                console.log(ex)
            }
        }

        $scope.is_active_semester = [];
        getSemesterDetail();
        function getSemesterDetail()
        {
            httprequest('getsemesterdetail',{}).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.semester_detail_list = response;
                    $scope.is_active_semester = $filter('filter')(response,{status:'a'},true);
                    if($scope.is_active_semester.length > 0)
                    {
                        $scope.InputActiveSem = $scope.is_active_semester[0].id;
                        defaultdate();
                    }
                }else{
                   $scope.semester_detail_list = [];
                   defaultdate();
                }
            });
        }
        
        $scope.savesemesterdetail = function(semesterdetail)
        {

            try{
                if(semesterdetail.date != '' && semesterdetail.semester)
                {
                    $scope.usersavebtntext = "Saving";
                 
                    var sdate = moment($scope.semesterdetail.date.startDate).format('MM/DD/YYYY');
                    var edate = moment($scope.semesterdetail.date.endDate).format('MM/DD/YYYY');
                
                    $scope.semesterdetail.start_date =sdate;
                    $scope.semesterdetail.end_date =edate;

                    httppostrequest('savesemesterdetail',semesterdetail).then(function(response){
                        if(response != null && response.message == true)
                        {
                            $scope.semesterdetail.serial = '';
                            $scope.usersavebtntext = "Save";
                            $scope.semesterdetail = {};
                            message('Session added','show');
                            defaultdate();
                            getSemesterDetail();
                          
                            $scope.semesterdetail.semester = $scope.semesterlist[0].id;
                        }else{
                            if(response.exists == "Exists")
                                {
                                    message('Semester Date already Exists','show');
                                }
                            else
                                {
                                    message('Semester Date not mateched in session dates','show');
                                }

                            $scope.usersavebtntext = "Save";
                            $scope.semesterdetail = {};
                            // message('Something is wrong','show');
                            defaultdate();
                        }
                    });
                }
            }
            catch(e)
            {
                console.log(e)
            }
        }

        $scope.editsemesterdetail = function(semesterdetail)
        {
            try{
                $scope.semesterdetail = semesterdetail;
                $scope.semesterdetail.date = {
                    startDate:moment(semesterdetail.start_date),
                    endDate: moment(semesterdetail.end_date),
                };
              }
            catch(e)
            {
                console.log(e)
            }
        }
        
        $scope.semesterdetailid = null
        // remove form
        $scope.removesemesterdetail = function(semesterdetail)
        {
            $("#MyModal").modal('show');
            $scope.semesterdetailid = semesterdetail.id;
        }

        $scope.removesemesterbyuser = function()
        {
            if(typeof $scope.semesterdetailid !== "undefined" && $scope.semesterdetailid)
            {

                try{
                    var data = {
                        id : $scope.semesterdetailid,
                    }
                    httppostrequest('removesemesterdate',data).then(function(response){
                        if(typeof response != 'undefined' && response)
                        {
                            $scope.semesterdetail.serial = '';
                            $scope.semesterdetailid = '';
                            $scope.removeid = null;
                             getSemesterDetail();
                        }
                    }); 
                }
                catch(e){}
            }
            $("#MyModal").modal('hide');
        }

    
        $("#MyModal").on("hidden.bs.modal", function () {
            $scope.removeid = null;
            $scope.semesterdetailid = null
        });

        $scope.gradeobj = {};
        $scope.gradelist = [];
        $scope.savegrade = function(gradeobj)
        {
            try{
                if(gradeobj.title && gradeobj.lower_limit && gradeobj.upper_limit)
                {
                    $scope.usersavebtntext = "Saving";

                    httppostrequest('savegrade',gradeobj).then(function(response){
                        if(response != null && response.message == true)
                        {
                            $scope.gradeobj = {};
                            $scope.usersavebtntext = "Save";
                            getGradeList();
                          
                        }else{
                           $scope.usersavebtntext = "Save";
                        }
                    });
                }
            }
            catch(e)
            {
                console.log(e)
            }
        }

        $scope.editgrade = function(grade)
        {
            $scope.gradeobj = grade;
        }

        $scope.removegrade = function(grade)
        {
            $("#RemoveGrade").modal();
            $scope.graderowid = grade.id;
        }

        $scope.removeGradepoint = function()
        {
            if(typeof $scope.graderowid !== "undefined" && $scope.graderowid)
            {
                try{
                    var data = {
                        id : $scope.graderowid,
                    }
                    httppostrequest('removegrade',data).then(function(response){
                        if(typeof response != 'undefined' && response)
                        {
                            $scope.graderowid = '';
                            getGradeList();
                        }
                    }); 
                }
                catch(e){}
            }
            $("#RemoveGrade").modal('hide');
        }

    
        $("#RemoveGrade").on("hidden.bs.modal", function () {
            $scope.graderowid = null;
        });

        getGradeList();
        function getGradeList()
        {
            try{
                httprequest('getgradelist',{}).then(function(response){
                    if(response != null && response.length > 0)
                    {
                        $scope.gradelist = response;
                    }else{
                       $scope.gradelist = []
                    }
                });
            }
            catch(e){}
        }
       
        $scope.semesterdetail.activeid = null;
        $scope.changesemesterdate = function(makesemsteractive)
        {
            try{
                $("#changeSemesterModal").modal('show');
                $scope.semesterdetail.activeid = makesemsteractive.id
            }
            catch(ex){}
        }

        $scope.deactiveselectedsemester = function()
        {
            try{
                getSemesterDetail();
            }
            catch(ex){}
        }

        $("#changeSemesterModal").on("hidden.bs.modal", function () {
            
            $scope.semesterdetail.activeid = null;
        });

        $scope.setSemesterActive = function()
        {
            try{
                if($scope.semesterdetail.activeid != null)
                {
                    var data = ({
                        inputSemester:$scope.semesterdetail.activeid
                    });

                    httppostrequest('makeactivesemesterdates',data).then(function(response){
                        $("#changeSemesterModal").modal('hide');
                        if(response != null && response.message == true)
                        {
                            message('Semester set','show')
                            $scope.semesterdetail.activeid = null;
                        }
                        else{
                            message('Semester  not set','show')
                        }

                    });
                }else{
                    message('Semester  not set','show');
                }
            }
            catch(ex){}
        }


        function httprequest(url,data)
        {
            var request = $http({
                method:'get',
                url:url,
                params:data,
                headers : {'Accept' : 'application/json'}
            });
            return (request.then(responseSuccess,responseFail))
        }

        function httppostrequest(url,data)
        {
            var request = $http({
                method:'POST',
                url:url,
                data:data,
                headers : {'Accept' : 'application/json'}
            });
            return (request.then(responseSuccess,responseFail))
        }

        function responseSuccess(response){
            return (response.data);
        }

        function responseFail(response){
            return (response.data);
        }

        // load Assembly
        loadAssesmbly();
        function loadAssesmbly()
        {
            try{
                httprequest('getassemblydata',{}).then(function(response){
                    if(response != null && response.length > 0)
                    {
                        $scope.assemblydata = response;

                    }else{
                       $scope.assemblydata = []
                    }
                });
            }
            catch(e){}
        }
        // save Assembly
        $scope.saveassembly = function(assemblyobj)
        {
            
            try{
                
                if(assemblyobj.starttime && assemblyobj.endtime)
                {

                    $scope.usersavebtntext = "Saving";
                    
                    httppostrequest('saveassembly',assemblyobj).then(function(response){
                        
                        if(response != null && response.message == true)
                        {
                            $scope.assemblyobj = {};
                            $scope.usersavebtntext = "Save";
                            message('Assembly time save successfully','show');
                            loadAssesmbly();
                          
                        }else{
                            message('End time must be greater Start time','show');
                            $scope.usersavebtntext = "Save";
                        }
                    });
                }
            }
            catch(e)
            {

                console.log(e)
            }
        }
        // load Break
        loadBreak();
        function loadBreak()
        {
            try{
                httprequest('getbreakdata',{}).then(function(response){
                    if(response != null && response.length > 0)
                    {
                        $scope.breakdata = response;

                    }else{
                       $scope.breakdata = []
                    }
                });
            }
            catch(e){}
        }
        // Save Break
        
        $scope.savebreak = function(breakobj)
        {
            
            try{
                //if(breakobj.monstarttime && breakobj.monendtime)
                if(breakobj.monstarttime && breakobj.monendtime && breakobj.tusstarttime && breakobj.tusendtime && breakobj.wedstarttime && breakobj.wedendtime && breakobj.thrstarttime && breakobj.threndtime && breakobj.fristarttime && breakobj.friendtime)
                {
                    $scope.usersavebtntext = "Saving";
                    
                    httppostrequest('savebreak',breakobj).then(function(response){
                        
                        if(response != null && response.message == true)
                        {
                            $scope.breakobj = {};
                            $scope.usersavebtntext = "Save";
                            message('Break time save successfully','show');
                            loadBreak();
                          
                        }else{
                            message('End time must be greater Start time','show');
                            $scope.usersavebtntext = "Save";
                        }
                    });
                }

            }
            catch(e)
            {

                console.log(e)
            }
        }
});
