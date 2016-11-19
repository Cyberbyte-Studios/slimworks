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
use Slimworks\Models\ArmaLife\Player as ChildPlayer;
use Slimworks\Models\ArmaLife\PlayerQuery as ChildPlayerQuery;
use Slimworks\Models\ArmaLife\Map\PlayerTableMap;

/**
 * Base class that represents a query for the 'players' table.
 *
 *
 *
 * @method     ChildPlayerQuery orderByUid($order = Criteria::ASC) Order by the uid column
 * @method     ChildPlayerQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPlayerQuery orderByAliases($order = Criteria::ASC) Order by the aliases column
 * @method     ChildPlayerQuery orderByPlayerid($order = Criteria::ASC) Order by the playerid column
 * @method     ChildPlayerQuery orderByCash($order = Criteria::ASC) Order by the cash column
 * @method     ChildPlayerQuery orderByBankacc($order = Criteria::ASC) Order by the bankacc column
 * @method     ChildPlayerQuery orderByCoplevel($order = Criteria::ASC) Order by the coplevel column
 * @method     ChildPlayerQuery orderByMediclevel($order = Criteria::ASC) Order by the mediclevel column
 * @method     ChildPlayerQuery orderByCivLicenses($order = Criteria::ASC) Order by the civ_licenses column
 * @method     ChildPlayerQuery orderByCopLicenses($order = Criteria::ASC) Order by the cop_licenses column
 * @method     ChildPlayerQuery orderByMedLicenses($order = Criteria::ASC) Order by the med_licenses column
 * @method     ChildPlayerQuery orderByCivGear($order = Criteria::ASC) Order by the civ_gear column
 * @method     ChildPlayerQuery orderByCopGear($order = Criteria::ASC) Order by the cop_gear column
 * @method     ChildPlayerQuery orderByMedGear($order = Criteria::ASC) Order by the med_gear column
 * @method     ChildPlayerQuery orderByCivStats($order = Criteria::ASC) Order by the civ_stats column
 * @method     ChildPlayerQuery orderByCopStats($order = Criteria::ASC) Order by the cop_stats column
 * @method     ChildPlayerQuery orderByMedStats($order = Criteria::ASC) Order by the med_stats column
 * @method     ChildPlayerQuery orderByArrested($order = Criteria::ASC) Order by the arrested column
 * @method     ChildPlayerQuery orderByAdminlevel($order = Criteria::ASC) Order by the adminlevel column
 * @method     ChildPlayerQuery orderByDonorlevel($order = Criteria::ASC) Order by the donorlevel column
 * @method     ChildPlayerQuery orderByBlacklist($order = Criteria::ASC) Order by the blacklist column
 * @method     ChildPlayerQuery orderByCivAlive($order = Criteria::ASC) Order by the civ_alive column
 * @method     ChildPlayerQuery orderByCivPosition($order = Criteria::ASC) Order by the civ_position column
 * @method     ChildPlayerQuery orderByPlaytime($order = Criteria::ASC) Order by the playtime column
 * @method     ChildPlayerQuery orderByInsertTime($order = Criteria::ASC) Order by the insert_time column
 * @method     ChildPlayerQuery orderByLastSeen($order = Criteria::ASC) Order by the last_seen column
 *
 * @method     ChildPlayerQuery groupByUid() Group by the uid column
 * @method     ChildPlayerQuery groupByName() Group by the name column
 * @method     ChildPlayerQuery groupByAliases() Group by the aliases column
 * @method     ChildPlayerQuery groupByPlayerid() Group by the playerid column
 * @method     ChildPlayerQuery groupByCash() Group by the cash column
 * @method     ChildPlayerQuery groupByBankacc() Group by the bankacc column
 * @method     ChildPlayerQuery groupByCoplevel() Group by the coplevel column
 * @method     ChildPlayerQuery groupByMediclevel() Group by the mediclevel column
 * @method     ChildPlayerQuery groupByCivLicenses() Group by the civ_licenses column
 * @method     ChildPlayerQuery groupByCopLicenses() Group by the cop_licenses column
 * @method     ChildPlayerQuery groupByMedLicenses() Group by the med_licenses column
 * @method     ChildPlayerQuery groupByCivGear() Group by the civ_gear column
 * @method     ChildPlayerQuery groupByCopGear() Group by the cop_gear column
 * @method     ChildPlayerQuery groupByMedGear() Group by the med_gear column
 * @method     ChildPlayerQuery groupByCivStats() Group by the civ_stats column
 * @method     ChildPlayerQuery groupByCopStats() Group by the cop_stats column
 * @method     ChildPlayerQuery groupByMedStats() Group by the med_stats column
 * @method     ChildPlayerQuery groupByArrested() Group by the arrested column
 * @method     ChildPlayerQuery groupByAdminlevel() Group by the adminlevel column
 * @method     ChildPlayerQuery groupByDonorlevel() Group by the donorlevel column
 * @method     ChildPlayerQuery groupByBlacklist() Group by the blacklist column
 * @method     ChildPlayerQuery groupByCivAlive() Group by the civ_alive column
 * @method     ChildPlayerQuery groupByCivPosition() Group by the civ_position column
 * @method     ChildPlayerQuery groupByPlaytime() Group by the playtime column
 * @method     ChildPlayerQuery groupByInsertTime() Group by the insert_time column
 * @method     ChildPlayerQuery groupByLastSeen() Group by the last_seen column
 *
 * @method     ChildPlayerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPlayerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPlayerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPlayerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPlayerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPlayerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPlayer findOne(ConnectionInterface $con = null) Return the first ChildPlayer matching the query
 * @method     ChildPlayer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPlayer matching the query, or a new ChildPlayer object populated from the query conditions when no match is found
 *
 * @method     ChildPlayer findOneByUid(int $uid) Return the first ChildPlayer filtered by the uid column
 * @method     ChildPlayer findOneByName(string $name) Return the first ChildPlayer filtered by the name column
 * @method     ChildPlayer findOneByAliases(string $aliases) Return the first ChildPlayer filtered by the aliases column
 * @method     ChildPlayer findOneByPlayerid(string $playerid) Return the first ChildPlayer filtered by the playerid column
 * @method     ChildPlayer findOneByCash(int $cash) Return the first ChildPlayer filtered by the cash column
 * @method     ChildPlayer findOneByBankacc(int $bankacc) Return the first ChildPlayer filtered by the bankacc column
 * @method     ChildPlayer findOneByCoplevel(string $coplevel) Return the first ChildPlayer filtered by the coplevel column
 * @method     ChildPlayer findOneByMediclevel(string $mediclevel) Return the first ChildPlayer filtered by the mediclevel column
 * @method     ChildPlayer findOneByCivLicenses(string $civ_licenses) Return the first ChildPlayer filtered by the civ_licenses column
 * @method     ChildPlayer findOneByCopLicenses(string $cop_licenses) Return the first ChildPlayer filtered by the cop_licenses column
 * @method     ChildPlayer findOneByMedLicenses(string $med_licenses) Return the first ChildPlayer filtered by the med_licenses column
 * @method     ChildPlayer findOneByCivGear(string $civ_gear) Return the first ChildPlayer filtered by the civ_gear column
 * @method     ChildPlayer findOneByCopGear(string $cop_gear) Return the first ChildPlayer filtered by the cop_gear column
 * @method     ChildPlayer findOneByMedGear(string $med_gear) Return the first ChildPlayer filtered by the med_gear column
 * @method     ChildPlayer findOneByCivStats(string $civ_stats) Return the first ChildPlayer filtered by the civ_stats column
 * @method     ChildPlayer findOneByCopStats(string $cop_stats) Return the first ChildPlayer filtered by the cop_stats column
 * @method     ChildPlayer findOneByMedStats(string $med_stats) Return the first ChildPlayer filtered by the med_stats column
 * @method     ChildPlayer findOneByArrested(boolean $arrested) Return the first ChildPlayer filtered by the arrested column
 * @method     ChildPlayer findOneByAdminlevel(string $adminlevel) Return the first ChildPlayer filtered by the adminlevel column
 * @method     ChildPlayer findOneByDonorlevel(string $donorlevel) Return the first ChildPlayer filtered by the donorlevel column
 * @method     ChildPlayer findOneByBlacklist(boolean $blacklist) Return the first ChildPlayer filtered by the blacklist column
 * @method     ChildPlayer findOneByCivAlive(boolean $civ_alive) Return the first ChildPlayer filtered by the civ_alive column
 * @method     ChildPlayer findOneByCivPosition(string $civ_position) Return the first ChildPlayer filtered by the civ_position column
 * @method     ChildPlayer findOneByPlaytime(string $playtime) Return the first ChildPlayer filtered by the playtime column
 * @method     ChildPlayer findOneByInsertTime(string $insert_time) Return the first ChildPlayer filtered by the insert_time column
 * @method     ChildPlayer findOneByLastSeen(string $last_seen) Return the first ChildPlayer filtered by the last_seen column *

 * @method     ChildPlayer requirePk($key, ConnectionInterface $con = null) Return the ChildPlayer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOne(ConnectionInterface $con = null) Return the first ChildPlayer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPlayer requireOneByUid(int $uid) Return the first ChildPlayer filtered by the uid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByName(string $name) Return the first ChildPlayer filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByAliases(string $aliases) Return the first ChildPlayer filtered by the aliases column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByPlayerid(string $playerid) Return the first ChildPlayer filtered by the playerid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByCash(int $cash) Return the first ChildPlayer filtered by the cash column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByBankacc(int $bankacc) Return the first ChildPlayer filtered by the bankacc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByCoplevel(string $coplevel) Return the first ChildPlayer filtered by the coplevel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByMediclevel(string $mediclevel) Return the first ChildPlayer filtered by the mediclevel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByCivLicenses(string $civ_licenses) Return the first ChildPlayer filtered by the civ_licenses column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByCopLicenses(string $cop_licenses) Return the first ChildPlayer filtered by the cop_licenses column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByMedLicenses(string $med_licenses) Return the first ChildPlayer filtered by the med_licenses column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByCivGear(string $civ_gear) Return the first ChildPlayer filtered by the civ_gear column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByCopGear(string $cop_gear) Return the first ChildPlayer filtered by the cop_gear column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByMedGear(string $med_gear) Return the first ChildPlayer filtered by the med_gear column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByCivStats(string $civ_stats) Return the first ChildPlayer filtered by the civ_stats column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByCopStats(string $cop_stats) Return the first ChildPlayer filtered by the cop_stats column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByMedStats(string $med_stats) Return the first ChildPlayer filtered by the med_stats column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByArrested(boolean $arrested) Return the first ChildPlayer filtered by the arrested column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByAdminlevel(string $adminlevel) Return the first ChildPlayer filtered by the adminlevel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByDonorlevel(string $donorlevel) Return the first ChildPlayer filtered by the donorlevel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByBlacklist(boolean $blacklist) Return the first ChildPlayer filtered by the blacklist column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByCivAlive(boolean $civ_alive) Return the first ChildPlayer filtered by the civ_alive column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByCivPosition(string $civ_position) Return the first ChildPlayer filtered by the civ_position column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByPlaytime(string $playtime) Return the first ChildPlayer filtered by the playtime column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByInsertTime(string $insert_time) Return the first ChildPlayer filtered by the insert_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPlayer requireOneByLastSeen(string $last_seen) Return the first ChildPlayer filtered by the last_seen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPlayer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPlayer objects based on current ModelCriteria
 * @method     ChildPlayer[]|ObjectCollection findByUid(int $uid) Return ChildPlayer objects filtered by the uid column
 * @method     ChildPlayer[]|ObjectCollection findByName(string $name) Return ChildPlayer objects filtered by the name column
 * @method     ChildPlayer[]|ObjectCollection findByAliases(string $aliases) Return ChildPlayer objects filtered by the aliases column
 * @method     ChildPlayer[]|ObjectCollection findByPlayerid(string $playerid) Return ChildPlayer objects filtered by the playerid column
 * @method     ChildPlayer[]|ObjectCollection findByCash(int $cash) Return ChildPlayer objects filtered by the cash column
 * @method     ChildPlayer[]|ObjectCollection findByBankacc(int $bankacc) Return ChildPlayer objects filtered by the bankacc column
 * @method     ChildPlayer[]|ObjectCollection findByCoplevel(string $coplevel) Return ChildPlayer objects filtered by the coplevel column
 * @method     ChildPlayer[]|ObjectCollection findByMediclevel(string $mediclevel) Return ChildPlayer objects filtered by the mediclevel column
 * @method     ChildPlayer[]|ObjectCollection findByCivLicenses(string $civ_licenses) Return ChildPlayer objects filtered by the civ_licenses column
 * @method     ChildPlayer[]|ObjectCollection findByCopLicenses(string $cop_licenses) Return ChildPlayer objects filtered by the cop_licenses column
 * @method     ChildPlayer[]|ObjectCollection findByMedLicenses(string $med_licenses) Return ChildPlayer objects filtered by the med_licenses column
 * @method     ChildPlayer[]|ObjectCollection findByCivGear(string $civ_gear) Return ChildPlayer objects filtered by the civ_gear column
 * @method     ChildPlayer[]|ObjectCollection findByCopGear(string $cop_gear) Return ChildPlayer objects filtered by the cop_gear column
 * @method     ChildPlayer[]|ObjectCollection findByMedGear(string $med_gear) Return ChildPlayer objects filtered by the med_gear column
 * @method     ChildPlayer[]|ObjectCollection findByCivStats(string $civ_stats) Return ChildPlayer objects filtered by the civ_stats column
 * @method     ChildPlayer[]|ObjectCollection findByCopStats(string $cop_stats) Return ChildPlayer objects filtered by the cop_stats column
 * @method     ChildPlayer[]|ObjectCollection findByMedStats(string $med_stats) Return ChildPlayer objects filtered by the med_stats column
 * @method     ChildPlayer[]|ObjectCollection findByArrested(boolean $arrested) Return ChildPlayer objects filtered by the arrested column
 * @method     ChildPlayer[]|ObjectCollection findByAdminlevel(string $adminlevel) Return ChildPlayer objects filtered by the adminlevel column
 * @method     ChildPlayer[]|ObjectCollection findByDonorlevel(string $donorlevel) Return ChildPlayer objects filtered by the donorlevel column
 * @method     ChildPlayer[]|ObjectCollection findByBlacklist(boolean $blacklist) Return ChildPlayer objects filtered by the blacklist column
 * @method     ChildPlayer[]|ObjectCollection findByCivAlive(boolean $civ_alive) Return ChildPlayer objects filtered by the civ_alive column
 * @method     ChildPlayer[]|ObjectCollection findByCivPosition(string $civ_position) Return ChildPlayer objects filtered by the civ_position column
 * @method     ChildPlayer[]|ObjectCollection findByPlaytime(string $playtime) Return ChildPlayer objects filtered by the playtime column
 * @method     ChildPlayer[]|ObjectCollection findByInsertTime(string $insert_time) Return ChildPlayer objects filtered by the insert_time column
 * @method     ChildPlayer[]|ObjectCollection findByLastSeen(string $last_seen) Return ChildPlayer objects filtered by the last_seen column
 * @method     ChildPlayer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PlayerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Slimworks\Models\ArmaLife\Base\PlayerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'armalife', $modelName = '\\Slimworks\\Models\\ArmaLife\\Player', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPlayerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPlayerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPlayerQuery) {
            return $criteria;
        }
        $query = new ChildPlayerQuery();
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
     * @return ChildPlayer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PlayerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PlayerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPlayer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uid, name, aliases, playerid, cash, bankacc, coplevel, mediclevel, civ_licenses, cop_licenses, med_licenses, civ_gear, cop_gear, med_gear, civ_stats, cop_stats, med_stats, arrested, adminlevel, donorlevel, blacklist, civ_alive, civ_position, playtime, insert_time, last_seen FROM players WHERE uid = :p0';
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
            /** @var ChildPlayer $obj */
            $obj = new ChildPlayer();
            $obj->hydrate($row);
            PlayerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPlayer|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PlayerTableMap::COL_UID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PlayerTableMap::COL_UID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the uid column
     *
     * Example usage:
     * <code>
     * $query->filterByUid(1234); // WHERE uid = 1234
     * $query->filterByUid(array(12, 34)); // WHERE uid IN (12, 34)
     * $query->filterByUid(array('min' => 12)); // WHERE uid > 12
     * </code>
     *
     * @param     mixed $uid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByUid($uid = null, $comparison = null)
    {
        if (is_array($uid)) {
            $useMinMax = false;
            if (isset($uid['min'])) {
                $this->addUsingAlias(PlayerTableMap::COL_UID, $uid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($uid['max'])) {
                $this->addUsingAlias(PlayerTableMap::COL_UID, $uid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_UID, $uid, $comparison);
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
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the aliases column
     *
     * Example usage:
     * <code>
     * $query->filterByAliases('fooValue');   // WHERE aliases = 'fooValue'
     * $query->filterByAliases('%fooValue%', Criteria::LIKE); // WHERE aliases LIKE '%fooValue%'
     * </code>
     *
     * @param     string $aliases The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByAliases($aliases = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($aliases)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_ALIASES, $aliases, $comparison);
    }

    /**
     * Filter the query on the playerid column
     *
     * Example usage:
     * <code>
     * $query->filterByPlayerid('fooValue');   // WHERE playerid = 'fooValue'
     * $query->filterByPlayerid('%fooValue%', Criteria::LIKE); // WHERE playerid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $playerid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByPlayerid($playerid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($playerid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_PLAYERID, $playerid, $comparison);
    }

    /**
     * Filter the query on the cash column
     *
     * Example usage:
     * <code>
     * $query->filterByCash(1234); // WHERE cash = 1234
     * $query->filterByCash(array(12, 34)); // WHERE cash IN (12, 34)
     * $query->filterByCash(array('min' => 12)); // WHERE cash > 12
     * </code>
     *
     * @param     mixed $cash The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByCash($cash = null, $comparison = null)
    {
        if (is_array($cash)) {
            $useMinMax = false;
            if (isset($cash['min'])) {
                $this->addUsingAlias(PlayerTableMap::COL_CASH, $cash['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cash['max'])) {
                $this->addUsingAlias(PlayerTableMap::COL_CASH, $cash['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_CASH, $cash, $comparison);
    }

    /**
     * Filter the query on the bankacc column
     *
     * Example usage:
     * <code>
     * $query->filterByBankacc(1234); // WHERE bankacc = 1234
     * $query->filterByBankacc(array(12, 34)); // WHERE bankacc IN (12, 34)
     * $query->filterByBankacc(array('min' => 12)); // WHERE bankacc > 12
     * </code>
     *
     * @param     mixed $bankacc The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByBankacc($bankacc = null, $comparison = null)
    {
        if (is_array($bankacc)) {
            $useMinMax = false;
            if (isset($bankacc['min'])) {
                $this->addUsingAlias(PlayerTableMap::COL_BANKACC, $bankacc['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bankacc['max'])) {
                $this->addUsingAlias(PlayerTableMap::COL_BANKACC, $bankacc['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_BANKACC, $bankacc, $comparison);
    }

    /**
     * Filter the query on the coplevel column
     *
     * Example usage:
     * <code>
     * $query->filterByCoplevel('fooValue');   // WHERE coplevel = 'fooValue'
     * $query->filterByCoplevel('%fooValue%', Criteria::LIKE); // WHERE coplevel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $coplevel The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByCoplevel($coplevel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($coplevel)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_COPLEVEL, $coplevel, $comparison);
    }

    /**
     * Filter the query on the mediclevel column
     *
     * Example usage:
     * <code>
     * $query->filterByMediclevel('fooValue');   // WHERE mediclevel = 'fooValue'
     * $query->filterByMediclevel('%fooValue%', Criteria::LIKE); // WHERE mediclevel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $mediclevel The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByMediclevel($mediclevel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($mediclevel)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_MEDICLEVEL, $mediclevel, $comparison);
    }

    /**
     * Filter the query on the civ_licenses column
     *
     * Example usage:
     * <code>
     * $query->filterByCivLicenses('fooValue');   // WHERE civ_licenses = 'fooValue'
     * $query->filterByCivLicenses('%fooValue%', Criteria::LIKE); // WHERE civ_licenses LIKE '%fooValue%'
     * </code>
     *
     * @param     string $civLicenses The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByCivLicenses($civLicenses = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($civLicenses)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_CIV_LICENSES, $civLicenses, $comparison);
    }

    /**
     * Filter the query on the cop_licenses column
     *
     * Example usage:
     * <code>
     * $query->filterByCopLicenses('fooValue');   // WHERE cop_licenses = 'fooValue'
     * $query->filterByCopLicenses('%fooValue%', Criteria::LIKE); // WHERE cop_licenses LIKE '%fooValue%'
     * </code>
     *
     * @param     string $copLicenses The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByCopLicenses($copLicenses = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($copLicenses)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_COP_LICENSES, $copLicenses, $comparison);
    }

    /**
     * Filter the query on the med_licenses column
     *
     * Example usage:
     * <code>
     * $query->filterByMedLicenses('fooValue');   // WHERE med_licenses = 'fooValue'
     * $query->filterByMedLicenses('%fooValue%', Criteria::LIKE); // WHERE med_licenses LIKE '%fooValue%'
     * </code>
     *
     * @param     string $medLicenses The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByMedLicenses($medLicenses = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($medLicenses)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_MED_LICENSES, $medLicenses, $comparison);
    }

    /**
     * Filter the query on the civ_gear column
     *
     * Example usage:
     * <code>
     * $query->filterByCivGear('fooValue');   // WHERE civ_gear = 'fooValue'
     * $query->filterByCivGear('%fooValue%', Criteria::LIKE); // WHERE civ_gear LIKE '%fooValue%'
     * </code>
     *
     * @param     string $civGear The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByCivGear($civGear = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($civGear)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_CIV_GEAR, $civGear, $comparison);
    }

    /**
     * Filter the query on the cop_gear column
     *
     * Example usage:
     * <code>
     * $query->filterByCopGear('fooValue');   // WHERE cop_gear = 'fooValue'
     * $query->filterByCopGear('%fooValue%', Criteria::LIKE); // WHERE cop_gear LIKE '%fooValue%'
     * </code>
     *
     * @param     string $copGear The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByCopGear($copGear = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($copGear)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_COP_GEAR, $copGear, $comparison);
    }

    /**
     * Filter the query on the med_gear column
     *
     * Example usage:
     * <code>
     * $query->filterByMedGear('fooValue');   // WHERE med_gear = 'fooValue'
     * $query->filterByMedGear('%fooValue%', Criteria::LIKE); // WHERE med_gear LIKE '%fooValue%'
     * </code>
     *
     * @param     string $medGear The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByMedGear($medGear = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($medGear)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_MED_GEAR, $medGear, $comparison);
    }

    /**
     * Filter the query on the civ_stats column
     *
     * Example usage:
     * <code>
     * $query->filterByCivStats('fooValue');   // WHERE civ_stats = 'fooValue'
     * $query->filterByCivStats('%fooValue%', Criteria::LIKE); // WHERE civ_stats LIKE '%fooValue%'
     * </code>
     *
     * @param     string $civStats The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByCivStats($civStats = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($civStats)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_CIV_STATS, $civStats, $comparison);
    }

    /**
     * Filter the query on the cop_stats column
     *
     * Example usage:
     * <code>
     * $query->filterByCopStats('fooValue');   // WHERE cop_stats = 'fooValue'
     * $query->filterByCopStats('%fooValue%', Criteria::LIKE); // WHERE cop_stats LIKE '%fooValue%'
     * </code>
     *
     * @param     string $copStats The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByCopStats($copStats = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($copStats)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_COP_STATS, $copStats, $comparison);
    }

    /**
     * Filter the query on the med_stats column
     *
     * Example usage:
     * <code>
     * $query->filterByMedStats('fooValue');   // WHERE med_stats = 'fooValue'
     * $query->filterByMedStats('%fooValue%', Criteria::LIKE); // WHERE med_stats LIKE '%fooValue%'
     * </code>
     *
     * @param     string $medStats The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByMedStats($medStats = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($medStats)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_MED_STATS, $medStats, $comparison);
    }

    /**
     * Filter the query on the arrested column
     *
     * Example usage:
     * <code>
     * $query->filterByArrested(true); // WHERE arrested = true
     * $query->filterByArrested('yes'); // WHERE arrested = true
     * </code>
     *
     * @param     boolean|string $arrested The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByArrested($arrested = null, $comparison = null)
    {
        if (is_string($arrested)) {
            $arrested = in_array(strtolower($arrested), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PlayerTableMap::COL_ARRESTED, $arrested, $comparison);
    }

    /**
     * Filter the query on the adminlevel column
     *
     * Example usage:
     * <code>
     * $query->filterByAdminlevel('fooValue');   // WHERE adminlevel = 'fooValue'
     * $query->filterByAdminlevel('%fooValue%', Criteria::LIKE); // WHERE adminlevel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $adminlevel The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByAdminlevel($adminlevel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($adminlevel)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_ADMINLEVEL, $adminlevel, $comparison);
    }

    /**
     * Filter the query on the donorlevel column
     *
     * Example usage:
     * <code>
     * $query->filterByDonorlevel('fooValue');   // WHERE donorlevel = 'fooValue'
     * $query->filterByDonorlevel('%fooValue%', Criteria::LIKE); // WHERE donorlevel LIKE '%fooValue%'
     * </code>
     *
     * @param     string $donorlevel The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByDonorlevel($donorlevel = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($donorlevel)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_DONORLEVEL, $donorlevel, $comparison);
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
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByBlacklist($blacklist = null, $comparison = null)
    {
        if (is_string($blacklist)) {
            $blacklist = in_array(strtolower($blacklist), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PlayerTableMap::COL_BLACKLIST, $blacklist, $comparison);
    }

    /**
     * Filter the query on the civ_alive column
     *
     * Example usage:
     * <code>
     * $query->filterByCivAlive(true); // WHERE civ_alive = true
     * $query->filterByCivAlive('yes'); // WHERE civ_alive = true
     * </code>
     *
     * @param     boolean|string $civAlive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByCivAlive($civAlive = null, $comparison = null)
    {
        if (is_string($civAlive)) {
            $civAlive = in_array(strtolower($civAlive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PlayerTableMap::COL_CIV_ALIVE, $civAlive, $comparison);
    }

    /**
     * Filter the query on the civ_position column
     *
     * Example usage:
     * <code>
     * $query->filterByCivPosition('fooValue');   // WHERE civ_position = 'fooValue'
     * $query->filterByCivPosition('%fooValue%', Criteria::LIKE); // WHERE civ_position LIKE '%fooValue%'
     * </code>
     *
     * @param     string $civPosition The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByCivPosition($civPosition = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($civPosition)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_CIV_POSITION, $civPosition, $comparison);
    }

    /**
     * Filter the query on the playtime column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaytime('fooValue');   // WHERE playtime = 'fooValue'
     * $query->filterByPlaytime('%fooValue%', Criteria::LIKE); // WHERE playtime LIKE '%fooValue%'
     * </code>
     *
     * @param     string $playtime The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByPlaytime($playtime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($playtime)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_PLAYTIME, $playtime, $comparison);
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
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByInsertTime($insertTime = null, $comparison = null)
    {
        if (is_array($insertTime)) {
            $useMinMax = false;
            if (isset($insertTime['min'])) {
                $this->addUsingAlias(PlayerTableMap::COL_INSERT_TIME, $insertTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($insertTime['max'])) {
                $this->addUsingAlias(PlayerTableMap::COL_INSERT_TIME, $insertTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_INSERT_TIME, $insertTime, $comparison);
    }

    /**
     * Filter the query on the last_seen column
     *
     * Example usage:
     * <code>
     * $query->filterByLastSeen('2011-03-14'); // WHERE last_seen = '2011-03-14'
     * $query->filterByLastSeen('now'); // WHERE last_seen = '2011-03-14'
     * $query->filterByLastSeen(array('max' => 'yesterday')); // WHERE last_seen > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastSeen The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function filterByLastSeen($lastSeen = null, $comparison = null)
    {
        if (is_array($lastSeen)) {
            $useMinMax = false;
            if (isset($lastSeen['min'])) {
                $this->addUsingAlias(PlayerTableMap::COL_LAST_SEEN, $lastSeen['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastSeen['max'])) {
                $this->addUsingAlias(PlayerTableMap::COL_LAST_SEEN, $lastSeen['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayerTableMap::COL_LAST_SEEN, $lastSeen, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPlayer $player Object to remove from the list of results
     *
     * @return $this|ChildPlayerQuery The current query, for fluid interface
     */
    public function prune($player = null)
    {
        if ($player) {
            $this->addUsingAlias(PlayerTableMap::COL_UID, $player->getUid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the players table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PlayerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PlayerTableMap::clearInstancePool();
            PlayerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PlayerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PlayerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PlayerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PlayerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PlayerQuery
