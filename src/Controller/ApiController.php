<?php
namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class ApiController.
 */
class ApiController extends Controller
{
    /**
     * Nombre total d'enregistrement.
     */
    const PARAMS_TOTAL = 'total';

    /**
     * Paramètre pour filter les résultats.
     */
    const PARAMS_FILTER = 'filter';

    /**
     * Paramètre pour exclure des résultats.
     */
    const PARAMS_EXCLUDE = 'exclude';

    /**
     * Paramètre pour trier les résultats.
     */
    const PARAMS_SORTING = 'sorting';

    /**
     * Paramètre pour limiter les résultats.
     */
    const PARAMS_LIMIT = 'limit';

    /**
     * Paramètre par défaut pour limiter les résultats.
     */
    const PARAMS_LIMIT_DEFAULT = 10;

    /**
     * Paramètre pour le numéro de page.
     */
    const PARAMS_PAGE = 'page';

    /**
     * Paramètre pour la position des résultats.
     */
    const PARAMS_START = 'start';

    /**
     * Paramètre pour personnaliser les groupes.
     */
    const PARAMS_GROUPS = 'groups';

    /**
     * @var array Liste des colonnes pouvant être filtrées
     */
    private $columnsFilter = array();

    /**
     * @var array Liste des colonnes pouvant être triées
     */
    private $columnsSorting = array();

    /**
     * Set columnsFilter.
     *
     * @param array $columns
     */
    public function setColumnsFilter($columns)
    {
        $this->columnsFilter = $columns;
    }

    /**
     * Get columnsFilter.
     *
     * @return array
     */
    public function getColumnsFilter()
    {
        return $this->columnsFilter;
    }

    /**
     * Set columnsSorting.
     *
     * @param array $columns
     */
    public function setColumnsSorting($columns)
    {
        $this->columnsSorting = $columns;
    }

    /**
     * Get columnsSorting.
     *
     * @return array
     */
    public function getColumnsSorting()
    {
        return $this->columnsSorting;
    }

    /**
     * Get a user from the Security Token Storage.
     *
     * @return Utilisateur|mixed
     *
     * @throws \LogicException If SecurityBundle is not available
     *
     * @see TokenInterface::getUser()
     *
     * @final since version 3.4
     */
    protected function getUser()
    {
        $user = parent::getUser();

        if ($user && $user instanceof UserInterface) {
            $user = $this->getDoctrine()->getRepository(Utilisateur::class)->find($user->getId());
        }

        return $user;
    }

    /**
     * Code de retour de la réponse en fonction d'une entité.
     *
     * @param mixed $entity
     *
     * @return int
     */
    protected function getStatusCodeFromEntity(object $entity): int
    {
        return !$entity->getId() ? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT;
    }

    /**
     * Code de retour de la réponse en fonction d'une request.
     *
     * @param Request $request
     *
     * @return int
     */
    protected function getStatusCodeFromRequest(Request $request): int
    {
        return 'POST' === strtoupper($request->getMethod()) ? Response::HTTP_CREATED : Response::HTTP_NO_CONTENT;
    }

    /**
     * Générer une réponse HTTP.
     *
     * @param int         $statusCode
     * @param string|null $url
     *
     * @return Response
     */
    protected function getResponse(int $statusCode, string $url = null): Response
    {
        $response = new Response();
        $response->setStatusCode($statusCode);

        if (Response::HTTP_CREATED === $statusCode) {
            $response->headers->set(
                'Location',
                $url
            );
        }

        return $response;
    }


    /**
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    protected function getBodyContent ($request)
    {
        /** @var mixed $bodyContent */
        $bodyContent = [];
        if ($request->getContent()) {
            try {
                $bodyContent = \GuzzleHttp\json_decode($this->getContent(), true);
            } catch (\Exception $e) {
                throw new \Exception(
                    'Json data error',
                    Response::HTTP_BAD_REQUEST,
                    null
                );
            }
        }
        return $bodyContent;
    }
}
