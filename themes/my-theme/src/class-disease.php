<?php
/* Disease Enumerations | usage $disease = Disease::Krebs;*/
abstract class Disease
 {
     const Krebs = "Krebs";
     const Prostatakrebs = "Prostatakrebs";
     const Myelom = "Myelom";
     const Brustkrebs = "Brustkrebs";
     const Darmkrebs = "Darmkrebs";
     const Blasenkrebs = "Blasenkrebs";
     const COPD = "COPD";
     const Hämophilie = "Hämophilie";
     const Lymphomen = "Lymphomen";
     const Lungenkrebs = "Lungenkrebs";


     // Returns all tags as array
     public static function getDiseases(){
       $array = array(self::Krebs,self::Prostatakrebs,self::Myelom,self::Brustkrebs,self::Darmkrebs,self::Blasenkrebs,self::COPD,self::Hämophilie,self::Lymphomen,self::Lungenkrebs);
       return $array;
     }
 }
