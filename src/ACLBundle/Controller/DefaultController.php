<?php

namespace ACLBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ACLBundle:Default:index.html.twig', array('name' => $name));
    }
}
