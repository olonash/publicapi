<?php
namespace App\Model;

use App\Entity\Locality;
use App\Entity\LocalityTranslation;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class LocalityTranslationModel
 * @package App\Model
 */
class LocalityTranslationModel extends BaseModel
{
    /**
     * @var
     */
    public $code ;
    /**
     * @var
     * @Groups({"locality:read"})
     */
    public $name;
    /**
     * @var
     */
    public $type;
    /**
     * @var
     */
    public $parent_code;

    /**
     * LocalityTranslationModel constructor.
     * @param LocalityTranslation $lt
     */
    public function __construct(LocalityTranslation $lt)
    {
        parent::__construct($lt);
        $this->fillData($lt);

        return $this;
    }

    /**
     * @param LocalityTranslation $lt
     */
    public function fillData(LocalityTranslation $lt)
    {
        $this->code   = $lt->getLocality()->getCode();
        $this->type =$lt->getLocality()->getTypeCode()->getValueCode();
        if ($lt->getLocality()->getParent() instanceof Locality) {
            $this->parent_code = $lt->getLocality()->getParent()->getCode();
        }
    }
}
