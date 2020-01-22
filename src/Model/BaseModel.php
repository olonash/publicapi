<?php
namespace App\Model;

/**
 * Class BaseModel.
 * @package App\Model
 */
class BaseModel
{
    /**
     * BaseModel constructor.
     *
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->setAttributes($entity);
        return $this;
    }

    /**
     * @param $entity.
     *
     * @return $this
     */
    public function setAttributes($entity)
    {
        foreach ($this as $key => $value) {
            $getter = 'get'.ucfirst($key);
            if (method_exists($entity, $getter) && !is_object($entity->$getter()) && !is_array($entity->$getter())) {
                $this->$key = $entity->$getter();
            }
        }

        return $this;
    }
}
