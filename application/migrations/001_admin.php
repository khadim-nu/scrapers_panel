<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Admin extends CI_Migration 
{
    public function up(){
        $this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT");
        $this->dbforge->add_field("name varchar(255) NOT NULL"); 
        $this->dbforge->add_field("email varchar(255) NOT NULL");
        $this->dbforge->add_field("password varchar(255) NOT NULL");
        $this->dbforge->add_field("token varchar(255) NOT NULL");
        $this->dbforge->add_field("status BOOLEAN DEFAULT 0 ");
        $this->dbforge->add_field("role_id int(11) NOT NULL");
        $this->dbforge->add_field("image_url varchar(255)");
        $this->dbforge->add_field("created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_field("updated_at TIMESTAMP NULL");
        $this->dbforge->add_field("created_by int(11) NOT NULL");
        $this->dbforge->add_field("updated_by int(11)");
        $this->dbforge->add_key('id', TRUE);
        
        $this->dbforge->create_table('admin', TRUE);
    }
    
    public function down(){
        $this->dbforge->drop_table('admin');
    }
}