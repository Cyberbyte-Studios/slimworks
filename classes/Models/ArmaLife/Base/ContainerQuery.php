<?php

namespace Slimworks\Models\ArmaLife\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Slimworks\Models\ArmaLife\Container as ChildContainer;
use Slimworks\Models\ArmaLife\ContainerQuery as ChildContainerQuery;
use Slimworks\Models\ArmaLife\Map\ContainerTableMap;

/**
 * Base class that represents a query for the 'containers' table.
 *
 *
 *
 * @method     ChildContainerQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildContainerQuery orderByPid($order = Criteria::ASC) Order by the pid column
 * @method     ChildContainerQuery orderByClassname($order = Criteria::ASC) Order by the classname column
 * @method     ChildContainerQuery orderByPos($order = Criteria::ASC) Order by the pos column
 * @method     ChildContainerQuery orderByInventory($order = Criteria::ASC) Order by the inventory column
 * @method     ChildContainerQuery orderByGear($order = Criteria::ASC) Order by the gear column
 * @method     ChildContainerQuery orderByDir($order = Criteria::ASC) Order by the dir column
 * @method     ChildContainerQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildContainerQuery orderByOwned($order = Criteria::ASC) Order by the owned column
 * @method     ChildContainerQuery orderByInsertTime($order = Criteria::ASC) Order by the insert_time column
 *
 * @method     ChildContainerQuery groupById() Group by the id column
 * @method     ChildContainerQuery groupByPid() Group by the pid column
 * @method     ChildContainerQuery groupByClassname() Group by the classname column
 * @method     ChildContainerQuery groupByPos() Group by the pos column
 * @method     ChildContainerQuery groupByInventory() Group by the inventory column
 * @method     ChildContainerQuery groupByGear() Group by the gear column
 * @method     ChildContainerQuery groupByDir() Group by the dir column
 * @method     ChildContainerQuery groupByActive() Group by the active column
 * @method     ChildContainerQuery groupByOwned() Group by the owned column
 * @method     ChildContainerQuery groupByInsertTime() Group by the insert_time column
 *
 * @method     ChildContainerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildContainerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildContainerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildContainerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildContainerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildContainerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildContainer findOne(ConnectionInterface $con = null) Return the first ChildContainer matching the query
 * @method     ChildContainer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildContainer matching the query, or a new ChildContainer object populated from the query conditions when no match is found
 *
 * @method     ChildContainer findOneById(int $id) Return the first ChildContainer filtered by the id column
 * @method     ChildContainer findOneByPid(string $pid) Return the first ChildContainer filtered by the pid column
 * @method     ChildContainer findOneByClassname(string $classname) Return the first ChildContainer filtered by the classname column
 * @method     ChildContainer findOneByPos(string $pos) Return the first ChildContainer filtered by the pos column
 * @method     ChildContainer findOneByInventory(string $inventory) Return the first ChildContainer filtered by the inventory column
 * @method     ChildContainer findOneByGear(string $gear) Return the first ChildContainer filtered by the gear column
 * @method     ChildContainer findOneByDir(string $dir) Return the first ChildContainer filtered by the dir column
 * @method     ChildContainer findOneByActive(boolean $active) Return the first ChildContainer filtered by the active column
 * @method     ChildContainer findOneByOwned(boolean $owned) Return the first ChildContainer filtered by the owned column
 * @method     ChildContainer findOneByInsertTime(string $insert_time) Return the first ChildContainer filtered by the insert_time column *

 * @method     ChildContainer requirePk($key, ConnectionInterface $con = null) Return the ChildContainer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContainer requireOne(ConnectionInterface $con = null) Return the first ChildContainer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContainer requireOneById(int $id) Return the first ChildContainer filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContainer requireOneByPid(string $pid) Return the first ChildContainer filtered by the pid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContainer requireOneByClassname(string $classname) Return the first ChildContainer filtered by the classname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContainer requireOneByPos(string $pos) Return the first ChildContainer filtered by the pos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContainer requireOneByInventory(string $inventory) Return the first ChildContainer filtered by the inventory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContainer requireOneByGear(string $gear) Return the first ChildContainer filtered by the gear column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContainer requireOneByDir(string $dir) Return the first ChildContainer filtered by the dir column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContainer requireOneByActive(boolean $active) Return the first ChildContainer filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContainer requireOneByOwned(boolean $owned) Return the first ChildContainer filtered by the owned column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildContainer requireOneByInsertTime(string $insert_time) Return the first ChildContainer filtered by the insert_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildContainer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildContainer objects based on current ModelCriteria
 * @method     ChildContainer[]|ObjectCollection findById(int $id) Return ChildContainer objects filtered by the id column
 * @method     ChildContainer[]|ObjectCollection findByPid(string $pid) Return ChildContainer objects filtered by the pid column
 * @method     ChildContainer[]|ObjectCollection findByClassname(string $classname) Return ChildContainer objects filtered by the classname column
 * @method     ChildContainer[]|ObjectCollection findByPos(string $pos) Return ChildContainer objects filtered by the pos column
 * @method     ChildContainer[]|ObjectCollection findByInventory(string $inventory) Return ChildContainer objects filtered by the inventory column
 * @method     ChildContainer[]|ObjectCollection findByGear(string $gear) Return ChildContainer objects filtered by the gear column
 * @method     ChildContainer[]|ObjectCollection findByDir(string $dir) Return ChildContainer objects filtered by the dir column
 * @method     ChildContainer[]|ObjectCollection findByActive(boolean $active) Return ChildContainer objects filtered by the active column
 * @method     ChildContainer[]|ObjectCollection findByOwned(boolean $owned) Return ChildContainer objects filtered by the owned column
 * @method     ChildContainer[]|ObjectCollection findByInsertTime(string $insert_time) Return ChildContainer objects filtered by the insert_time column
 * @method     ChildContainer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ContainerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Slimworks\Models\ArmaLife\Base\ContainerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'armalife', $modelName = '\\Slimworks\\Models\\ArmaLife\\Container', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildContainerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildContainerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildContainerQuery) {
            return $criteria;
        }
        $query = new ChildContainerQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $pid] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildContainer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ContainerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ContainerTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildContainer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, pid, classname, pos, inventory, gear, dir, active, owned, insert_time FROM containers WHERE id = :p0 AND pid = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildContainer $obj */
            $obj = new ChildContainer();
            $obj->hydrate($row);
            ContainerTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildContainer|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ContainerTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ContainerTableMap::COL_PID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ContainerTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ContainerTableMap::COL_PID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ContainerTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ContainerTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContainerTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the pid column
     *
     * Example usage:
     * <code>
     * $query->filterByPid('fooValue');   // WHERE pid = 'fooValue'
     * $query->filterByPid('%fooValue%', Criteria::LIKE); // WHERE pid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByPid($pid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContainerTableMap::COL_PID, $pid, $comparison);
    }

    /**
     * Filter the query on the classname column
     *
     * Example usage:
     * <code>
     * $query->filterByClassname('fooValue');   // WHERE classname = 'fooValue'
     * $query->filterByClassname('%fooValue%', Criteria::LIKE); // WHERE classname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $classname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByClassname($classname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContainerTableMap::COL_CLASSNAME, $classname, $comparison);
    }

    /**
     * Filter the query on the pos column
     *
     * Example usage:
     * <code>
     * $query->filterByPos('fooValue');   // WHERE pos = 'fooValue'
     * $query->filterByPos('%fooValue%', Criteria::LIKE); // WHERE pos LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pos The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByPos($pos = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pos)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContainerTableMap::COL_POS, $pos, $comparison);
    }

    /**
     * Filter the query on the inventory column
     *
     * Example usage:
     * <code>
     * $query->filterByInventory('fooValue');   // WHERE inventory = 'fooValue'
     * $query->filterByInventory('%fooValue%', Criteria::LIKE); // WHERE inventory LIKE '%fooValue%'
     * </code>
     *
     * @param     string $inventory The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByInventory($inventory = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($inventory)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContainerTableMap::COL_INVENTORY, $inventory, $comparison);
    }

    /**
     * Filter the query on the gear column
     *
     * Example usage:
     * <code>
     * $query->filterByGear('fooValue');   // WHERE gear = 'fooValue'
     * $query->filterByGear('%fooValue%', Criteria::LIKE); // WHERE gear LIKE '%fooValue%'
     * </code>
     *
     * @param     string $gear The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByGear($gear = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gear)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContainerTableMap::COL_GEAR, $gear, $comparison);
    }

    /**
     * Filter the query on the dir column
     *
     * Example usage:
     * <code>
     * $query->filterByDir('fooValue');   // WHERE dir = 'fooValue'
     * $query->filterByDir('%fooValue%', Criteria::LIKE); // WHERE dir LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dir The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByDir($dir = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dir)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContainerTableMap::COL_DIR, $dir, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContainerTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the owned column
     *
     * Example usage:
     * <code>
     * $query->filterByOwned(true); // WHERE owned = true
     * $query->filterByOwned('yes'); // WHERE owned = true
     * </code>
     *
     * @param     boolean|string $owned The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByOwned($owned = null, $comparison = null)
    {
        if (is_string($owned)) {
            $owned = in_array(strtolower($owned), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ContainerTableMap::COL_OWNED, $owned, $comparison);
    }

    /**
     * Filter the query on the insert_time column
     *
     * Example usage:
     * <code>
     * $query->filterByInsertTime('2011-03-14'); // WHERE insert_time = '2011-03-14'
     * $query->filterByInsertTime('now'); // WHERE insert_time = '2011-03-14'
     * $query->filterByInsertTime(array('max' => 'yesterday')); // WHERE insert_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $insertTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function filterByInsertTime($insertTime = null, $comparison = null)
    {
        if (is_array($insertTime)) {
            $useMinMax = false;
            if (isset($insertTime['min'])) {
                $this->addUsingAlias(ContainerTableMap::COL_INSERT_TIME, $insertTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($insertTime['max'])) {
                $this->addUsingAlias(ContainerTableMap::COL_INSERT_TIME, $insertTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContainerTableMap::COL_INSERT_TIME, $insertTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildContainer $container Object to remove from the list of results
     *
     * @return $this|ChildContainerQuery The current query, for fluid interface
     */
    public function prune($container = null)
    {
        if ($container) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ContainerTableMap::COL_ID), $container->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ContainerTableMap::COL_PID), $container->getPid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the containers table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContainerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ContainerTableMap::clearInstancePool();
            ContainerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ContainerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ContainerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ContainerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ContainerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ContainerQuery
