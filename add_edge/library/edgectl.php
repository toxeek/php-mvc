<?php
/** 
 *  Abstract class - instantiates an Edge Object and 
 *  serves also as a Helper class.
 *  
 */ 

abstract class Edge_Abstract extends Yospace_Abstract {

    // class variables
    protected $_edgeDnsName;
    protected $_edgeIpAddress;
    protected $_edgeCreationTimeStamp;
    protected $_edgePop;


    // class constructor
    public function __construct($edgeDnsName,$edgeIpAddress) {
        parent::_construct();
        $_edgeDnsName   = $edgeDnsName;
        $_edgeIpAddress = $edgeIpAddress;
        

    }

    // class getter
    public function getEdgeDetails($edgeInstance) {
        

    }

    // class setter
    public function setEdgeDetails($edgeInstance) {


    }



}





