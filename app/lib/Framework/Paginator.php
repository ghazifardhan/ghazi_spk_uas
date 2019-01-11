<?php

namespace Petruk\Framework;

class Paginator {

    public function paginate($datas, $perPage, $page) {
        $items = $datas;
        $total = ceil(count($items)/$perPage);
        
        if($total > 5) {
            if ($page > 1) {
                $startPage = ($total - $page) < 5 ? $total - 4 : $page;
                $endPage = ($total - $page) < 5 ? $total : $page + 4;
            } else {
                $startPage = ($total - $page) < 5 ? $page - ($page - 6) : $page;
                $endPage = $page + 4;
            }                
        }

        if($total <= 5) {
            if ($page > 1) {
                $startPage = 1;
                $endPage = $total;
            } else {
                $startPage = $page;
                $endPage = $total;
            }  
        }

        for ($i = $startPage ; $i <= $endPage ; $i++) {
            $elements[] = [
                'page' => $i,
                'url' => '?page=' . $i
            ];
        }

        $nextPageUrl = $total == $page ? $total : $page + 1;
        $previousPageUrl = $page == 1 ? 1 : $page - 1;

        $page = [
            'onFirstPage' => $page == 1 ? true : false,
            'nextPageUrl' => "?page=" . $nextPageUrl,
            'previousPageUrl' => "?page=" . $previousPageUrl,
            'total' => count($items),
            'startPage' => $startPage,
            'endPage' => $endPage,
            'currentPage' => $page,
            'lastPage' => $total,
            'elements' => $total > 0 ? $elements : array(),
            'hasMorePages' => $page == $total ? false : true
        ];

        return $page;
    }
}