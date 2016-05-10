<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10.05.16
 * Time: 11:51
 */

namespace App\Http\Controllers;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    public $statusCode = 200;

    public function getStatusCode() {

        return $this->statusCode;
    }
    public function setStatusCode($statusCode) {

        $this->statusCode = $statusCode;
        return $this;
    }
    public function respondNotFound($message = 'Not found') {

        return $this->setStatusCode(404)->respondWithError($message);

    }
    public function respondInternalError($message = 'Internal Error') {

        return $this->setStatusCode(500)->respondWithError($message);

    }

    public function respondWithError($message){
        return $this->respond([
            'data' => null,
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode(),
            ]

        ]);
    }

    public function respond($data, $headers = []) {

        $data['access'] = true;

        return Response::json($data, $this->getStatusCode(), $headers);

    }

    public function respondWithPagination(LengthAwarePaginator $paginator, $data) {

        $data['access'] = true;

        $aPaginator = [
            'total' => $paginator->total(),
            'total_pages' => ceil($paginator->total() / $paginator->perPage()),
            'current_page' => $paginator->currentPage(),
            'limit' => $paginator->perPage(),
        ];
        return $this->respond([
            'data' => $data,
            'paginator' => $aPaginator
        ]);

    }

    public function respondCreated($message = 'Created') {

        return $this->setStatusCode(200)->respond([
            'message' => $message,
            'access' => true
        ]);
    }

}