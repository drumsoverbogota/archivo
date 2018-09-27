<?php
class Track{

  public function TrackPages()
  {   
    $this->CI = &get_instance();
    $this->CI->load->model('log_model');
      if (!$this->CI->ion_auth->logged_in())
      {
          $url = $_SERVER['PATH_INFO'].'/'.$_SERVER['QUERY_STRING'];   
          $this->CI->log_model->set_log_visitas($url);
          
      }      
  }
}