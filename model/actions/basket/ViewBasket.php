<?php

/**
 * Description of ViewBasket
 *
 * @author Alex Luckett <lucketta@aston.ac.uk>
 */
class ViewBasket extends AuthenticatedAction {
    
    public function __construct($permissionInteger) {
        parent::__construct($permissionInteger);
    }
    
    public function execute($requestParams) {
        $userId = $_SESSION['userId'];
        $bookList = BasketDAO::getBooksFromBasket($userId);
        
        $_REQUEST['bookList'] = $bookList;
    }

    public function pageInclude() {
        return "/view/student/viewBasket.php";
    }
}
