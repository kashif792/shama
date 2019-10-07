<?php
// require_header
require APPPATH.'views/__layout/header.php';

// require_top_navigation
require APPPATH.'views/__layout/topbar.php';

// require_left_navigation
require APPPATH.'views/__layout/leftnavigation.php';
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<div class="col-sm-10 col-md-10 col-lg-10 class-page "  ng-controller="class_report_ctrl" ng-init="processfinished=false">
    <?php
        // require_footer
        require APPPATH.'views/__layout/filterlayout.php';
    ?>
   
    <div class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <!-- widget title -->
                    <div class="panel-heading">
                        <label>Mid Term Report</label>
                        <label class="right-controllers">
                            <a href="javascript:void(0)" class="link-student" ng-click="printreport()" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </label>
                        <label class="right-controllers">
                            <a href="javascript:void(0)" class="link-student" ng-click="download()" title="Download"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                            <!-- <a href="javascript:void(0)" class="link-student" onclick="getPDF()" title="Download"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a> -->
                        </label>
                    </div>
                    <div class="panel-body whide" id="class_report" >
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-inline" >
                                   
                                    <div class="form-group">
                                        <label for="inputRSession">Session:</label>
                                        <select  class="form-control" ng-options="item.name for item in rsessionlist track by item.id"  name="inputRSession" id="inputRSession"  ng-model="filterobj.session" ng-change="changeclass()" ></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="select_class">Grade:</label>
                                        <select class="form-control" ng-options="item.name for item in classlist track by item.id"  name="select_class" id="select_class"  ng-model="filterobj.class" ng-change="changeclass()"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSection">Section:</label>
                                        <select class="form-control"  ng-options="item.name for item in sectionslist track by item.id"  name="inputSection" id="inputSection"  ng-model="filterobj.section" ng-change="changeclass()"></select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSemester">Semester:</label>
                                        <select class="form-control"    ng-options="item.name for item in semesterlist track by item.id"  name="inputSemester" id="inputSemester"  ng-model="filterobj.semester" ng-change="changeclass()"></select>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="inputDate">Student:</label>
                                            <select  class="form-control" ng-options="item.name for item in studentlist track by item.id"  name="InputStudent" id="InputStudent"  ng-model="filterobj.studentid" ng-change="changestudent()" >
                                                <option style="display:none" value="">Select Student</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row padding-top canvas_div_pdf">

                            <div class="col-sm-12">
                                <div>
                                           <div>
                                            <table  class="table table-striped table-bordered row-border hover">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Obtained Marks</th>
                                                <th>Total Marks</th>
                                                <th>Grade</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="report-body">
                                           <tr ng-repeat="s in subjectlist"  ng-init="$last && finished()" >
                                                <td>{{s.subject}}</td>
                                                <td>{{s.evalution[0].mid}}</td>
                                                <td>{{s.evalution[0].total_marks}}</td>
                                                <td>{{s.evalution[0].grade}}</td>
                                                
                                            </tr>
                                            <tr ng-show="subjectlist.length > 0">
                                                <td class="blue_back">Total Obtained Marks</td>
                                                <td class="blue_back">{{obtain_marks}}</td>
                                                <td class="blue_back">{{total_marks}}</td>
                                                <td class="blue_back"></td>
                                                
                                            </tr>
                                             <tr ng-hide="subjectlist.length > 0">
                                                <td colspan="11" class="no-record">No data found</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                               
                                            </div>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
// require_footer
require APPPATH.'views/__layout/footer.php';
?>

<script src="<?php echo base_url(); ?>js/angular-datatables.min.js"></script>
<script src="<?php echo base_url(); ?>js/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>js/vfs_fonts.js"></script>
<script src="<?php echo  base_url(); ?>js/ui-bootstrap-tpls-2.5.0.js"></script>

<script type="text/javascript">
    var app = angular.module('invantage', ['daterangepicker','ui.bootstrap']);

    app.filter('periodtime', function myDateFormat($filter){
        return function(text){
            var  tempdate= new Date(text);
            return $filter('date')(tempdate, "medium");
        }
    });

    app.controller('class_report_ctrl', function($scope, $window, $http, $document, $timeout,$interval,$compile,$filter){
        $scope.filterobj = {};
        defaultdate();
       $scope.active = 1;
        $scope.fallsemester = [];

        $("#class_report").show();
         // Initialize default date
        function defaultdate()
        {
            try{
                
                $scope.filterobj.date = {
                    startDate:moment().format('MMM D, YY'),
                    endDate: moment().format('MMM D, YY'),
                };

                $scope.options = {
                    
                    eventHandlers:{
                        'apply.daterangepicker': function(ev, picker){
                            var sdate = $scope.filterobj.date.startDate.format('MMM D, YY');
                            var edate = $scope.filterobj.date.endDate.format('MMM D, YY');
                            $scope.filterobj.start_date =sdate;
                            $scope.filterobj.end_date =edate;
                            //$scope.GetEvulationHeader();
                        }
                    }
                };
            }
            catch(ex)
            {
                console.log(ex)
            }
        }

        function getSessionList()
        {
            httprequest('getsessiondetail',({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.rsessionlist = response
                    
                     var find_active_session = $filter('filter')(response,{status:'a'},true);
                    if(find_active_session.length > 0)
                    {
                        $scope.filterobj.session = find_active_session[0]
                    }
                }
                else{
                    $scope.finished();
                }
            });
        }
        
        getSessionList();

        function getClassList()
        {
            httprequest('getclasslist',({})).then(function(response){
                if(response != null && response.length > 0)
                {
                    $scope.classlist = response
                    $scope.filterobj.class = response[0]
                    loadSections();
                }
            });
        }

        getClassList();

        function loadSections()
        {
            try{
                var data = ({inputclassid:$scope.filterobj.class.id})
                httprequest('getsectionbyclass',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.sectionslist = response;
                        $scope.filterobj.section = response[0];
                        getSemesterData()
                    }
                    else{
                        $scope.sectionslist = [];
                    }
                })
            }
            catch(ex){}
        }

        function getSemesterData(){
            try{
                $scope.semesterlist = []
                httprequest('<?php echo $path_url; ?>getsemesterdata',({})).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.semesterlist = response;
                        var find_active_semester = $filter('filter')(response,{active_semster:'a'},true);
                        
                        if(find_active_semester.length > 0)
                        {
                            
                            $scope.filterobj.semester = find_active_semester[0]  ;
                            $scope.getSubjectList();
                            $scope.loadStudentByClass();
                        }

                        // var temp = {
                        //     id:'b',
                        //     name:'Both',
                        //     status:'i'
                        // }

                        // $scope.semesterlist.push(temp);
                        
                    
                    }
                    else{
                        $scope.semesterlist = [];
                    }
                });
             }
            catch(ex){}
        }

        $scope.toogleform = function()
        {
            $scope.is_form_toggle = !$scope.is_form_toggle;
        }

        $scope.getSubjectList = function()
        {
            try{
                if($scope.filterobj.class && $scope.filterobj.semester)
                {
                     var data ={
                        inputclassid:$scope.filterobj.class.id,
                        inputsemesterid:$scope.filterobj.semester.id,
                        inputsessionid:$scope.filterobj.session.id,
                    }
                    
                    httppostrequest('classreportsubjects',data).then(function(response){
                        if(response.length > 0 && response != null)
                        {
                            //$scope.subjectlist = response;
                             
                            $scope.filterobj.subjectid = response[0];
                           // $scope.GetEvulationHeader();
                           
                        }
                        else{
                            $scope.subjectlist = [];
                         
                        }
                    });
                }
            }
            catch(e){}
        }
        

        $scope.selectedSubject = function(subject,index)
        {
            $scope.filterobj.subjectid = subject;
            $scope.eprocessfinished = false;
            getQuizDetail();
        }

        $scope.changeclass = function()
        {
            $scope.getSubjectList();
            $scope.loadStudentByClass();
            $scope.active = 1;
            $scope.getGradedata();
        }



        
        $scope.finished = function()
        {
            $scope.processfinished = true;
            $scope.eprocessfinished = true;
        }
        // Generate PDF
        function buildTableBody(data, columnsheader,columns) {
            try{
                var body = [];
                if(columnsheader.length > 0)
                {
                    body.push(columnsheader);
                }

                data.forEach(function(row) {
                    var dataRow = [];

                    columns.forEach(function(column) {
                        var columnvalue = null;
                        if(column == 'subject')
                        {
                            columnvalue = row[column].toString();
                            dataRow.push(columnvalue);
                        }
                        

                    });

                    

                    if(dataRow.length > 0)
                    {
                        body.push(dataRow);
                    }
                    
                });

                return body;
            }
            catch(e){
                console.log(e)
            }
        }
        function table(data, columnsheader, columns ) {
            try{
                return {
                    table: {
                        headerRows: 1,
                        body: buildTableBody(data,columnsheader,columns)
                    }
                };
            }
            catch(e){
                console.log(e)
            }
            
        } 
        // End here 

        $scope.renderprintdata = function()
        {
            try{

                var docDefinition = {
                    pageOrientation: 'landscape',
                    content: [
                        {text:'Mid Term Report',style:'report_header'},
                        {
                            margin: [0, 10, 0, 5],
                            columns: [
                               {
                                    width: '*',
                                    text: 'Grade: '+$scope.filterobj.class.name+"-"+$scope.filterobj.section.name+'-'+$scope.filterobj.semester.name,
                                    alignment: 'left',
                                },
                                 {
                                    width: '*',
                                    text: 'Session: '+$scope.filterobj.session.name,
                                    alignment: 'right',
                                },
                            ]
                        },
                        {
                            margin: [0, 5, 0, 5],
                            columns: [
                               {
                                    width: '*',
                                    text: 'Campus: <?php echo $schoolname."-".$campuscity; ?>',
                                    alignment: 'left',
                                },
                               {
                                    width: '*',
                                    text: 'Subject: '+$scope.filterobj.subjectid.name,
                                    alignment: 'right',
                                },
                            ]
                        },
                        table($scope.subjectlist,["Subject","Obtained Marks","Total Marks","Comments"],["Subject","Obtained Marks","Total Marks","Comments"]),
                        
                   ],

                    styles: {
                        report_header: {
                            fontSize: 24,
                            bold: true,
                            alignment: 'center'
                        }
                    }
                };
                return docDefinition;
            }
            catch(e){}
        }
        $scope.printreport = function()
        {
            var reportobj = $scope.renderprintdata();
         
            pdfMake.createPdf(reportobj).print();
        }

      $scope.download = function()
        {

            try{
            

            var data ={
                inputclassid:$scope.filterobj.studentid.id,
                inputclassid:$scope.filterobj.class.id,
                inputsectionid:$scope.filterobj.section.id,
                inputsemesterid:$scope.filterobj.semester.id,
                inputsessionid:$scope.filterobj.session.id,
                inputstudentid:$scope.filterobj.studentid.id,
                
            }

            httppostrequest('<?php echo base_url(); ?>midreportpdf',data).then(function(response){
                console.log(response);
                if(response.length > 0)
                {
                    
                }
                else{
                    
                }
            });
           }
            catch(ex){
                console.log(ex)
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
        

        $scope.changestudent = function()
        {
           $scope.getGradedata();
           
        }

         $scope.loading = false;
        $scope.loadStudentByClass = function()
        {
            
            try{
                var data = ({   
                    inputclassid:$scope.filterobj.class.id,
                    inputsectionid:$scope.filterobj.section.id,
                    inputsemesterid:$scope.filterobj.semester.id,
                    inputsessionid:$scope.filterobj.session.id,
                    
                });
             
                httprequest('<?php echo base_url(); ?>getstudentbyclass',data).then(function(response){
                    if(response.length > 0 && response != null)
                    {
                        $scope.studentlist = response;

                        var is_student_found = $filter('filter')(response,{id:studentid},true);
                        
                        if(is_student_found.length > 0)
                        {
                            studentid = false;
                            $scope.InputStudent = is_student_found[0];
                        }else{
                            $scope.InputStudent = response[0];

                        }
                        
                        $scope.loading = false;
                        $scope.getGradedata();
                    }
                    else{
                        $scope.studentlist = [];
                        $scope.fallsemester = [];
                        $scope.springsemester = [];
                        message('','hide')
                    }
                })
            }
            catch(ex){
                console.log(ex)
            }
        }

        $scope.getGradedata = function()
        {
            try{
            

            var data ={
                inputclassid:$scope.filterobj.studentid.id,
                inputclassid:$scope.filterobj.class.id,
                inputsectionid:$scope.filterobj.section.id,
                inputsemesterid:$scope.filterobj.semester.id,
                inputsessionid:$scope.filterobj.session.id,
                inputstudentid:$scope.filterobj.studentid.id,
                
            }

            httppostrequest('<?php echo base_url(); ?>midstudentreportdata',data).then(function(response){
                //console.log(response);
                if(response.length > 0)
                {
                    //$scope.subjectlist = response;
                    if(response[0].semester == 'Fall')
                    {
                        $scope.subjectlist = response[0].result;
                    }
                    else{
                        $scope.springsemester = response[0].result;
                    }
                     $scope.grade = response[0].grade;
                     $scope.obtain_marks = response[0].obtain_marks;
                     $scope.percent = response[0].percent;
                     $scope.total_marks = response[0].total_marks;
                }
                else{
                    $scope.resultlist = [];
                    $scope.fallsemester = [];
                    $scope.springsemester = [];
                }
            });
           }
            catch(ex){
                console.log(ex)
            }
           
        }
  });
    function midpdf()
            {
                console.log("calling!");
                console.log($("#inputRSession").val());
                console.log($("#select_class").val());
                console.log($("#inputSection").val());
                console.log($("#inputSemester").val());
                console.log($("#InputStudent").val());
                $("#session_id").val($("#inputRSession").val());
                $("#class_id").val($("#select_class").val());
                $("#section_id").val($("#inputSection").val());
                $("#semester_id").val($("#inputSemester").val());
                $("#student_id").val($("#InputStudent").val());

                $("#formpdf").submit();
                // $.ajax({
                //     'url': "<?php echo base_url()?>midreportpdf",
                //     'type': 'POST',
                //     'success': function (data) {
                //         console.log(data);
                        
                //     }
                // });
            }
</script>
<form action="<?php echo base_url()?>midreportpdf" id="formpdf" method="post" target="_blank">
    <input type="hidden" name="session_id"  id="session_id" >
    <input type="hidden" name="class_id"  id="class_id" >
    <input type="hidden" name="section_id"  id="section_id" >
    <input type="hidden" name="semester_id" id="semester_id"  >
    <input type="hidden" name="student_id" id="student_id" >
</form>

<style type="text/css">
    form.tab-form-demo .tab-pane {
        margin: 20px 20px;
    }
</style>
<!-- <script type="text/javascript">
    function getPDF(){
        if($("#InputStudent").val()==0)
        {
            alert("Please select Student");
            return false;
        }
        var HTML_Width = $(".canvas_div_pdf").width();
        var HTML_Height = $(".canvas_div_pdf").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width+(top_left_margin*2);
        var PDF_Height = (PDF_Width*1.5)+(top_left_margin*2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;
        
        var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;
        
        $(".canvas_div_pdf").prepend('<div class="car-offers" >I want to download the current screen as a PDF/Image using html2canvas.js.</div>');
        var header = '<div class="car-offers" >I want to download the current screen as a PDF/Image using html2canvas.js.</div>';
        var body = $(".canvas_div_pdf")[0];
        
        html2canvas(body,{allowTaint:true}).then(function(canvas) {
            canvas.getContext('3d');
            
            console.log(canvas.height+"  "+canvas.width);
            
            
            var imgData = canvas.toDataURL("image/jpeg", 1.0);
            var pdf = new jsPDF('p', 'pt',  [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin,canvas_image_width,canvas_image_height);
            
            
            for (var i = 1; i <= totalPDFPages; i++) { 
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
            }
            $(".car-offers").remove();
            pdf.save("<?php echo uniqid()?>.pdf");

        });
    };
</script> -->