<?php

namespace App\Controller;

use App\Entity\Shot;
use App\Repository\ShotRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class OrangeElephantController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/orange/elephant', name: 'app_orange_elephant')]
    public function orangeElephant(): Response
    {
        return $this->render('orange_elephant/index.html.twig', [
            'controller_name' => 'OrangeElephantController',
        ]);
    }

//    #[Route('/shots', name: 'shots', methods: ['GET', 'HEAD'])]
//    public function shot(): Response
//    {
//        $repository = $this->em->getRepository(Shot::class);
//        $shot = $repository->findOneBy(['name' => 'Shark Attack']);
//
//        $encoders = [new JsonEncoder()]; // If no need for XmlEncoder
//        $normalizers = [new ObjectNormalizer()];
//        $serializer = new Serializer($normalizers, $encoders);
//
//        $jsonShot = $serializer->serialize($shot, 'json', [
//            'circular_reference_handler' => function ($object) {
//                return $object->getId();
//            }
//        ]);
//
//        return new Response($jsonShot, 200, ['Content-Type' => 'application/json']);
//    }

    #[Route('/shot/{name}', name: 'shot', defaults: ['name' => 'degraca'],  methods: ['GET', 'HEAD'])]
    public function getShot($name): Response
    {
        return $this->json([
            'message' => $name
        ]);
    }
}
