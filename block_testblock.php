<?php
class block_testblock extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_testblock');
    }
    function has_config()
    {
        return true;
    }

    public function get_content() {
        global $DB;

        if ($this->content !== null) {
            return $this->content;
        }
        $content='';
       $showcourses =  get_config('block_testblock','showcourses');

       if($showcourses){
           $courses= $DB->get_records('course');
           foreach ($courses as $course){
               $content .=$course->fullname.'<br>';
           }
       }else{
           $users= $DB->get_records('user');
           foreach ($users as $user){
               $content.=$user->firstname." ".$user->lastname.'<br>';
           }
       }



        $this->content  =  new stdClass;

        $this->content->text = $content;
        $this->content->footer = 'The footer of our Test block!!!!';

        return $this->content;
    }
}