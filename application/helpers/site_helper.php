<?php
function getDuration($start_time,$end_time)
    {
        $to_time =strtotime($start_time);
        $from_time = strtotime($end_time);
        $duration =  round(abs($to_time - $from_time) / 60,2). " minutes";
        return $duration;
    }
?>