<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\WeatherForecastSlot;
use App\Repository\WeatherForecastSlotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    public function __construct(private readonly WeatherForecastSlotRepository $weatherForecastSlotRepository) {}


    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        $weatherForecastSlots = $this->weatherForecastSlotRepository->getSlotsForNext12Days();

        return $this->render('dashboard/index.html.twig', [
            'slots' => $weatherForecastSlots,
        ]);
    }
}
