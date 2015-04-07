<?php

namespace AppBundle\Controller;

use AppBundle\Utils\JsonLoader;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class BootyController extends FOSRestController
{
    /**
     * @Rest\View
     * @Route("/objects4Treasure/{id}", requirements={"id":"\d+","_method" = "GET"}, defaults={"_format" = "json"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function objects4Treasure($id)
    {
        $loader = new JsonLoader();
        try {
            $treasure = $loader->loadObject("treasure".$id.".json", 'AppBundle\Model\Treasure');

            $response = array("totale" => count($treasure->getOggetti()));
        }catch(Exception $e) {
            $response = "Problems with the treasure: ".$id;
        }
    	$view = $this->view($response, 200);
    	return $this->handleView($view);
    }

    /**
     * @Rest\View
     * @Route("/objects4Treasure/{id}", requirements={"id":"^(?!\d+).*$","_method" = "GET"}, defaults={"id":"","_format" = "json"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function objects4TreasureWrongFormat($id) {
        $view = $this->view("The treasure ID must be numeric (e.g /objects4Treasure/1).", 200);
        return $this->handleView($view);
    }

    /**
     * @Rest\View
     * @Route("/value4Treasure/{id}", requirements={"id":"\d+","_method" = "GET"}, defaults={"_format" = "json"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function value4Treasure($id)
    {
        $loader = new JsonLoader();
        try {
            $treasure = $loader->loadObject("treasure".$id.".json", 'AppBundle\Model\Treasure');

            $response = array("valore" => $treasure->getObjectValue());
        } catch(Exception $e) {
            $response = "Problems with the treasure: ".$id;
        }
        $view = $this->view($response, 200);
        return $this->handleView($view);
    }

    /**
     * @Rest\View
     * @Route("/value4Treasure/{id}", requirements={"id":"^(?!\d+).*$","_method" = "GET"}, defaults={"id":"","_format" = "json"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function value4TreasureWrongFormat($id) {
        $view = $this->view("The treasure ID must be numeric (e.g /value4Treasure/1).", 200);
        return $this->handleView($view);
    }

    /**
     * @Rest\View
     * @Route("/mostWanted", requirements={"_method" = "GET"}, defaults={"_format" = "json"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mostWanted()
    {
        $loader = new JsonLoader();
        $treasures = $loader->loadAllObjects("treasure", 'AppBundle\Model\Treasure');
        $applicants = $loader->loadObject("applicants.json", 'AppBundle\Model\Applicants');

        $mostWanted = $applicants->getMostWantedObject($treasures);
        $response = array("oggetto" => $mostWanted->object, "quantita" => $mostWanted->amount);
        $view = $this->view($response, 200);
        return $this->handleView($view);
    }

    /**
     * @Rest\View
     * @Route("/mostWanted4Treasure/{id}", requirements={"id":"\d+","_method" = "GET"}, defaults={"_format" = "json"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mostWanted4Treasure($id)
    {
        $loader = new JsonLoader();
        try {
            $treasure = $loader->loadObject("treasure".$id.".json", 'AppBundle\Model\Treasure');
            $applicants = $loader->loadObject("applicants.json", 'AppBundle\Model\Applicants');

            $mostWanted = $applicants->getMostWantedObject(array($treasure));
            $response = array("oggetto" => $mostWanted->object, "quantita" => $mostWanted->amount);
        } catch(Exception $e) {
            $response = "Problems with the treasure: ".$id;
        }
        $view = $this->view($response, 200);
        return $this->handleView($view);
    }

    /**
     * @Rest\View
     * @Route("/mostWanted4Treasure/{id}", requirements={"id":"^(?!\d+).*$","_method" = "GET"}, defaults={"id":"","_format" = "json"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mostWanted4TreasureWrongFormat($id) {
        $view = $this->view("The treasure ID must be numeric (e.g /mostWanted4Treasure/1).", 200);
        return $this->handleView($view);
    }
}
