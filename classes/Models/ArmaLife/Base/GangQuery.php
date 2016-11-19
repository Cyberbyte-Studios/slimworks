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
use Slimworks\Models\ArmaLife\Gang as ChildGang;
use Slimworks\Models\ArmaLife\GangQuery as ChildGangQuery;
use Slimworks\Models\ArmaLife\Map\GangTableMap;

/**
 * Base class that represents a query for the 'gangs' table.
 *
 *
 *
 * @method     ChildGangQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildGangQuery orderByOwner($order = Criteria::ASC) Order by the owner column
 * @method     ChildGangQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildGangQuery orderByMembers($order = Criteria::ASC) Order by the members column
 * @method     ChildGangQuery orderByMaxmembers($order = Criteria::ASC) Order by the maxmembers column
 * @method     ChildGangQuery orderByBank($order = Criteria::ASC) Order by the bank column
 * @method     ChildGangQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildGangQuery orderByInsertTime($order = Criteria::ASC) Order by the insert_time column
 *
 * @method     ChildGangQuery groupById() Group by the id column
 * @method     ChildGangQuery groupByOwner() Group by the owner column
 * @method     ChildGangQuery groupByName() Group by the name column
 * @method     ChildGangQuery groupByMembers() Group by the members column
 * @method     ChildGangQuery groupByMaxmembers() Group by the maxmembers column
 * @method     ChildGangQuery groupByBank() Group by the bank column
 * @method     ChildGangQuery groupByActive() Group by the active column
 * @method     ChildGangQuery groupByInsertTime() Group by the insert_time column
 *
 * @method     ChildGangQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildGangQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildGangQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildGangQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildGangQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildGangQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildGang findOne(ConnectionInterface $con = null) Return the first ChildGang matching the query
 * @method     ChildGang findOneOrCreate(ConnectionInterface $con = null) Return the first ChildGang matching the query, or a new ChildGang object populated from the query conditions when no match is found
 *
 * @method     ChildGang findOneById(int $id) Return the first ChildGang filtered by the id column
 * @method     ChildGang findOneByOwner(string $owner) Return the first ChildGang filtered by the owner column
 * @method     ChildGang findOneByName(string $name) Return the first ChildGang filtered by the name column
 * @method     ChildGang findOneByMembers(string $members) Return the first ChildGang filtered by the members column
 * @method     ChildGang findOneByMaxmembers(int $maxmembers) Return the first ChildGang filtered by the maxmembers column
 * @method     ChildGang findOneByBank(int $bank) Return the first ChildGang filtered by the bank column
 * @method     ChildGang findOneByActive(boolean $active) Return the first ChildGang filtered by the active column
 * @method     ChildGang findOneByInsertTime(string $insert_time) Return the first ChildGang filtered by the insert_time column *

 * @method     ChildGang requirePk($key, ConnectionInterface $con = null) Return the ChildGang by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGang requireOne(ConnectionInterface $con = null) Return the first ChildGang matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGang requireOneById(int $id) Return the first ChildGang filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGang requireOneByOwner(string $owner) Return the first ChildGang filtered by the owner column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGang requireOneByName(string $name) Return the first ChildGang filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGang requireOneByMembers(string $members) Return the first ChildGang filtered by the members column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGang requireOneByMaxmembers(int $maxmembers) Return the first ChildGang filtered by the maxmembers column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGang requireOneByBank(int $bank) Return the first ChildGang filtered by the bank column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGang requireOneByActive(boolean $active) Return the first ChildGang filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildGang requireOneByInsertTime(string $insert_time) Return the first ChildGang filtered by the insert_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildGang[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildGang objects based on current ModelCriteria
 * @method     ChildGang[]|ObjectCollection findById(int $id) Return ChildGang objects filtered by the id column
 * @method     ChildGang[]|ObjectCollection findByOwner(string $owner) Return ChildGang objects filtered by the owner column
 * @method     ChildGang[]|ObjectCollection findByName(string $name) Return ChildGang objects filtered by the name column
 * @method     ChildGang[]|ObjectCollection findByMembers(string $members) Return ChildGang objects filtered by the members column
 * @method     ChildGang[]|ObjectCollection findByMaxmembers(int $maxmembers) Return ChildGang objects filtered by the maxmembers column
 * @method     ChildGang[]|ObjectCollection findByBank(int $bank) Return ChildGang objects filtered by the bank column
 * @method     ChildGang[]|ObjectCollection findByActive(boolean $active) Return ChildGang objects filtered by the active column
 * @method     ChildGang[]|ObjectCollection findByInsertTime(string $insert_time) Return ChildGang objects filtered by the insert_time column
 * @method     ChildGang[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class GangQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Slimworks\Models\ArmaLife\Base\GangQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'armalife', $modelName = '\\Slimworks\\Models\\ArmaLife\\Gang', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildGangQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildGangQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildGangQuery) {
            return $criteria;
        }
        $query = new ChildGangQuery();
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
     * @return ChildGang|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(GangTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = GangTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildGang A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, owner, name, members, maxmembers, bank, active, insert_time FROM gangs WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildGang $obj */
            $obj = new ChildGang();
            $obj->hydrate($row);
            GangTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildGang|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GangTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GangTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GangTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GangTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GangTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the owner column
     *
     * Example usage:
     * <code>
     * $query->filterByOwner('fooValue');   // WHERE owner = 'fooValue'
     * $query->filterByOwner('%fooValue%', Criteria::LIKE); // WHERE owner LIKE '%fooValue%'
     * </code>
     *
     * @param     string $owner The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function filterByOwner($owner = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($owner)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GangTableMap::COL_OWNER, $owner, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GangTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the members column
     *
     * Example usage:
     * <code>
     * $query->filterByMembers('fooValue');   // WHERE members = 'fooValue'
     * $query->filterByMembers('%fooValue%', Criteria::LIKE); // WHERE members LIKE '%fooValue%'
     * </code>
     *
     * @param     string $members The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function filterByMembers($members = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($members)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GangTableMap::COL_MEMBERS, $members, $comparison);
    }

    /**
     * Filter the query on the maxmembers column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxmembers(1234); // WHERE maxmembers = 1234
     * $query->filterByMaxmembers(array(12, 34)); // WHERE maxmembers IN (12, 34)
     * $query->filterByMaxmembers(array('min' => 12)); // WHERE maxmembers > 12
     * </code>
     *
     * @param     mixed $maxmembers The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function filterByMaxmembers($maxmembers = null, $comparison = null)
    {
        if (is_array($maxmembers)) {
            $useMinMax = false;
            if (isset($maxmembers['min'])) {
                $this->addUsingAlias(GangTableMap::COL_MAXMEMBERS, $maxmembers['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxmembers['max'])) {
                $this->addUsingAlias(GangTableMap::COL_MAXMEMBERS, $maxmembers['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GangTableMap::COL_MAXMEMBERS, $maxmembers, $comparison);
    }

    /**
     * Filter the query on the bank column
     *
     * Example usage:
     * <code>
     * $query->filterByBank(1234); // WHERE bank = 1234
     * $query->filterByBank(array(12, 34)); // WHERE bank IN (12, 34)
     * $query->filterByBank(array('min' => 12)); // WHERE bank > 12
     * </code>
     *
     * @param     mixed $bank The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function filterByBank($bank = null, $comparison = null)
    {
        if (is_array($bank)) {
            $useMinMax = false;
            if (isset($bank['min'])) {
                $this->addUsingAlias(GangTableMap::COL_BANK, $bank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bank['max'])) {
                $this->addUsingAlias(GangTableMap::COL_BANK, $bank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GangTableMap::COL_BANK, $bank, $comparison);
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
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(GangTableMap::COL_ACTIVE, $active, $comparison);
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
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function filterByInsertTime($insertTime = null, $comparison = null)
    {
        if (is_array($insertTime)) {
            $useMinMax = false;
            if (isset($insertTime['min'])) {
                $this->addUsingAlias(GangTableMap::COL_INSERT_TIME, $insertTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($insertTime['max'])) {
                $this->addUsingAlias(GangTableMap::COL_INSERT_TIME, $insertTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GangTableMap::COL_INSERT_TIME, $insertTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildGang $gang Object to remove from the list of results
     *
     * @return $this|ChildGangQuery The current query, for fluid interface
     */
    public function prune($gang = null)
    {
        if ($gang) {
            $this->addUsingAlias(GangTableMap::COL_ID, $gang->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the gangs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(GangTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            GangTableMap::clearInstancePool();
            GangTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(GangTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(GangTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            GangTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            GangTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // GangQuery
