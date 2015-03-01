<?php

/**
 * Displays the page containing the user list.
 *
 * @author Alex Luckett <lucketta@aston.ac.uk>
 */
class ViewUsers extends AuthenticatedAction {
    
    public function execute($requestParams) {
        $_REQUEST['users'] = UserDAO::getStudents();
    }

    public function pageInclude() {
        return "/view/staff/viewUserList.php";
    }

}
