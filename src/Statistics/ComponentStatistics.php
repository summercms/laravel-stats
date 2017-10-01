<?php

namespace Wnx\LaravelStats\Statistics;

use Wnx\LaravelStats\Analyzers\ClassMethodsAnalyzer;
use Wnx\LaravelStats\Component;
use Wnx\LaravelStats\Statistics\ClassStatistics;

class ComponentStatistics
{
    /**
     * @var Wnx\LaravelStats\Component
     */
    public $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    /**
     * Generate Statistics Array for the given Component
     * @return array
     */
    public function getAsArray() : array
    {
        return [
            'component'         => $this->component->getName(),
            'lines'             => $this->getLines(),
            'loc'               => $this->getLinesOfCode(),
            'number_of_classes' => $this->getNumberOfClasses(),
            'methods'           => $this->getNumberOfMethods(),
            'methods_per_class' => $this->getNumberOfMethodsPerClass(),
            'loc_per_method'    => $this->getLinesOfCodePerMethod()
        ];
    }

    /**
     * Return the total number of Classes declared for this component
     * @return int
     */
    public function getNumberOfClasses() : int
    {
        return count($this->component->getClasses());
    }

    /**
     * Return the total number of Methods declared over all declared classes
     * @return int
     */
    public function getNumberOfMethods() : int
    {
        $methods = 0;

        foreach($this->component->getClasses() as $reflection) {

            $classStats = new ClassStatistics($reflection);
            $methods += $classStats->getNumberOfMethods();
        }

        return $methods;
    }

    /**
     * Return the average number of methods per class
     * @return float
     */
    public function getNumberOfMethodsPerClass() : float
    {
        return round($this->getNumberOfMethods() / $this->getNumberOfClasses(), 2);
    }

    /**
     * Return the total number of lines
     * @return int
     */
    public function getLines() : int
    {
        return 0;
    }

    /**
     * Return the total number of lines of code
     * @return int
     */
    public function getLinesOfCode() : float
    {
        return 0;
    }

    /**
     * Return the average number of lines of code per method
     * @return float
     */
    public function getLinesOfCodePerMethod() : float
    {
        return 0;
    }
}
