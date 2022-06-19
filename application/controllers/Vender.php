<?php
class Vender extends CI_Controller{
    public function __construct(){
        parent::__construct();   
        if (!isset($this->session->userdata['login'])) {
            redirect(base_url() . 'login');
            die;
        }
        if ($this->session->userdata['id_rol'] != 0) {
            redirect(base_url() . 'login');
            die;
        }
        $this->load->model("m_menus");
    }


    public function index(){
        if(!$this->session->has_userdata("carrito"))
            $this->session->set_userdata("carrito", array());
        $data['titulo'] =  "Vender2";
        $data['scripts'] =  array("vender.js");
        $carrito = $this->session->carrito;
        $this->load->view("encabezado",$data);
        $this->load->view("vender/vender", array(
            "carrito" => $carrito,
        ));
        $this->load->view("pie",$data);
    }

    public function quitarDelCarrito($indice){
        $carrito = $this->session->carrito;
        array_splice($carrito, $indice, 1);
        $this->session->set_userdata("carrito", $carrito);
        redirect("vender/");
    }

    public function cancelarVenta(){
        $this->vaciarCarrito();
        $this->session->set_flashdata(array(
            "mensaje" => "Venta cancelada correctamente",
            "clase" => "success",
        ));
        redirect("vender/");
    }

    private function vaciarCarrito(){
        $this->session->set_userdata("carrito", array());
    }

    public function terminarVenta(){
        $carrito = $this->session->carrito;
        # Primero ver si hay algo en el carrito, si no, indicarlo
        if(count($carrito) < 1){
            $this->session->set_flashdata(array(
                "mensaje" => "Para vender, primero tienes que agregar productos al carrito",
                "clase" => "warning",
            ));
            redirect("vender/");
        }
        $this->load->model("VentaModel");
        $resultado = $this->VentaModel->nueva($carrito);
        if($resultado){
            $this->vaciarCarrito();
            $this->session->set_flashdata(array(
                "mensaje" => "Venta realizada correctamente",
                "clase" => "success",
            ));
            redirect("vender/");
        }else{
            $this->session->set_flashdata(array(
                "mensaje" => "Error realizando la venta, intente de nuevo",
                "clase" => "danger",
            ));
            redirect("vender/");
        }
        
        
    }

    private function agregarAlCarrito($producto,$cantidad){
        $carrito = $this->session->carrito;
        $producto->cantidad = $cantidad;
        $producto->total = $producto->cantidad * $producto->precioVenta;
        array_push($carrito, $producto);
        $this->session->set_userdata("carrito", $carrito);
    }

    private function obtenerIndiceSiExiste($codigo){
        $carrito = $this->session->carrito;
        $conteo = count($carrito);
        for($indice = 0; $indice < $conteo; $indice++){
            if($carrito[$indice]->codigo === $codigo) return $indice;
        }
        return -1;
    }

    private function aumentarCantidad($indice,$cant){
        $carrito = $this->session->carrito;
        $producto = $carrito[$indice];
        $producto->cantidad = $producto->cantidad + $cant;
        $producto->total = $producto->cantidad * $producto->precioVenta;
        $carrito[$indice] = $producto;
        $this->session->set_userdata("carrito", $carrito);
    }

    public function agregar(){
        $codigoDeBarras = $this->input->post("codigo");
        $cantidad = $this->input->post("cantidad");
        $indice = $this->obtenerIndiceSiExiste($codigoDeBarras);
        # Si el producto ya estaba en el carrito...
        if($indice !== -1){
            # Simplemente le aumentamos la cantidad
            $this->aumentarCantidad($indice,$cantidad);
        }else{
            #Si no, es uno nuevo
            $this->load->model("ProductoModel");
            $producto = $this->ProductoModel->porCodigoDeBarras($codigoDeBarras);
            # Pero puede que no exista un producto con ese código
            if(null === $producto){
                $this->session->set_flashdata(array(
                    "mensaje" => "No existe un producto registrado con el código de barras que se proporcionó",
                    "clase" => "warning",
                ));
            # O que no tenga existencia 
            }else if($producto->existencia < 1){
                $this->session->set_flashdata(array(
                    "mensaje" => "No hay suficiente existencia del producto",
                    "clase" => "warning",
                ));
            }else{
                # Y caso de que sí exista y la existencia sea suficiente...
                $this->agregarAlCarrito($producto,$cantidad);
            }
        }
        # Al final, en cualquier caso redireccionamos, ya sea con o sin mensajes
        redirect("vender/");
    }

}
?>