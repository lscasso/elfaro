<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class estadisticas extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('helper');
        
        
    }

    public function index() {
        $this->historicoPartidos();
    }

    public function campeonato($id=null) {
        if (!isset($id))
            show_404 ();
            
        $header = $this->db->select('nombre')->from('Campeonatos')->where('id', $id)->get()->row();
        if (count($header) == 0)
            show_404 ();
        $data['partidos'] = $this->db->select('Partidos.id')->select('Equipos.nombre')->select('golesFaro')->select('golesRival')
                        ->select('fecha')->select('instancia')->select('penalesFaro')->select('penalesRival')->select('Canchas.nombre as cancha')
                        ->select('Jueces.nombre as juez')
                        ->select('rival')
                        ->from('Partidos')
                        ->join('Equipos', 'Equipos.id = Partidos.rival')->join('Canchas', 'Partidos.cancha = Canchas.id', 'left')
                        ->join('Jueces', 'Jueces.id = juez', 'left')
                        ->where('idCampeonato', $id)
                        ->order_by('fecha')->get()->result_array();
        
        $info = $this->totalesP($data);  
        $data['incidencias'] = $info['incidencias'];
        $data['titulo'] = 'Partidos';
        $header->jugadores = $this->listadoJugadores();
        $header->rivales = $this->listadoRivales();
        $header->campeonatos = $this->listadoCampeonatos();
        $this->load->view('header',$header);
        $this->load->view('partidos', $data);
        $this->load->view('totales', $info['totales']);
        $this->load->view('goleadores', $this->goleador($id,'idCampeonato'));
        $this->load->view('footer',  $this->lastUpdate());
    }
    
    public function rival($id = null) {
        if (!isset($id))
            show_404 ();
        $header = $this->db->select('Concat("vs ",nombre) as nombre', false)->from('Equipos')->where('id', $id)->get()->row();
        if (count($header) == 0)
            show_404 ();
        $data['partidos'] = $this->db->select('Partidos.id')->select('Equipos.nombre')->select('golesFaro')->select('golesRival')
                        ->select('fecha')
                        ->select('CONCAT(instancia," ",Campeonatos.nombre) as instancia', false)
                        ->select('penalesFaro')->select('penalesRival')->select('Canchas.nombre as cancha')
                        ->select('Jueces.nombre as juez')
                        ->select('rival')
                        ->from('Partidos')
                        ->join('Campeonatos', 'Campeonatos.id = Partidos.idCampeonato')
                        ->join('Equipos', 'Equipos.id = Partidos.rival')->join('Canchas', 'Partidos.cancha = Canchas.id', 'left')
                        ->join('Jueces', 'Jueces.id = juez', 'left')
                        ->where('rival', $id)
                        ->order_by('fecha')->get()->result_array();
        
        $info = $this->totalesP($data);         
        $data['titulo'] = 'Partidos';
        $data['incidencias'] = $info['incidencias'];
        $header->jugadores = $this->listadoJugadores();
        $header->rivales = $this->listadoRivales();
        $header->campeonatos = $this->listadoCampeonatos();
        $this->load->view('header',$header);
        $this->load->view('totales', $info['totales']);
        $this->load->view('goleadores', $this->goleador($id,'rival'));
        $this->load->view('partidos', $data);
        $this->load->view('footer',$this->lastUpdate());
    }
    
    public function jugadores($id = null){
        if (!isset($id))
            show_404 ();
        $header = $this->db->select('Jugadores.*')->select('sum(if (tipo = 1 || tipo = 2,1,0)) as goles',false)
                ->select('sum(if (tipo = 3,1,0)) as amarillas',false)
                ->select('sum(if (tipo = 4,1,0)) as rojas',false)
                ->from('Jugadores')
                 ->join('Incidencias','Jugadores.id = Incidencias.idJugador','left')->where('Jugadores.id',$id)->get()->row();
        if (count($header) == 0)
            show_404 ();
        $header->jugadores = $this->listadoJugadores();
        $header->rivales = $this->listadoRivales();
        $header->campeonatos = $this->listadoCampeonatos();
        $this->load->view('header',$header);
        $this->load->view('jugadores',$header);
        $data['partidos'] = $this->getPartidos($id,'Goles');
        if (count($data['partidos'])){
            $info = $this->totalesP($data);         
            $data['incidencias'] = $info['incidencias'];
            $data['titulo'] = 'Goles';
            $this->load->view('partidos', $data);
        }
        $dataA['partidos'] = $this->getPartidos($id,'Amarillas');
        if (count($dataA['partidos'])){
            $infoA = $this->totalesP($dataA);
            $dataA['incidencias'] = $infoA['incidencias'];
            $dataA['titulo'] = 'Amarillas';
            $this->load->view('partidos', $dataA);
            
        }
        $dataR['partidos'] = $this->getPartidos($id,'Rojas');
        if (count($dataR['partidos'])){
            $infoR = $this->totalesP($dataR);         
            $dataR['incidencias'] = $infoR['incidencias'];
            $dataR['titulo'] = 'Rojas';
            $this->load->view('partidos', $dataR);
        }
        $this->load->view('footer',$this->lastUpdate());
    }
    
    private function getPartidos($idJugador, $tipo){
         $this->db->select('Distinct(Partidos.id)')->select('Equipos.nombre')->select('golesFaro')->select('golesRival')
                        ->select('fecha')
                        ->select('CONCAT(instancia," ",Campeonatos.nombre) as instancia', false)
                        ->select('penalesFaro')->select('penalesRival')->select('Canchas.nombre as cancha')
                        ->select('Jueces.nombre as juez')
                        ->select('rival')
                        ->from('Partidos')
                        ->join('Campeonatos', 'Campeonatos.id = Partidos.idCampeonato')
                        ->join('Incidencias', 'Partidos.id = Incidencias.idPartido')
                        ->join('Equipos', 'Equipos.id = Partidos.rival')->join('Canchas', 'Partidos.cancha = Canchas.id', 'left')
                        ->join('Jueces', 'Jueces.id = juez', 'left')
                        ->where('idJugador',$idJugador);
         if ($tipo == 'Goles')
              $this->db->where('tipo = 2 || tipo = 1');
         if ($tipo == 'Amarillas')
              $this->db->where('tipo = 3');
         if ($tipo == 'Rojas')
              $this->db->where('tipo = 4');
                      
         return $this->db->order_by('fecha')->get()->result_array();
         
    }
   public function historicoPartidos(){
       
       $resultado['rivales'] = $this->db->select('Equipos.id')->select('Equipos.nombre')->select('sum(if(golesFaro>golesRival,1,0)) as ganados',false)
               ->select('sum(if(golesFaro=golesRival,1,0)) as empatados',false)
               ->select('sum(if(golesFaro>golesRival,1,0)) as perdidos',false)
               ->select('sum(golesFaro) as golesF')->select('sum(golesRival) as golesC')
               ->select('sum(if(golesFaro=golesRival AND penalesFaro!=NULL AND penalesRival!=NULL AND penalesFaro>penalesRival,1,0)) as gPenales',false)
               ->select('sum(if(golesFaro=golesRival AND penalesFaro!=NULL AND penalesRival!=NULL AND penalesFaro<penalesRival,1,0)) as pPenales',false)
               ->from('Equipos')
               ->join('Partidos','Equipos.id = Partidos.rival')
               ->group_by('Equipos.id, Equipos.nombre')
               ->order_by('Equipos.nombre')->get()->result_array();
        $header['nombre'] = 'Tabla Histórica de resultados';
        $header['jugadores'] = $this->listadoJugadores();
        $header['rivales'] = $this->listadoRivales();
        $header['campeonatos'] = $this->listadoCampeonatos();
        $this->load->view('header',$header);
        $this->load->view('tablaHistorica', $resultado);
        $this->load->view('footer',$this->lastUpdate());
    }
    private function totalesP($data) {
        $array = array();
        $totales['ganados'] = 0;
        $totales['perdidos'] = 0;
        $totales['empatados'] = 0;
        $totales['gPenales'] = 0;
        $totales['pPenales'] = 0;
        $totales['golesF'] = 0;
        $totales['golesC'] = 0;
        foreach ($data['partidos'] as $partido) {
            $array[$partido['id']] = $this->db->select('Jugadores.id')->select('Jugadores.nombre')->select('tipo')
                    ->from('Incidencias')->join('Jugadores', 'Incidencias.idJugador = Jugadores.id', 'left')
                            ->where('idPartido', $partido['id'])->order_by('orden')->get()->result_array();
            $totales['golesF'] += $partido['golesFaro'];
            $totales['golesC'] += $partido['golesRival'];
            if ($partido['golesFaro'] > $partido['golesRival'])
                $totales['ganados'] ++;
            else if ($partido['golesFaro'] < $partido['golesRival'])
                $totales['perdidos'] ++;
            else {
                $totales['empatados'] ++;
                if (isset($partido['penalesFaro']) && isset($partido['penalesRival'])) {
                    if ($partido['penalesFaro'] > $partido['penalesRival'])
                        $totales['gPenales'] ++;
                    else
                        $totales['pPenales'] ++;
                }
            }
        }
        $info['incidencias'] = $array;
        $info['totales'] = $totales;
        return $info;
    }
    private function lastUpdate(){
        $last = $this->db->select('fecha')->select('instancia')->select('nombre')->from('Partidos')
                ->join('Campeonatos', 'Campeonatos.id = Partidos.idCampeonato')
                ->where('fecha in (select max(fecha) from Partidos)')->get()->row();
        
        return $last;
    }
    
    public function goleadores($id = null){
        if (isset($id))
             $header = $this->db->select('nombre')->from('Campeonatos')->where('id', $id)->get()->row();
        else{
            $header = new stdClass();
            $header->nombre = 'Tabla Histórica de Goleadores';
        }
        if (count($header) == 0)
            show_404 ();
        $header->jugadores = $this->listadoJugadores();
        $header->rivales = $this->listadoRivales();
        $header->campeonatos = $this->listadoCampeonatos();
        $this->load->view('header',$header);
        $this->load->view('goleadores', $this->goleador($id,'idCampeonato'));
        $this->load->view('footer',$this->lastUpdate());
    }
            
    private function goleador($id = null,$tipo = null){
        
        $this->db->select('sum(if (tipo = 1,1,0)) as jugada',false)
                ->select('sum(if (tipo = 2,1,0)) as penales',false)
                ->select('Jugadores.nombre')
                ->select('Jugadores.id')->from('Incidencias')
                ->join('Partidos','Partidos.id = Incidencias.idPartido')
                ->join('Jugadores','Jugadores.id = Incidencias.idJugador');
        if (isset($id)){
            $this->db->where($tipo,$id);
        }
        $goleadores['goleadores'] = $this->db->where('tipo = 2 or tipo = 1')->group_by('idJugador')->order_by('count(tipo)')
                ->get()->result_array();
        return $goleadores;
    }
    
    private function listadoJugadores(){
        return $this->db->select('id')->select('nombre')->from('Jugadores')->order_by('nombre')->get()->result_array();
    }
    private function listadoCampeonatos(){
        return $this->db->select('id')->select('nombre')->from('Campeonatos')->order_by('nombre')->get()->result_array();
    }
    private function listadoRivales(){
        return $this->db->select('id')->select('nombre')->from('Equipos')->order_by('nombre')->get()->result_array();
    }
}
