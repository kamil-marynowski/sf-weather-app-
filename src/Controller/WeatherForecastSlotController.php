<?php

namespace App\Controller;

use App\Entity\WeatherForecastSlot;
use App\Form\WeatherForecastSlotType;
use App\Repository\WeatherForecastSlotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherForecastSlotController extends AbstractController
{
    public function __construct(private readonly WeatherForecastSlotRepository $weatherForecastSlotRepository) {}

    #[Route('/weather-forecast-slots', name: 'app_weather_forecast_slots_index')]
    public function index(): Response
    {
        return $this->render(view: 'weather_forecast_slots/index.html.twig', parameters: [
            'controller_name' => 'WeatherForecastSlotController',
        ]);
    }

    #[Route('/weather-forecast-slots/new', name: 'app_weather_forecast_slots_new', methods: ['GET', 'POST'])]
    public function new(Request $request): RedirectResponse|Response
    {
        $weatherForecastSlot = new WeatherForecastSlot();

        $form = $this->createForm(type: WeatherForecastSlotType::class, data: $weatherForecastSlot);
        $form->handleRequest(request: $request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->weatherForecastSlotRepository->save(entity: $weatherForecastSlot, flush: true);

            return $this->redirectToRoute(route: 'app_weather_forecast_slots_index');
        }

        return $this->renderForm(view: 'weather_forecast_slots/new.html.twig', parameters: [
            'weatherForecastSlot' => $weatherForecastSlot,
            'form'                => $form,
        ]);
    }
}
