<?php
    class DateHelper
    {
        public static function getCurrentDate()
        {
            return date('Y-m-d');
        }

        public static function getIndiaDateFormat()
        {
            return date('d-m-Y');
        }

        public static function convertMillisToDate($currentMillis)
        {
            $mil = $currentMillis;
            $seconds = $mil / 1000;
            echo date("d-m-Y", $seconds);
        }
    }
?>