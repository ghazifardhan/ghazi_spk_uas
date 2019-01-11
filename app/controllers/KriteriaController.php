<?php

namespace Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Model\Kriteria;
use Model\AlternatifToKriteria;
use Petruk\Framework\UploadFile;
use Petruk\Framework\Auth;
use Petruk\Framework\Paginator;
use Josantonius\Session\Session;
use Validator\ValidatorFactory;

class KriteriaController extends Controller {

    private $kriteria;

    public function __construct() {
        parent::__construct();

        $this->kriteria = new Kriteria();
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

        $kriterias = $this->kriteria
                    ->offset($from)
                    ->limit($perPage)
                    ->get();

        $paginator = (new Paginator)->paginate($kriterias, $perPage, $page);

        // return $this->json(compact('users', 'paginator'));
        
        return $this->render('page/kriteria/index', compact('kriterias', 'paginator'));
    }

    public function create() {
        return $this->render('page/kriteria/create');
    }

    public function store() {

        $requestData = $this->request->request->all();
        $valid = $this->_validate($requestData);

        if ($valid->passes() === TRUE) {
            $this->kriteria->fill([
                'kriteria' => $requestData['kriteria'],
                'bobot' => $requestData['bobot'],
                'atribut' => $requestData['atribut'],
            ]);
            if ($this->kriteria->save()) {
                $data['success'] = true;
                $data['message'] = 'Berhasil membuat kriteria';
                return $this->redirect('/kriteria?success=' . $data['success'] . '&message=' . $data['message']);
            } else {
                $data['success'] = false;
                $data['message'] = 'Gagal membuat kriteria';
                return $this->redirect('/kriteria?success=' . $data['success'] . '&message=' . $data['message']);
            }
        } else {            
            $errors = $valid->errors();
            return $this->render('page/kriteria/create', compact('errors'));
        }        

    }

    public function edit($id) {
        $kriteria = $this->kriteria->find($id);
        return $this->render('page/kriteria/edit', compact('kriteria'));
    }

    public function update($id) {
        $requestData = $this->request->request->all();
        $valid = $this->_validate($requestData);
        $kriteria = $this->kriteria->find($id);

        if ($valid->passes() === TRUE) {
            $kriteria->fill([
                'kriteria' => $requestData['kriteria'],
                'bobot' => $requestData['bobot'],
                'atribut' => $requestData['atribut'],
            ]);
            if ($kriteria->save()) {
                $data['success'] = true;
                $data['message'] = 'Berhasil membuat kriteria';
                return $this->redirect('/kriteria?success=' . $data['success'] . '&message=' . $data['message']);
            } else {
                $data['success'] = false;
                $data['message'] = 'Gagal membuat kriteria';
                return $this->redirect('/kriteria?success=' . $data['success'] . '&message=' . $data['message']);
            }
        } else {            
            $errors = $valid->errors();
            return $this->render('page/kriteria/edit', compact('errors'));
        } 
    }

    public function destroy($id) {
        $this->kriteria->destroy($id);

        $alternatifToKriteria = (new AlternatifToKriteria)->where('kriteria_id', $id)->delete();
    
        return $this->redirect('/kriteria');
    }

    protected function _validate($data) {
        $validators = $this->kriteria->validate;
        $messages = $this->kriteria->message;

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
