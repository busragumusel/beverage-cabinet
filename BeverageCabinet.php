<?php

require_once('Beverage.php');

class BeverageCabinet
{
    const EMPTY_CAPACITY_STATUS = 'EMPTY';
    const FULL_CAPACITY_STATUS = 'FULL';
    const PARTIALLY_CAPACITY_STATUS = 'PARTIALLY';

    private $beverage;
    private $shelveCount = 3;
    private $shelveCapacity = 20;
    private $beverageList = [];
    private $doorStatus = false; // If $doorStatus is false that means door is closed

    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    /**
     * @return int
     */
    public function getShelveCount()
    {
        return $this->shelveCount;
    }

    /**
     * @param int $shelveCount
     */
    public function setShelveCount($shelveCount)
    {
        $this->shelveCount = $shelveCount;
    }

    /**
     * @return int
     */
    public function getShelveCapacity()
    {
        return $this->shelveCapacity;
    }

    /**
     * @param int $shelveCapacity
     */
    public function setShelveCapacity($shelveCapacity)
    {
        $this->shelveCapacity = $shelveCapacity;
    }

    public function getCapacity()
    {
        return $this->shelveCount * $this->shelveCapacity;
    }

    public function addBeverage(Beverage $beverage, $shelveNumber)
    {
        if ($beverage->getName() !== $this->beverage->getName()) {
            return 'This beverage cannot put in this cabinet.';
        }

        if (!$this->doorStatus) {
            return 'Please open the cabinet\'s door.';
        }

        if ($shelveNumber > $this->shelveCount) {
            return $shelveNumber . ' shelve number does not exist.';
        }

        if (!isset($this->beverageList[$shelveNumber])) {
            $this->beverageList[$shelveNumber] = 0;
        }

        if ($this->beverageList[$shelveNumber] == $this->shelveCapacity) {
            $warning = 'This shelve is full.';

            if ($this->getCabinetCapacityStatus() === self::FULL_CAPACITY_STATUS) {
                $warning .= ' And this cabinet is full.';
            }

            return $warning;
        }

        $this->beverageList[$shelveNumber]++;

        return true;
    }

    public function takeBeverage($shelveNumber)
    {
        if (!$this->doorStatus) {
            return 'Please open the cabinet\'s door.';
        }

        if (
            !isset($this->beverageList[$shelveNumber])
            || $this->beverageList[$shelveNumber] == 0
        ) {
            return 'This shelve is empty.';
        }

        $this->beverageList[$shelveNumber]--;

        return true;
    }

    public function getBeverageCount()
    {
        return array_sum($this->beverageList);
    }

    public function getCabinetCapacityStatus()
    {
        $cabinetCapacity = $this->getCapacity();
        $beverageCount = $this->getBeverageCount();

        if ($cabinetCapacity === $beverageCount) {
            return self::FULL_CAPACITY_STATUS;
        } elseif ($beverageCount === 0) {
            return self::EMPTY_CAPACITY_STATUS;
        } else {
            return self::PARTIALLY_CAPACITY_STATUS;
        }
    }

    /**
     * @return bool
     */
    public function getDoorStatus()
    {
        return $this->doorStatus;
    }

    /**
     * @param bool $doorStatus
     */
    public function setDoorStatus($doorStatus)
    {
        $this->doorStatus = $doorStatus;
    }
}
