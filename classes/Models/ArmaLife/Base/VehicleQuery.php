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
use Slimworks\Models\ArmaLife\Vehicle as ChildVehicle;
use Slimworks\Models\ArmaLife\VehicleQuery as ChildVehicleQuery;
use Slimworks\Models\ArmaLife\Map\VehicleTableMap;

/**
 * Base class that represents a query for the 'vehicles' table.
 *
 *
 *
 * @method     ChildVehicleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildVehicleQuery orderBySide($order = Criteria::ASC) Order by the side column
 * @method     ChildVehicleQuery orderByClassname($order = Criteria::ASC) Order by the classname column
 * @method     ChildVehicleQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildVehicleQuery orderByPid($order = Criteria::ASC) Order by the pid column
 * @method     ChildVehicleQuery orderByAlive($order = Criteria::ASC) Order by the alive column
 * @method     ChildVehicleQuery orderByBlacklist($order = Criteria::ASC) Order by the blacklist column
 * @method     ChildVehicleQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildVehicleQuery orderByPlate($order = Criteria::ASC) Order by the plate column
 * @method     ChildVehicleQuery orderByPlatestring($order = Criteria::ASC) Order by the plateString column
 * @method     ChildVehicleQuery orderByColor($order = Criteria::ASC) Order by the color column
 * @method     ChildVehicleQuery orderByInventory($order = Criteria::ASC) Order by the inventory column
 * @method     ChildVehicleQuery orderByGear($order = Criteria::ASC) Order by the gear column
 * @method     ChildVehicleQuery orderByFuel($order = Criteria::ASC) Order by the fuel column
 * @method     ChildVehicleQuery orderByDamage($order = Criteria::ASC) Order by the damage column
 * @method     ChildVehicleQuery orderByInsertTime($order = Criteria::ASC) Order by the insert_time column
 *
 * @method     ChildVehicleQuery groupById() Group by the id column
 * @method     ChildVehicleQuery groupBySide() Group by the side column
 * @method     ChildVehicleQuery groupByClassname() Group by the classname column
 * @method     ChildVehicleQuery groupByType() Group by the type column
 * @method     ChildVehicleQuery groupByPid() Group by the pid column
 * @method     ChildVehicleQuery groupByAlive() Group by the alive column
 * @method     ChildVehicleQuery groupByBlacklist() Group by the blacklist column
 * @method     ChildVehicleQuery groupByActive() Group by the active column
 * @method     ChildVehicleQuery groupByPlate() Group by the plate column
 * @method     ChildVehicleQuery groupByPlatestring() Group by the plateString column
 * @method     ChildVehicleQuery groupByColor() Group by the color column
 * @method     ChildVehicleQuery groupByInventory() Group by the inventory column
 * @method     ChildVehicleQuery groupByGear() Group by the gear column
 * @method     ChildVehicleQuery groupByFuel() Group by the fuel column
 * @method     ChildVehicleQuery groupByDamage() Group by the damage column
 * @method     ChildVehicleQuery groupByInsertTime() Group by the insert_time column
 *
 * @method     ChildVehicleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildVehicleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildVehicleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildVehicleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildVehicleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildVehicleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildVehicle findOne(ConnectionInterface $con = null) Return the first ChildVehicle matching the query
 * @method     ChildVehicle findOneOrCreate(ConnectionInterface $con = null) Return the first ChildVehicle matching the query, or a new ChildVehicle object populated from the query conditions when no match is found
 *
 * @method     ChildVehicle findOneById(int $id) Return the first ChildVehicle filtered by the id column
 * @method     ChildVehicle findOneBySide(string $side) Return the first ChildVehicle filtered by the side column
 * @method     ChildVehicle findOneByClassname(string $classname) Return the first ChildVehicle filtered by the classname column
 * @method     ChildVehicle findOneByType(string $type) Return the first ChildVehicle filtered by the type column
 * @method     ChildVehicle findOneByPid(string $pid) Return the first ChildVehicle filtered by the pid column
 * @method     ChildVehicle findOneByAlive(boolean $alive) Return the first ChildVehicle filtered by the alive column
 * @method     ChildVehicle findOneByBlacklist(boolean $blacklist) Return the first ChildVehicle filtered by the blacklist column
 * @method     ChildVehicle findOneByActive(boolean $active) Return the first ChildVehicle filtered by the active column
 * @method     ChildVehicle findOneByPlate(string $plate) Return the first ChildVehicle filtered by the plate column
 * @method     ChildVehicle findOneByPlatestring(string $plateString) Return the first ChildVehicle filtered by the plateString column
 * @method     ChildVehicle findOneByColor(int $color) Return the first ChildVehicle filtered by the color column
 * @method     ChildVehicle findOneByInventory(string $inventory) Return the first ChildVehicle filtered by the inventory column
 * @method     ChildVehicle findOneByGear(string $gear) Return the first ChildVehicle filtered by the gear column
 * @method     ChildVehicle findOneByFuel(double $fuel) Return the first ChildVehicle filtered by the fuel column
 * @method     ChildVehicle findOneByDamage(string $damage) Return the first ChildVehicle filtered by the damage column
 * @method     ChildVehicle findOneByInsertTime(string $insert_time) Return the first ChildVehicle filtered by the insert_time column *

 * @method     ChildVehicle requirePk($key, ConnectionInterface $con = null) Return the ChildVehicle by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOne(ConnectionInterface $con = null) Return the first ChildVehicle matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVehicle requireOneById(int $id) Return the first ChildVehicle filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneBySide(string $side) Return the first ChildVehicle filtered by the side column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByClassname(string $classname) Return the first ChildVehicle filtered by the classname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByType(string $type) Return the first ChildVehicle filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByPid(string $pid) Return the first ChildVehicle filtered by the pid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByAlive(boolean $alive) Return the first ChildVehicle filtered by the alive column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByBlacklist(boolean $blacklist) Return the first ChildVehicle filtered by the blacklist column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByActive(boolean $active) Return the first ChildVehicle filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByPlate(string $plate) Return the first ChildVehicle filtered by the plate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByPlatestring(string $plateString) Return the first ChildVehicle filtered by the plateString column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByColor(int $color) Return the first ChildVehicle filtered by the color column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByInventory(string $inventory) Return the first ChildVehicle filtered by the inventory column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByGear(string $gear) Return the first ChildVehicle filtered by the gear column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByFuel(double $fuel) Return the first ChildVehicle filtered by the fuel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByDamage(string $damage) Return the first ChildVehicle filtered by the damage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildVehicle requireOneByInsertTime(string $insert_time) Return the first ChildVehicle filtered by the insert_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildVehicle[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildVehicle objects based on current ModelCriteria
 * @method     ChildVehicle[]|ObjectCollection findById(int $id) Return ChildVehicle objects filtered by the id column
 * @method     ChildVehicle[]|ObjectCollection findBySide(string $side) Return ChildVehicle objects filtered by the side column
 * @method     ChildVehicle[]|ObjectCollection findByClassname(string $classname) Return ChildVehicle objects filtered by the classname column
 * @method     ChildVehicle[]|ObjectCollection findByType(string $type) Return ChildVehicle objects filtered by the type column
 * @method     ChildVehicle[]|ObjectCollection findByPid(string $pid) Return ChildVehicle objects filtered by the pid column
 * @method     ChildVehicle[]|ObjectCollection findByAlive(boolean $alive) Return ChildVehicle objects filtered by the alive column
 * @method     ChildVehicle[]|ObjectCollection findByBlacklist(boolean $blacklist) Return ChildVehicle objects filtered by the blacklist column
 * @method     ChildVehicle[]|ObjectCollection findByActive(boolean $active) Return ChildVehicle objects filtered by the active column
 * @method     ChildVehicle[]|ObjectCollection findByPlate(string $plate) Return ChildVehicle objects filtered by the plate column
 * @method     ChildVehicle[]|ObjectCollection findByPlatestring(string $plateString) Return ChildVehicle objects filtered by the plateString column
 * @method     ChildVehicle[]|ObjectCollection findByColor(int $color) Return ChildVehicle objects filtered by the color column
 * @method     ChildVehicle[]|ObjectCollection findByInventory(string $inventory) Return ChildVehicle objects filtered by the inventory column
 * @method     ChildVehicle[]|ObjectCollection findByGear(string $gear) Return ChildVehicle objects filtered by the gear column
 * @method     ChildVehicle[]|ObjectCollection findByFuel(double $fuel) Return ChildVehicle objects filtered by the fuel column
 * @method     ChildVehicle[]|ObjectCollection findByDamage(string $damage) Return ChildVehicle objects filtered by the damage column
 * @method     ChildVehicle[]|ObjectCollection findByInsertTime(string $insert_time) Return ChildVehicle objects filtered by the insert_time column
 * @method     ChildVehicle[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class VehicleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Slimworks\Models\ArmaLife\Base\VehicleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'armalife', $modelName = '\\Slimworks\\Models\\ArmaLife\\Vehicle', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildVehicleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildVehicleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildVehicleQuery) {
            return $criteria;
        }
        $query = new ChildVehicleQuery();
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
     * @return ChildVehicle|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(VehicleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = VehicleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildVehicle A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, side, classname, type, pid, alive, blacklist, active, plate, plateString, color, inventory, gear, fuel, damage, insert_time FROM vehicles WHERE id = :p0';
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
            /** @var ChildVehicle $obj */
            $obj = new ChildVehicle();
            $obj->hydrate($row);
            VehicleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildVehicle|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VehicleTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VehicleTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(VehicleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(VehicleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the side column
     *
     * Example usage:
     * <code>
     * $query->filterBySide('fooValue');   // WHERE side = 'fooValue'
     * $query->filterBySide('%fooValue%', Criteria::LIKE); // WHERE side LIKE '%fooValue%'
     * </code>
     *
     * @param     string $side The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterBySide($side = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($side)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_SIDE, $side, $comparison);
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
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByClassname($classname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($classname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_CLASSNAME, $classname, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * Example usage:
     * <code>
     * $query->filterByType('fooValue');   // WHERE type = 'fooValue'
     * $query->filterByType('%fooValue%', Criteria::LIKE); // WHERE type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $type The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($type)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_TYPE, $type, $comparison);
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
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByPid($pid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_PID, $pid, $comparison);
    }

    /**
     * Filter the query on the alive column
     *
     * Example usage:
     * <code>
     * $query->filterByAlive(true); // WHERE alive = true
     * $query->filterByAlive('yes'); // WHERE alive = true
     * </code>
     *
     * @param     boolean|string $alive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByAlive($alive = null, $comparison = null)
    {
        if (is_string($alive)) {
            $alive = in_array(strtolower($alive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VehicleTableMap::COL_ALIVE, $alive, $comparison);
    }

    /**
     * Filter the query on the blacklist column
     *
     * Example usage:
     * <code>
     * $query->filterByBlacklist(true); // WHERE blacklist = true
     * $query->filterByBlacklist('yes'); // WHERE blacklist = true
     * </code>
     *
     * @param     boolean|string $blacklist The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByBlacklist($blacklist = null, $comparison = null)
    {
        if (is_string($blacklist)) {
            $blacklist = in_array(strtolower($blacklist), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VehicleTableMap::COL_BLACKLIST, $blacklist, $comparison);
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
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VehicleTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the plate column
     *
     * Example usage:
     * <code>
     * $query->filterByPlate('fooValue');   // WHERE plate = 'fooValue'
     * $query->filterByPlate('%fooValue%', Criteria::LIKE); // WHERE plate LIKE '%fooValue%'
     * </code>
     *
     * @param     string $plate The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByPlate($plate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($plate)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_PLATE, $plate, $comparison);
    }

    /**
     * Filter the query on the plateString column
     *
     * Example usage:
     * <code>
     * $query->filterByPlatestring('fooValue');   // WHERE plateString = 'fooValue'
     * $query->filterByPlatestring('%fooValue%', Criteria::LIKE); // WHERE plateString LIKE '%fooValue%'
     * </code>
     *
     * @param     string $platestring The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByPlatestring($platestring = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($platestring)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_PLATESTRING, $platestring, $comparison);
    }

    /**
     * Filter the query on the color column
     *
     * Example usage:
     * <code>
     * $query->filterByColor(1234); // WHERE color = 1234
     * $query->filterByColor(array(12, 34)); // WHERE color IN (12, 34)
     * $query->filterByColor(array('min' => 12)); // WHERE color > 12
     * </code>
     *
     * @param     mixed $color The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByColor($color = null, $comparison = null)
    {
        if (is_array($color)) {
            $useMinMax = false;
            if (isset($color['min'])) {
                $this->addUsingAlias(VehicleTableMap::COL_COLOR, $color['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($color['max'])) {
                $this->addUsingAlias(VehicleTableMap::COL_COLOR, $color['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_COLOR, $color, $comparison);
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
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByInventory($inventory = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($inventory)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_INVENTORY, $inventory, $comparison);
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
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByGear($gear = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($gear)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_GEAR, $gear, $comparison);
    }

    /**
     * Filter the query on the fuel column
     *
     * Example usage:
     * <code>
     * $query->filterByFuel(1234); // WHERE fuel = 1234
     * $query->filterByFuel(array(12, 34)); // WHERE fuel IN (12, 34)
     * $query->filterByFuel(array('min' => 12)); // WHERE fuel > 12
     * </code>
     *
     * @param     mixed $fuel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByFuel($fuel = null, $comparison = null)
    {
        if (is_array($fuel)) {
            $useMinMax = false;
            if (isset($fuel['min'])) {
                $this->addUsingAlias(VehicleTableMap::COL_FUEL, $fuel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fuel['max'])) {
                $this->addUsingAlias(VehicleTableMap::COL_FUEL, $fuel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_FUEL, $fuel, $comparison);
    }

    /**
     * Filter the query on the damage column
     *
     * Example usage:
     * <code>
     * $query->filterByDamage('fooValue');   // WHERE damage = 'fooValue'
     * $query->filterByDamage('%fooValue%', Criteria::LIKE); // WHERE damage LIKE '%fooValue%'
     * </code>
     *
     * @param     string $damage The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByDamage($damage = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($damage)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_DAMAGE, $damage, $comparison);
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
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function filterByInsertTime($insertTime = null, $comparison = null)
    {
        if (is_array($insertTime)) {
            $useMinMax = false;
            if (isset($insertTime['min'])) {
                $this->addUsingAlias(VehicleTableMap::COL_INSERT_TIME, $insertTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($insertTime['max'])) {
                $this->addUsingAlias(VehicleTableMap::COL_INSERT_TIME, $insertTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VehicleTableMap::COL_INSERT_TIME, $insertTime, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildVehicle $vehicle Object to remove from the list of results
     *
     * @return $this|ChildVehicleQuery The current query, for fluid interface
     */
    public function prune($vehicle = null)
    {
        if ($vehicle) {
            $this->addUsingAlias(VehicleTableMap::COL_ID, $vehicle->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the vehicles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(VehicleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            VehicleTableMap::clearInstancePool();
            VehicleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(VehicleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(VehicleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            VehicleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            VehicleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // VehicleQuery
