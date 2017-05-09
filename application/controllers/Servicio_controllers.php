<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio_controllers extends CI_Controller {

	public function index()
	{
		//$this->load->view('welcome_message');
	}
	public function Actividades()
	{
		$this->servicios_model->Actividades();
	}
	public function articulos()
	{
		$this->servicios_model->Articulos();
	}
	public function ClientesMora()
	{
		$this->servicios_model->ClienteMora($_POST['mVendedor']);
	}
	public function ClientesIndicadores()
	{
		$this->servicios_model->ClienteIndicadores($_POST['mVendedor']);
	}
	public function Clientes()
	{
		$this->servicios_model->Clientes($_POST['mVendedor']);

	}
	public function Historial()
	{
		$this->servicios_model->Historial($_POST['mVendedor']);

	}
	public function Puntos()
	{
		$this->servicios_model->Puntos($_POST['mVendedor']);

	}
	public function Agenda()
	{
		$this->servicios_model->Agenda($_POST['mVendedor']);

	}
	public function InsertCobros()
	{
		$this->servicios_model->InsertCobros($_POST['pCobros']);
	}
	public function InsertVisitas()
	{
		$this->servicios_model->InsertVisitas($_POST['mVisitas']);
	}
	public function InsertAgenda()
	{
		$this->servicios_model->InsertAgenda($_POST['mAgenda']);
	}
	public function LoginUsuario()
	{
		$this->servicios_model->LoginUsuario($_POST['usuario'],$_POST['pass']);
	}
	public function insertPedidos()
	{
		$this->servicios_model->insertPedidos($_POST['PEDIDOS']);
	}
	public function updatePedidos()
	{
		$this->servicios_model->updatePedidos($_POST['PEDIDOS']);
	}
}
/*[
	{"detalles":
		{"nameValuePairs":
			{
				"ID0":"F09P03051731",
				"ARTICULO0":"10126011",
				"DESC0":"Leucovorina Cálcica 50 mg/5 ml Solución Iny. 5 ml/Vial 1/Caja Refrigerado (Naprod)",
				"CANT0":"150",
				"TOTAL0":"190.00",
				"BONI0":"0",
				"ID1":"F09P03051731",
				"ARTICULO1":"10301052",
				"DESC1":"Acetaminofén 300 mg Supositorios 10/Caja (Ramos)",
				"CANT1":"20",
				"TOTAL1":"49.50",
				"BONI1":"5+1",
				"ID2":"F09P03051731",
				"ARTICULO2":"10303022",
				"DESC2":"Ambroxol + Clenbuterol 7.5 mg x 0.005 mg/5 ml Jarabe 120 ml/Frasco 1/Caja (Ramos)",
				"CANT2":"3",
				"TOTAL2":"55.00",
				"BONI2":"0"
			}},"mCliente":"02319","mEstado":"0","mFecha":"2017-05-03 16:52:53","mIdPedido":"F09P03051731","mNombre":"FARMACIA DRA ZELEDON","mPrecio":"29655.0","mVendedor":"F09"},
	{"detalles":
		{"nameValuePairs":
			{
				"ID3":"F09P03051732",
				"ARTICULO3":"10118022",
				"DESC3":"Anastrozol 1 Mg Tab Recubierta 28/Caja (Naprod)",
				"CANT3":"1",
				"TOTAL3":"1066.00",
				"BONI3":"0"
			}},"mCliente":"01762","mEstado":"0","mFecha":"2017-05-03 18:01:30","mIdPedido":"F09P03051732","mNombre":"FARMACIA IRELA SOMOTO","mPrecio":"1066.0","mVendedor":"F09"},
	{"detalles":
		{"nameValuePairs":
			{
				"ID4":"F09P03051733",
				"ARTICULO4":"10115012",
				"DESC4":"Lenalidomida 25 mg Capsulas 10/Frasco 1/Caja (Naprod)",
				"CANT4":"1","TOTAL4":"78000.00","BONI4":"0"
			}},"mCliente":"00758","mEstado":"0","mFecha":"2017-05-03 18:02:25","mIdPedido":"F09P03051733","mNombre":"FARMACIA GUADALUPE #2","mPrecio":"78000.0","mVendedor":"F09"},
	{"detalles":
		{"nameValuePairs":
			{
				"ID5":"F09P03051734",
				"ARTICULO5":"10118441",
				"DESC5":"Pemetrexed 500 mg Liofilizado para Sol. Iny. Vial 1/Caja (Naprod)",
				"CANT5":"3","TOTAL5":"19975.00","BONI5":"0"
			}},"mCliente":"01762","mEstado":"0","mFecha":"2017-05-03 18:03:46","mIdPedido":"F09P03051734","mNombre":"FARMACIA IRELA SOMOTO","mPrecio":"59925.0","mVendedor":"F09"}
]*/