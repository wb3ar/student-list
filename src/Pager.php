<?php

namespace MyLibrary;

/**
 * Класс модели постраничной навигации.
 */
class Pager
{
    private $totalPages;
    private $recordsPerPage;
    private $templatePageUrl;
    private $currentPage;
    public function __construct($totalRecords, $recordsPerPage, $templatePageUrl, $page)
    {
        $this->totalPages = ceil($totalRecords / $recordsPerPage);
        $this->recordsPerPage = $recordsPerPage;
        $this->templatePageUrl = $templatePageUrl;
        $this->currentPage = $page;
    }
    public function getVar($var)
    {
        return $this->$var;
    }
    public function getLinkForPage($search, $page, $order, $desc)
    {
        if (!empty($search)) {
            $queryArray['search'] = htmlSpec($search);
        }
        if (!empty($page) and $page !== 1) {
            $queryArray['page'] = $page;
        }
        if (!empty($order)) {
            $queryArray['order'] = $order;
            if (!empty($desc)) {
                $queryArray['desc'] = 1;
            }
        }

        $url = $this->templatePageUrl.http_build_query($queryArray);

        return $url;
    }
    public function getOffset()
    {
        return $this->getVar('recordsPerPage') * $this->getVar('currentPage') - $this->getVar('recordsPerPage');
    }
}
