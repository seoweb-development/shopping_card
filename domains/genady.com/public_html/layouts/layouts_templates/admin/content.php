<div class="<?php echo $this->_controller?>_wrapper">


    <?php
    if(is_file(realpath('../public_html/templates/'.$this->_controller.'/'.$this->_controller."_body_content.php"))) {
        require_once $this->_controller . '/' . $this->_controller . "_body_content.php";
    }
    ?>








</div>