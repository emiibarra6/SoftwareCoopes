<?php
class Ventas extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model("VentaModel");
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
        $data['scripts'] = array('ventas.js');
        $ventasRealizadas = $this->VentaModel->todas();
        $datos = array("ventas" => $ventasRealizadas);
        $this->load->view("encabezado",$data);
        $this->load->view("ventas/todas", $datos);
        $this->load->view("pie" , $data);
    }

    public function detalle($id){
        $detallesDeVenta = $this->VentaModel->porId($id);
        # Por si no existe la venta...
        if($detallesDeVenta->detalles === null){
            $this->session->set_flashdata(array(
                "mensaje" => "Los detalles de la venta no se pueden ver porque no existe una venta con ese ID",
                "clase" => "warning",
            ));
            redirect("ventas/");
        }
        $datos = array("venta" => $detallesDeVenta);
        $this->load->view("encabezado");
        $this->load->view("ventas/detalle", $datos);
        $this->load->view("pie");
    }

    public function eliminar($id){
        $resultado = $this->VentaModel->eliminar($id);
        if($resultado){
            $mensaje = "Venta eliminada";
            $clase = "success";
        }else{
            $mensaje = "Error al eliminar la venta";
            $clase = "warning";
        }
        $this->session->set_flashdata(array(
            "mensaje" => $mensaje,
            "clase" => $clase,
        ));
        redirect("ventas/");
    }

}
?>