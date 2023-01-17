<?php

namespace App\Controller;

use App\Entity\Shot;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ShotsController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/shots', name: 'shots', methods: ['GET', 'HEAD'])]
    public function shots(): Response
    {
        $repository = $this->em->getRepository(Shot::class);
        $shots = $repository->findAll();

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $jsonShots = $serializer->serialize($shots, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        return new Response($jsonShots, 200, ['Content-Type' => 'application/json']);
    }

    #[Route('/shot/{id}', name: 'shot', defaults: ['id' => '1'], methods: ['GET', 'HEAD'])]
    public function shot($id): Response
    {
        $repository = $this->em->getRepository(Shot::class);
        $shot = $repository->find($id);

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $jsonShot = $serializer->serialize($shot, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        return new Response($jsonShot, 200, ['Content-Type' => 'application/json']);
    }

    #[Route('/shot', name: 'create_shot', methods: ['POST'])]
    public function store(Request $request): Response
    {
        $shot = new Shot();

        $data = json_decode($request->getContent(), true);

        $shot->setName($data['name']);
        $shot->setDifficulty($data['difficulty']);

        $this->em->persist($shot);
        $this->em->flush();

        return $this->json([
            'message' => $shot
        ]);
    }
}
