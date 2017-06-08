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
	public function cumple()
	{
		$this->servicios_model->uptCumple();
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
		//$this->servicios_model->Clientes("F07");
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
		//$this->servicios_model->LoginUsuario("F10","wb1406");
	}
	public function insertPedidos()
	{
		//$pedidos = '[{"detalles":{"nameValuePairs":{"ID0":"F09P29051731","ARTICULO0":"10118041","DESC0":"Bleomicina Sulfato 15 UI PPSI 5ml/Vial 1/Caja Refrigerado (Naprod)","CANT0":"12.0","TOTAL0":"483","BONI0":"0"}},"mCliente":"00998","mComentario":"pedido desde tablet de maryan","mEstado":"0","mFecha":"2017-05-29 07:43:59","mIdPedido":"F09P29051731","mNombre":"FARMACIA MARIA BELEN","mPrecio":"5796.0","mVendedor":"F09"}]';
		$this->servicios_model->insertPedidos($_POST['PEDIDOS']);
		//$this->servicios_model->insertPedidos($pedidos);
	}
	public function updatePedidos()
	{
		$this->servicios_model->updatePedidos($_POST['PEDIDOS']);
	}
	public function insertRazones()
	{
		$this->servicios_model->insertRazones($_POST['RAZONES']);
	}
	public function lotes()
	{
		$this->servicios_model->lotes();
	}
	public function CONSECUTIVO()
	{
		$this->servicios_model->CONSECUTIVO($_POST['usuario']);
		//$this->servicios_model->CONSECUTIVO("F09");
	}

	public function prueba()
	{
		$numero = '[{"detalles":{"nameValuePairs":{"IdRazon0":"F10R07061754","IdAE0":"8","Actividad0":"LLENAR FORMATO FALTANTE","Categoria0":"ACTUALIZACION DE DATOS","IdRazon1":"F10R07061754","IdAE1":"9","Actividad1":"SOLICITUD DE DOCUMENTACION","Categoria1":"ACTUALIZACION DE DATOS","IdRazon2":"F10R07061754","IdAE2":"16","Actividad2":"CIERRE DE CAMPAÑA","Categoria2":"CAMPAÑA","IdRazon3":"F10R07061754","IdAE3":"17","Actividad3":"PROMOVER CAMPAÑA","Categoria3":"CAMPAÑA"}},"mCliente":"03466","mFecha":"2017-06-07 15:59:26","mIdRazon":"F10R07061754","mObservacion":"","mVendedor":"F10"}]';
		//echo json_encode($numero);
		//$this->servicios_model->insertRazones($numero);
	}
}
