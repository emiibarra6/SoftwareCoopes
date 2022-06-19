<?php
class Proveedores extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("ProveedoresModel");
        if (!isset($this->session->userdata['login'])) {
            redirect(base_url() . 'login');
            die;
        }
        if ($this->session->userdata['id_rol'] != 1) {
            redirect(base_url() . 'login');
            die;
        }
        $this->load->model("m_menus");
     
    }
    public function index(){
        $data['scripts'] = array('proveedores.js');
        $proveedoresRegistrados = $this->ProveedoresModel->todos();
        $datos = array("proveedores" => $proveedoresRegistrados);
        $this->load->view("encabezado",$data);
        $this->load->view("proveedores/listar", $datos);
        $this->load->view("pie" , $data);
    }

    public function eliminar($id){
        $resultado = $this->ProveedoresModel->eliminar($id);
        if($resultado){
            $mensaje = "Proveedor eliminada";
            $clase = "success";
        }else{
            $mensaje = "Error al eliminar el Proveedor";
            $clase = "warning";
        }
        $this->session->set_flashdata(array(
            "mensaje" => $mensaje,
            "clase" => $clase,
        ));
        redirect("Proveedores/");
    }

    public function editar($id){
        $proveedor = $this->ProveedoresModel->uno($id);
        if(null === $proveedor){
            $this->session->set_flashdata(array(
                "mensaje" => "El Proveedor que quieres editar no existe",
                "clase" => "danger",
            ));
            redirect("Proveedor/");
        }
        $this->load->view("encabezado");
        $this->load->view("proveedores/editar", array("proveedor" => $proveedor));
        $this->load->view("pie");
    }

    #Guardar cambios dentro de editar....
    public function guardarCambios(){
        $resultado = $this->ProveedoresModel->guardarCambios(
            $this->input->post("id"),
            $this->input->post("cuit"),
            $this->input->post("nombre"),
            $this->input->post("celular"),
        );
        if($resultado){
            $mensaje = "Proveedor actualizado correctamente";
            $clase = "success";
        }else{
            $mensaje = "Error al actualizar el proveedor";
            $clase = "danger";
        }
        $this->session->set_flashdata(array(
            "mensaje" => $mensaje,
            "clase" => $clase,
        ));
        redirect("listado-proveedores/");
    }
}
?>