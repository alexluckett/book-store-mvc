<?php

/**
 * Used when a static php file needs to be displayed.
 *
 * @author Alex Luckett <lucketta@aston.ac.uk>
 */
class LoadPage extends GuestAction {
    
    private $filePath;
    private $filename;
    
    public function __construct($filePath, $filename) {     
        $this->filePath = trim($filePath);
        $this->filename = trim($filename);
    }

    public function execute($requestParams) { } // nothing to do for simply loading pages!
    
    /**
     * Returns the full file path
     * 
     * @return string filePath
     */
    private function getFullPath() {
        $path = $this->filePath;
        $file = $this->filename;
        
        $fullPath = "";
        
        if(strlen($path) == 0) {
            $fullPath = $file;
        } else {
            $fullPath = $path.'/'.$file;
        }
        
        return $fullPath;
    }

    public function pageInclude() {
        return $this->getFullPath();
    }

}