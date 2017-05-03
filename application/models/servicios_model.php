<?php
class servicios_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function Articulos()
    {
        $i=0;
        $rtnArticulo=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_mstr_articulos",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnArticulo['results'][$i]['mCodigo']     = $key['ARTICULO'];
            $rtnArticulo['results'][$i]['mName']  = $key['DESCRIPCION'];
            $rtnArticulo['results'][$i]['mExistencia']   = number_format($key['EXISTENCIA'],2,'.','');
            $rtnArticulo['results'][$i]['mUnidad']       = $key['UNIDAD'];
            $rtnArticulo['results'][$i]['mPrecio']       = number_format($key['PRECIO'],2,'.','');
            $rtnArticulo['results'][$i]['mPuntos']       = $key['PUNTOS']   ;
            $rtnArticulo['results'][$i]['mReglas']       = $key['REGLAS'];
            $i++;
        }
        echo json_encode($rtnArticulo);
        $this->sqlsrv->close();
    }


    public function Clientes($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_Clientes WHERE VENDEDOR='".$Vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente['results'][$i]['mCliente']      = $key['CLIENTE'];
            $rtnCliente['results'][$i]['mNombre']       = $key['NOMBRE'];
            $rtnCliente['results'][$i]['mDireccion']    = $key['DIRECCION'];
            $rtnCliente['results'][$i]['mRuc']          = $key['RUC'];
            $rtnCliente['results'][$i]['mPuntos']       = $key['RUBRO1_CLI'];
            $rtnCliente['results'][$i]['mMoroso']       = $key['MOROSO'];
            $rtnCliente['results'][$i]['mCredito']      = number_format($key['CREDITO'],2, '.', '');
            $rtnCliente['results'][$i]['mSaldo']        = number_format($key['SALDO'],2, '.', '');
            $rtnCliente['results'][$i]['mDisponible']   = number_format($key['DISPONIBLE'],2, '.', '');
            $rtnCliente['results'][$i]['mCumple']       = $this->Cumple($key['CLIENTE']);
            $i++;
        }
        echo json_encode($rtnCliente);
        $this->sqlsrv->close();
    }

    public function Historial($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_hstCompra_3M WHERE VENDEDOR='".$Vendedor."' ",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente['results'][$i]['mArticulo']      = $key['ARTICULO'];
            $rtnCliente['results'][$i]['mNombre']       = $key['DESCRIPCION'];
            $rtnCliente['results'][$i]['mCantidad']    = number_format($key['CANTIDAD'],0);
            $rtnCliente['results'][$i]['mFecha']          = $key['Dia'];
            $rtnCliente['results'][$i]['mCliente']       = $key['Cliente'];
            $rtnCliente['results'][$i]['mVendedor']       = $key['VENDEDOR'];
            $i++;
        }
        echo json_encode($rtnCliente);
        $this->sqlsrv->close();
    }
    private function Cumple($Codigo)
    {
        $i=0;
        $rtnCliente="00-00-0000";
        $query = $this->sqlsrv->fetchArray("SELECT convert(varchar, Fecha, 105) as Fecha FROM tblcumplenero WHERE Codigo='".$Codigo."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente = $key['Fecha'];
            $i++;
        }
        return  $rtnCliente;
        $this->sqlsrv->close();
    }
    public function ClienteMora($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_ClientesPerMora WHERE VENDEDOR='".$Vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente['results'][$i]['mCliente']      = $key['CLIENTE'];
            $rtnCliente['results'][$i]['mNombre']       = $key['NOMBRE'];
            $rtnCliente['results'][$i]['mVencidos']   = number_format($key['NoVencidos'],2,'.','');
            $rtnCliente['results'][$i]['mD30']       = number_format($key['Dias30'],2,'.','');
            $rtnCliente['results'][$i]['mD60']       = number_format($key['Dias60'],2,'.','');
            $rtnCliente['results'][$i]['mD90']       = number_format($key['Dias90'],2,'.','');
            $rtnCliente['results'][$i]['mD120']      = number_format($key['Dias120'],2,'.','');
            $rtnCliente['results'][$i]['mMd120']       = number_format($key['Mas120'],2,'.','');
            $i++;
        }
        echo json_encode($rtnCliente);
        $this->sqlsrv->close();
    }
    public function ClienteIndicadores($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_indicadores_clientes WHERE VENDEDOR='".$Vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente['results'][$i]['mCliente']           = $key['CLIENTE'];
            $rtnCliente['results'][$i]['mNombre']           = $key['NombreCliente'];
            $rtnCliente['results'][$i]['mVendedor']           = $key['VENDEDOR'];
            $rtnCliente['results'][$i]['mMetas']             = number_format($key['MetaVentaEnValores'],2,'.','');
            $rtnCliente['results'][$i]['mVentasActual']      = number_format($key['VentaEnValoresAct'],2,'.','');
            $rtnCliente['results'][$i]['mPromedioVenta3M']   = number_format($key['VentaEnValores3MAnt'],2,'.','');
            $rtnCliente['results'][$i]['mCantidadItems3M']   = number_format($key['NumItemFac3MAnt'],2,'.','');
            $i++;
        }
        echo json_encode($rtnCliente);
        $this->sqlsrv->close();
    }
    public function Puntos($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT CLIENTE,CONVERT(VARCHAR(50),FECHA,110) AS FECHA,FACTURA,SUM(TT_PUNTOS) AS TOTAL,RUTA FROM vtVS2_Facturas_CL WHERE RUTA = '".$Vendedor."'
                        GROUP BY FACTURA,FECHA,RUTA,CLIENTE",SQLSRV_FETCH_ASSOC);
       foreach($query as $key){
            $Remanente = number_format($this->FacturaSaldo($key['FACTURA'],$key['TOTAL']),2,'.','');
            if (intval($Remanente) > 0.00 ) {
                $rtnCliente['results'][$i]['mFecha']            = $key['FECHA'];
                $rtnCliente['results'][$i]['mCliente']            = $key['CLIENTE'];
                $rtnCliente['results'][$i]['mFactura']          = $key['FACTURA'];
                $rtnCliente['results'][$i]['mPuntos']           = number_format($key['TOTAL'],2,'.','');
                $rtnCliente['results'][$i]['mRemanente']        = $Remanente;
                $i++;
            }
            
        }

        echo json_encode($rtnCliente);

        $this->sqlsrv->close();
    }
    public function FacturaSaldo($id,$pts){        
        $this->db->where('Factura',$id);
        $this->db->select('Puntos');
        $query = $this->db->get('visys.rfactura');
        if($query->num_rows() > 0){
            $parcial = $query->result_array()[0]['Puntos'];
        } else {
            $parcial = $pts;
        }
        return $parcial;
    }
    public function LoginUsuario($usuario,$pass){
        $i=0;
        $rtnUsuario = array();

        $this->db->where('Usuario',$usuario);
        $this->db->where('Password',$pass);
        $query = $this->db->get('usuario');

            
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $rtnUsuario['results'][$i]['mUsuario'] = $key['Usuario'];
                $rtnUsuario['results'][$i]['mNombre'] = $key['Nombre'];
                $rtnUsuario['results'][$i]['mIdUser'] = $key['IdUser']; 
                $rtnUsuario['results'][$i]['mPass'] = $key['Password']; 
            }            
        }
        echo json_encode($rtnUsuario);
    }
    public function Agenda($Ruta){
        $i=0;
        $rtnAgenda = array();
        $this->db->where('Ruta',$Ruta);
        $this->db->where('Estado',1);
        $query = $this->db->get('vtsplanes');


        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $rtnAgenda['results'][$i]['mIdPlan']        = $key['IdPlan'];
                $rtnAgenda['results'][$i]['mVendedor']      = $key['Vendedor'];
                $rtnAgenda['results'][$i]['mRuta']          = $key['Ruta'];
                $rtnAgenda['results'][$i]['mInicia']        = $key['Inicia'];
                $rtnAgenda['results'][$i]['mTermina']       = $key['Termina'];
                $rtnAgenda['results'][$i]['mZona']          = $key['Zona'];
                $rtnAgenda['results'][$i]['mEstado']        = $key['Estado'];
                $rtnAgenda['results'][$i]['mLunes']         = $key['Lunes'];
                $rtnAgenda['results'][$i]['mMartes']        = $key['Martes'];
                $rtnAgenda['results'][$i]['mMiercoles']     = $key['Miercoles'];
                $rtnAgenda['results'][$i]['mJueves']        = $key['Jueves'];
                $rtnAgenda['results'][$i]['mViernes']       = $key['Viernes'];
            }
        }
        echo json_encode($rtnAgenda);
    }
  public function InsertCobros($json){
        foreach(json_decode($json, true) as $key){
            $Cobros = array(
                'IDCOBRO'     => $key['mIdCobro'],
                'CLIENTE'     => $key['mCliente'],
                'RUTA'        => $key['mRuta'],
                'TIPO'        => $key['mTipo'],
                'IMPORTE'     => $key['mImporte'],
                'OBSERVACION' => $key['mObservacion'],
                'FECHA'       => $key['mFecha']);
           $query = $this->db->insert('cobros', $Cobros);
        }
        echo json_encode($query);
    }
    public function InsertVisitas($json){
        foreach(json_decode($json, true) as $key){
            $Visitas = array(
                'IdPlan'       => $key['mIdPlan'],
                'IdCliente'    => $key['mIdCliente'],
                'Fecha'        => $key['mFecha'],
                'Lati'         => $key['mLati'],
                'Logi'         => $key['mLogi'],
                'Local'        => $key['mLocal'],
                'Observacion'  => $key['mObservacion'],
                'Accion'       => $key['mTipo']);
            $query = $this->db->insert('visitas', $Visitas);
        }
        echo json_encode($query);
    }

    public function InsertAgenda($json){
        foreach(json_decode($json, true) as $key){
            $AgendaTop = array(
                'IdPlan'      => $key['mIdPlan'],
                'Vendedor'    => $key['mVendedor'],
                'Ruta'        => $key['mRuta'],
                'Inicia'      => $key['mInicia'],
                'Termina'     => $key['mTermina'],
                'Zona'        => $key['mZona']);
            $this->db->insert('agenda', $AgendaTop);

            $AgendaTop = array(
                'IdPlan'       => $key['mIdPlan'],
                'Lunes'        => $key['mLunes'],
                'Martes'       => $key['mMartes'],
                'Miercoles'    => $key['mMiercoles'],
                'Jueves'       => $key['mJueves'],
                'Viernes'      => $key['mViernes']);
            $query = $this->db->insert('vclientes', $AgendaTop);
        }
        echo json_encode($query);
    }

    public function url_pedidos($Data)
    {
        $i = 0;
        $rtnUsuario = array();
        //$consulta = "";
        foreach(json_decode($Data, true) as $key){
            
            $query = $this->db->query("SELECT IDPEDIDO FROM pedido WHERE IDPEDIDO = '".$key['mIdPedido']."'");
            if ($query->num_rows() == 0) {
                    $rtnUsuario['results'][$i]['mEstado'] = $this->db->query('CALL SP_pedidos ("'.$key['mIdPedido'].'","'.$key['mVendedor'].'","'.$key['mCliente'].'",
                                            "'.$key['mNombre'].'","'.$key['mFecha'].'","'.$key['mPrecio'].'","'.$key['mEstado'].'")');

               for ($e=0; $e <(count($key['detalles']['nameValuePairs']))/6; $e++){
                    $datos = array('IDPEDIDO' => $key['detalles']['nameValuePairs']['ID'.$i],
                                   'ARTICULO' => $key['detalles']['nameValuePairs']['ARTICULO'.$i],
                                   'DESCRIPCION' => $key['detalles']['nameValuePairs']['DESC'.$i],
                                   'CANTIDAD' => $key['detalles']['nameValuePairs']['CANT'.$i],
                                   'TOTAL' => number_format($key['detalles']['nameValuePairs']['TOTAL'.$i],2),
                                   'BONIFICADO' => $key['detalles']['nameValuePairs']['BONI'.$i]
                                );
                    $rtnUsuario['results'][$i]['mEstado'] = $this->db->insert('pedido_detalle',$datos);
                    $i++;
                }
            }else{
                $rtnUsuario['results'][$i]['mEstado'] = "ALGUNOS PEDIDOS NO SE ENVIARON PORQUE YA FUERON REGISTRADOS";
            }
        }
        
        echo json_encode($rtnUsuario);
    }
    
    public function updatePedidos($Post){
        $i = 0;
        $rtnPedido = array();
        foreach(json_decode($Post, true) as $key){
            $this->db->where('IDPEDIDO',$key['mIdPedido']);
            $this->db->select('IDPEDIDO,ESTADO');
            $query = $this->db->get('pedido');
            if ($query->num_rows()>0) {
                foreach ($query->result_array() as $key) {
                    $rtnPedido['results'][$i]['mIdPedido']  = $key['IDPEDIDO'];
                    $rtnPedido['results'][$i]['mEstado']    = $key['ESTADO'];
                    $i++;
                }
            }else{
                    $rtnPedido['results'][$i]['mIdPedido']  = " ";
                    $rtnPedido['results'][$i]['mEstado']    = " ";
            }
        }
        echo json_encode($rtnPedido);
    }

    public function Actividades(){
        $i=0;
        $rtnActividad = array();
        $query=$this->db->get('actividades');

        if ($query->num_rows()>0)
        {
            foreach ($query->result_array() as $key)
            {
                $rtnActividad['results'][$i]['mIdAE'] = $key['IDACTIVIDAD'];
                $rtnActividad['results'][$i]['mCategoria'] = $key['CATEGORIA'];
                $rtnActividad['results'][$i]['mActividad'] = $key['ACTIVIDAD'];
                $i++;
            }
        }
        echo json_encode($rtnActividad);
    }
}
?>
