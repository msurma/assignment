<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends AbstractRepository<Post>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends AbstractRepository implements PostRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function save(Post $post, bool $flush = false): void
    {
        $this->getEntityManager()->persist($post);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getPosts(int $page = 1, int $itemsPerPage = 5): array
    {
        return $this->createQueryBuilder('p')
            ->addCriteria(
                Criteria::create()
                    ->setFirstResult(($page - 1) * $itemsPerPage)
                    ->setMaxResults($itemsPerPage)
            )
            ->getQuery()
            ->getResult();
    }

    public function getPostsCount(): int
    {
        return $this->createQueryBuilder('p')
            ->select('count(1)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
