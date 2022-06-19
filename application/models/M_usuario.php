<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_usuario extends CI_Model {

	function login($usuario){
		$this->db->select("*");
    	$this->db->from("usuarios");
		$this->db->where("usuario", $usuario);
		$this->db->where("usuarios.activo", 1);
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
				$resultados['row']=$dataQuery->row();
			}
			else{
				$resultados['existeUsuario'] = false;
			}
		}
		return $resultados;
	}


	function cambiopass($usuario,$pass){
		$this->db->trans_start();
		$this->db->set( 'pass' ,$pass );
		$this->db->set( 'blanqueo' ,VALOR_BD_BLANQUEO_NO);
		$this->db->where ('usuario',$usuario);
		$dataQuery =  $this->db->update('usuarios');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$resultados['mensajeErrorDB']=lang('error_mensaje_bd_no_espesifico');
		}else{
			$resultados['mensajeErrorDB']="";
		}
		return $resultados;
	}

	
	public function listadoUsuarios($parametros = array()) {
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->join('roles', 'roles.id_rol = usuarios.id_rol');
		//eLsto es para el buscador AUN NO IMPEMENTADO.
		if (isset($parametros['src'])) {
			$this->db->like('usuarios.usuario', $parametros['src']);
			$this->db->or_like('usuarios.nombre', $parametros['src']);
		}
		if (isset($parametros['ps']) && isset($parametros['pl'])) {
							 $this->db->limit($parametros['ps'], $parametros['pl']);
					 }
		$this->db->order_by('usuarios.nombre', 'asc');
		$result = $this->db->get();
		return $result->result();
	}

	public function getUsuario($id){
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where ('usuario',$id);

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

	public function exisUsuarioCuil($id){
		$this->db->select('usuario');
		$this->db->from('usuarios');
		$this->db->where('usuario', $id);
		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function registrarUsuario($data){
		$this->db->insert('usuarios', $data);
    return true;
	}

	public function editarusuario($usuario, $datos) {
			$this->db->where('usuario', $usuario);
			$this->db->update('usuarios', $datos);
			return true;
	}


	public function desactivarUsuario($id){
		try {
			$this->db->trans_begin();
			$this->db->where('usuario' , $id);
			$this->db->update('usuarios' , array('activo' => '0'));
			$this->db->trans_commit();
			return true;
		} catch (Exception $e) {
			$this->db->trans_rollback();
		}
	}
	



}
