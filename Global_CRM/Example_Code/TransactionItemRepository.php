<?php

namespace LogKB\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use LogKB\Domain\Model\TransactionItem;
use LogKB\Domain\Repository\TransactionItemRepositoryInterface;
use NPORIT\DoctrineCommon\Infrastructure\Persistence\Doctrine\QueryBuilderCollection;

/**
 * Class TransactionItemRepository
 *
 * @package LogKB\Infrastructure\Persistence\Doctrine\Repository
 */
class TransactionItemRepository extends EntityRepository implements TransactionItemRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return TransactionItem|null
     */
    public function findById(int $id): ?TransactionItem
    {
        /** @var int $id */
        $transactionItem = $this->find($id);

        return $transactionItem;
    }

    /**
     * @param int $transactionId
     *
     * @return array|null
     */
    public function findByTransactionId(int $transactionId): ?array
    {
        /** @var int $transactionId */
        $transactionItems = $this->findBy([
            'transaction' => $transactionId
        ]);

        return $transactionItems;
    }

    /**
     * @param array $transactionIds
     * @param string $field
     *
     * @return Collection|null
     */
    public function getActualState(array $transactionIds, string $field): ?Collection
    {
        $qb = $this->createQueryBuilder('ti')
            ->where('ti.transaction IN (:transactionIds)')
            ->andWhere('ti.field = :field')
            ->orderBy('ti.id', Criteria::DESC)
            ->setMaxResults(1)
            ->setParameters([
                'transactionIds' => $transactionIds,
                'field' => $field
            ]);

        return new QueryBuilderCollection($qb);
    }

    /**
     * @param TransactionItem $transaction
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(TransactionItem $transactionItem): void
    {
        $this->_em->persist($transactionItem);
        $this->_em->flush();
    }
}