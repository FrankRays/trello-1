<?php
// src/AppBundle/Serializer/Normalizer/CategoryNormalizer.php
namespace AppBundle\Serializer\Normalizer;
use AppBundle\Entity\Category;

class CategoryNormalizer extends AbstractNormalizer
{
    /**
     * {@inheritdoc}
     *
     * @param object $object
     * @param null $format
     * @param array $context
     * @return array
     */
    public function normalize($object, $format = null, array $context = [])
    {
        /* @var Category $object */
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName(),
            'orderId' => $object->getOrderId(),
            'tasks' => $object->getTasks(),
            'countTasks' => $object->getTasks()->count(),
            //'task' => $this->normalizeObject($object->getTasks(), $format, $context),
        ];
        return $data;
    }
    /**
     * {@inheritdoc}
     *
     * @param mixed $data
     * @param null $format
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Category;
    }
}