<?php

namespace App\Model;


interface TimestampedInterface {

    public function getDate(): ?\DateTimeInterface;
    
    public function setDate(\DateTimeInterface $date);


}