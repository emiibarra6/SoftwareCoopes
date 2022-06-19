<?php
class Menu extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("m_menus");
    }

    public function index(){
        $this->load->view("encabezado");
        $data['menuDataCompleta'] = $this->m_menus->get_menus($this->session->userdata('id_rol'));
        $data['menu'] = $data['menuDataCompleta']['rows']->result(); 
        $this->load->view("menu/listar", $data);
        $this->load->view("pie");
    }
}
?>