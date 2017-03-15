<?php
// src/AppBundle/Serializer/Normalizer
namespace AppBundle\Serializer\Normalizer;
use AppBundle\Entity\User;

/**
 * Class UserNormalizer.
 * @package AppBundle\Serializer\Normalizer
 */
class UserNormalizer extends AbstractNormalizer
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
        /* @var User $object */
        $data = [
            'id' => $object->getId(),
            'type' => $object->getType(),
            'category' => $this->normalizeObject($object->getCategory(), $format, $context),
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
        return $data instanceof User;
    }
}