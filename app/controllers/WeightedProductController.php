<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\Alternatif;
use Model\Kriteria;
use Model\AlternatifToKriteria;
use Petruk\Framework\UploadFile;
use Petruk\Framework\Auth;
use Petruk\Framework\Paginator;
use Josantonius\Session\Session;
use Validator\ValidatorFactory;

class WeightedProductController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $kriterias = (new Kriteria)->orderBy('id', 'ASC')->get();

        $alternatifs = (new Alternatif)->with(array('altToKriteria' => function($q) {
            $q->orderBy('kriteria_id', 'ASC');
        }))->orderBy('id', 'ASC')->get();
        // $altToKriteria = (new AlternatifToKriteria)->orderBy(, 'ASC')->get();

        $data['totalValue'] = 0;
        
        for ($i = 0; $i < count($kriterias); $i++) {
            $data['totalValue'] += $kriterias[$i]['bobot'];
        }

        $data['totalValueFixing'] = 0;
        for ($i = 0; $i < count($kriterias); $i++) {
            $kriterias[$i]['weight_fixing'] = $kriterias[$i]['bobot'] / $data['totalValue'];
            $data['totalValueFixing'] += $kriterias[$i]['weight_fixing'];
        }

        $data['totalValueVektor'] = 0;
        for ($i = 0; $i < count($alternatifs); $i++) {
            for ($j = 0; $j < count($alternatifs[$i]['altToKriteria']); $j++) {
                if(!isset($alternatifs[$i]['vektor'])) {
                    $alternatifs[$i]['vektor'] = 1;
                }
                if ($kriterias[$j]['atribut'] == 'benefit') {
                    $alternatifs[$i]['altToKriteria'][$j]['test'] = pow($alternatifs[$i]['altToKriteria'][$j]['nilai'], $kriterias[$j]['weight_fixing']);
                } else {
                    $alternatifs[$i]['altToKriteria'][$j]['test'] = pow($alternatifs[$i]['altToKriteria'][$j]['nilai'], -($kriterias[$j]['weight_fixing']));
                }    
                $alternatifs[$i]['vektor'] = $alternatifs[$i]['vektor'] * $alternatifs[$i]['altToKriteria'][$j]['test'];
            }            
            $data['totalValueVektor'] += $alternatifs[$i]['vektor'];
        }

        // $newAlternatifs = array();

        for ($i = 0; $i < count($alternatifs); $i++) {
            $newAlternatifs[$i] = array(
                'id' => $alternatifs[$i]['id'],
                'alternatif' => $alternatifs[$i]['alternatif'],
                'ranking_value' => $alternatifs[$i]['vektor'] / $data['totalValueVektor'],
            );
            // $newAlternatifs[$i]['ranking_value'] = $newAlternatifs[$i]['vektor'] / $data['totalValueVektor'];
        }

        usort($newAlternatifs, array($this, 'sortRank'));

        // return $this->json(compact('alternatifs', 'kriterias', 'data', 'newAlternatifs'));
        return $this->render('page/weighted_product/index', compact('alternatifs', 'kriterias', 'data', 'newAlternatifs'));

    }

    function sortRank($a, $b) {
        $a = $a['ranking_value'];
        $b = $b['ranking_value'];
    
        if ($a == $b) return 0;
        return ($a > $b) ? -1 : 1;
    }

}
