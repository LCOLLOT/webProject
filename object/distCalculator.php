<?php
/**
 * Created by PhpStorm.
 * User: penichotlucas
 * Date: 11/06/2018
 * Time: 20:07
 */

class distCalculator
{
    private $lat1, $long1;
    private $lat2, $long2;

    public function __construct($lat1,$lat2,$long1,$long2)
    {
        $this->lat1 = $lat1;
        $this->lat2 = $lat2;
        $this->long1 = $long1;
        $this->long2 = $long2;
    }

    private function convertRad($angle){
        return (M_PI * $angle)/180;
    }

    public function getDist()
    {
        $rayon = 6378000;

        $this->lat1 = $this->convertRad($this->lat1);
        $this->lat2 = $this->convertRad($this->lat2);
        $this->long1 = $this->convertRad($this->long1);
        $this->long2 = $this->convertRad($this->long2);

        return ($rayon * (M_PI / 2 - asin(sin($this->lat2)* sin($this->lat1) +cos($this->long2 - $this->long1) * cos($this->lat2) * cos($this->lat1))));
            }

}
