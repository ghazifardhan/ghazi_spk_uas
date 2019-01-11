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

class AlternatifController extends Controller {

    private $alternatif;

    public function __construct() {
        parent::__construct();

        $this->alternatif = new Alternatif();
    }

    public function index() {

        $perPage = 25;
        $page = empty($this->request->query->get('page')) ? 1 : $this->request->query->get('page');

        if  (!empty($page)) {
            $from = $page > 1 ? ($page * $perPage) - $perPage : $page - 1;
            $to = $page > 1 ? ($perPage * $page) : $perPage;
        } else {
            $from = 0;
            $to = $perPage;
        }

        $alternatifs = $this->alternatif
                    ->offset($from)
                    ->limit($perPage)
                    ->get();

        $paginator = (new Paginator)->paginate($alternatifs, $perPage, $page);

        // return $this->json(compact('users', 'paginator'));
        
        return $this->render('page/alternatif/index', compact('alternatifs', 'paginator'));
    }

    public function create() {
        return $this->render('page/alternatif/create');
    }

    public function store() {

        $requestData = $this->request->request->all();
        $valid = $this->_validate($requestData);

        if ($valid->passes() === TRUE) {
            $this->alternatif->fill([
                'alternatif' => $requestData['alternatif'],
            ]);
            if ($this->alternatif->save()) {
                $data['success'] = true;
                $data['message'] = 'Berhasil membuat alternatif';
                return $this->redirect('/alternatif?success=' . $data['success'] . '&message=' . $data['message']);
            } else {
                $data['success'] = false;
                $data['message'] = 'Gagal membuat alternatif';
                return $this->redirect('/alternatif?success=' . $data['success'] . '&message=' . $data['message']);
            }
        } else {            
            $errors = $valid->errors();
            return $this->render('page/alternatif/create', compact('errors'));
        }        

    }

    public function show($id) {
        $alternatif = $this->alternatif->find($id);
        $kriterias = (new Kriteria)->orderBy('id', 'ASC')->get();
        $altToKriteria = (new AlternatifToKriteria)->with('alternatif', 'kriteria')->where('alternatif_id', $id)->orderBy('kriteria_id', 'ASC')->get();

        $isCreate = true;
        if (count($altToKriteria) > 0) {
            $isCreate = false;
        }

        return $this->render('page/alternatif/show', compact('kriterias', 'altToKriteria', 'alternatif', 'isCreate'));
    }

    public function edit($id) {
        $alternatif = $this->alternatif->find($id);
        return $this->render('page/alternatif/edit', compact('alternatif'));
    }

    public function update($id) {
        $requestData = $this->request->request->all();
        $valid = $this->_validate($requestData);
        $alternatif = $this->alternatif->find($id);

        if ($valid->passes() === TRUE) {
            $alternatif->fill([
                'alternatif' => $requestData['alternatif'],
            ]);
            if ($alternatif->save()) {
                $data['success'] = true;
                $data['message'] = 'Berhasil membuat alternatif';
                return $this->redirect('/alternatif?success=' . $data['success'] . '&message=' . $data['message']);
            } else {
                $data['success'] = false;
                $data['message'] = 'Gagal membuat alternatif';
                return $this->redirect('/alternatif?success=' . $data['success'] . '&message=' . $data['message']);
            }
        } else {            
            $errors = $valid->errors();
            return $this->render('page/alternatif/edit', compact('errors'));
        } 
    }

    public function destroy($id) {
        $this->alternatif->destroy($id);
    
        return $this->redirect('/alternatif');
    }

    protected function _validate($data) {
        $validators = $this->alternatif->validate;
        $messages = $this->alternatif->message;

        if (!empty($fields)) {
            foreach ($fields as $field) {
                $validator[$field] = $validators[$field];
            }
        } else {
            $validator = $validators;
        }

        $invalid = (new ValidatorFactory)->make($data, $validator, $messages);

        return $invalid;        
    }
}
