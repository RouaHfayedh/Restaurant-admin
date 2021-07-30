<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Ad;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AdController extends AbstractController
{
    /**
     * @Route("/allAd", name="All_ad")
     */
    public function index(SerializerInterface $serializer): Response
    {
        $ads=$this->getDoctrine()->getRepository(Ad::class)->findAll();
        $response = new Response( $serializer->serialize(
            $ads,
            'json', ['groups' => ['default' ]]
        ));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/ad/{id}", name="ad_ByID")
     */
    public function show(SerializerInterface $serializer,$id) : Response
    {
        $ad=$this->getDoctrine()->getRepository(Ad::class)->find($id);
        $response = new Response($serializer->serialize(
            $ad,
            'json', ['groups' => ['default' ]]
        ));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }
}
