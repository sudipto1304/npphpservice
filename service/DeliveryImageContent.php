<?php

class DeliveryImage {
    private $viewLink;
    
    public function getViewLink() {
        return $this->$viewLink;
    }

    public function setViewLink( $viewLink ) {
        $this->$viewLink = $viewLink;
    }

}

?>
