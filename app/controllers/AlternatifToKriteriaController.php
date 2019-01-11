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

class AlternatifToKriteriaController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function store() {

        $requestData = $this->request->request->all();

        for ($i = 0; $i < count($requestData['alternatif_id']); $i++) {
            $altToKriteria[$i] = new AlternatifToKriteria();
            $altToKriteria[$i]->fill([
                'alternatif_id' => $requestData['alternatif_id'][$i],
                'kriteria_id' => $requestData['kriteria_id'][$i],
                'nilai' => $requestData['nilai'][$i] == "" ? 0 : $requestData['nilai'][$i],
            ]);
            $altToKriteria[$i]->save();
        }

        $data['success'] = true;
        $data['message'] = 'Berhasil mengubah data';

        return $this->redirect('/alternatif?success=' . $data['success'] . '&message=' . $data['message']);

    }

    public function update() {
        $requestData = $this->request->request->all();

        for ($i = 0; $i < count($requestData['alternatif_id']); $i++) {
            $altToKriteria[$i] = (new AlternatifToKriteria)->where([
                'alternatif_id' => $requestData['alternatif_id'][$i],
                'kriteria_id' => $requestData['kriteria_id'][$i]
                ])->first();
            $altToKriteria[$i]->fill([
                'alternatif_id' => $requestData['alternatif_id'][$i],
                'kriteria_id' => $requestData['kriteria_id'][$i],
                'nilai' => $requestData['nilai'][$i] == "" ? 0 : $requestData['nilai'][$i],
            ]);
            $altToKriteria[$i]->save();
        }

        $data['success'] = true;
        $data['message'] = 'Berhasil mengubah data';

        return $this->redirect('/alternatif?success=' . $data['success'] . '&message=' . $data['message']);
    }

}
