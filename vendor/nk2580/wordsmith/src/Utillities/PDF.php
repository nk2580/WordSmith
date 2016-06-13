<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nk2580\wordsmith\Utillities;

use \Knp\Snappy\Pdf as Snappy;

/**
 * PDF Exporter Wrapper for snappy PDF - this utillitiy relies uppon the wkhtmltopdf binary
 * please ensure your server has access to this binary before using this class or it will return an error
 * for information on this binary  - 
 *
 * @author accounts
 */
class PDF {

    public $snappy;

    public function __construct($path = NULL) {
        if (!empty($path)) {
            $pdf_binary_path = $path;
        } else if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $pdf_binary_path = 'C:\wkhtmltopdf\bin\wkhtmltopdf.exe';
        } else {
            $pdf_binary_path = '/usr/local/bin/wkhtmltopdf';
        }
        $this->snappy = new Snappy($pdf_binary_path);
        $upload_dir = wp_upload_dir();
        $this->snappy->setTemporaryFolder($upload_dir['path']);
    }

    /**
     * Generate a PDF from a URL and return its filename
     * 
     * @param String $url
     * @param String $filename
     * @param Array $options
     * @return String
     */
    public function generate($url, $filename, $options = array()) {
        $this->cleanExport($filename);
        $this->snappy->generate($url, $filename, $options);
        return $filename;
    }

    /**
     * Generate a PDF from HTML and reutrn it's filename
     *  
     * @param String $html
     * @param String $filename
     * @param Array $options
     * @return String 
     */
    public function generateFromHtml($html, $filename, $options = array()) {
        $this->cleanExport($filename);
        $this->snappy->generateFromHtml($html, $filename, $options);
        return $filename;
    }

    /**
     * show the output of a PDF generated on the fly with a URL
     * 
     * @param String $url
     * @param Array $options
     */
    public function output($url, $filename, $options = array()) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $this->snappy->getOutput($url, $options);
    }

    /**
     * show the output of a PDF generated on the fly with HTML
     * 
     * @param String $html
     * @param Array $options
     */
    public function outputFromHtml($html, $filename, $options = array()) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        echo $this->snappy->getOutputFromHtml($html, $options);
    }

    private function cleanExport($filename) {
        if (isset($filename) && file_exists($filename)) {
            unlink($filename);
        }
    }

}
