<?php

namespace App\Controller;

use App\Entity\Investment;
use App\Repository\InvestmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api', name: 'api_')]
class ApiInvestmentsController extends AbstractController
{
    #[Route('/investments', name: 'investment_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        $investments = $entityManager
            ->getRepository(Investment::class)
            ->findAll();

        $json = $serializer->serialize($investments, 'json');
        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }

    #[Route('/investment/{id}', name: 'investment_show', methods: ['GET'])]
    public function show(Request $request, int $id, InvestmentRepository $investmentRepository, SerializerInterface $serializer): Response
    {
        $investment = $investmentRepository->find($id);
        $json = $serializer->serialize($investment, 'json');
        return new JsonResponse($json, Response::HTTP_OK, [], true);
        }

        #[Route('/investments/filter', methods: ['GET'])]
        public function searchInvestments(Request $request, InvestmentRepository $investmentRepository): JsonResponse
    {
        $ville = $request->query->get('ville');
        $etatAvancement = $request->query->get('etatAvancement');

        $investments = $investmentRepository->findByFilters($ville, $etatAvancement);

            return $this->json($investments);
        }

    #[Route('/investment/{id}', name: 'investment_update', methods:['PUT', 'PATCH'] )]
    public function update(EntityManagerInterface $entityManager, Request $request, int $id, SerializerInterface $serializer): JsonResponse
    {
        $investment = $entityManager
            ->getRepository(Investment::class)
            ->find($id);

        if (!$investment) {
            return $this->json('No investment found for id ' . $id, 404);
        }

        // Decode JSON payload
        $requestData = json_decode($request->getContent(), true);

        if (!$requestData) {
            return $this->json(['error' => 'Invalid JSON payload'], 400);
        }

        // Update only if fields are provided in the request
        if (isset($requestData['titreoperation'])) {
            $investment->setTitreoperation($requestData['titreoperation']);
        }
        if (isset($requestData['ville'])) {
            $investment->setVille($requestData['ville']);
        }
        if (isset($requestData['enveloppePrev'])) {
            $investment->setEnveloppePrev($requestData['enveloppePrev']);
        }
        if (isset($requestData['etatAvancement'])) {
            $investment->setEtatAvancement($requestData['etatAvancement']);
        }


        $entityManager->flush();

        $json = $serializer->serialize($investment, 'json');
        return new JsonResponse($json, Response::HTTP_OK, [], true);
    }
}
