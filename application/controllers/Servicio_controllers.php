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
		$razon = '[{"mFecha":"2017-05-26 10:26:49","mFin":"10:26:49","mIdCliente":"00998","mIdPlan":"20","mInicio":"10:26:33","mLati":"0.0","mLocal":"LOCAL","mLogi":"0.0","mObservacion":"TIPO DE VISITA: RAZON: F09R2605172","mTipo":"RAZON"}]';
		$this->servicios_model->InsertVisitas($razon);
		//$this->servicios_model->InsertVisitas($_POST['mVisitas']);
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
		$pedidos;
		$this->servicios_model->insertPedidos($_POST['PEDIDOS']);
		//$this->servicios_model->insertPedidos($pedidos);
	}
	public function updatePedidos()
	{
		$this->servicios_model->updatePedidos($_POST['PEDIDOS']);
	}
	public function insertRazones()
	{
		//$razones = '[{"detalles":{"nameValuePairs":{"IdRazon0":"F09R2605171","IdAE0":"6","Actividad0":"VERIFICAR RECEPCION DE PEDIDO","Categoria0":"SEGUIMIENTO A PEDIDOS"}},"mCliente":"00889","mFecha":"2017-05-26 11:27:24","mIdRazon":"F09R2605171","mObservacion":"sdasdsadasd","mVendedor":"F09"},{"detalles":{"nameValuePairs":{"IdRazon1":"F09R2605172","IdAE1":"18","Actividad1":"FIESTA DE ANIVERSARIO","Categoria1":"INVITACION","IdRazon2":"F09R2605172","IdAE2":"15","Actividad2":"RETIRAR PRODUCTO NO VENCIDO","Categoria2":"PRODUCTO"}},"mCliente":"00991","mFecha":"2017-05-26 11:41:22","mIdRazon":"F09R2605172","mObservacion":"razon numero 2","mVendedor":"F09"}]';
		//$this->servicios_model->insertRazones($razones);
		$this->servicios_model->insertRazones($_POST['RAZONES']);
	}
}
