  var app = angular.module('invantage',[]);
    app.controller('promote_ctrl', function($scope, $window, $http, $document, $timeout,$interval,$compile){


        //var strJson = '[{"text":"Home","icon":"fa-home","href":"http://codeignitertutoriales.com"},{"text":"Youtube","icon":"fa-youtube-square","href":"https://www.youtube.com/user/davicotico"},{"text":"Github","icon":"fa-github","href":"https://github.com/davicotico","target":"_self","title":""},{"text":"Opcion4","icon":"fa-crop"},{"text":"Opcion5","icon":"fa-flask"},{"text":"Opcion6","icon":"fa-map-marker"},{"text":"Opcion7","icon":"fa-search","children":[{"text":"Opcion7-1","icon":"fa-plug"},{"text":"Opcion7-2","icon":"fa-filter"}]}]';
        var strjson1 = '[{"href":"http://home.com","icon":"fa-home","text":"Home"},{"icon":"fa-bar-chart-o","text":"Opcion2"},{"icon":"fa-cloud-upload","text":"Opcion3"},{"icon":"fa-crop","text":"Opcion4"},{"icon":"fa-flask","text":"Opcion5"},{"icon":"fa-search","text":"Opcion7","children":[{"icon":"fa-plug","text":"Opcion7-1","children":[{"icon":"fa-filter","text":"Opcion7-2","children":[{"icon":"fa-map-marker","text":"Opcion6"}]}]}]}]';
        var options = {
            hintCss: {'border': '1px dashed #13981D'},
            placeholderCss: {'background-color': 'gray'},
            ignoreClass: 'btn',
            opener: {
                active: true,
                as: 'html',
                close: '<i class="fa fa-minus"></i>',
                open: '<i class="fa fa-plus"></i>',
                openerCss: {'margin-right': '10px'},
                openerClass: 'btn btn-success btn-xs'
            },
            isAllowed: function (cEl, hint, target) {
                console.clear();

                var subjectid = cEl.attr('data-subject-id');
                var lessonid = cEl.attr('data-lesson-id');
                var posistionid = cEl.attr('data-lesson-posistion');

                if(target.attr('data-lesson-id') == undefined && hint[0].id == 'sortableListsHint')
                {
                    //updatelist(subjectid,lessonid,posistionid)
                    return true;
                }

                // if(cEl[0].id.toString() != 'Lesson' && hint[0].id == 'sortableListsHint')
                // {

                //     if(target[0] == null)
                //     {
                //         return false;
                //     }
                //     else if(target[0].id == 'Lesson'){
                //          return true;
                //     }

                // }

                // if(cEl[0].id.toString() != 'Lesson' && hint[0].id == 'sortableListsHint'   )
                // {
                //     return false;
                // }

                // if(cEl[0].id.toString() == 'Lesson' && hint[0].id == 'sortableListsHint')
                // {
                //     if(target[0] == null)
                //     {
                //         return true;
                //     }
                //     else {
                //          return false;
                //     }
                // }

                // if(cEl[0].id.toString() != 'Lesson' && hint[0].id == 'sortableListsHint' && target[0].id == 'Lesson')
                // {
                //     return true;
                // }

                //  if(cEl[0].id.toString() == 'Lesson' && hint[0].id == 'sortableListsHint' && target[0].id != 'Lesson')
                // {
                //     return false;
                // }



                return false;
            }, // Params: current el., hint el.
            onDragStart: function (e, cEl) {

              return true;
            }, // Params: e jQ. event obj., current el.
            onChange: function (cEl) {



            }, // Params: current el.
            complete: function (cEl) {


                    return true;

            }  // Params: current el.
        };

         var editor = new MenuEditor('myList', {
                            listOptions: options,
                            labelEdit: '',
                            labelRemove: 'Remove'
                        });


        function setsessiondate(){
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
        function loaddatatable()
        {
            $('#table-body-phase-tow').DataTable( {
                responsive: true,
                "order": [[ 0, "asc"  ]],
            });
        }

        var urllist = {
            getclasslist:'getclasslist',
            getsemesterdata:'getsemesterdata',
            getschedular:'getschedular'
        }

        angular.element(function () {
            getclasslist()

         });

        function getclasslist()
        {
            httprequest(urllist.getclasslist,({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.classlist = response
                    $scope.select_class = response[0]
                    getSemesterData();
                }
            });
        }

        function getSemesterData()
        {
            try{
                httprequest(urllist.getsemesterdata,({})).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.semesterlist = response;
                        $scope.inputSemester = response[0];
                        getschedular()
                    }
                    else{
                        $scope.semesterlist = [];
                    }
                })
            }
            catch(ex){}
        }

        $scope.changeclass = function()
        {
            getschedular()
        }

         $scope.changesemester = function()
        {
            getschedular()
        }

        $scope.schedular = []
        function getschedular()
        {
            try{
                var data = ({
                    classid:$scope.select_class.id,
                    semesterid:$scope.inputSemester.id
                })

                httprequest(urllist.getschedular,data).then(function(response){
                    var str = [];
                    if(response.length > 0 && response != null)
                    {
                        $scope.schedular = response

                        for (var i = 0; i < response.length; i++) {
                            var subjectarray = [];
                            for (var k = 0; k < response[i].lesson.length; k++) {
                                var lessondetail = [];

                                for (var l = 0; l <= response[i].lesson[k].lessondetail.length -1; l++) {
                                    var icon = '<i class="fa fa-picture-o" aria-hidden="true"></i>';
                                    if(response[i].lesson[k].lessondetail[l].type == 'Video')
                                    {
                                         var icon = '<i class="fa fa-video-camera" aria-hidden="true"></i>';
                                    }
                                    if(response[i].lesson[k].lessondetail[l].type == 'Text')
                                    {
                                         var icon = '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
                                    }
                                    if(response[i].lesson[k].lessondetail[l].type == 'Document')
                                    {
                                         var icon = '<i class="fa fa-file-word-o" aria-hidden="true"></i>';
                                    }
                                    if(response[i].lesson[k].lessondetail[l].type == 'Application')
                                    {
                                         var icon = '<i class="fa fa-tablet" aria-hidden="true"></i>';
                                    }

                                    var templesson = {
                                        "text":icon +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+response[i].lesson[k].lessondetail[l].name+' &nbsp;&nbsp;('+response[i].lesson[k].subject+')',
                                        "lessonid":response[i].lesson[k].lessondetail[l].id,
                                        "subjectid":response[i].lesson[k].subid,
                                        "lessonposition":parseInt(i)+1,
                                    }
                                    str.push(templesson)
                                }

                            }
                        }
                        editor.setData(JSON.stringify(str));
                    }
                    else{
                        editor.setData(JSON.stringify(str));
                    }
                })
            }
            catch(ex){}
        }

        function updatelist(subjectid,lessonid,position)
        {
            for (var i = 0; i < $scope.schedular.length; i++) {
                var subjectarray = [];
                for (var k = 0; k < $scope.schedular[i].lesson.length; k++) {
                    var lessondetail = [];
                    for (var l = 0; l < $scope.schedular[i].lesson[k].lessondetail.length; l++) {
                        if($scope.schedular[i].lesson[k].subid == subjectid && ((parseInt(i)+1) > (parseInt(position))) && ((parseInt(i)+1) != (parseInt(position))) )
                        {
                            var icon = '<i class="fa fa-picture-o" aria-hidden="true"></i>';
                            if($scope.schedular[i].lesson[k].lessondetail[l].type == 'Video')
                            {
                                 var icon = '<i class="fa fa-video-camera" aria-hidden="true"></i>';
                            }
                            if($scope.schedular[i].lesson[k].lessondetail[l].type == 'Text')
                            {
                                 var icon = '<i class="fa fa-file-text-o" aria-hidden="true"></i>';
                            }
                            if($scope.schedular[i].lesson[k].lessondetail[l].type == 'Document')
                            {
                                 var icon = '<i class="fa fa-file-word-o" aria-hidden="true"></i>';
                            }
                            if($scope.schedular[i].lesson[k].lessondetail[l].type == 'Application')
                            {
                                 var icon = '<i class="fa fa-tablet" aria-hidden="true"></i>';
                            }

                            var templesson = {
                                "text":icon +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+$scope.schedular[i].lesson[k].lessondetail[l].name+' &nbsp;&nbsp;('+$scope.schedular[i].lesson[k].subject+')',
                                "lessonid":$scope.schedular[i].lesson[k].lessondetail[l].id,
                                "subjectid":$scope.schedular[i].lesson[k].subid,
                            }

                            var li = $("li[data-subject-id='"+$scope.schedular[i].lesson[k].subid+"'][data-lesson-posistion='"+(parseInt(i)+1)+"']");
                            li.find('div span.txt').html(icon +'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+$scope.schedular[i].lesson[k].lessondetail[l].name+' &nbsp;&nbsp;('+$scope.schedular[i].lesson[k].subject+')')
                        }
                    }
                }
            }
        }

        function findlesson(lessonname,iindex,kindex)
        {
            for (var i = iindex; i < $scope.schedular.length; i++) {
                for (var k = kindex; k < $scope.schedular[i].lesson.length; k++) {
                    for (var l = 0; l < $scope.schedular[i].lesson[k].lessondetail.length; l++) {
                        if(lessonname == $scope.schedular[i].lesson[k].lessondetail[l].name)
                        {
                            return $scope.schedular[i].lesson[k].lessondetail[l].name
                        }
                    }
                }
            }
        }

        function findsubject(subjectname,inx)
        {
            for (var i = inx; i < $scope.schedular.length; i++) {
                for (var k = 0; k < $scope.schedular[i].lesson.length; k++) {
                    if(subjectname == $scope.schedular[i].lesson[k].subject)
                    {
                        return $scope.schedular[i].lesson[k].subid
                    }
                }
            }
        }

        $scope.saveschedular = function()
        {
            var str = JSON.parse(editor.getString());
            $scope.lessonlist = [];
            for (var i = 0; i < str.length; i++) {
               for (var k = 0; k < str[i].children.length; k++) {

                    var is_subject_found =    findsubject(str[i].children[k].text,i)
                    if(is_subject_found != null)
                    {
                        console.log(is_subject_found)
                    }
                    for (var l = 0; l < str[i].children[k].children.length; l++) {
                        var is_lesson_found =      findlesson(str[i].children[k].children[l].text,i,k)
                        console.log(is_lesson_found)
                    }
                }
            }
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
});
