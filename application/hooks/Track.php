<?php
class Track{

  public function TrackPages()
  {   
    $this->CI = &get_instance();
    $this->CI->load->model('log_model');
      if (!$this->CI->ion_auth->logged_in())
      {
          $http_referer = 'NA';
          if (array_key_exists('HTTP_REFERER',$_SERVER)) {
            $http_referer = $_SERVER['HTTP_REFERER'];
          }          
          if (array_key_exists('REQUEST_URI',$_SERVER)) {
            if (strpos($_SERVER['REQUEST_URI'], "/link/") !== false){
              return;
            }
            $url = $_SERVER['REQUEST_URI'];
          }
          else{
            $url = '//';
          }
          $this->CI->log_model->set_log_visitas($url, $http_referer);          
      }      
  }
}