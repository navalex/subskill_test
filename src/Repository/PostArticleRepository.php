<?php

namespace App\Repository;

use App\Entity\PostArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PostArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostArticle[]    findAll()
 * @method PostArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostArticle::class);
    }


    public function offsetLimitFind($offset, $limit, $category_id = null)
    {
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.publish_date', 'DESC')
            ->select(['a.id', 'a.title', 'a.slug', 'a.description', 'a.image', 'a.publish_date'])
            ->join('a.category', 'c')
            ->addSelect('c.name AS category_name, c.color AS category_color')
            ->setMaxResults($limit)
            ->setFirstResult($offset);
        if ($category_id) {
            $query
                ->where('c.id = :category_id')
                ->setParameter('category_id', $category_id)
            ;
        }
        return $query->getQuery()->getResult();
    }
}
