<?php
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        $output = json_encode(array(
            'type' => 'error',
            'text' => 'Sorry Request must be Ajax GET'
        ));
        die($output);
    }
    if ( $_GET && !empty(filter_var($_GET['gDocID'])) ) {
        $MTgDocID               = filter_var($_GET['gDocID']);
        $MTgDocArray            = array();
        $MTgDocArray['start']   = '<div id="contents">';
        $MTgDocArray['end']     = '<div id="footer">';
        $MTgDocGetContent       = file_get_contents('https://docs.google.com/document/pub?id=' . $MTgDocID);
        $MTgDocGetContentStart  = strpos( $MTgDocGetContent, $MTgDocArray["start"] );
        $MTgDocGetContentEnd    = strpos( $MTgDocGetContent, $MTgDocArray["end"] );
        $MTgDocContent          = substr( $MTgDocGetContent, $MTgDocGetContentStart, ($MTgDocGetContentEnd - $MTgDocGetContentStart) );
        echo preg_replace("|<style\b[^>]*>(.*?)</style>|s", "", $MTgDocContent);
    }
