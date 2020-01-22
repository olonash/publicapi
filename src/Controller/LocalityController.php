<?php
namespace App\Controller;

use App\Manager\LocalityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * Class LocalityController
 * @package App\Controller
 */
class LocalityController extends ApiController
{
    /**
     * Filtre la liste des locations
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function staticLocation(Request $request)
    {
        $response = $this->get(LocalityManager::SERVICE_NAME)->localityWithTranslationwithModel($request);

        return new JsonResponse($response->data, Response::HTTP_OK, [], true);
    }
}
