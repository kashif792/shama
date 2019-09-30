<?php 

// require_header 

require APPPATH.'views/__layout/header.php';
?>
// require_header 

<html>
<head>
<title></title>
</head>
<body>
<div onload="Handsontable()" class="col-sm-10 dplan-widget"  ng-controller="lesson_plan_controler">
   
<div class="row">
   <div id="example1" class="hot handsontable"></div>

</div>
<div class="row">
<Button type="button">Save</Button>
</div>

</div>
</body>
</html>

<script>
  



function Handsontable(){
   
alert();
// document.addEventListener("DOMContentLoaded", function() {

//   function getCarData() {
//     return [
//       {car: "Mercedes A 160", year: 2012, available: true, comesInBlack: 'yes'},
//       {car: "Citroen C4 Coupe", year: 2013, available: false, comesInBlack: 'yes'},
//       {car: "Audi A4 Avant", year: 2014, available: true, comesInBlack: 'no'},
//       {car: "Opel Astra", year: 2015, available: false, comesInBlack: 'yes'},
//       {car: "BMW 320i Coupe", year: 2016, available: false, comesInBlack: 'no'}
//     ];
//   }
  
//   var example1 = document.getElementById('example1'),
//     hot1;
  
//   hot1 = new Handsontable(example1, {
//     data: getCarData(),
//     colHeaders: ['Car model', 'Year of manufacture', 'Available'],
//     columns: [
//       {
//         data: 'car'
//       },
//       {
//         data: 'year',
//         type: 'numeric'
//       },
//       {
//         data: 'available',
//         type: 'checkbox'
//       }
//     ]
//   });
  
//   function bindDumpButton() {
//       if (typeof Handsontable === "undefined") {
//         return;
//       }
  
//       Handsontable.Dom.addEvent(document.body, 'click', function (e) {
  
//         var element = e.target || e.srcElement;
  
//         if (element.nodeName == "BUTTON" && element.name == 'dump') {
//           var name = element.getAttribute('data-dump');
//           var instance = element.getAttribute('data-instance');
//           var hot = window[instance];
//           console.log('data of ' + name, hot.getData());
//         }
//       });
//     }
//   bindDumpButton();

// });



}

</script>

          




