<?php
class Post 
{
  var $imageLink;
  var $width;
  var $height;
  var $postLink;
  var $numberOfLikes;

  function __construct($imageLink,$width,$height,$postLink,$numberOfLikes) 
  {
   $this->imageLink = $imageLink;
   $this->width = $width;
   $this->height = $height;
   $this->postLink = $postLink;
   $this->numberOfLikes = $numberOfLikes;

   }
}

?>