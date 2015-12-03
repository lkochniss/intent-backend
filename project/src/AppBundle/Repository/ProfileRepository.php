<?php
/**
 * @package AppBundle\Repository
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Profile;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ProfileRepository
 */
class ProfileRepository extends AbstractRepository
{
    /**
     * @param Profile $profile Persist profile.
     * @return JsonResponse
     */
    public function save(Profile $profile)
    {
        $this->getEntityManager()->persist($profile);
        $this->getEntityManager()->flush();

        return new JsonResponse('success');
    }
}
