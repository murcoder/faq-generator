<?php

/* Definition of a question-object */
class question{

  protected $nr;
  protected $category;
  protected $disease;
  protected $text;
  protected $fromDoctor;



  //Constructor
  function __construct(){
    $this->nr = 0;
    $this->category = "";
    $this->disease = "";
    $this->text = "";
    $this->fromDoctor = false;
  }


  /*
  *   Getter and setter
  */
  public function getNr(){
    return $this->nr;
  }
  public function setNr($nr){
    $this->nr = $nr;
  }
  public function getCategory(){
    return $this->category;
  }
  public function setCategory($category){
    $this->category = $category;
  }
  public function getDisease(){
    return $this->disease;
  }
  public function setDisease($disease){
    $this->disease = $disease;
  }
  public function getText(){
    return $this->text;
  }
  public function setText($text){
    $this->text = $text;
  }
  public function isFromDoctor(){
    return $this->isFromDoctor;
  }
  public function setIsFromDoctor($isFromDoctor){
    $this->isFromDoctor = $isFromDoctor;
  }



  /*  String representation of the object
  *   usage: echo $question;
  */
  public function __toString(){
    $result =  '<div class="question" data-nr="'.$this->nr.'" data-category="'.$this->category.'" data-disease="'.$this->disease.'">';
    $result .= ' <div class="checkbox list-group-item">';
    $result .= '        <ul class="list-inline">';
    $result .= '            <li class="checkboxLeft">';
    $result .= '                <div class="btn-group" data-toggle="buttons">';
    $result .= '                    <span class="btn btn-default" id="question_checkbox">
                                    <input type="checkbox" autocomplete="off"
                                    data-category="'.$this->category.'"
                                    data-disease="'.$this->disease.'"';
   if(!$this->isFromDoctor()){
     $result .= '                   data-doctor="0"';
   }else{
     $result .= '                   data-doctor="1"';
   }
    $result .= '                    data-nr="'.$this->nr.'"
                                    name="question-'.$this->nr.'"
                                    value="true">
                                    <span class="glyphicon glyphicon-ok"></span></span>';
    $result .= '                </div></li>';
    $result .= '            <li class="checkboxRight">';
    $result .= '                <label onclick="$(this).parents(\'.checkbox\').find(\'.btn\').click();">'.$this->text.'</label></li>
                        </ul></div>';
    $result .='</div>';
    return $result;


  }


}
