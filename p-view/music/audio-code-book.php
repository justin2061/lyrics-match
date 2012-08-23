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

$db_obj = LMDBAccess::getInstance();

$select_sql = "SELECT ".
              "id, audio_word ".
              "FROM muisc_audio_code_word ".
              "WHERE is_deleted = '0' ".
              "AND code_book_id = '1' ".
              "ORDER BY id LIMIT 1";

$query_result = $db_obj->selectCommand($select_sql);

foreach ($query_result as $query_result_data) {

   $audio_word_id = $query_result_data['id'];
   $audio_word = json_decode($query_result_data['audio_word']);

   ?>
   <div id="chartdiv<?=$audio_word_id;?>" style="width: 50px; height: 300px;"></div>
   <script type="text/javascript">
      var chart<?=$audio_word_id;?>;

      var chartData<?=$audio_word_id;?> = [{
          code_word<?=$audio_word_id;?>: "code word<?=$audio_word_id;?>",
          pitch1: 1,
          pitch2: 1,
          pitch3: 1,
          pitch4: 1,
          pitch5: 1,
          pitch6: 1,
          pitch7: 1,
          pitch8: 1,
          pitch9: 1,
          pitch10: 1,
          pitch11: 1,
          pitch12: 1
      }];

      AmCharts.ready(function () {

         // SERIAL CHART
         chart = new AmCharts.AmSerialChart();
         chart.dataProvider = chartData;
         chart.categoryField = "code_word<?=$audio_word_id;?>";

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

         <?php
         $count = 1;
         foreach ($audio_word as $key=>$audio_word_value) {
            ?>
            var graph = new AmCharts.AmGraph();
            graph.title = "pitch<?=$count?>";
            graph.labelText = "";
            graph.balloonText = "0.1";
            graph.valueField = "pitch<?=$count?>";
            graph.type = "column";
            graph.lineAlpha = 0;
            graph.fillAlphas = <?=$audio_word_value?>;
            graph.lineColor = "#D41313";
            chart.addGraph(graph);
            <?php
            $count++;
         }
         ?>

         // WRITE
         chart.write("chartdiv<?=$audio_word_id;?>");
      });

   </script>
   <?php

}
?>