<?php
namespace App\Manager;

use App\Entity\LocalityTranslation;
use App\Model\LocalityTranslationModel;
use App\Model\Response\ApiResponse;
use App\Repository\LocalityRepository;
use App\Repository\LocalityTranslationRepository;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LocalityManager
 * @package App\Manager
 */
class LocalityManager extends BaseManager
{
    const SERVICE_NAME = 'app.locality_manager';

    /**
     * LocalityManager constructor.
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
     * @param Request $request
     * @return mixed
     */
    public function localisationFiltreSerializer(Request $request)
    {
        try {
            /** @var LocalityRepository $repo */
            $repo = $this->entityManager->getRepository(LocalityTranslation::class);
            //$liste = $repo->findAll();
            $liste = $repo->findFilter('country', 1, 'fr');

            $data = $this->serialize($liste, 'json', 'locality:read');

        } catch (\Exception $e) {
            $data = $e->getMessage();
        }

        return $data;
    }

    /**
     * Recupere la liste des localisations selon les filtres
     * {
     *  language_code: ''
     *  parent_code : ''
     *  type_code: ''
     * }
     * @param Request $request
     * @return mixed
     */
    public function localityWithTranslationwithModel(Request $request)
    {
        $response = new ApiResponse();
        $filtres = $this->getBodyContent($request);
        /** @var LocalityTranslationRepository$repo */
        $repo = $this->entityManager->getRepository(LocalityTranslation::class);
        $languageCodeExistant = $repo->getTranslationCodeExistant();

        $filtres['language_code'] = !empty($filtres['language_code'])? $filtres['language_code'] : 'fr';
        $filtres['parent_code'] = !empty($filtres['parent_code'])? $filtres['parent_code'] : '';
        $filtres['type_code'] = !empty($filtres['type_code'])? $filtres['type_code'] : '';

        if (!in_array($filtres['language_code'], $languageCodeExistant)) {
            $response->setData('language_code non existant : '. $filtres['language_code']);
            return $response;
        }
        try {
            $liste = $repo->findFilter($filtres['type_code'], $filtres['parent_code'], $filtres['language_code']);
            $localities = [];
            foreach ($liste as $localityTrans) {
                $model = new LocalityTranslationModel($localityTrans);
                $localities[] = $model;
            }
            $response->setData(json_encode($localities));
        } catch (\Exception $e) {
            $response->setData($e->getMessage());
        }

        return $response;
    }
}
