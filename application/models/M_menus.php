<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Modelo que maneja todas las operaciones referidas a menu
class m_menus extends CI_Model {

	// Trae los menus de un modulos para los que el usuario tiene permiso
	function get_menus($idrol){
		$this->db->select("*");
        $this->db->from("p_menues");
        $this->db->join("p_permisos_menus", "p_menues.codigo_item=p_permisos_menus.codigo_item and p_menues.codigo_modulo=p_permisos_menus.codigo_modulo", "inner");
		$this->db->where("p_permisos_menus.id_rol", $idrol);
        $this->db->order_by('p_menues.numero_orden', 'ASC');

		$dataQuery = $this->db->get();
		$errorDB=$this->db->error();
		$resultados['mensajeErrorDB']="";
		$resultados['existeMenu']=false;

		if($errorDB['code']!=0){
			$resultados['mensajeErrorDB']=$errorDB['message'];
		}else{
			if ($dataQuery->num_rows()>0) {
				$resultados['existeMenu']=true;
				$resultados['rows']=$dataQuery;
			}
			else{
				$resultados['existeMenu']=false;
			}
		}
		return 	$resultados;
	}

	// Evalua si un usuario determinado tien permiso para una pag de un modulo determinado
	function get_permiso_usuario_modulo_pag($idrol,$modulo,$pag){
		$this->db->select("*");
        $this->db->from("p_menues");
        $this->db->join("p_permisos_menus", "p_menues.codigo_item=p_permisos_menus.codigo_item and p_menues.codigo_modulo=p_permisos_menus.codigo_modulo", "inner");
				$this->db->join("roles", "roles.id_rol=p_permisos_menus.id_rol");
				$this->db->where("p_permisos_menus.id_rol", $idrol);
        //$this->db->or_where("p_permisos_menus.id_rol", CODIGO_USUARIO_GENERICO);
        $this->db->where("p_permisos_menus.codigo_modulo", $modulo);
        $this->db->where("p_menues.url_item", $pag);
        $this->db->order_by('p_menues.numero_orden', 'ASC');

		$dataQuery = $this->db->get();

		$errorDB=$this->db->error();
		$resultados['mensajeErrorDB']="";
		$resultados['permiso']=false;

		if($errorDB['code']!=0){
			$resultados['mensajeErrorDB']=$errorDB['message'];
		}else{
			if ($dataQuery->num_rows()>0) {
				$resultados['permiso']=true;
			}
			else{
				$resultados['permiso']=false;
			}
		}
		return 	$resultados;
	}

	// NO USE TODAVIA
	function get_permisos_usuario_pagina($usuario,$codigo_modulo,$codigo_item){

    $this->db->select("*");
    $this->db->from("p_permisos_menus");
    $this->db->where("usuario", $usuario);
		$this->db->where("codigo_modulo", $codigo_modulo);
		$this->db->where("codigo_item", $codigo_item);
		$dataQuery = $this->db->get();

		$errorDB=$this->db->error();
		$resultados['mensajeErrorDB']="";
		$resultados['existeAbm']=false;

		if($errorDB['code']!=0){
			$resultados['mensajeErrorDB']=$errorDB['message'];
		}else{
			if ($dataQuery->num_rows()>0) {
				$resultados['existeAbm']=true;
				$resultados['rows']=$dataQuery;
			}
			else{
				$resultados['existeAbm']=false;
			}
		}
		return 	$resultados;
	}


	// ----------------------------- MODULO ADMIN ------------------------------//
	public function listadoMenues($parametros = array()) {
		$this->db->select('*');
		$this->db->from('p_menues');
		//esto es para el buscador AUN NO IMPLEMENTADO.
		if (isset($parametros['src'])) {
			$this->db->like('roles.rol', $parametros['src']);
		}
		if (isset($parametros['ps']) && isset($parametros['pl'])) {
							 $this->db->limit($parametros['ps'], $parametros['pl']);
					 }
		$this->db->join("p_permisos_menus", "p_menues.codigo_item=p_permisos_menus.codigo_item and p_menues.codigo_modulo=p_permisos_menus.codigo_modulo", "inner");
		$this->db->join("roles", "roles.id_rol=p_permisos_menus.id_rol");
		$this->db->join("p_modulos", "p_modulos.codigo_modulo=p_menues.codigo_modulo");
		$this->db->order_by('roles.rol', 'asc');
		$result = $this->db->get();
		return $result->result();

	}


	public function listadoPMenues($parametros = array()) {
	  $this->db->select('*');
	  $this->db->from('p_menues');
	  //esto es para el buscador AUN NO IMPLEMENTADO.
	  if (isset($parametros['src'])) {
	    $this->db->like('p_menues.codigo_item', $parametros['src']);
	  }
	  if (isset($parametros['ps']) && isset($parametros['pl'])) {
	             $this->db->limit($parametros['ps'], $parametros['pl']);
	         }

	  $this->db->order_by('p_menues.numero_orden', 'asc');
	  $result = $this->db->get();
	  return $result->result();
	  // ----------------------------- FIN MODULO ADMIN ------------------------------//
	}

	public function codigosItemPadres(){
		$this->db->select('codigo_item,nombre_item');
		$this->db->from('p_menues');
		$this->db->where('p_menues.codigo_item_padre', '0');
		$result = $this->db->get();
		return $result->result();
	}

	public function codigosItems(){
		$this->db->select('codigo_item,nombre_item');
		$this->db->from('p_menues');
		$result = $this->db->get();
		return $result->result();
	}

	public function getMenu($id){
		$this->db->select('*');
		$this->db->from('p_menues');
		$this->db->where ('codigo_item',$id);
		$dataQuery = $this->db->get();
		$errorDB = $this->db->error();
		$resultados['mensajeErrorDB'] = "";
		$resultados['existeUsuario'] = false;
		$numerodeFilas=$dataQuery->num_rows();

		if($errorDB['code'] != 0){
			$resultados['mensajeErrorDB']=$errorDB['message'];
		}else{
			if ($numerodeFilas!=0) {
				$resultados['existeUsuario'] = true;
				$resultados['result']=$dataQuery->row();
			}
			else{
				$resultados['existeUsuario'] = false;
			}
		}
		return $resultados;
	}

	public function registrarMenu($data){
		$this->db->insert('p_menues', $data);
    return true;
	}

	public function verificarIdModulo($id) {
			$this->db->select('*');
			$this->db->from('p_menues');
			$this->db->where('codigo_item', $id);
			$result = $this->db->get();
			if ($result->num_rows() > 0) {
				return $result->row();
			} else {
				return null;
			}
		}

	public function ExistNOrden($norden){
		$this->db->select('numero_orden');
		$this->db->from('p_menues');
		$this->db->where('numero_orden', $norden);
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function ExistCodItem($cod){
		$this->db->select('codigo_item');
		$this->db->from('p_menues');
		$this->db->where('codigo_item', $cod);
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function ExistItem($item){
		$this->db->select('nombre_item');
		$this->db->from('p_menues');
		$this->db->where('nombre_item', $item);
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}



	public function ExistURL($url){
		$this->db->select('url_item');
		$this->db->from('p_menues');
		$this->db->where('url_item', $url);
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

  public function editarMenu($id, $datos) {
			$this->db->where('codigo_item', $id);
			$this->db->update('p_menues', $datos);
			return true;
		}
}
