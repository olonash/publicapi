<?php
namespace App\Controller;

use App\Manager\ProductManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package App\Controller
 */
class ProductController extends ApiController
{
    /**
     * Search product by filter
     *
     * @Route("/product/search", name="api_product_search")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function productSearch(Request $request)
    {
        $response = $this->get(ProductManager::SERVICE_NAME)->productSearch($request);

        return new JsonResponse($response->data, Response::HTTP_OK, [], true);
    }
}
