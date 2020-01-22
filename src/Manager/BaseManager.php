<?php
namespace App\Manager;

use App\Entity\Societe;
use App\Entity\Utilisateur;
use App\Exception\NoAccessException;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Translator;

/**
 * Class BaseManager
 *
 * @package App\Manager
 */
abstract class BaseManager
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    protected $entityManager;

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $repository;

    /**
     *
     * @var string
     */
    protected $class;

    /**
     * @var
     */
    protected $dispatcher;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * BaseManager constructor.
     * @param $class
     * @param ContainerInterface $container
     */
    public function __construct(
        $class,
        ContainerInterface $container
    ) {
        $this->container = $container;
        $this->entityManager = $container->get('doctrine.orm.entity_manager');
        $this->class = $class;
        $this->repository = $this->entityManager->getRepository($this->class);

        $this->translator = $this->getContainer()->get('translator');
    }

    /**
     * @param $entity
     *
     * @return mixed
     */
    public function save($entity)
    {
        $this->entityManager->persist($entity);

        return $entity;
    }

    /**
     * @param $entity
     *
     * @return mixed
     */
    public function saveAndFlush($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

    /**
     * @param $entity
     *
     * @return mixed
     */
    public function delete($entity)
    {
        $this->entityManager->remove($entity);
        $this->flushAndClear();

        return true;
    }

    /**
     *  flush entity manager
     */
    public function flushAndClear()
    {
        $this->entityManager->flush();
    }

    /**
     * @return mixed
     */
    public function createNew()
    {
        $class = $this->class;

        return new $class();
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * @param integer $id
     *
     * @return object
     */
    public function find($id)
    {
        return  $this->repository->findOneBy(['id' => $id]);
    }

    /**
     * @param array      $_criteria
     * @param array|null $_orderBy
     * @param null       $_limit
     * @param null       $_offset
     *
     * @return array
     */
    public function findBy(array $_criteria, array $_orderBy = null, $_limit = null, $_offset = null)
    {
        return $this->repository->findBy($_criteria, $_orderBy, $_limit, $_offset);
    }

    /**
     * @param array $criteria
     *
     * @return object
     */
    public function findOneBy(array $criteria)
    {
        return  $this->repository->findOneBy($criteria);
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
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
                $bodyContent = json_decode($request->getContent(), true);
            } catch (\Exception $e) {
                throw new \Exception(
                    'Erreur de données Json',
                    Response::HTTP_BAD_REQUEST,
                    null
                );
            }
        }
        return $bodyContent;
    }

}
