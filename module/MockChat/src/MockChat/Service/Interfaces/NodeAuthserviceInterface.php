<?php
/**
 * 
 * User: Windows
 * Date: 4/8/14
 * Time: 6:21 PM
 * 
 */

namespace MockChat\Service\Interfaces;


interface NodeAuthserviceInterface {

    function  get_identity();
    function getExpressSession();
    function getSessionSid();

} 