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
        $query = $this->sqlsrv->fetchArray("SELECT * FROM vtVS2_Clientes WHERE VENDEDOR='".$Vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente['results'][$i]['mCliente']      = $key['CLIENTE'];
            $rtnCliente['results'][$i]['mNombre']       = $key['NOMBRE'];
            $rtnCliente['results'][$i]['mDireccion']    = $key['DIRECCION'];
            $rtnCliente['results'][$i]['mRuc']          = $key['RUC'];
            $rtnCliente['results'][$i]['mPuntos']       = $key['RUBRO1_CLI'];
            $rtnCliente['results'][$i]['mMoroso']       = $key['MOROSO'];

            $i++;
        }
        echo json_encode($rtnCliente);
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
            $rtnCliente['results'][$i]['mSaldo']        = number_format($key['SALDO'],2, '.', '');
            $rtnCliente['results'][$i]['mLimite']       = number_format($key['LIMITE_CREDITO'],2, '.', '');
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
            $rtnCliente['results'][$i]['mCredito']           = number_format($key['DISPONIBLE'],2,'.','');
            $rtnCliente['results'][$i]['mLimite']            = number_format($key['LIMITE_CREDITO'],2,'.','');
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
        $query = $this->db->get('rfactura');
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
        $link = @mysql_connect('localhost', 'root', 'a7m1425.')or die('No se pudo conectar: ' . mysql_error());            
        mysql_select_db('gmv') or die('No se pudo seleccionar la base de datos');
        $query = "SELECT * FROM usuario WHERE Usuario = '".$usuario."' AND Password = '".$pass."'";

        $result = mysql_query($query) or die('Consulta fallida: '.mysql_error());
        $key = mysql_fetch_array($result, MYSQL_ASSOC);

        if (count($key)>1) {
            $rtnUsuario['results'][$i]['mUsuario'] = $key['Usuario'];
            $rtnUsuario['results'][$i]['mNombre'] = $key['Nombre'];
            $rtnUsuario['results'][$i]['mIdUser'] = $key['IdUser']; 
        }
            echo json_encode($rtnUsuario);        
    }
    public function InsertCobros($json){
        foreach(json_decode($json, true) as $key){
            $Cobros = array(
                'IDCOBRO'     => $key['mIdCobro'],
                'CLIENTE'     => $key['mCliente'],
                'RUTA'        => $key['mRuta'],
                'TIPO'        => $key['mTipo'],
                'IMPORTE'        => $key['mImporte'],
                'OBSERVACION' => $key['mObservacion'],
                'FECHA'       => $key['mFecha']);
           $query = $this->db->insert('cobros', $Cobros);
        }
        echo json_encode($query);
    }

}
?>
