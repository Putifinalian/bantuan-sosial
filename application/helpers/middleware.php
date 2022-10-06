<?php 

function middleware_check_user($this_)
{
    if(!$this_->session->userdata("is_login")){
        redirect($_SERVER['HTTP_REFERER']);
    }
    return $this_;
}
