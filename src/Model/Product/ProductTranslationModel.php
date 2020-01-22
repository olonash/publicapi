<?php
namespace App\Model\Product;

use App\Entity\ProductTranslation;
use App\Model\BaseModel;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class ProductModel
 * @package App\Model\Product
 */
class ProductTranslationModel extends BaseModel
{
    /**
     * @var
     */
    public $id;
    /**
     * @var
     * @Groups({"locality:read"})
     */
    public $name;

    /**
     * ProductTranslationModel constructor.
     * @param ProductTranslation $pt
     */
    public function __construct(ProductTranslation $pt)
    {
        parent::__construct($pt);
        $this->fillData($pt);

        return $this;
    }

    /**
     * @param ProductTranslation $p
     * @return $this
     */
    public function fillData(ProductTranslation $p)
    {
        return $this;
    }
}
