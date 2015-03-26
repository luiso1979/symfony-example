<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class DefaultController extends FOSRestController
{
    /**
     * @Rest\View
     * @Route("/helloworld", requirements={"_method" = "GET"}, defaults={"_format" = "json"})
     */
    public function helloworldAction()
    {
    	$response = array("response" => "Hello world");
    	$view = $this->view($response, 200);
    	return $this->handleView($view);
    }
}
