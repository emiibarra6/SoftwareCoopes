<?php
class ProveedoresModel extends CI_model{
    public function __construct(){
        $this->load->database();
    }

    public function uno($id){
        return $this->db->get_where("proveedores", array("id" => $id))->row();
    }

    public function guardarCambios($id,$cuit, $nombre, $celular){
        $this->cuit = $cuit;
        $this->nombre = $nombre;
        $this->celular = $celular;
        return $this->db->update('proveedores', $this, array("id" => $id));
    }


    public function todos(){
        return $this->db
        ->select("*")
        ->from("proveedores")
        ->get()
        ->result();
    }

    public function eliminar($id){
        return $this->db->delete("proveedores", array("id" => $id));
    }

    public function nuevo($data){
        $this->db->insert("proveedores", $data);
        return true;
    }
}
?>