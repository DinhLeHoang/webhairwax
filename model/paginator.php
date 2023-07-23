<?php
    class Paginator {
  
    private $_conn;
    private $_limit;
    private $_page;
    public $_query;
    public $_total;
    public $_totalpage;
    public function __construct($query) {

        $this->_conn = ketnoi();
        $this->_query = $query;

        $rs = $this->_conn->query($this->_query);
        $this->_total = $rs->num_rows;
    }
    public function getData($limit, $page) {

        $this->_limit = $limit;
        $this->_page = $page;

        if ($this->_limit == 'all') {
            $query = $this->_query;
        } else {
            $query = $this->_query . " LIMIT " . ( ( $this->_page - 1 ) * $this->_limit ) . ", $this->_limit";
        }
        $this->_query = $query;
        $rs = $this->_conn->query($query);
        $this->_totalpage = $rs->num_rows;
        while ($row = $rs->fetch_assoc()) {
            $results[] = $row;
        }
        if(isset($results)){
            $result = new stdClass();
            $result->page = $this->_page;
            $result->limit = $this->_limit;
            $result->total = $this->_totalpage;
            $result->data = $results;
        }
        else{
            $results = array();
            $result = new stdClass();
            $result->page = $this->_page;
            $result->limit = $this->_limit;
            $result->total = $this->_totalpage;
            $result->data = $results;
        }
        return $result;
    }
    public function createLinks($links, $list_class) {
        if ($this->_limit == 'all') {
            return '';
        }

        $last = ceil($this->_total / $this->_limit);

        $start = ( ( $this->_page - $links ) > 0 ) ? $this->_page - $links : 1;
        $end = ( ( $this->_page + $links ) < $last ) ? $this->_page + $links : $last;

        $html = '<ul class="' . $list_class . ' justify-content-center">';

        $class = ( $this->_page == 1 ) ? "disabled" : "";
        $disablelinkprev = ( $this->_page == 1 ) ? "style=\"pointer-events: none; cursor: default;\"": "";
        $html .= '<li class="page-item ' . $class . '"><a class="page-link" '.$disablelinkprev.'" href="?limit=' . $this->_limit . '&page=' . ( $this->_page - 1 ) . '">Previous</a></li>';

        if ($start > 1) {
            $html .= '<li class="page-item"><a class="page-link" href="?limit=' . $this->_limit . '&page=1">1</a></li>';
            $html .= '<li class="page-item disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class = ( $this->_page == $i ) ? "active" : "";
            $html .= '<li class="page-item ' . $class . '"><a class="page-link" href="?limit=' . $this->_limit . '&page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html .= '<li class="page-item disabled"><span>...</span></li>';
            $html .= '<li class="page-item"><a class="page-link" href="?limit=' . $this->_limit . '&page=' . $last . '">' . $last . '</a></li>';
        }
        $disablelinknext = "";
        if($last == 0){
            $class = "disabled";
            $disablelinknext = "style=\"pointer-events: none; cursor: default;\"";
        }
        else{
            $class = ( $this->_page == $last ) ? "disabled" : "";
            $disablelinknext = ( $this->_page == $last ) ? "style=\"pointer-events: none; cursor: default;\"": "";
        }
        $html .= '<li class="page-item ' . $class . '"><a class="page-link" '.$disablelinknext.'" href="?limit=' . $this->_limit . '&page=' . ( $this->_page + 1 ) . '">Next</a></li>';

        $html .= '</ul>';

        return $html;
    }

}
?>

