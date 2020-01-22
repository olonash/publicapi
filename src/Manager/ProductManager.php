<?php
namespace App\Manager;

use App\Entity\ProductTranslation;
use App\Model\Product\ProductTranslationModel;
use App\Model\Response\ApiResponse;
use App\Repository\ProductTranslationRepository;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * Class ProductManager
 * @package App\Manager
 */
class ProductManager extends BaseManager
{
    const SERVICE_NAME = 'app.product_manager';

    /**
     * ProductManager constructor.
     *
     * @param $class
     * @param ContainerInterface $container
     */
    public function __construct(
        $class,
        ContainerInterface $container
    ) {
        parent::__construct($class, $container);
    }

    /**
     * Recherche de produit
     * {
     *  language_code: ''
     *  sub_type_code : ''
     *  type_code: ''
     * }
     * @param Request $request
     * @return mixed
     */
    public function productSearch(Request $request)
    {
        $response = new ApiResponse();
        $filtres = $this->getBodyContent($request);
        /** @var ProductTranslationRepository $prodTransRepo */
        $prodTransRepo = $this->entityManager->getRepository(ProductTranslation::class);
        $languageCodeExistant = $prodTransRepo->getTranslationCodeExistant();
        //test si le filtre existe
        $filtres['language_code'] = !empty($filtres['language_code'])? $filtres['language_code'] : 'fr';
        $filtres['sub_type_code'] = !empty($filtres['sub_type_code'])? $filtres['sub_type_code'] : '';
        $filtres['type_code'] = !empty($filtres['type_code'])? $filtres['type_code'] : '';

        if (!in_array($filtres['language_code'], $languageCodeExistant)) {
            $response->setData('language_code non existant : '. $filtres['language_code']);
            return $response;
        }
        try {
            $liste = $prodTransRepo
                ->searchProduct($filtres['type_code'], $filtres['sub_type_code'], $filtres['language_code']);
            $data = [];
            /** @var ProductTranslation $entity */
            foreach ($liste as $entity) {
                //dd($entity);
                $model = new ProductTranslationModel($entity);
                $data[] = $model;
            }
            $response->setData(json_encode($data));
        } catch (\Exception $e) {
            $response->setData($e->getMessage());
        }

        return $response;
    }
}
