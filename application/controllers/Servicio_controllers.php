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
