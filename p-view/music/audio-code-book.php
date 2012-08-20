<?php
/**
 * audio-code-book.php is the /music/audio-code-book.php content
 *
 * PHP version 5
 *
 * @category PHP
 * @package  /music/
 * @author   Fukuball Lin <fukuball@gmail.com>
 * @license  No Licence
 * @version  Release: <1.0>
 * @link     http://sarasti.cs.nccu.edu.tw
 */
?>
<div id="chartdiv" style="width: 600px; height: 400px;"></div>
<script type="text/javascript">
   var chart;

   var chartData = [{
       year: "2003",
       europe: 2.5,
       namerica: 2.5,
       asia: 2.1,
       lamerica: 0.3,
       meast: 0.2,
       africa: 0.1
   }, {
       year: "2004",
       europe: 2.6,
       namerica: 2.7,
       asia: 2.2,
       lamerica: 0.3,
       meast: 0.3,
       africa: 0.1
   }, {
       year: "2005",
       europe: 2.8,
       namerica: 2.9,
       asia: 2.4,
       lamerica: 0.3,
       meast: 0.3,
       africa: 0.1
   }];

   AmCharts.ready(function () {
       // SERIAL CHART
       chart = new AmCharts.AmSerialChart();
       chart.dataProvider = chartData;
       chart.categoryField = "year";

       // sometimes we need to set margins manually
       // autoMargins should be set to false in order chart to use custom margin values
       chart.autoMargins = false;
       chart.marginLeft = 0;
       chart.marginRight = 0;
       chart.marginTop = 30;
       chart.marginBottom = 40;

       // AXES
       // category
       var categoryAxis = chart.categoryAxis;
       categoryAxis.gridAlpha = 0;
       categoryAxis.axisAlpha = 0;
       categoryAxis.gridPosition = "start";

       // value
       var valueAxis = new AmCharts.ValueAxis();
       valueAxis.stackType = "100%"; // this line makes the chart 100% stacked
       valueAxis.gridAlpha = 0;
       valueAxis.axisAlpha = 0;
       valueAxis.labelsEnabled = false;
       chart.addValueAxis(valueAxis);

       // GRAPHS
       // first graph
       var graph = new AmCharts.AmGraph();
       graph.title = "Europe";
       graph.labelText = "[[percents]]%";
       graph.balloonText = "[[value]] ([[percents]]%)";
       graph.valueField = "europe";
       graph.type = "column";
       graph.lineAlpha = 0;
       graph.fillAlphas = 1;
       graph.lineColor = "#C72C95";
       chart.addGraph(graph);

       // second graph
       var graph = new AmCharts.AmGraph();
       graph.title = "North America";
       graph.labelText = "[[percents]]%";
       graph.balloonText = "[[value]] ([[percents]]%)";
       graph.valueField = "namerica";
       graph.type = "column";
       graph.lineAlpha = 0;
       graph.fillAlphas = 1;
       graph.lineColor = "#D8E0BD";
       chart.addGraph(graph);

       // third graph
       var graph = new AmCharts.AmGraph();
       graph.title = "Asia-Pacific";
       graph.labelText = "[[percents]]%";
       graph.balloonText = "[[value]] ([[percents]]%)";
       graph.valueField = "asia";
       graph.type = "column";
       graph.lineAlpha = 0;
       graph.fillAlphas = 1;
       graph.lineColor = "#B3DBD4";
       chart.addGraph(graph);

       // fourth graph
       var graph = new AmCharts.AmGraph();
       graph.title = "Latin America";
       graph.labelText = "[[percents]]%";
       graph.balloonText = "[[value]] ([[percents]]%)";
       graph.valueField = "lamerica";
       graph.type = "column";
       graph.lineAlpha = 0;
       graph.fillAlphas = 1;
       graph.lineColor = "#69A55C";
       chart.addGraph(graph);

       // fifth graph
       var graph = new AmCharts.AmGraph();
       graph.title = "Middle-East";
       graph.labelText = "[[percents]]%";
       graph.balloonText = "[[value]] ([[percents]]%)";
       graph.valueField = "meast";
       graph.type = "column";
       graph.lineAlpha = 0;
       graph.fillAlphas = 1;
       graph.lineColor = "#B5B8D3";
       chart.addGraph(graph);

       // sixth graph
       var graph = new AmCharts.AmGraph();
       graph.title = "Africa";
       graph.labelText = "[[percents]]%";
       graph.balloonText = "[[value]] ([[percents]]%)";
       graph.valueField = "africa";
       graph.type = "column";
       graph.lineAlpha = 0;
       graph.fillAlphas = 1;
       graph.lineColor = "#F4E23B";
       chart.addGraph(graph);

       // LEGEND
       var legend = new AmCharts.AmLegend();
       legend.borderAlpha = 0.2;
       legend.horizontalGap = 10;
       legend.autoMargins = false;
       legend.marginLeft = 20;
       legend.marginRight = 20;
       legend.switchType = "v";
       chart.addLegend(legend);

       // WRITE
       chart.write("chartdiv");
   });

   // this method makes chart 2D/3D
   function setDepth() {
       if (document.getElementById("rb1").checked) {
           chart.depth3D = 0;
           chart.angle = 0;
       } else {
           chart.depth3D = 25;
           chart.angle = 30;
       }
       chart.validateNow();
   }
</script>