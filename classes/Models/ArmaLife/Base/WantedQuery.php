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
use Slimworks\Models\ArmaLife\Wanted as ChildWanted;
use Slimworks\Models\ArmaLife\WantedQuery as ChildWantedQuery;
use Slimworks\Models\ArmaLife\Map\WantedTableMap;

/**
 * Base class that represents a query for the 'wanted' table.
 *
 *
 *
 * @method     ChildWantedQuery orderById($order = Criteria::ASC) Order by the wantedID column
 * @method     ChildWantedQuery orderByName($order = Criteria::ASC) Order by the wantedName column
 * @method     ChildWantedQuery orderByCrimes($order = Criteria::ASC) Order by the wantedCrimes column
 * @method     ChildWantedQuery orderByBounty($order = Criteria::ASC) Order by the wantedBounty column
 * @method     ChildWantedQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildWantedQuery orderByInsertTime($order = Criteria::ASC) Order by the insert_time column
 *
 * @method     ChildWantedQuery groupById() Group by the wantedID column
 * @method     ChildWantedQuery groupByName() Group by the wantedName column
 * @method     ChildWantedQuery groupByCrimes() Group by the wantedCrimes column
 * @method     ChildWantedQuery groupByBounty() Group by the wantedBounty column
 * @method     ChildWantedQuery groupByActive() Group by the active column
 * @method     ChildWantedQuery groupByInsertTime() Group by the insert_time column
 *
 * @method     ChildWantedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildWantedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildWantedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildWantedQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildWantedQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildWantedQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildWanted findOne(ConnectionInterface $con = null) Return the first ChildWanted matching the query
 * @method     ChildWanted findOneOrCreate(ConnectionInterface $con = null) Return the first ChildWanted matching the query, or a new ChildWanted object populated from the query conditions when no match is found
 *
 * @method     ChildWanted findOneById(string $wantedID) Return the first ChildWanted filtered by the wantedID column
 * @method     ChildWanted findOneByName(string $wantedName) Return the first ChildWanted filtered by the wantedName column
 * @method     ChildWanted findOneByCrimes(string $wantedCrimes) Return the first ChildWanted filtered by the wantedCrimes column
 * @method     ChildWanted findOneByBounty(int $wantedBounty) Return the first ChildWanted filtered by the wantedBounty column
 * @method     ChildWanted findOneByActive(boolean $active) Return the first ChildWanted filtered by the active column
 * @method     ChildWanted findOneByInsertTime(string $insert_time) Return the first ChildWanted filtered by the insert_time column *

 * @method     ChildWanted requirePk($key, ConnectionInterface $con = null) Return the ChildWanted by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWanted requireOne(ConnectionInterface $con = null) Return the first ChildWanted matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWanted requireOneById(string $wantedID) Return the first ChildWanted filtered by the wantedID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWanted requireOneByName(string $wantedName) Return the first ChildWanted filtered by the wantedName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWanted requireOneByCrimes(string $wantedCrimes) Return the first ChildWanted filtered by the wantedCrimes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWanted requireOneByBounty(int $wantedBounty) Return the first ChildWanted filtered by the wantedBounty column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWanted requireOneByActive(boolean $active) Return the first ChildWanted filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildWanted requireOneByInsertTime(string $insert_time) Return the first ChildWanted filtered by the insert_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildWanted[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildWanted objects based on current ModelCriteria
 * @method     ChildWanted[]|ObjectCollection findById(string $wantedID) Return ChildWanted objects filtered by the wantedID column
 * @method     ChildWanted[]|ObjectCollection findByName(string $wantedName) Return ChildWanted objects filtered by the wantedName column
 * @method     ChildWanted[]|ObjectCollection findByCrimes(string $wantedCrimes) Return ChildWanted objects filtered by the wantedCrimes column
 * @method     ChildWanted[]|ObjectCollection findByBounty(int $wantedBounty) Return ChildWanted objects filtered by the wantedBounty column
 * @method     ChildWanted[]|ObjectCollection findByActive(boolean $active) Return ChildWanted objects filtered by the active column
 * @method     ChildWanted[]|ObjectCollection findByInsertTime(string $insert_time) Return ChildWanted objects filtered by the insert_time column
 * @method     ChildWanted[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class WantedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Slimworks\Models\ArmaLife\Base\WantedQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'armalife', $modelName = '\\Slimworks\\Models\\ArmaLife\\Wanted', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildWantedQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildWantedQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildWantedQuery) {
            return $criteria;
        }
        $query = new ChildWantedQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildWanted|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WantedTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = WantedTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildWanted A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT wantedID, wantedName, wantedCrimes, wantedBounty, active, insert_time FROM wanted WHERE wantedID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildWanted $obj */
            $obj = new ChildWanted();
            $obj->hydrate($row);
            WantedTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildWanted|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
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
     * @return $this|ChildWantedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(WantedTableMap::COL_WANTEDID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildWantedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(WantedTableMap::COL_WANTEDID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the wantedID column
     *
     * Example usage:
     * <code>
     * $query->filterById('fooValue');   // WHERE wantedID = 'fooValue'
     * $query->filterById('%fooValue%', Criteria::LIKE); // WHERE wantedID LIKE '%fooValue%'
     * </code>
     *
     * @param     string $id The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWantedQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($id)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WantedTableMap::COL_WANTEDID, $id, $comparison);
    }

    /**
     * Filter the query on the wantedName column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE wantedName = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE wantedName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWantedQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WantedTableMap::COL_WANTEDNAME, $name, $comparison);
    }

    /**
     * Filter the query on the wantedCrimes column
     *
     * Example usage:
     * <code>
     * $query->filterByCrimes('fooValue');   // WHERE wantedCrimes = 'fooValue'
     * $query->filterByCrimes('%fooValue%', Criteria::LIKE); // WHERE wantedCrimes LIKE '%fooValue%'
     * </code>
     *
     * @param     string $crimes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWantedQuery The current query, for fluid interface
     */
    public function filterByCrimes($crimes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($crimes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WantedTableMap::COL_WANTEDCRIMES, $crimes, $comparison);
    }

    /**
     * Filter the query on the wantedBounty column
     *
     * Example usage:
     * <code>
     * $query->filterByBounty(1234); // WHERE wantedBounty = 1234
     * $query->filterByBounty(array(12, 34)); // WHERE wantedBounty IN (12, 34)
     * $query->filterByBounty(array('min' => 12)); // WHERE wantedBounty > 12
     * </code>
     *
     * @param     mixed $bounty The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildWantedQuery The current query, for fluid interface
     */
    public function filterByBounty($bounty = null, $comparison = null)
    {
        if (is_array($bounty)) {
            $useMinMax = false;
            if (isset($bounty['min'])) {
                $this->addUsingAlias(WantedTableMap::COL_WANTEDBOUNTY, $bounty['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bounty['max'])) {
                $this->addUsingAlias(WantedTableMap::COL_WANTEDBOUNTY, $bounty['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WantedTableMap::COL_WANTEDBOUNTY, $bounty, $comparison);
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
     * @return $this|ChildWantedQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(WantedTableMap::COL_ACTIVE, $active, $comparison);
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
     * @return $this|ChildWantedQuery The current query, for fluid interface
     */
    public function filterByInsertTime($insertTime = null, $comparison = null)
    {
        if (is_array($insertTime)) {
            $useMinMax = false;
            if (isset($insertTime['min'])) {
                $this->addUsingAlias(WantedTableMap::COL_INSERT_TIME, $insertTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($insertTime['max'])) {
                $this->addUsingAlias(WantedTableMap::COL_INSERT_TIME, $insertTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(WantedTableMap::COL_INSERT_TIME, $insertTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildWanted $wanted Object to remove from the list of results
     *
     * @return $this|ChildWantedQuery The current query, for fluid interface
     */
    public function prune($wanted = null)
    {
        if ($wanted) {
            $this->addUsingAlias(WantedTableMap::COL_WANTEDID, $wanted->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the wanted table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(WantedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            WantedTableMap::clearInstancePool();
            WantedTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(WantedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(WantedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            WantedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            WantedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // WantedQuery
