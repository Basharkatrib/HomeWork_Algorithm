<?php
//Bashar Katrib / Ghefar / Bashir / Ayman

class JensSchmidt {
    private $graph;  
    private $number;  
    private $stack;  
    private $points;  
    private $low;  
    private $Stack;  
    private $component;
    private $visited; // New array to track visited vertices
    
    public function __construct($graph) {
        $this->graph = $graph;  
        $this->number = 0;  
        $this->stack = [];  
        $this->points = [];  
        $this->low = [];   
        $this->component = [];
        $this->visited = [];
    }
    
    // Function to find strongly connected components
    public function getStronglyConnectedComponents() {
        foreach (array_keys($this->graph) as $vertex) {
            if (!isset($this->points[$vertex])) {
                $this->tarjanSCC($vertex);
            }
        }
        return $this->component;
    }
    
    // Helper function to initialize arrays
    private function initializeVertex($vertex) {
        $this->points[$vertex] = $this->number;  
        $this->low[$vertex] = $this->number;
        $this->number++;
        array_push($this->stack, $vertex);
        $this->Stack[$vertex] = true;
        $this->visited[$vertex] = true;
    }

    // Bashar Hammad / yousef / Younes / Mjd
    
    // Function to perform Tarjan's Strongly Connected Components Algorithm
    private function tarjanSCC($v) {
        $this->initializeVertex($v);
        
        foreach ($this->graph[$v] as $w) {
            if (!isset($this->points[$w])) {
                $this->tarjanSCC($w);
                $this->low[$v] = min($this->low[$v], $this->low[$w]);
            } elseif ($this->Stack[$w]) {
                $this->low[$v] = min($this->low[$v], $this->points[$w]);
            }
        }
        
        if ($this->low[$v] == $this->points[$v]) {
            $component = [];
            do {
                $w = array_pop($this->stack);
                $component[] = $w;
                $this->Stack[$w] = false;
            } while ($w != $v);
            $this->component[] = $component;
        }
    }

    // Additional function to reset the state of the object
    public function reset() {
        $this->number = 0;
        $this->stack = [];
        $this->points = [];
        $this->low = [];
        $this->Stack = [];
        $this->component = [];
        $this->visited = [];
    }
}

// Usage example
$graph = [
    0 => [1],
    1 => [2],
    2 => [0, 3],
    3 => [4],
    4 => [5],
    5 => [3]
];

$jens = new JensSchmidt($graph);
$scc = $jens->getStronglyConnectedComponents();
print_r($scc);

?>
